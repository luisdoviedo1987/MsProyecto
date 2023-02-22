<?php

    if ( ! class_exists( 'weLaunch' ) && ! class_exists( 'Redux' ) ) {
        return;
    }

    if( class_exists( 'weLaunch' ) ) {
        $framework = new weLaunch();
    } else {
        $framework = new Redux();
    }

    $opt_name = 'woocommerce_cart_pdf_options';

    $args = array(
        'opt_name' => 'woocommerce_cart_pdf_options',
        'use_cdn' => TRUE,
        'dev_mode' => FALSE,
        'display_name' => 'WooCommerce Cart PDF',
        'display_version' => '1.0.6',
        'page_title' => 'WooCommerce Cart PDF',
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => '&copy; '.date('Y').' weLaunch',
        'admin_bar' => FALSE,
        'menu_type' => 'submenu',
        'menu_title' => 'Cart PDF',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'woocommerce',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => FALSE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    $framework::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'help-tab',
            'title'   => __( 'Information', 'woocommerce-cart-pdf' ),
            'content' => __( '<p>Need support? Please use the comment function on codecanyon.</p>', 'woocommerce-cart-pdf' )
        ),
    );
    $framework::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    // $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'woocommerce-cart-pdf' );
    // $framework::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    $framework::setSection( $opt_name, array(
        'title'  => __( 'Cart PDF', 'woocommerce-cart-pdf' ),
        'id'     => 'general',
        'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'woocommerce-cart-pdf' ),
        'icon'   => 'el el-home',
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'General', 'woocommerce-cart-pdf' ),
        // 'desc'       => __( '', 'woocommerce-cart-pdf' ),
        'id'         => 'general-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable',
                'type'     => 'switch',
                'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Enable Cart PDF to use the options below', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
            array(
                'id'       => 'showCartCatalogLink',
                'type'     => 'checkbox',
                'title'    => __( 'Cart PDF Export Link', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Show Cart Cart PDF Link', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
            array(
                'id'       => 'cartLinkPosition',
                'type'     => 'select',
                'title'    => __( 'Cart Link position', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Choose the position of the button on the cart page.', 'woocommerce-cart-pdf' ),
                'default'  => 'woocommerce_before_cart',
                'options'  => array( 
                    'woocommerce_before_cart' => __('before_cart', 'woocommerce-cart-pdf'),
                    'woocommerce_before_cart_table' => __('before_cart_table', 'woocommerce-cart-pdf'),
                    'woocommerce_before_cart_contents' => __('before_cart_contents', 'woocommerce-cart-pdf'),
                    'woocommerce_cart_contents' => __('cart_contents', 'woocommerce-cart-pdf'),
                    'woocommerce_cart_actions' => __('cart_actions', 'woocommerce-cart-pdf'),
                    'woocommerce_after_cart_contents' => __('after_cart_contents', 'woocommerce-cart-pdf'),
                    'woocommerce_after_cart_table' => __('after_cart_table', 'woocommerce-cart-pdf'),
                    'woocommerce_cart_collaterals' => __('cart_collaterals', 'woocommerce-cart-pdf'),
                    'woocommerce_after_cart' => __('after_cart', 'woocommerce-cart-pdf'),
                ),
                'required' => array('showCartCatalogLink','equals','1'),
            ),
            array(
                'id'       => 'cartBtnText',
                'type'     => 'text',
                'title'    => __( 'Cart Button text', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Text inside the cart button.', 'woocommerce-cart-pdf' ),
                'default' => 'Export Cart (PDF)',
                'required' => array('showCartCatalogLink','equals','1'),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Send Cart (Email)', 'woocommerce-cart-pdf' ),
        'id'         => 'sendcart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'sendCartEMail',
                'type'     => 'switch',
                'title'    => __( 'Enable Email Cart Sending', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Show a button send the cart via Email.', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
            array(
                'id'       => 'sendCartEMailButtonText',
                'type'     => 'text',
                'title'    => __( 'Email Cart Button Text', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Text inside the send button.', 'woocommerce-cart-pdf' ),
                'default' => 'Send Cart (PDF)',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailTo',
                'type'     => 'text',
                'title'    => __( 'Email Cart Default To', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Default to address (split by comma if multiple).', 'woocommerce-cart-pdf' ),
                'default' => '',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailToLabel',
                'type'     => 'text',
                'title'    => __( 'Email Cart To Label', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Label for to field.', 'woocommerce-cart-pdf' ),
                'default' => 'To Email (split by comma for multiple emails)',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailToPlaceholder',
                'type'     => 'text',
                'title'    => __( 'Email Cart To Placeholder', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Placeholder for to field.', 'woocommerce-cart-pdf' ),
                'default' => 'To Email (split by comma for multiple emails)',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailSubject',
                'type'     => 'text',
                'title'    => __( 'Email Cart Subject', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Subject.', 'woocommerce-cart-pdf' ),
                'default' => 'Your Cart as PDF | ' . get_bloginfo('name'),
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailCC',
                'type'     => 'text',
                'title'    => __( 'Email Cart Default CC', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Default CC Address (split by comma if multiple).', 'woocommerce-cart-pdf' ),
                'default' => '',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailBCC',
                'type'     => 'text',
                'title'    => __( 'Email Cart BCC', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Default BCC Address  (split by comma if multiple).', 'woocommerce-cart-pdf' ),
                'default' => '',
                'required' => array('sendCartEMail','equals','1'),
            ),
            // Text
            array(
                'id'       => 'sendCartEMailText',
                'type'  => 'editor',
                'args'   => array(
                    'teeny'            => false,
                ),
                'title'    => __( 'Email Cart Default Text', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Default Text.', 'woocommerce-cart-pdf' ),
                'default' => '',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailTextLabel',
                'type'     => 'text',
                'title'    => __( 'Email Cart Text Label', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Label for text field.', 'woocommerce-cart-pdf' ),
                'default' => 'Your message',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailTextPlaceholder',
                'type'     => 'text',
                'title'    => __( 'Email Cart Text Placeholder', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Placeholder for text field.', 'woocommerce-cart-pdf' ),
                'default' => 'Your message',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailTextShow',
                'type'     => 'checkbox',
                'title'    => __( 'Email Cart Text Show in Frontend', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Show the text field in fronted so users can enter a custom message in the mail with the attachment. Otherwise the default message above will be used.', 'woocommerce-cart-pdf' ),
                'default' =>  '1',
                'required' => array('sendCartEMail','equals','1'),
            ),
            // Button
            array(
                'id'       => 'sendCartEMailSendButtonText',
                'type'     => 'text',
                'title'    => __( 'Email Cart Send Button Text', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Text for the send button.', 'woocommerce-cart-pdf' ),
                'default' => 'Send Cart PDF',
                'required' => array('sendCartEMail','equals','1'),
            ),
            array(
                'id'       => 'sendCartEMailSuccessText',
                'type'     => 'text',
                'title'    => __( 'Email Cart Success Text', 'woocommerce-cart-pdf' ),
                'subtitle'    => __( 'Text after button has been sent.', 'woocommerce-cart-pdf' ),
                'default' => 'Your cart PDF has been sent.',
                'required' => array('sendCartEMail','equals','1'),
            ),
            
        )
    ) );


    $framework::setSection( $opt_name, array(
        'title'      => __( 'Layout', 'woocommerce-cart-pdf' ),
        'id'         => 'defaults',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'format',
                'type'     => 'select',
                'title'    => __( 'Format', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Choose a pre-defined page size. A4 is recommended!', 'woocommerce-cart-pdf' ),
                'options'  => array(
                    'A4' => __('A4', 'woocommerce-cart-pdf'),
                    'A4-L' => __('A4 Landscape', 'woocommerce-cart-pdf'),
                    'A0' => __('A0', 'woocommerce-cart-pdf'),
                    'A0-L' => __('A0 Landscape', 'woocommerce-cart-pdf'),
                    'A1' => __('A1', 'woocommerce-cart-pdf'),
                    'A1-L' => __('A1 Landscape', 'woocommerce-cart-pdf'),
                    'A3' => __('A3', 'woocommerce-cart-pdf'),
                    'A3-L' => __('A3 Landscape', 'woocommerce-cart-pdf'),
                    'A5' => __('A5', 'woocommerce-cart-pdf'),
                    'A5-L' => __('A5 Landscape', 'woocommerce-cart-pdf'),
                    'A6' => __('A6', 'woocommerce-cart-pdf'),
                    'A6-L' => __('A6 Landscape', 'woocommerce-cart-pdf'),
                    'A7' => __('A7', 'woocommerce-cart-pdf'),
                    'A7-L' => __('A7 Landscape', 'woocommerce-cart-pdf'),
                    'A8' => __('A8', 'woocommerce-cart-pdf'),
                    'A8-L' => __('A8 Landscape', 'woocommerce-cart-pdf'),
                    'A9' => __('A9', 'woocommerce-cart-pdf'),
                    'A9-L' => __('A9 Landscape', 'woocommerce-cart-pdf'),
                    'A10' => __('A10', 'woocommerce-cart-pdf'),
                    'A10-L' => __('A10 Landscape', 'woocommerce-cart-pdf'),
                    'Letter' => __('Letter', 'woocommerce-cart-pdf'),
                    'Legal' => __('Legal', 'woocommerce-cart-pdf'),
                    'Executive' => __('Executive', 'woocommerce-cart-pdf'),
                    'Folio' => __('Folio', 'woocommerce-cart-pdf'),
                ),
                'default' => 'A4',
            ),
            array(
                'id'             => 'layoutPadding',
                'type'           => 'spacing',
                // 'output'         => array('.site-header'),
                'mode'           => 'padding',
                'units'          => array('px'),
                'units_extended' => 'false',
                'title'          => __('Padding', 'woocommerce-cart-pdf'),
                'default'            => array(
                    'padding-top'     => '50px', 
                    'padding-right'   => '20px', 
                    'padding-bottom'  => '10px', 
                    'padding-left'    => '20px',
                    'units'          => 'px', 
                ),
            ),
            array(
                'id'     =>'layoutTextColor',
                'type'  => 'color',
                'title' => __('Text Color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'default'   => '#333333',
            ),
            array(
                'id'     =>'layoutFontFamily',
                'type'  => 'select',
                'title' => __('Default Font', 'woocommerce-cart-pdf'), 
                'options'  => array(
                    'dejavusans' => __('Sans', 'woocommerce-cart-pdf' ),
                    'dejavuserif' => __('Serif', 'woocommerce-cart-pdf' ),
                    'dejavusansmono' => __('Mono', 'woocommerce-cart-pdf' ),
                    'droidsans' => __('Droid Sans', 'woocommerce-cart-pdf'),
                    'droidserif' => __('Droid Serif', 'woocommerce-cart-pdf'),
                    'lato' => __('Lato', 'woocommerce-cart-pdf'),
                    'lora' => __('Lora', 'woocommerce-cart-pdf'),
                    'merriweather' => __('Merriweather', 'woocommerce-cart-pdf'),
                    'montserrat' => __('Montserrat', 'woocommerce-cart-pdf'),
                    'opensans' => __('Open sans', 'woocommerce-cart-pdf'),
                    'opensanscondensed' => __('Open Sans Condensed', 'woocommerce-cart-pdf'),
                    'oswald' => __('Oswald', 'woocommerce-cart-pdf'),
                    'ptsans' => __('PT Sans', 'woocommerce-cart-pdf'),
                    'sourcesanspro' => __('Source Sans Pro', 'woocommerce-cart-pdf'),
                    'slabo' => __('Slabo', 'woocommerce-cart-pdf'),
                    'raleway' => __('Raleway', 'woocommerce-cart-pdf'),
                ),
                'default'   => 'dejavusans',
            ),
            array(
                'id'     =>'layoutFontSize',
                'type'     => 'spinner', 
                'title'    => __('Default font size', 'woocommerce-cart-pdf'),
                'default'  => '11',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
            ),
            array(
                'id'     =>'layoutFontLineHeight',
                'type'     => 'spinner', 
                'title'    => __('Default line height', 'woocommerce-cart-pdf'),
                'default'  => '14',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
            ),
            array(
                'id'     =>'contentItemsEvenBackgroundColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Even Items Background Color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'default' => '#FFFFFF',
            ),
            array(
                'id'     =>'contentItemsEvenTextColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Even Items Text Color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'default' => '#333333',
            ),
            array(
                'id'     =>'contentItemsOddBackgroundColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Odd Items Background Color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'default' => '#ebebeb',
            ),
            array(
                'id'     =>'contentItemsOddTextColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Odd Items Text Color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'default' => '#333333',
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Cover Page', 'woocommerce-cart-pdf' ),
        'id'         => 'cover',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enableCover',
                'type'     => 'checkbox',
                'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Enable the Cover Page', 'woocommerce-cart-pdf' ),
                'default' =>  '0',
            ),
            array(
                'id'     =>'coverImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Cover image', 'woocommerce-cart-pdf'), 
                'subtitle' => __('Recommended Image Size: 1240 x 1754 px.', 'woocommerce-cart-pdf'), 
                'args'   => array(
                    'teeny'            => false,
                ),
                'required' => array('enableCover','equals','1'),
            ),
        ),
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Header', 'woocommerce-cart-pdf' ),
        'id'         => 'header',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enableHeader',
                'type'     => 'checkbox',
                'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Enable header', 'woocommerce-cart-pdf' ),
                'default'  => '1',
            ),
            array(
                'id'     =>'headerBackgroundColor',
                'type' => 'color',
                'title' => __('Header background color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'required' => array('enableHeader','equals','1'),
                'default'  => '#222222',
            ),
            array(
                'id'     =>'headerTextColor',
                'type'  => 'color',
                'title' => __('Header text color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'required' => array('enableHeader','equals','1'),
                'default'  => '#FFFFFF',
            ),
            array(
                'id'     =>'headerFontSize',
                'type'     => 'spinner', 
                'title'    => __('Text font size', 'woocommerce-cart-pdf'),
                'default'  => '11',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
                'required' => array('enableHeader','equals','1'),
            ),
            array(
                'id'     =>'headerLineHeight',
                'type'     => 'spinner', 
                'title'    => __('Text line height', 'woocommerce-cart-pdf'),
                'default'  => '14',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
                'required' => array('enableHeader','equals','1'),
            ),
            array(
                'id'     =>'headerLayout',
                'type'  => 'select',
                'title' => __('Header Layout', 'woocommerce-cart-pdf'), 
                'required' => array('enableHeader','equals','1'),
                'options'  => array(
                    'oneCol' => __('1/1', 'woocommerce-cart-pdf' ),
                    'twoCols' => __('1/2 + 1/2', 'woocommerce-cart-pdf' ),
                    'threeCols' => __('1/3 + 1/3 + 1/3', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'twoCols',
            ),
            array(
                'id'     =>'headerTopMargin',
                'type'     => 'spinner', 
                'title'    => __('Header Margin', 'woocommerce-cart-pdf'),
                'default'  => '20',
                'min'      => '1',
                'step'     => '1',
                'max'      => '200',
            ),
            array(
                'id'     =>'headerHeight',
                'type'     => 'spinner', 
                'title'    => __('Header Height', 'woocommerce-cart-pdf'),
                'default'  => '40',
                'min'      => '1',
                'step'     => '1',
                'max'      => '200',
            ),
            array(
                'id'             => 'headerPadding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px'),
                'units_extended' => 'false',
                'title'          => __('Header Padding', 'woocommerce-cart-pdf'),
                'subtitle'       => __('Choose the spacing or padding you want.', 'woocommerce-cart-pdf'),
                'default'            => array(
                    'padding-top'     => '10px', 
                    'padding-right'   => '20px', 
                    'padding-bottom'  => '10px', 
                    'padding-left'    => '20px',
                    'units'          => 'px', 
                )
            ),
            array(
                'id'     =>'headerTopLeft',
                'type'  => 'select',
                'title' => __('Top Left Header', 'woocommerce-cart-pdf'), 
                'required' => array('enableHeader','equals','1'),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'bloginfo',
            ),
            array(
                'id'     =>'headerTopLeftText',
                'type'  => 'editor',
                'title' => __('Top Left Header Text', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopLeft','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'headerTopLeftImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Left Header Image', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopLeft','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'headerTopMiddle',
                'type'  => 'select',
                'title' => __('Top Middle Header', 'woocommerce-cart-pdf'), 
                'required' => array('headerLayout','equals','threeCols'),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'category',
            ),
            array(
                'id'     =>'headerTopMiddleText',
                'type'  => 'editor',
                'title' => __('Top Middle Header Text', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopMiddle','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'headerTopMiddleImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Middle Header Image', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopMiddle','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'headerTopRight',
                'type'  => 'select',
                'title' => __('Top Right Header', 'woocommerce-cart-pdf'), 
                'required' => array('headerLayout','equals',array('threeCols','twoCols')),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'pagenumber',
            ),
            array(
                'id'     =>'headerTopRightText',
                'type'  => 'editor',
                'title' => __('Top Right Header Text', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopRight','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'headerTopRightImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Right Header Image', 'woocommerce-cart-pdf'), 
                'required' => array('headerTopRight','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Data to show', 'woocommerce-cart-pdf' ),
        'id'         => 'data',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'contentItemsShowPos',
                'type'     => 'checkbox',
                'title'    => __( 'Show Position', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
            array(
                'id'     =>'contentItemsShowPosWidth',
                'type'     => 'spinner', 
                'title'    => __('Pos Column Size (%)', 'woocommerce-cart-pdf'),
                'default'  => '6',
                'min'      => '1',
                'step'     => '10',
                'max'      => '100',
                'required' => array('contentItemsShowPos','equals','1'),
            ),
                array(
                    'id'       => 'contentItemsShowPosName',
                    'type'     => 'text',
                    'title'    => __( 'Column Pos Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Pos.', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowPos','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowImage',
                'type'     => 'checkbox',
                'title'    => __( 'Show Image', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowImageWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Image Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowImage','equals','1'),
                ),
                array(
                    'id'     =>'contentItemsShowImageSize',
                    'type'     => 'spinner', 
                    'title'    => __('Image size (px)', 'woocommerce-cart-pdf'),
                    'default'  => '80',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '150',
                    'required' => array('contentItemsShowImage','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowImageName',
                    'type'     => 'text',
                    'title'    => __( 'Column Image Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Image', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowImage','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowProduct',
                'type'     => 'checkbox',
                'title'    => __( 'Show Product Name', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowProductWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '17',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowProduct','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowProductName',
                    'type'     => 'text',
                    'title'    => __( 'Column Product Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Product', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowProduct','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowLinks',
                'type'     => 'checkbox',
                'title'    => __( 'Show Product Link', 'woocommerce-cart-pdf' ),
                'default' => 1,
                'required' => array('contentItemsShowProduct','equals','1'),
            ),
            array(
                'id'       => 'contentItemsShowSKU',
                'type'     => 'checkbox',
                'title'    => __( 'Show SKU', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowSKUWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowSKU','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowSKUName',
                    'type'     => 'text',
                    'title'    => __( 'Column SKU Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('SKU', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowSKU','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowWeight',
                'type'     => 'checkbox',
                'title'    => __( 'Show Weight', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowWeightWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '13',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowWeight','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowWeightName',
                    'type'     => 'text',
                    'title'    => __( 'Column Weight Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Weight', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowWeight','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowDimensions',
                'type'     => 'checkbox',
                'title'    => __( 'Show Dimensions', 'woocommerce-cart-pdf' ),
                'default' => 0,
            ),
                array(
                    'id'     =>'contentItemsShowDimensionsWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowDimensions','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowDimensionsName',
                    'type'     => 'text',
                    'title'    => __( 'Column Dimensions Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Dimensions', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowDimensions','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowQty',
                'type'     => 'checkbox',
                'title'    => __( 'Show Quantity', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowQtyWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowQty','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowQtyName',
                    'type'     => 'text',
                    'title'    => __( 'Column Qty Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Qty', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowQty','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowPrice',
                'type'     => 'checkbox',
                'title'    => __( 'Show Price', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowPriceWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '9',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowPrice','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowPriceName',
                    'type'     => 'text',
                    'title'    => __( 'Column Price Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Price', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowPrice','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowShortDescription',
                'type'     => 'checkbox',
                'title'    => __( 'Show Short Description', 'woocommerce-cart-pdf' ),
                'default' => 0,
            ),
                array(
                    'id'     =>'contentItemsShowShortDescriptionWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '17',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowShortDescription','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowShortDescriptionName',
                    'type'     => 'text',
                    'title'    => __( 'Column Short Description', 'woocommerce-cart-pdf' ),
                    'default'  => __('Short Description', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowShortDescription','equals','1'),
                ),

            array(
                'id'       => 'contentItemsShowDescription',
                'type'     => 'checkbox',
                'title'    => __( 'Show Description', 'woocommerce-cart-pdf' ),
                'default' => 0,
            ),
                array(
                    'id'     =>'contentItemsShowDescriptionWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '17',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowDescription','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowDescriptionName',
                    'type'     => 'text',
                    'title'    => __( 'Column Description', 'woocommerce-cart-pdf' ),
                    'default'  => __('Description', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowDescription','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowUser',
                'type'     => 'checkbox',
                'title'    => __( 'Show Current User', 'woocommerce-cart-pdf' ),
                'default' => 0,
            ),
                array(
                    'id'     =>'contentItemsShowUserWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowUser','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowUserName',
                    'type'     => 'text',
                    'title'    => __( 'Column User Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('User', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowUser','equals','1'),
                ),
            // array(
            //     'id'       => 'contentItemsShowVAT',
            //     'type'     => 'checkbox',
            //     'title'    => __( 'Show Product VAT', 'woocommerce-cart-pdf' ),
            //     'default' => 0,
            // ),
            //     array(
            //         'id'     =>'ccontentItemsShowVATWidth',
            //         'type'     => 'spinner', 
            //         'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
            //         'default'  => '9',
            //         'min'      => '1',
            //         'step'     => '10',
            //         'max'      => '100',
            //         'required' => array('ccontentItemsShowVAT','equals','1'),
            //     ),
            //     array(
            //         'id'       => 'contentItemsShowVATName',
            //         'type'     => 'text',
            //         'title'    => __( 'Column VAT Name', 'woocommerce-cart-pdf' ),
            //         'default'  => __('VAT', 'woocommerce-cart-pdf'),
            //         'required' => array('contentItemsShowVAT','equals','1'),
            //     ),
            array(
                'id'       => 'contentItemsShowCouponTotal',
                'type'     => 'checkbox',
                'title'    => __( 'Show Coupon Total Discount', 'woocommerce-cart-pdf' ),
                'default' => 0,
            ),
                array(
                    'id'     =>'contentItemsShowCouponTotalWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '10',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('contentItemsShowCouponTotal','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowCouponTotalName',
                    'type'     => 'text',
                    'title'    => __( 'Column Coupon Total', 'woocommerce-cart-pdf' ),
                    'default'  => __('Discount', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowCouponTotal','equals','1'),
                ),
            array(
                'id'       => 'contentItemsShowTotal',
                'type'     => 'checkbox',
                'title'    => __( 'Show Product Total', 'woocommerce-cart-pdf' ),
                'default' => 1,
            ),
                array(
                    'id'     =>'contentItemsShowTotalWidth',
                    'type'     => 'spinner', 
                    'title'    => __('Column Size (%)', 'woocommerce-cart-pdf'),
                    'default'  => '9',
                    'min'      => '1',
                    'step'     => '10',
                    'max'      => '100',
                    'required' => array('ccontentItemsShowTotal','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowTotalName',
                    'type'     => 'text',
                    'title'    => __( 'Column Total Name', 'woocommerce-cart-pdf' ),
                    'default'  => __('Total', 'woocommerce-cart-pdf'),
                    'required' => array('contentItemsShowTotal','equals','1'),
                ),
                array(
                    'id'       => 'contentItemsShowTotalSaved',
                    'type'     => 'checkbox',
                    'title'    => __( 'Show Product Total Saved Price', 'woocommerce-cart-pdf' ),
                    'subtitle'    => __( 'When a product is on sale or a coupon is applied it will show the difference amount that is saved.', 'woocommerce-cart-pdf' ),
                    'default' => 0,
                ),
                    array(
                        'id'       => 'contentItemsShowTotalSavedText',
                        'type'     => 'text',
                        'title'    => __( 'Product Total Saved Price Text', 'woocommerce-cart-pdf' ),
                        'default'  => __('You saved: %s', 'woocommerce-cart-pdf'),
                        'required' => array('contentItemsShowTotalSaved','equals','1'),
                    ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Extra Texts', 'woocommerce-cart-pdf' ),
        'id'         => 'extra-texts',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enableTextBeforeProducts',
                'type'     => 'checkbox',
                'title'    => __( 'Enable Text Before Products', 'woocommerce-cart-pdf' ),
                'default'   => 1,
            ),
            array(
                'id'     =>'textBeforeProducts',
                'type'  => 'editor',
                'title' => __('Text Before Products', 'woocommerce-cart-pdf'), 
                'required' => array('enableTextBeforeProducts','equals','1'),
                'default' => '<p>Dear Customer,<br><br>below you find an export of your current cart of our website.</p><h2>Cart Items</h2>',
            ),
            array(
                'id'     =>'textBeforeProductsFontSize',
                'type'     => 'spinner', 
                'title'    => __('Text font size', 'woocommerce-cart-pdf'),
                'default'  => '11',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
                'required' => array('enableTextBeforeProducts','equals','1'),
            ),
            array(
                'id'     =>'textBeforeProductsLineHeight',
                'type'     => 'spinner', 
                'title'    => __('Text line height', 'woocommerce-cart-pdf'),
                'default'  => '14',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
                'required' => array('enableTextBeforeProducts','equals','1'),
            ),
            array(
                'id'     =>'textBeforeProductsTextAlign',
                'type'  => 'select',
                'title' => __('Text Align', 'woocommerce-cart-pdf'), 
                'options'  => array(
                    'left' => __('Left', 'woocommerce-cart-pdf' ),
                    'center' => __('Center', 'woocommerce-cart-pdf' ),
                    'right' => __('Right', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'left',
                'required' => array('enableTextBeforeProducts','equals','1'),
            ),
            array(
                'id'       => 'enableTextAfterProducts',
                'type'     => 'checkbox',
                'title'    => __( 'Enable Text After Products', 'woocommerce-cart-pdf' ),
                'default'   => 1,
            ),
            array(
                'id'     =>'textAfterProducts',
                'type'  => 'editor',
                'title' => __('Text After Products', 'woocommerce-cart-pdf'), 
                'required' => array('enableTextAfterProducts','equals','1'),
                'default' => 'Thanks for creating this PDF export of your cart.<br><br>You can now print this out and go to your local dealer to buy our products.<br><br>Your Shop Name',
            ),
            array(
                'id'     =>'textAfterProductsFontSize',
                'type'     => 'spinner', 
                'title'    => __('Text font size', 'woocommerce-cart-pdf'),
                'default'  => '11',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
                'required' => array('enableTextAfterProducts','equals','1'),
            ),
            array(
                'id'     =>'textAfterProductsLineHeight',
                'type'     => 'spinner', 
                'title'    => __('Text line height', 'woocommerce-cart-pdf'),
                'default'  => '14',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
                'required' => array('enableTextAfterProducts','equals','1'),
            ),
            array(
                'id'     =>'textAfterProductsTextAlign',
                'type'  => 'select',
                'title' => __('Text Align', 'woocommerce-cart-pdf'), 
                'options'  => array(
                    'left' => __('Left', 'woocommerce-cart-pdf' ),
                    'center' => __('Center', 'woocommerce-cart-pdf' ),
                    'right' => __('Right', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'Left',
                'required' => array('enableTextAfterProducts','equals','1'),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Footer', 'woocommerce-cart-pdf' ),
        // 'desc'       => __( '', 'woocommerce-cart-pdf' ),
        'id'         => 'footer',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enableFooter',
                'type'     => 'checkbox',
                'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Enable footer', 'woocommerce-cart-pdf' ),
                'default'  => 1,
            ),
            array(
                'id'     =>'footerBackgroundColor',
                'type' => 'color',
                'url'      => true,
                'title' => __('Footer background color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'required' => array('enableFooter','equals','1'),
                'default' => '#222222',
            ),
            array(
                'id'     =>'footerTextColor',
                'type'  => 'color',
                'url'      => true,
                'title' => __('Footer text color', 'woocommerce-cart-pdf'), 
                'validate' => 'color',
                'required' => array('enableFooter','equals','1'),
                'default' => '#FFFFFF',
            ),
            array(
                'id'     =>'footerFontSize',
                'type'     => 'spinner', 
                'title'    => __('Text font size', 'woocommerce-cart-pdf'),
                'default'  => '11',
                'min'      => '1',
                'step'     => '1',
                'max'      => '40',
                'required' => array('enableFooter','equals','1'),
            ),
            array(
                'id'     =>'footerLineHeight',
                'type'     => 'spinner', 
                'title'    => __('Text line height', 'woocommerce-cart-pdf'),
                'default'  => '14',
                'min'      => '1',
                'step'     => '1',
                'max'      => '100',
                'required' => array('enableFooter','equals','1'),
            ),
            array(
                'id'     =>'footerLayout',
                'type'  => 'select',
                'title' => __('Footer Layout', 'woocommerce-cart-pdf'), 
                'required' => array('enableFooter','equals','1'),
                'options'  => array(
                    'oneCol' => __('1/1', 'woocommerce-cart-pdf' ),
                    'twoCols' => __('1/2 + 1/2', 'woocommerce-cart-pdf' ),
                    'threeCols' => __('1/3 + 1/3 + 1/3', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'oneCol',
            ),
            array(
                'id'     =>'footerTopMargin',
                'type'     => 'spinner', 
                'title'    => __('Footer Margin', 'woocommerce-cart-pdf'),
                'default'  => '10',
                'min'      => '1',
                'step'     => '1',
                'max'      => '200',
            ),
            array(
                'id'     =>'footerHeight',
                'type'     => 'spinner', 
                'title'    => __('Footer Height', 'woocommerce-cart-pdf'),
                'default'  => '20',
                'min'      => '1',
                'step'     => '1',
                'max'      => '200',
            ),
            array(
                'id'             => 'footerPadding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px'),
                'units_extended' => 'false',
                'title'          => __('Footer Padding', 'woocommerce-cart-pdf'),
                'subtitle'       => __('Choose the spacing or padding you want.', 'woocommerce-cart-pdf'),
                'default'            => array(
                    'padding-top'     => '10px', 
                    'padding-right'   => '20px', 
                    'padding-bottom'  => '10px', 
                    'padding-left'    => '20px',
                    'units'          => 'px', 
                )
            ),
            array(
                'id'     =>'footerTopLeft',
                'type'  => 'select',
                'title' => __('Top Left Footer', 'woocommerce-cart-pdf'), 
                'required' => array('enableFooter','equals','1'),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
                'default' => 'pagenumber',
            ),
            array(
                'id'     =>'footerTopLeftText',
                'type'  => 'editor',
                'title' => __('Top Left Footer Text', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopLeft','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                ),
                'default' => 'I am a custom text inside the footer.',
            ),
            array(
                'id'     =>'footerTopLeftImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Left Footer Image', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopLeft','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'footerTopMiddle',
                'type'  => 'select',
                'title' => __('Top Middle Footer', 'woocommerce-cart-pdf'), 
                'required' => array('footerLayout','equals','threeCols'),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
            ),
            array(
                'id'     =>'footerTopMiddleText',
                'type'  => 'editor',
                'title' => __('Top Middle Footer Text', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopMiddle','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'footerTopMiddleImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Middle Footer Image', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopMiddle','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'footerTopRight',
                'type'  => 'select',
                'title' => __('Top Right Footer', 'woocommerce-cart-pdf'), 
                'required' => array('footerLayout','equals',array('threeCols','twoCols')),
                'options'  => array(
                    'none' => __('None', 'woocommerce-cart-pdf' ),
                    'bloginfo' => __('Blog information', 'woocommerce-cart-pdf' ),
                    'text' => __('Custom text', 'woocommerce-cart-pdf' ),
                    'pagenumber' => __('Pagenumber', 'woocommerce-cart-pdf' ),
                    'image' => __('Image', 'woocommerce-cart-pdf' ),
                    'exportinfo' => __('Export Information', 'woocommerce-cart-pdf' ),
                ),
            ),
            array(
                'id'     =>'footerTopRightText',
                'type'  => 'editor',
                'title' => __('Top Right Footer Text', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopRight','equals','text'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
            array(
                'id'     =>'footerTopRightImage',
                'type' => 'media',
                'url'      => true,
                'title' => __('Top Right Footer Image', 'woocommerce-cart-pdf'), 
                'required' => array('footerTopRight','equals','image'),
                'args'   => array(
                    'teeny'            => false,
                )
            ),
        )
    ) );

    // $framework::setSection( $opt_name, array(
    //     'title'      => __( 'Backcover', 'woocommerce-cart-pdf' ),
    //     'id'         => 'backcover',
    //     'subsection' => true,
    //     'fields'     => array(
    //         array(
    //             'id'       => 'enableBackcover',
    //             'type'     => 'checkbox',
    //             'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
    //             'subtitle' => __( 'Enable the Backcover Page', 'woocommerce-cart-pdf' ),
    //             'default' =>  '0',
    //         ),
    //         array(
    //             'id'     =>'backcoverImage',
    //             'type' => 'media',
    //             'url'      => true,
    //             'title' => __('Backcover image', 'woocommerce-cart-pdf'), 
    //             'subtitle' => __('Recommended Image Size: 1240 x 1754 px.', 'woocommerce-cart-pdf'), 
    //             'args'   => array(
    //                 'teeny'            => false,
    //             ),
    //             'required' => array('enableBackcover','equals','1'),
    //         ),
    //     ),
    // ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Limit Access', 'woocommerce-cart-pdf' ),
        // 'desc'       => __( '', 'woocommerce-cart-pdf' ),
        'id'         => 'limit-access-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enableLimitAccess',
                'type'     => 'checkbox',
                'title'    => __( 'Enable', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Enable the limit access. This will activate the below settings.', 'woocommerce-cart-pdf' ),
            ),
            array(
                'id'     =>'role',
                'type' => 'select',
                'data' => 'roles',
                'title' => __('User Role', 'woocommerce-cart-pdf'),
                'subtitle' => __('Select a custom user Role (Default is: administrator) who can use this plugin.', 'woocommerce-cart-pdf'),
                'multi' => true,
                'default' => 'administrator',
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => __( 'Advanced settings', 'woocommerce-cart-pdf' ),
        'desc'       => __( 'Custom stylesheet / javascript.', 'woocommerce-cart-pdf' ),
        'id'         => 'advanced',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'debugMode',
                'type'     => 'checkbox',
                'title'    => __( 'Enable Debug Mode', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'This stops creating the PDF and shows the plain HTML.', 'woocommerce-cart-pdf' ),
                'default'   => 0,
            ),
            array(
                'id'       => 'debugMPDF',
                'type'     => 'checkbox',
                'title'    => __( 'Enable MPDF Debug Mode', 'woocommerce-print-products' ),
                'subtitle' => __( 'Show image , font or other errors in the PDF Rendering engine.', 'woocommerce-print-products' ),
                'default'   => 0,
            ),
            array(
                'id'       => 'performanceUseImageLocally',
                'type'     => 'checkbox',
                'title'    => __( 'Use Images Locally', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'This will get images directly from your server paths rather than requesting it from a http or https. Only enable it if your images are on the same server!', 'woocommerce-cart-pdf' ),
                'default'  => '0',
            ),
            array(
                'id'       => 'customCSS',
                'type'     => 'ace_editor',
                'mode'     => 'css',
                'title'    => __( 'Custom CSS', 'woocommerce-cart-pdf' ),
                'subtitle' => __( 'Add some stylesheet if you want.', 'woocommerce-cart-pdf' ),
            ),
        )
    ));

    $framework::setSection( $opt_name, array(
        'title'  => __( 'Preview', 'woocommerce-cart-pdf' ),
        'id'     => 'preview',
        'desc'   => __( 'Need support? Please use the comment function on codecanyon.', 'woocommerce-cart-pdf' ),
        'icon'   => 'el el-eye-open',
    ) );

    /*
     * <--- END SECTIONS
     */
