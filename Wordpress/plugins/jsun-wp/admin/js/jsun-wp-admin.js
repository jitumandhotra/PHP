(function( $ ) {
	'use strict';

	/*
		$(function() {	});
	*/

	$( window ).load(function() {    

		$('.nav-tab').click(function(event) {
            event.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.tab-content').hide();
            $($(this).attr('href')).show();
        });

        $('#generateApiKey, #generateNewApiKey').click(function(event) {
        	$.ajax({
        		method : 'POST',
			    url: jsun.adminUrl+'admin-ajax.php',
			    data: {
			      action: 'jsun_generate_api_key',			      
			    },
			    success: function(response) {
			    	$('#textToCopy').html(response.data.data.api_key);
			    },
			    error: function(jqXHR, textStatus, errorThrown) {
			      console.error('AJAX Error:', textStatus, errorThrown);
			    }
		  	});
		});       
    

	    function copyToClipboard(text) {
	        var tempInput = document.createElement("input");
	        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
	        tempInput.value = text;
	        document.body.appendChild(tempInput);
	        tempInput.select();
	        document.execCommand("copy");
	        document.body.removeChild(tempInput);
	        alert('Copied to clipboard: ' + text);
	    }    

	});


})( jQuery );
