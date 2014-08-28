/*
*	Author: Julien PIERRE
*	Date: 12.08.2014
*	Version: 2.0.0
*/
(function($) {
	var userAgent = navigator.userAgent.toLowerCase();
	$.browser = {
	 // version: (userAgent.match( /.+(?:rv|it|ra|ie|me)[\/: ]([d.]+)/ ) || [])[1], // Ne foncitonne pas pour la version
	   chrome: /chrome/.test( userAgent ),
	   safari: /webkit/.test( userAgent ) && !/chrome/.test( userAgent ),
	   opera: /opera/.test( userAgent ),
	   msie: /(msie|trident)/.test( userAgent ) && !/opera/.test( userAgent ),
	   mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent ) && !(/(msie|trident)/.test( userAgent ) && !/opera/.test( userAgent ))
	};
}) (jQuery);
	/*
jQuery.uaMatch = function( ua ) {
	/*ua = ua.toLowerCase();

	var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
		/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
		/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
		/(msie) ([\w.]+)/.exec( ua ) ||
		/(msie) (trident)/.exec( ua ) ||
		ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
		[];

	return {
		browser: match[ 1 ] || "",
		version: match[ 2 ] || "0"
	};
	
	
	
	
};

/*
// Don't clobber any existing jQuery.browser in case it's different
if ( !jQuery.browser ) {
	matched = jQuery.uaMatch( navigator.userAgent );
	browser = {};
alert(matched.browser);
	if ( matched.browser ) {
		browser[ matched.browser ] = true;
		browser.version = matched.version;
	}

	// Chrome is Webkit, but Webkit is also Safari.
	if ( browser.chrome ) {
		browser.webkit = true;
	} else if ( browser.webkit ) {
		browser.safari = true;
	}
	
	
	if ( browser.trident ) {
		browser.msie = true;
		browser.mozilla = false;
	}
	
console.log(browser);
	jQuery.browser = browser;
}*/