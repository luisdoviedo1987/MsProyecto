(function( $ ) {
	'use strict';

	var openPreviewBtn = $('#11_section_group_li');
	var previewFrameContainer = $('#cart-pdf-preview-frame-container');
	var previewFrame = $('#cart-pdf-preview-frame');
	var previewFrameSpinner = $('#cart-pdf-preview-spinner');
	var previewCategoryID= $('#cart-pdf-preview-category-id');
	var overlay = $('.cart-pdf-preview-frame-overlay');

	previewFrame.load(function(){
        $(this).show();
        previewFrameSpinner.hide();
        previewFrame.show();
    });

	openPreviewBtn.on('click', function(e) {
		e.preventDefault();

		var category_id = $(previewCategoryID).val();

		overlay.fadeIn();
		previewFrameContainer.fadeIn();
		previewFrameSpinner.show();

		previewFrame.attr("src", woocommerce_cart_pdf_options.frontend_url + '?cart-pdf=' + category_id);

	});

	previewCategoryID.on('change', function(e) {

		var category_id = $(this).val();

		previewFrame.hide();
		previewFrameSpinner.show();
		previewFrame.attr("src", woocommerce_cart_pdf_options.frontend_url + '?cart-pdf=' + category_id);
	})

	overlay.on('click', function(e) {
		e.preventDefault();
		previewFrameContainer.fadeOut();
		overlay.fadeOut();
	});


})( jQuery );