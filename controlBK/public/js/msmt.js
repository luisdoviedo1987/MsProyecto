$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content") } });
    $.validator.setDefaults({
        ignore: [],
        errorClass: "e-validation-error",
        errorPlacement: function (error, element) {
            $(error).insertAfter(element.closest(".e-widget"));
        },
    });
});
function rmss(s, t, m, b, u) {
    setTimeout(function () {
        if (s) {
            $(".cart-basket-count").each(function () {
                $(this).html(parseInt($(this).html()) + 1);
            });
        }
        $(".bd-loading-modal-lg").modal("hide");
        $("#success_modal").modal("show");
        $("#success_modal_title").html(t);
        $("#success_modal_subtitle").html(m);
        if (b != null) {
            $("#success_modal_body_buttons").show();
            $("#success_modal_body_buttons").val(b);
            $("#success_modal_body_btn_carrito").on("click", function () {
                window.location.replace(u);
            });
        }
    }, 1000);
}
function rmse(t, m) {
    setTimeout(function () {
        $(".bd-loading-modal-lg").modal("hide");
        $("#error_modal").modal("show");
        $("#error_modal_title").html(t);
        $("#error_modal_subtitle").html(m);
    }, 1000);
}

function rmload() {
    setTimeout(function () {
        $(".bd-loading-modal-lg").modal("hide");
    }, 500);
}
