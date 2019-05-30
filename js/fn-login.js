// Background changer
/*
 * fn-login.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {
	
	'use strict';

	/* Inits */
	/* --------------------------------------------------------- */

	var img_array = ['TFE1.png','TFE2.png', 'TFE3.png', 'TFE4.png', 'TFE5.png'],
        newIndex = 0, index = 0, interval = 6000;
    (function changeBg() {
        index = (index + 1) % img_array.length;

        $('body').css('backgroundImage', function () {
            return 'url(img/' + img_array[index] +')';
        });
        setTimeout(changeBg, interval);
    })();

	/* --------------------------------------------------------- */
    

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */