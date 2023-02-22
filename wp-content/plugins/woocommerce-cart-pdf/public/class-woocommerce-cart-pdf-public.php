<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://woocommerce-cart-pdf.db-dzine.de
 * @since      1.0.0
 *
 * @package    woocommerce_cart_pdf
 * @subpackage woocommerce_cart_pdf/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    woocommerce_cart_pdf
 * @subpackage woocommerce_cart_pdf/public
 * @author     Daniel Barenkamp <contact@db-dzine.de>
 */
class WooCommerce_Cart_PDF_Public extends WooCommerce_Cart_PDF {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options
	 */
	protected $options;

	/**
	 * Product URL
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $url
	 */
	private $url;

	/**
	 * category
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $category
	 */
	private $category;

	/**
	 * category
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $category
	 */
	private $current_category_id;

	/**
	 * Product
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $product
	 */
	private $product;

	/**
	 * Post
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $post
	 */
	private $post;

	/**
	 * Data
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      mixed    $data
	 */
	private $data;

	/**
	 * mpdf
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      mixed    $mpdf
	 */
	protected $mpdf;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->data = new stdClass;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() 
	{
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-cart-pdf-public.css', array(), $this->version, 'all' );
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0', 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() 
	{
		global $woocommerce_cart_pdf_options;
		$this->options = $woocommerce_cart_pdf_options;

		if($this->get_option('sendCartEMail')) {
			wp_enqueue_script( $this->plugin_name.'-public', plugin_dir_url( __FILE__ ) . 'js/woocommerce-cart-pdf-public.js', array( 'jquery' ), $this->version, true );
		}

	    $forJS['ajax_url'] = admin_url('admin-ajax.php');
        $forJS['sendCartEMailSuccessText'] = $this->get_option('sendCartEMailSuccessText');
               
        wp_localize_script($this->plugin_name . '-public', 'woocommerce_cart_pdf_options', $forJS);
	}
	
	/**
	 * Init Cart PDF 
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://welaunch.io
	 * @return  [type]                       [description]
	 */
    public function init()
    {
		global $woocommerce_cart_pdf_options;
		$this->options = $woocommerce_cart_pdf_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		// Enable User check
		if($this->get_option('enableLimitAccess')) {
			$roles = $this->get_option('role');
			if(empty($roles)) {
				$roles[] = 'administrator';
			}

			$currentUserRole = $this->get_user_role();

			if(!in_array($currentUserRole, $roles)) {
				return FALSE;
			}
		}

		$actual_link = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		if( strpos($actual_link, '?') === FALSE ){ 
			$this->url = $actual_link . '?'; 
		} else {
		 	$this->url = $actual_link . '&'; 
		}
		

		$cartLinkPosition = $this->get_option('cartLinkPosition');
		add_action( $cartLinkPosition, array($this, 'show_export_cart_buttons'), 90 );

		if($this->get_option('sendCartEMail')) { 
			add_action( 'wp_footer', array($this, 'send_cart_email_popup'), 20 );
		}

		if(isset($_GET['cart-pdf'])) {
			add_action("wp", array($this, 'watch'));
		}
    }

    /**
     * Show Cart Export Button
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://welaunch.io
     * @return  [type]                       [description]
     */
    public function show_export_cart_buttons()
    {
		if(!is_cart()) {
			return false;
		}

		$cartBtnText = $this->get_option('cartBtnText');
		$sendCartEMailButtonText = $this->get_option('sendCartEMailButtonText');

    	echo '<div class="woocommerce-cart-pdf link-wrapper">';
		
			if($this->get_option('showCartCatalogLink')) {
				echo '<a href="' . $this->url . 'cart-pdf=true" class="woocommerce_cart_pdf_button button alt" target="_blank"><i class="fa fa-file-pdf-o fa-1x "></i>  ' . $cartBtnText . '</a>';	
			}
			
			if($this->get_option('sendCartEMail')) {
				echo '<a href="#" class="woocommerce-cart-pdf-email-button button alt"><i class="fa fa-envelope fa-1x "></i>  ' . $sendCartEMailButtonText . '</a>';	
			}

    	echo '</div>';
    }

    /**
     * Watch Cart PDF Generation to start?
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://welaunch.io
     * @return  [type]                       [description]
     */
    public function watch()
    {
    	// default Variables
		$this->data->blog_name = get_bloginfo('name');
		$this->data->blog_description  = get_bloginfo('description');

		if(!empty($_GET['cart-pdf']))
		{
			try {
				$this->build_pdf();
	    	} catch (Exception $e) {
	    		echo $e->getMessage();
	    	}
		}
	}

	/**
	 * Build the PDF
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://welaunch.io
	 * @return  [type]                       [description]
	 */
    public function build_pdf($write = false)
    {
    	$this->mpdf = $this->get_mpdf();

		$html = "";
		
		$filename = 'cart';
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	  		$filename = $filename . '-' . ICL_LANGUAGE_CODE;
		}

		$this->mpdf->SetTitle( htmlspecialchars( ucfirst($filename) . ' ' . __(' PDF', 'woocommerce-cart-pdf'), ENT_QUOTES));

		// Check Cover Page
		$this->showCoverPage = false;
		if($this->get_option('enableCover')) {
			$this->showCoverPage = true;
			$html .= $this->get_cover();
		}	

		// Get Custom CSS
		$css = $this->build_CSS();

		// Set Header
		if($this->get_option('enableHeader'))
		{
			$header = $this->get_header();
			$this->mpdf->DefHTMLHeaderByName('defaultHeader', $header);

			if($this->showCoverPage) {
				// $this->mpdf->SetHTMLHeaderByName('defaultHeader', 0, false);
			} else {
				$this->mpdf->SetHTMLHeaderByName('defaultHeader');
			}
		}

		// Set Footer
		if($this->get_option('enableFooter'))
		{
			$footer = $this->get_footer();
			$this->mpdf->DefHTMLFooterByName('defaultFooter', $footer);

			if($this->showCoverPage) {
				$this->mpdf->SetHTMLFooterByName('defaultFooter', 0, false);
			} else {
				$this->mpdf->SetHTMLFooterByName('defaultFooter');
			}
		}
		
		if($this->get_option('enableTextBeforeProducts'))
		{
			$html .= $this->get_text_before_products();
		}
		
		$html .= $this->get_cart_html();

		if($this->get_option('enableTextAfterProducts')) {
			$html .= $this->get_text_after_products();
		}

        // Check Backcover Page
        if($this->get_option('enableBackcover')) {
            $html .= $this->get_backcover();
        }   

		$debugMode = $this->get_option('debugMode');
		if($debugMode === "1") {
			die($css.$html);
		}

		$html = '<div class="frame">' . $html . '</div>';



		$this->mpdf->WriteHTML($css.$html);

		$this->mpdf->useAdobeCJK = true;
		$this->mpdf->autoScriptToLang = true;
		$this->mpdf->autoLangToFont = true;
		$this->mpdf->shrink_tables_to_fit = 1;

		if($write) {
			$folder = $this->get_uploads_dir( 'woocommerce-cart-pdfs' );
			if ( ! file_exists( $folder ) ) {
				mkdir( $folder, 0775, true );
			}

			$filePath = $folder . $filename.'.pdf';
			$this->mpdf->Output($filePath, 'F');	
			return $filePath;
		} else {
			$this->mpdf->Output($filename.'.pdf', 'I');	
			exit;
		}
    }

    protected function get_mpdf()
    {
    	if(!class_exists('\Mpdf\Mpdf')) return FALSE;

    	require_once(plugin_dir_path( dirname( __FILE__ ) ) . 'fonts/customFonts.php');

    	$headerTopMargin = $this->get_option('headerTopMargin');
    	$footerTopMargin = $this->get_option('footerTopMargin');

    	$format = $this->get_option('format') ? $this->get_option('format') : 'A4' ;
    	$orientation = $this->get_option('orientation') ? $this->get_option('orientation') : 'P';

    	$fontFamily = $this->get_option('fontFamily') ? $this->get_option('fontFamily') : 'dejavusans';

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$mpdfConfig = array(
			'mode' => 'utf-8', 
			'format' => $format,    // format - A4, for example, default ''
			'default_font_size' => 0,     // font size - default 0
			'default_font' => $fontFamily,    // default font family
			'margin_left' => 0,    	// 15 margin_left
			'margin_right' => 0,    	// 15 margin right
			'margin_top' => $headerTopMargin,     // 16 margin top
			'margin_bottom' => $footerTopMargin,    	// margin bottom
			'margin_header' => 0,     // 9 margin header
			'margin_footer' => 0,     // 9 margin footer
			'orientation' => $orientation,  	// L - landscape, P - portrait
			'tempDir' => plugin_dir_path( dirname( __FILE__ ) ) . 'cache/',
			'fontDir' => array(
				plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/mpdf/mpdf/ttfonts/',
				plugin_dir_path( dirname( __FILE__ ) ) . 'fonts/',
			),
		    'fontdata' => array_merge($fontData, $customFonts),
		);
		$mpdf = new \Mpdf\Mpdf($mpdfConfig);	

		if($this->get_option('debugMPDF')) {
			$mpdf->debug = true;
			$mpdf->debugfonts = true;
			$mpdf->showImageErrors = true;
		}

		return $mpdf;
    } 

    public function build_CSS()
    {
		$css = "";

		$layoutPadding = $this->get_option('layoutPadding');
    	
    	// Font
    	$layoutFontFamily = $this->get_option('layoutFontFamily') ? $this->get_option('layoutFontFamily') : 'dejavusans';
    	$layoutTextColor = $this->get_option('layoutTextColor');

    	$layoutFontSize = $this->get_option('layoutFontSize') ? $this->get_option('layoutFontSize') : '11';
    	$layoutFontSize = intval($layoutFontSize);

    	$layoutFontLineHeight =  $this->get_option('layoutFontLineHeight') ? $this->get_option('layoutFontLineHeight') : $layoutFontSize + 6; 
    	$layoutFontLineHeight = intval($layoutFontLineHeight);

		$css = '
		<head>
			<style media="all">';

		if($this->showCoverPage) {
			$css .= '@page {
					header: defaultHeader;
					footer: defaultFooter;	
				}
				@page :first {
					header: none;
					footer: none;	
				}';
		}

		$css .= '
			body, table { 
				color: ' . $layoutTextColor . ';
				font-family: ' . $layoutFontFamily . ', sans-serif;
				font-size: ' . $layoutFontSize . 'pt;
				line-height: ' . $layoutFontLineHeight . 'pt;
				margin: 0;
				padding: 0;
				width: 100%;
	 		}

			table {
				width: 100%;
				text-align: left;
				border-spacing: 0;
			}

			table th, table td {
				padding: 4px 5px;
				text-align: left;
			}

	 		.header, .footer {
				padding-top: 10px;
				padding-bottom: 10px;
				padding-right: ' . $layoutPadding['padding-right'] . '; 
				padding-left: ' . $layoutPadding['padding-left'] . '; 
	 		}

	 		h1 {
				font-size: 20pt;
				line-height: 26pt;
	 		}

	 		h2 {
				font-size: 18pt;
				line-height: 24pt;
	 		}

	 		h3 {
				font-size: 16pt;
				line-height: 22pt;
	 		}

	 		h4 {
				font-size: 14pt;
				line-height: 20pt;
	 		}

	 		h5 {
				font-size: 12pt;
				line-height: 18pt;
	 		}

	 		.col {
				float: left;
	 		}
			
			.col-4 {
				width: 44%;
			}
	
	 		.col-8 {
	 			width: 66%;
	 		}

	 		.row {
	 			clear: both;
	 			float: none;
	 		}

			.two-cols, .three-cols, .four-cols {
				width: 100% !important;
			}
			.two-cols .col {
				width: 49.5%;
				float: left;
			}
			.three-cols .col {
				width: 33%;
				float: left;
			}
			.four-cols .col {
				width: 24%;
				float: left;
			}

	 		.frame {
				padding-top: ' . $layoutPadding['padding-top'] . '; 
				padding-right: ' . $layoutPadding['padding-right'] . '; 
				padding-bottom: ' . $layoutPadding['padding-bottom'] . '; 
				padding-left: ' . $layoutPadding['padding-left'] . '; 
 			}
 			.wc-proceed-to-checkout { display: none; } ';


		// Items
    	$contentItemsEvenBackgroundColor = $this->get_option('contentItemsEvenBackgroundColor');
		$contentItemsEvenTextColor = $this->get_option('contentItemsEvenTextColor');

    	$contentItemsOddBackgroundColor = $this->get_option('contentItemsOddBackgroundColor');
		$contentItemsOddTextColor = $this->get_option('contentItemsOddTextColor');

		$css .= '
			table.content-items {
				margin-bottom: 20px;
			}

			table.content-items tr.even, .cart-subtotal { 
				background-color: ' . $contentItemsEvenBackgroundColor . ';
				color: ' . $contentItemsEvenTextColor . ';
	 		}
	 		table.content-items tr.odd, .order-total { 
				background-color: ' . $contentItemsOddBackgroundColor . ';
				color: ' . $contentItemsOddTextColor . ';
	 		}
	 		table.content-items tfoot tr.black-border td {
				border-top: 1px solid #cecece;
 			}
 			table.content-items .content-item-total {
 				text-align: right;
			}

			table.content-items .discount {
				color: #F44336;
			}';
		

    	// Header
    	if($this->get_option('enableHeader')) {
	    	$headerFontSize = $this->get_option('headerFontSize');
	    	$headerLineHeight = $this->get_option('headerLineHeight');
	    	$headerPadding = $this->get_option('headerPadding');
	    	$headerBackgroundColor = $this->get_option('headerBackgroundColor');
	    	$headerTextColor = $this->get_option('headerTextColor');
			$this->get_option('headerHeight') ? $headerHeight = $this->get_option('headerHeight') : $headerHeight = 'auto';

	    	$css .= 
	    	'.header { 
				padding-top: ' . $headerPadding['padding-top'] . '; 
				padding-right: ' . $headerPadding['padding-right'] . '; 
				padding-bottom: ' . $headerPadding['padding-bottom'] . '; 
				padding-left: ' . $headerPadding['padding-left'] . '; 
				background-color: ' . $headerBackgroundColor . '; 
				color: ' . $headerTextColor . '; 
				height: ' . $headerHeight . 'px; 
				font-size: ' . $headerFontSize . 'pt;
				line-height: ' . $headerLineHeight . 'pt;
			}
			.header p {
				margin-top: 0;
				margin-bottom: 0;
			}';
		}

		// Footer
		if($this->get_option('enableFooter')) {
			$footerFontSize = $this->get_option('footerFontSize');
			$footerLineHeight = $this->get_option('footerLineHeight');
	    	$footerPadding = $this->get_option('footerPadding');
	    	$footerBackgroundColor = $this->get_option('footerBackgroundColor');
	    	$footerTextColor = $this->get_option('footerTextColor');
	    	$footerHeight = $this->get_option('footerHeight');

	    	$css .= 
	    	'.footer { 
				padding-top: ' . $footerPadding['padding-top'] . '; 
				padding-right: ' . $footerPadding['padding-right'] . '; 
				padding-bottom: ' . $footerPadding['padding-bottom'] . '; 
				padding-left: ' . $footerPadding['padding-left'] . '; 
				background-color: ' . $footerBackgroundColor . '; 
				color: ' . $footerTextColor . '; 
				font-size: ' . $footerFontSize . 'pt;
				line-height: ' . $footerLineHeight . 'pt;
				
			}
			.footer p {
				margin-top: 0;
				margin-bottom: 0;
			}';
		}

		// Text Before#
		if($this->get_option('enableTextBeforeProducts'))
		{

			$productContainerPadding = $this->get_option('productContainerPadding');
	    	$productsContainerPadding = '10px ' . $productContainerPadding['padding-right'] . ' 0px '  . $productContainerPadding['padding-right'];

	    	$textBeforeProductsFontSize = $this->get_option('textBeforeProductsFontSize');
	    	$textBeforeProductsLineHeight = $this->get_option('textBeforeProductsLineHeight');
	    	$textBeforeProductsTextAlign = $this->get_option('textBeforeProductsTextAlign');

	    	$css .= '
				.text-before-container {
				font-size: ' . $textBeforeProductsFontSize . 'pt; 
				line-height: ' . $textBeforeProductsLineHeight . 'pt;
				text-align: ' . $textBeforeProductsTextAlign . ';
			}

			.text-before {
				padding: ' . $productsContainerPadding . ';
			}';
		}

		// Text After
		if($this->get_option('enableTextAfterProducts'))
		{
			$productContainerPadding = $this->get_option('productContainerPadding');
	    	$productsContainerPadding = '10px ' . $productContainerPadding['padding-right'] . ' 0px '  . $productContainerPadding['padding-right'];

	    	$textAfterProductsFontSize = $this->get_option('textAfterProductsFontSize');
	    	$textAfterProductsLineHeight = $this->get_option('textAfterProductsLineHeight');
	    	$textAfterProductsTextAlign = $this->get_option('textAfterProductsTextAlign');

	    	$css .= '
				.text-after-container {
				font-size: ' . $textAfterProductsFontSize . 'pt; 
				line-height: ' . $textAfterProductsLineHeight . 'pt;
				text-align: ' . $textAfterProductsTextAlign . ';
			}

			.text-after {
				padding: ' . $productsContainerPadding . ';
			}';
		}

		$customCSS = $this->get_option('customCSS');
		if(!empty($customCSS))
		{
			$css .= $customCSS;
		}

		$css .= '
			</style>

		</head>';

		return $css;
    }

    public function get_header()
    {
    	$headerLayout = $this->get_option('headerLayout');

    	$topLeft = $this->get_option('headerTopLeft');
    	$topMiddle = $this->get_option('headerTopMiddle');
    	$topRight = $this->get_option('headerTopRight');

    	if($headerLayout == "oneCol")
    	{
			$header = '
			<div class="header one-col">
				<div class="header-block-one" style="text-align: center;">' . $this->get_header_footer_type($topLeft, 'headerTopLeft') . '</div>
			</div>';
    	} elseif($headerLayout == "threeCols") {
			$header = '
			<div class="header three-cols">
				<div  class="col header-block-one" style="text-align: left;">' . $this->get_header_footer_type($topLeft, 'headerTopLeft') . '</div>
				<div  class="col header-block-two" style="text-align: center;">' . $this->get_header_footer_type($topMiddle, 'headerTopMiddle') . '</div>
				<div  class="col header-block-three" style="text-align: right;">' . $this->get_header_footer_type($topRight, 'headerTopRight') . '</div>
			</div>';
		} else {
			$header = '
			<div class="header two-cols">
				<div  class="col header-block-one" style="text-align: left;">' . $this->get_header_footer_type($topLeft, 'headerTopLeft') . '</div>
				<div  class="col header-block-two" style="text-align: right;">' . $this->get_header_footer_type($topRight, 'headerTopRight') . '</div>
			</div>';
		}

		return $header;
    }

    public function get_footer()
    {
    	$footerLayout = $this->get_option('footerLayout');

    	$topLeft = $this->get_option('footerTopLeft');
    	$topMiddle = $this->get_option('footerTopMiddle');
    	$topRight = $this->get_option('footerTopRight');

    	if($footerLayout == "oneCol")
    	{
			$footer = '
			<div class="footer one-col">
				<div class="footer-block-one" style="text-align: center;">' . $this->get_header_footer_type($topLeft, 'footerTopLeft') . '</div>
			</div>';
    	} elseif($footerLayout == "threeCols") {
			$footer = '
			<div class="footer three-cols">
				<div  class="col footer-block-one" style="text-align: left;">' . $this->get_header_footer_type($topLeft, 'footerTopLeft') . '</div>
				<div  class="col footer-block-two" style="text-align: center;">' . $this->get_header_footer_type($topMiddle, 'footerTopMiddle') . '</div>
				<div  class="col footer-block-three" style="text-align: right;">' . $this->get_header_footer_type($topRight, 'footerTopRight') . '</div>
			</div>';
		} else {
			$footer = '
			<div class="footer two-cols">
				<div  class="col footer-block-one" style="text-align: left;">' . $this->get_header_footer_type($topLeft, 'footerTopLeft') . '</div>
				<div  class="col footer-block-two" style="text-align: right;">' . $this->get_header_footer_type($topRight, 'footerTopRight') . '</div>
			</div>';
		}

		return $footer;
    }

    private function get_header_footer_type($type, $position)
    {
    	// Custom Attribute Header & Footer
		if($this->current_category_id == "attr" && ($position == "headerTopLeft" || $position == "footerTopLeft")) {

			$taxonomy = $_GET['taxonomy'];
			$termId = $_GET['term-id'];

			if(isset($this->term_metas[$termId])) {

				if($position == "headerTopLeft" && isset($this->term_metas[$termId]['headerTopLeft']) && !empty($this->term_metas[$termId]['headerTopLeft'])) {
					return wpautop( do_shortcode( $this->term_metas[$termId]['headerTopLeft'] ) );
				}

				if($position == "footerTopLeft" && isset($this->term_metas[$termId]['footerTopLeft']) && !empty($this->term_metas[$termId]['footerTopLeft'])) {
					return wpautop( do_shortcode( $this->term_metas[$termId]['footerTopLeft'] ) );
				}
			}
    	}

    	switch ($type) {
    		case 'text':
    			return wpautop( do_shortcode( $this->get_option($position.'Text') ) );
    			break;
    		case 'bloginfo':
    			return $this->data->blog_name.'<br/>'.$this->data->blog_description;
    			break;
    		case 'pagenumber':
				return __( 'Page:', 'woocommerce-cart-pdf').' {PAGENO}';
    			break;
    		case 'image':
    			$image = $this->get_option($position.'Image');
    			$imageSrc = $image['url'];
    			$imageHTML = '<img src="' . $image['url'] . '">';
    			return $imageHTML;
    			break;
    		case 'exportinfo':
    			return date('d.m.y');
    			break;
    		default:
    			return '';
    			break;
    	}
    }

	public function get_pagebreak()
	{
		$html = '<pagebreak />';
		return $html;
	}

	public function get_text_before_products()
	{
		$textBeforeProducts = $this->get_option('textBeforeProducts');

		$html = '
		<div class="container text-before-container" width="100%">
				<div class="text-before" width="100%">' . wpautop($textBeforeProducts). '</div>
		</div>';

		return $html;
	}

	public function get_cart_html()
	{
		$html = "";

		$cart_items = WC()->cart->get_cart();
    	if(empty($cart_items)) {
    		return $html;
    	}

    	$showData = array(
			'showPos' => array(
				'active' => $this->get_option('contentItemsShowPos'),
				'width' => $this->get_option('contentItemsShowPosWidth'),
				'name' => $this->get_option('contentItemsShowPosName'),
			),
			'showImage' => array(
				'active' => $this->get_option('contentItemsShowImage'),
				'width' => $this->get_option('contentItemsShowImageWidth'),
				'name' => $this->get_option('contentItemsShowImageName'),
			),
			'showProduct' => array(
				'active' => $this->get_option('contentItemsShowProduct'),
				'width' => $this->get_option('contentItemsShowProductWidth'),
				'name' => $this->get_option('contentItemsShowProductName'),
			),
			'showSKU' => array(
				'active' => $this->get_option('contentItemsShowSKU'),
				'width' => $this->get_option('contentItemsShowSKUWidth'),
				'name' => $this->get_option('contentItemsShowSKUName'),
			),
			'showWeight' => array(
				'active' => $this->get_option('contentItemsShowWeight'),
				'width' => $this->get_option('contentItemsShowWeightWidth'),
				'name' => $this->get_option('contentItemsShowWeightName'),
			),
			'showDimensions' => array(
				'active' => $this->get_option('contentItemsShowDimensions'),
				'width' => $this->get_option('contentItemsShowDimensionsWidth'),
				'name' => $this->get_option('contentItemsShowDimensionsName'),
			),
			'showQty' => array(
				'active' => $this->get_option('contentItemsShowQty'),
				'width' => $this->get_option('contentItemsShowQtyWidth'),
				'name' => $this->get_option('contentItemsShowQtyName'),
			),
			'showPrice' => array(
				'active' => $this->get_option('contentItemsShowPrice'),
				'width' => $this->get_option('contentItemsShowPriceWidth'),
				'name' => $this->get_option('contentItemsShowPriceName'),
			),
			'showVAT' => array(
				'active' => $this->get_option('contentItemsShowVAT'),
				'width' => $this->get_option('contentItemsShowVATWidth'),
				'name' => $this->get_option('contentItemsShowVATName'),
			),
			'showShortDescription' => array(
				'active' => $this->get_option('contentItemsShowShortDescription'),
				'width' => $this->get_option('contentItemsShowShortDescriptionWidth'),
				'name' => $this->get_option('contentItemsShowShortDescriptionName'),
			),
			'showDescription' => array(
				'active' => $this->get_option('contentItemsShowDescription'),
				'width' => $this->get_option('contentItemsShowDescriptionWidth'),
				'name' => $this->get_option('contentItemsShowDescriptionName'),
			),
			'showUser' => array(
				'active' => $this->get_option('contentItemsShowUser'),
				'width' => $this->get_option('contentItemsShowUserWidth'),
				'name' => $this->get_option('contentItemsShowUserName'),
			),
			'showCouponTotal' => array(
				'active' => $this->get_option('contentItemsShowCouponTotal'),
				'width' => $this->get_option('contentItemsShowCouponTotalWidth'),
				'name' => $this->get_option('contentItemsShowCouponTotalName'),
			),
			'showTotal' => array(
				'active' => $this->get_option('contentItemsShowTotal'),
				'width' => $this->get_option('contentItemsShowTotalWidth'),
				'name' => $this->get_option('contentItemsShowTotalName'),
			),
    	);

    	$showData = apply_filters('woocommerce_cart_pdf_data_to_show', $showData);

    	$html .= 
    	'<table class="content-items">
	    	<thead>
				<tr class="odd">';

					foreach($showData as $showDataKey => $showDataValue) {
						if(!$showDataValue['active']) {
							unset($showData[$showDataKey]);
							continue;
						}
						$html .= '<th class="th-' . $showDataKey . '" width="' . $showDataValue['width'] . '%">' . $showDataValue['name'] . '</th>';
					}

					$html .= '
				</tr>
	    	</thead>
	    	<tbody>';

			$tax_display = get_option( 'woocommerce_tax_display_cart' );
			$productLink = $this->get_option('contentItemsShowLinks');

	    	$i = 1;
	    	foreach ($cart_items as $cart_item_key => $cart_item) {

				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if($productLink) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				} else {
					$product_permalink = "";
				}

				// if ( 'excl' === $tax_display ) {
				// 	$subtotal = $this->data->order->get_line_subtotal( $item );
				// } else {
				// 	$subtotal = $this->data->order->get_line_subtotal( $item, true );
				// }

	    		$tr_class = ($i % 2 == 0) ? 'odd' : 'even';

	    		$html .= 
	    			'<tr class="' . $tr_class . '">';

	    				foreach($showData as $showDataKey => $showDataValue) {

		    				if($showDataKey == 'showPos') {
		    					$html .= '<td class="td-' . $showDataKey . '">' . $i . '</td>';
		    				} 

		    				elseif($showDataKey == 'showImage') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
									$imageSrc	   = wp_get_attachment_image_src( get_post_thumbnail_id( $_product->get_id(), 'full' ) );
									if(!isset($imageSrc[0]) && $_product->is_type('variation')) {
										$imageSrc	   = wp_get_attachment_image_src( get_post_thumbnail_id( $_product->get_parent_id(), 'full' ) );
									}

									if(!isset($imageSrc[0])) {
										$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
									} else {
										$imageSize = $this->get_option( 'contentItemsShowImageSize' );

										if($this->get_option('performanceUseImageLocally') && !empty($imageSrc[0])) {
										    $uploads = wp_upload_dir();
											$imageSrc[0] = str_replace( $uploads['baseurl'], $uploads['basedir'], $imageSrc[0] );
										}

										$html .= '<td class="td-' . $showDataKey . '"><img src="' . $imageSrc[0] . '" width="' . $imageSize . 'px" alt=""></td>';
									}
								}
		    				} 

		    				elseif($showDataKey == 'showProduct') {

								$html .=  '<td class="td-' . $showDataKey . '">';
									if ( ! $product_permalink ) {
										$html .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
									} else {
										$html .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									$html .=  wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										$html .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}

								$html .= '</td>';
		    				} 

		    				elseif($showDataKey == 'showShortDescription') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . ($_product->get_short_description() ? do_shortcode($_product->get_short_description()) : __('N/A', 'woocommerce-cart-pdf')) . '</td>';
		    					}
		    				} 

		    				elseif($showDataKey == 'showDescription') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . ($_product->get_description() ? do_shortcode($_product->get_description()) : __('N/A', 'woocommerce-cart-pdf')) . '</td>';
		    					}
		    				} 
		    				elseif($showDataKey == 'showUser') {

		    					$user = wp_get_current_user();
								if(!$user) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . $user->display_name . '</td>';
		    					}
		    				} 

		    				elseif($showDataKey == 'showSKU') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . ($_product->get_sku() ? $_product->get_sku() : __('N/A', 'woocommerce-cart-pdf')) . '</td>';
		    					}
		    				} 

		    				elseif($showDataKey == 'showWeight') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . ($_product->get_weight() ? $_product->get_weight() : __('N/A', 'woocommerce-cart-pdf')) . '</td>';
		    					}
		    				} 

		    				elseif($showDataKey == 'showDimensions') {
								if(!$_product) {
									$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
								} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . ($_product->get_dimensions() ? $_product->get_dimensions() : __('N/A', 'woocommerce-cart-pdf')) . '</td>';
		    					}
		    				} 

		    				elseif($showDataKey == 'showQty') {
								$html .= '<td class="td-' . $showDataKey . '">' . apply_filters( 'woocommerce_cart_item_quantity', $cart_item['quantity'], $cart_item_key, $cart_item ) . '</td>';
		    				} 

		    				elseif($showDataKey == 'showPrice') {
		    					if($_product->is_on_sale()) {
		    						$html .= '<td class="td-' . $showDataKey . '">' . apply_filters( 'woocommerce_cart_item_price', $_product->get_price_html() ) . '</td>';
	    						} else {
		    						$html .= '<td class="td-' . $showDataKey . '">' . apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) . '</td>';
		    					}
		    					
	    					} 

		    				elseif($showDataKey == 'showCouponTotal') {

		    					$appliedCoupons = WC()->cart->get_applied_coupons();
		    					if(empty($appliedCoupons)) {
		    						$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
		    					} else {

		    						$couponAmount = 0;
		    						foreach ($appliedCoupons as $appliedCoupon) {
		    							$appliedCoupon = new WC_Coupon($appliedCoupon);

		    							if(!$appliedCoupon->is_valid_for_product($_product)) {

		    								continue;
		    							}

										if($appliedCoupon->discount_type == "percent") {
											$couponAmount = $couponAmount + ( $_product->get_price() * ($appliedCoupon->amount / 100) * $cart_item['quantity']);
										} elseif($appliedCoupon->discount_type == "fixed_product") {
											$couponAmount = $couponAmount + ( $appliedCoupon->amount * $cart_item['quantity']);
										}
										
		    						}

		    						if($couponAmount == 0) {
		    							$html .= '<td class="td-' . $showDataKey . '">' . __('N/A', 'woocommerce-cart-pdf') . '</td>';
		    						} else {
	    								$html .= '<td class="td-' . $showDataKey . '">' . wc_price($couponAmount) . '</td>';
		    						}
		    					}
		
	    					} 

	    					elseif($showDataKey == 'showVAT') {
		    					$html .= '<td>' . wc_price( $item->get_total_tax() ) . '</td>';
	    					} 

	    					elseif($showDataKey == 'showTotal') {

	    						$savedAmount = 0;
	    						$savedAmountHTML = "";
	    						$totalAmount = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

	    						if($this->get_option('contentItemsShowTotalSaved')) {

	    							if($_product->is_on_sale()) {
	    								$savedAmount = $cart_item['quantity'] * ($_product->get_regular_price() - $_product->get_sale_price());
	    							}

	    							if($couponAmount > 0) {
	    								$savedAmount = $savedAmount + $couponAmount;
	    								$totalAmount = wc_price( ($_product->get_regular_price() * $cart_item['quantity'] ) - $couponAmount);
	    							}
	    						} 

	    						if($savedAmount > 0) {
	    							$savedAmountHTML = '<br><span class="saved-price">' . sprintf($this->get_option('contentItemsShowTotalSavedText'), wc_price($savedAmount) ) . '</span>';
	    						}

	    						$html .= '<td class="td-' . $showDataKey . ' content-item-total">' . $totalAmount . $savedAmountHTML .'</td>';
    						} else {
    							$html .= apply_filters('woocommerce_cart_pdf_data_to_show_custom_value_' . $showDataKey, '');
    						}
    					}

						$html .= '
	    			</tr>';
				$i++;
	    	}

    	$html .= 
    		'</tbody>
    	</table>';

    	ob_start();
    	
		do_action( 'woocommerce_before_cart_collaterals' );
		?>

		<div class="cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>

		<?php

		do_action( 'woocommerce_after_cart' );

		$html .= ob_get_contents();
		ob_end_clean();
    	
    	return $html;
	}

	public function get_text_after_products()
	{
		$textAfterProducts = $this->get_option('textAfterProducts');

		$html = '
		<div class="container text-after-container" width="100%">
			<div class="text-after" width="100%">' . wpautop($textAfterProducts). '</div>
		</div>';

		return $html;
	}

	public function send_cart_email_popup()
	{
		$sendCartEMailTo = $this->get_option('sendCartEMailTo');
		$sendCartEMailText = $this->get_option('sendCartEMailText');
		$sendCartEMailSendButtonText = $this->get_option('sendCartEMailSendButtonText');

		$sendCartEMailToLabel = $this->get_option('sendCartEMailToLabel');
		$sendCartEMailTextLabel = $this->get_option('sendCartEMailTextLabel');

		$sendCartEMailToPlaceholder = $this->get_option('sendCartEMailToPlaceholder');
		$sendCartEMailTextPlaceholder = $this->get_option('sendCartEMailTextPlaceholder');

		?>

		<div class="woocommerce-cart-pdf-overlay" style="display: none;"></div>
		<div class="woocommerce-cart-pdf-popup-container" style="display: none;">
			<div class="woocommerce-cart-pdf-popup">
				<form action="POST" class="woocommerce-cart-pdf-email-form">
					<label for="woocommerce_cart_pdf_email_to"><?php echo $sendCartEMailToLabel ?></label>
					<input name="woocommerce_cart_pdf_email_to" class="woocommerce-cart-pdf-email-to" type="text" placeholder="<?php echo $sendCartEMailToPlaceholder ?>" value="<?php echo $sendCartEMailTo ?>">

					<?php if($this->get_option('sendCartEMailTextShow')) { ?>
					<label for="woocommerce_cart_pdf_email_text"><?php echo $sendCartEMailTextLabel ?></label>
					<textarea name="woocommerce_cart_pdf_email_text" class="woocommerce-cart-pdf-email-text" id="" placeholder="<?php echo $sendCartEMailTextPlaceholder ?>" cols="30" rows="10"><?php echo $sendCartEMailText ?></textarea>
					<?php } ?>

					<button type="submit" class="woocommerce-cart-pdf-email-send  button btn btn-primary"><?php echo $sendCartEMailSendButtonText ?></button>
				</form>
			</div>	
		</div>

		<?php
	}

    private function escape_filename($file)
    {
		$file = strtolower(trim($file));
		$find = array(' ', '&', '\r\n', '\n', '+',',');
		$file = str_replace ($find, '-', $file);
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$file = preg_replace ($find, $repl, $file);

		return $file;
    }

    public function get_cover()
    {
    	$html = "";
    	$coverImage = $this->get_option('coverImage');

    	if(!$coverImage) {
    		return $html;
    	} 

    	$imageURL = $coverImage['url'];

		if($this->get_option('performanceUseImageLocally') && !empty($imageURL)) {
		    $uploads = wp_upload_dir();
			$imageURL = str_replace( $uploads['baseurl'], $uploads['basedir'], $imageURL );
		}
   		
    	$html .= '<style media="all">@page :first { background: url("' . $imageURL . '"); background-repeat: none; background-image-resize: 6; }</style>';
    	$html .= '<pagebreak odd-footer-name="defaultFooter" odd-footer-value="on" odd-header-name="defaultHeader" odd-header-value="on"></pagebreak>';
    	
    	return $html;
    }

    public function send_email()
    {
		$response = array(
			'status' => 0,
			'message' => '',
		);

        if (!defined('DOING_AJAX') || !DOING_AJAX) {
        	$response['message'] = esc_html__('No AJAX call', 'woocommerce-cart-pdf');
        	echo json_encode($response);
            die();
        }

        if (!isset($_POST['to'])) {
            $response['message'] = esc_html__('To missing.', 'woocommerce-cart-pdf');
            echo json_encode($response);
            die();
        }

        $to = $_POST['to'];
        if($this->get_option('sendCartEMailTextShow')) {
	        $text = $_POST['text'];
	    } else {
	    	$text = $this->get_option('sendCartEMailText');
	    }

        if (empty($to) || empty($text)) {
            $response['message'] = esc_html__('Empty to or text.', 'woocommerce-cart-pdf');
            echo json_encode($response);
            die();
        }

        $text .= sprintf( __('<br><br>This mail was sent to %s', 'woocommerce-cart-pdf'), $to);

        $headers = array();
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $subject = $this->get_option('sendCartEMailSubject');
        
        $cc = $this->get_option('sendCartEMailCC');
        if(!empty($cc)) {
        	$headers[] = 'Cc: ' . $cc;
        }

        $bcc = $this->get_option('sendCartEMailBCC');
        if(!empty($bcc)) {
        	$headers[] = 'Bcc: ' . $bcc;
        }

        $pdf = $this->build_pdf(true);

        if(wp_mail($to, $subject, $text, $headers, $pdf)) {
        	$response['status'] = 1;
			$response['message'] = esc_html__('Email sent.', 'woocommerce-cart-pdf');
        } else {
			$response['message'] = esc_html__('Email not sent.', 'woocommerce-cart-pdf');
        }

        echo json_encode($response);
        die();
    }

    public function get_backcover()
    {
    	$html = "";
    	$backcoverImage = $this->get_option('backcoverImage');

    	if(!$backcoverImage) {
    		return $html;
    	} 
    	$imageURL = $backcoverImage['url'];

		if($this->get_option('performanceUseImageLocally') && !empty($imageURL)) {
		    $uploads = wp_upload_dir();
			$imageURL = str_replace( $uploads['baseurl'], $uploads['basedir'], $imageURL );
		}

		// $html .= $this->get_pagebreak();
		// $html .= '<div style="background: url(' . $imageURL . '); background-repeat: none; background-image-resize: 6; width:100%; height:100%; margin-top: -50px;"></div>';
    	
    	return $html;
    }

	/**
	 * Return the current user role
	 *
	 * @since    1.0.0
	 */
	private function get_user_role()
	{
		global $current_user;

		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);

		return $user_role;
	}


	protected function get_uploads_dir( $subdir = '' ) 
	{
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
		if ( '' != $subdir ) {
			$upload_dir = $upload_dir . '/' . $subdir . '/';
		}
		return $upload_dir;
	}
}