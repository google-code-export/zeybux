/*
*	Author: Julien PIERRE
*	Date: 18.08.2011
*	Version: 1.0.0
*/
jQuery.fn.numeric = function(options, callback)
{
	var defaults = {
		allowNegatives: false,
		decimal: ",",
		nbInteger: 10,
		nbDecimal: 2
	};
	
	defaults = $.extend(defaults, options);
	callback = typeof callback == "function" ? callback : function(){};	

	function getSelectionStart(o) {
		if (o.createTextRange) {
			var r = document.selection.createRange().duplicate();
			r.moveEnd('character', o.value.length);
			if (r.text == '') return o.value.length;
			return o.value.lastIndexOf(r.text);
		} else return o.selectionStart;
	}

	function getSelectionEnd(o) {
		if (o.createTextRange) {
			var r = document.selection.createRange().duplicate();
			r.moveStart('character', -o.value.length);
			return r.text.length;
		} else return o.selectionEnd;
	}

	function getNewValue(o,k,e,i) {
		var s = e.charCode == i ? String.fromCharCode(k) : '';
		var t = $(o).val(), start = getSelectionStart(o), end = getSelectionEnd(o);
		if(end == start) {
			if(k == 8 && e.charCode == 0) {start--;}
			if(k == 46 && e.charCode == 0) {end++;}
		}
		return t.substring(0, start) + s + t.substring(end, t.length);
	}

	function format(t,d,NbD,NbI) {
		t = t.replace('-','');
		if(
			(t.indexOf(d)!= -1 && (t.length - t.indexOf(d) - 1) > NbD)
		||	(	(	(t.indexOf(d) > NbI)
				||	(t.indexOf(d)== -1 && t.length > NbI)
				)
				&&	NbI > 0
			)
		||	(	NbI <= 0
			&&	(	(t.charAt(0) != 0
					&& t.charAt(0) != ''
					&& t.length > 0
					)
				||	t.indexOf(d) > 1
				||	(t.indexOf(d)== -1 
					&& t.length > 1
					)
				)
			)
		)
		{
			return false;
		}
		return true;
	}

	this.keypress(
		function(e)
		{
			var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;

			// Permet de gérer le . et la , en même temps comme séparateur décimal
			var lKeyInit = key;
			if(defaults.decimal.charCodeAt(0) == 44 && key == 46 && e.charCode == 46) { key = 44;}

			// Autorisations des touches F1/F3/F5/F6/F7/F11
			if(e.charCode == 0 && (key == 112 || key == 114 || key == 116 || key == 117 || key == 118 || key == 122) )
			{
				return true;
			}			
			// allow enter/return key (only when in an input box)
			if(key == 13 && this.nodeName.toLowerCase() == "input")
			{
				return true;
			}
			else if(key == 13)
			{
				return false;
			}
			var allow = false;
			// allow Ctrl+A
			if((e.ctrlKey && key == 97 /* firefox */) || (e.ctrlKey && key == 65) /* opera */) return true;
			// allow Ctrl+X (cut)
			if((e.ctrlKey && key == 120 /* firefox */) || (e.ctrlKey && key == 88) /* opera */) return true;
			// allow Ctrl+C (copy)
			if((e.ctrlKey && key == 99 /* firefox */) || (e.ctrlKey && key == 67) /* opera */) return true;
			// allow Ctrl+Z (undo)
			if((e.ctrlKey && key == 122 /* firefox */) || (e.ctrlKey && key == 90) /* opera */) return true;
			// allow or deny Ctrl+V (paste), Shift+Ins
			if((e.ctrlKey && key == 118 /* firefox */) || (e.ctrlKey && key == 86) /* opera */
			|| (e.shiftKey && key == 45)) return true;
			
			// Calcul de la nouvelle valeur du champ
			var t = getNewValue(this,key,e,lKeyInit);

			// if a number was not pressed
			if(key < 48 || key > 57)
			{
				// Nombre négatif
				if(defaults.allowNegatives == false && key == 45)
				{
					return false;
				}
				else if
				(
						defaults.allowNegatives == true 
					&& 	getSelectionStart(this) == 0
					&& 	t.replace(/[^-]/g, '').length <= 1
					&& 	key == 45
				)
				{
					return true;
				}

				// check for other keys that have special purposes
				if(
					key != 8 /* backspace */ &&
					key != 9 /* tab */ &&
					key != 13 /* enter */ &&
					key != 35 /* end */ &&
					key != 36 /* home */ &&
					key != 37 /* left */ &&
					key != 39 /* right */ &&
					key != 46 /* del */ 
				)
				{
					allow = false;
				}
				else
				{
					// for detecting special keys (listed above)
					// IE does not support 'charCode' and ignores them in keypress anyway
					if(typeof e.charCode != "undefined")
					{
						// special keys have 'keyCode' and 'which' the same (e.g. backspace)
						if(e.keyCode == e.which && e.which != 0)
						{
							allow = true;
						}
						// or keyCode != 0 and 'charCode'/'which' = 0
						else if(e.keyCode != 0 && e.charCode == 0 && e.which == 0)
						{
							allow = true;
						}
					}
				}
				// if key pressed is the decimal and it is not already in the field
				var exp=new RegExp("[^"+defaults.decimal+"]","g");
				if(key == defaults.decimal.charCodeAt(0) && t.replace(exp, '').length == 1 && this.value.length > 0 && defaults.nbDecimal > 0)
				{
					allow = true;
				}
				if((key == 46 || key == 8) && e.charCode == 0) { // Si suppression il faut vérifier le nouveau format
					allow = format(t,defaults.decimal,defaults.nbDecimal,defaults.nbInteger);				
				}
			}
			else // SI c'est un nombre
			{
				allow = format(t,defaults.decimal,defaults.nbDecimal,defaults.nbInteger);
			}
			
			// Si aucune décimal pas de séparateur
			if(defaults.decimal.charCodeAt(0) == key && defaults.nbDecimal <= 0) {
				allow = false;
			}
			
			// Si le caractère initial est "." alors on modifie l'écriture
			if(allow && lKeyInit == 46 && e.charCode == 46) {
				$(this).val(getNewValue(this,defaults.decimal.charCodeAt(0),e,lKeyInit));
				return false;
			}		
			return allow;
		}
	)
	.blur(
		function()
		{
			var val = jQuery(this).val();
			if(val != "")
			{
				var re = new RegExp("^\\d+$|\\d*" + defaults.decimal + "\\d+");
				if(!re.exec(val))
				{
					callback.apply(this);
				}
			}
		}
	);
	return this;
};