$( document ).ready(function() {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  var dataFinal = [];
  let data = {};

  $(".next").on("click", function(e){
    e.preventDefault();
    current_fs = $(this).parent().parent();
    next_fs = $(this).parent().parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
  });

  $(".previous").click(function (e) {
    e.preventDefault();
    current_fs = $(this).parent().parent();
    previous_fs = $(this).parent().parent().prev();

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
  });

  /* return data of inputs */
  $(".form_planes_mascotas").on("click", ".btnFinal", function (e) {
    e.preventDefault();

    console.log("la data final es", dataFinal);
    toggleSidebar();
    $('.fieldset_dinamic').remove();
    $('.form_planes_mascotas')[0].reset();
    $('.fieldset_main').css("display","block")
    $('.fieldset_main').css("opacity","1")

    
  });
  
});

$("form").submit(function (e) {
  e.preventDefault();
});

/* funcion live click for next fieldset dynamic */
$(".form_planes_mascotas").on("click", ".next_formulario", function(e){
  e.preventDefault();
  current_fs = $(this).parent().parent();
  next_fs = $(this).parent().parent().next();

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          display: "none",
          position: "relative",
        });
        next_fs.css({ opacity: opacity });
      },
      duration: 500,
    }
  );
});

/* funcion live click for back fieldset dynamic */
$(".form_planes_mascotas").on("click", ".previus_formulario", function(e){
  e.preventDefault();
  current_fs = $(this).parent().parent();
  previous_fs = $(this).parent().parent().prev();

  //show the previous fieldset
  previous_fs.show();

  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          display: "none",
          position: "relative",
        });
        previous_fs.css({ opacity: opacity });
      },
      duration: 500,
    }
  );
});

//clean fieldset in modal close quatity of 

$(".btn_close_clean").click(function (e) { 
  e.preventDefault();
  $('.cantidadFormControl').val('');
  $('.fieldset_dinamic').remove();
});$( document ).ready(function() {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  var dataFinal = [];
  let data = {};

  $(".next").on("click", function(e){
    e.preventDefault();
    current_fs = $(this).parent().parent();
    next_fs = $(this).parent().parent().next();

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
  });

  $(".previous").click(function (e) {
    e.preventDefault();
    current_fs = $(this).parent().parent();
    previous_fs = $(this).parent().parent().prev();

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
  });

  /* return data of inputs */
  $(".form_planes_mascotas").on("click", ".btnFinal", function (e) {
    e.preventDefault();

    console.log("la data final es", dataFinal);
    toggleSidebar();
    $('.fieldset_dinamic').remove();
    $('.form_planes_mascotas')[0].reset();
    $('.fieldset_main').css("display","block")
    $('.fieldset_main').css("opacity","1")

    
  });
  
});

$("form").submit(function (e) {
  e.preventDefault();
});

/* funcion live click for next fieldset dynamic */
$(".form_planes_mascotas").on("click", ".next_formulario", function(e){
  e.preventDefault();
  current_fs = $(this).parent().parent();
  next_fs = $(this).parent().parent().next();

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          display: "none",
          position: "relative",
        });
        next_fs.css({ opacity: opacity });
      },
      duration: 500,
    }
  );
});

/* funcion live click for back fieldset dynamic */
$(".form_planes_mascotas").on("click", ".previus_formulario", function(e){
  e.preventDefault();
  current_fs = $(this).parent().parent();
  previous_fs = $(this).parent().parent().prev();

  //show the previous fieldset
  previous_fs.show();

  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          display: "none",
          position: "relative",
        });
        previous_fs.css({ opacity: opacity });
      },
      duration: 500,
    }
  );
});

//clean fieldset in modal close quatity of 

$(".btn_close_clean").click(function (e) { 
  e.preventDefault();
  $('.cantidadFormControl').val('');
  $('.fieldset_dinamic').remove();
});