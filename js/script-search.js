jQuery(document).ready(function( $ ) {

	/*
     * obtiene la lista de productos e inicia el awesomplete en los buscadores
     */

	$.getJSON("http://lafuente.es/aw_database_data.json", function(json) {

    var list = json

    new Awesomplete(document.querySelector("#header .searchform input"),{ list: list }); //buscador desktop
    new Awesomplete(document.querySelector('#search'),{ list: list }); //buscador móvil
    });

	 /*
     * Aperturas y cierres Buscador
     */

     $('.search-trigger').click(function() {
        $('.search-overlay').addClass("visible");
    });


     $('.lnk-close').click(function() {
        $('.search-overlay').removeClass("visible");
    });

    $('#header .searchform input').on('click focusin', function() {
    this.value = '';
	});

	$('#search').on('click focusin', function() {
    this.value = '';
	});

    $(document).click(function(event) {
      //if you click on anything except the modal itself or the "open modal" link, close the modal
      if (!$(event.target).closest(".searchbox-container, .search-trigger").length) {
        $("body").find(".search-overlay").removeClass("visible");
      }
    });

	document.querySelector('#header .searchform input').addEventListener("awesomplete-selectcomplete", function(event) {
	     	var myForm = document.querySelector("#header .searchform");
			myForm.submit();
	});

	document.querySelector('#search').addEventListener("awesomplete-selectcomplete", function(event) {
	     	var myForm = document.querySelector("#awesoform");
			myForm.submit();
	});

})
