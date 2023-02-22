(function( $ ) {
	'use strict';

	// Create the defaults once
	var pluginName = "WooCommerceCartPDF",
		defaults = {
			'modalHeightAuto' : '1',
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this.trans = this.settings.trans;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend( Plugin.prototype, {
		init: function() {
			this.window = $(window);
			this.documentHeight = $( document ).height();
			this.windowHeight = this.window.height();
			this.product = {};
			this.elements = {};

			this.emailSendPopup();
		},
		emailSendPopup : function() {

			var that = this;
			var overlay = $('.woocommerce-cart-pdf-overlay');
			var popup = $('.woocommerce-cart-pdf-popup-container');

			if(overlay.length < 1) {
				return ;
			}

			var toggler = $('.woocommerce-cart-pdf-email-button');
			toggler.on('click', function(e) {

				e.preventDefault();
				overlay.fadeIn();
				popup.fadeIn();
			});

			overlay.on('click', function(e) {
				$(this).fadeOut();
				popup.fadeOut();
			});

			$(document).on('submit', '.woocommerce-cart-pdf-email-form', function(e) {

				e.preventDefault();

				var $this = $(this);
				var to = $this.find('.woocommerce-cart-pdf-email-to').val();
				var text = $this.find('.woocommerce-cart-pdf-email-text').val();

				if(!to || to == "") {
					alert('Fields missing');
					return false;
				}
				
				$('.woocommerce-cart-pdf-email-send').attr('disabled', 'disabled');
				jQuery.ajax({
					url: that.settings.ajax_url,
					type: 'post',
					dataType: 'JSON',
					data: {
						action: 'woocommerce_cart_pdf_send_email',
						to: to,
						text: text,
					},
					success : function( response ) {
						if(response.status == 0) {
							alert(response.message);
							$('.woocommerce-cart-pdf-email-send').removeAttr('disabled');
							return false;
						}

						$this.html(that.settings.sendCartEMailSuccessText);
					},
					error: function(jqXHR, textStatus, errorThrown) {
					    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
					}
				});

			});
		},
	} );

	// Constructor wrapper
	$.fn[ pluginName ] = function( options ) {
		return this.each( function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" +
					pluginName, new Plugin( this, options ) );
			}
		} );
	};

	$(document).ready(function() {

		$( "body" ).WooCommerceCartPDF(woocommerce_cart_pdf_options);

	} );

})( jQuery );