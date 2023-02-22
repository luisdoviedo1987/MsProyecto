var page = {
  Init: function () {
    document.getElementById("result-products").src =
      "https://cotizador.medismart.net/ms/manage/";
  },
};

jQuery(document).ready(function () {
  page.Init();
});
