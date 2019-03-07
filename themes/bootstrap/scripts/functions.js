/**
 * 
 * @param {type} header
 * @param {type} message
 * @param {type} _class
 * @param {type} tag
 * @returns {undefined}
 */
function showAlertAnimated(header, message, _class, tag) {
	var _html = message;
	$(tag).removeClass().removeAttr("style").html(_html).addClass("alert alert-block " + _class)
		.animate({ opacity: 1.0 }, 4000).fadeOut("slow");
}

/**
 * Muestra un mensaje animado
 * @param {type} success
 * @param {type} successHeader
 * @param {type} successMessage
 * @param {type} errorHeader
 * @param {type} errorMessage
 * @param {type} tag
 * @returns {undefined}
 */
function showAlertAnimatedToggled(success, successHeader, successMessage, errorHeader, errorMessage, tag) {
	if (!tag) var tag = "#flash";
	console.log("Tag: " + tag);
	if (success) {
		showAlertAnimated(successHeader, successMessage, "alert-success", tag);
	} else {
		showAlertAnimated(errorHeader, errorMessage, "alert-error", tag);
	}
}
/**
 * Redirecciona a la URL indicada con un delay asignado
 * @param {type} url
 * @param {type} delay
 * @returns {undefined}
 */
function redirectTime(url, delay){
	setTimeout(function(){ 
		window.location = url;
	}, delay);
}

/**
 * 
 * @param {type} e
 * @returns {Number|window.event.keyCode|Window.event.keyCode}
 */
function getkey(e){
	if (window.event) {
		shift= event.shiftKey;
		ctrl= event.ctrlKey;
		alt=event.altKey;
		return window.event.keyCode;
	}
	else if (e) {
		var valor=e.which;
		if (valor>96 && valor<123) {
			valor=valor-32;
		}
		return valor;
	}
	else
		return null;
}


/**
 * Limpia todos los campos de un formulario
 * @returns String elemento o id html
 */
function clear_form_elements(ele) {
    $(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}