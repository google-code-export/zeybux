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