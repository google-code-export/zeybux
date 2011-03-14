;function CommunVue() {
	
	this.comDelete = function(pData) {	
		pData.find(".com-delete").click( function () { $(this).parent().parent().remove(); });
		return pData;	
	}
	
	this.comNumeric = function(pData) {
		if($(pData).length != 0)
			pData.find('.com-numeric').numeric(',');
		else
			$("body").find('.com-numeric').numeric(',');
		return pData;
	}
	
	this.comLienDatepicker = function(pDatePetite,pDateGrande,pData) {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
		var dates = pData.find('#' + pDatePetite + ',#' + pDateGrande).datepicker({
			changeMonth: true,
			changeYear: true,
			onSelect: function(selectedDate) {
				var option = this.id == pDatePetite ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
		return pData;
	}
	
	this.comDatepicker = function(pIdDate,pData) {
		$.datepicker.setDefaults($.datepicker.regional['fr']);
		pData.find('#' + pIdDate).datepicker({
			changeMonth: true,
			changeYear: true});
		return pData;		
	}
	
	this.majMenu = function(pModule,pVue) {
		var lId = '#menu-' + pModule + '-' + pVue;
		if(pModule == 'administration') {
			lId = '#lien-administration';
		}
		$('.btn-menu').removeClass("ui-state-active");
		$(lId).addClass("ui-state-active");		
	}
	
	this.comHoverBtn = function(pData) {
		pData.find(	".com-button:not(.ui-state-disabled)," +
					".com-btn-header:not(.ui-state-disabled)," +
					".com-btn-header-multiples:not(.ui-state-disabled)")
		.hover(
			function(){ 
				$(this).addClass("ui-state-hover"); 
			},
			function(){ 
				$(this).removeClass("ui-state-hover"); 
			}
		)
		.mousedown(function(){
				$(this).addClass("ui-state-active");	
		})
		.mouseup(function(){
				$(this).removeClass("ui-state-active");
		});
		
		return pData;
	}
}