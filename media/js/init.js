$.tools.validator.localize("en", {
    '*'                 : 'Por favor corrija este valor',
    '[required]'        : 'Por favor complete el campo requerido',
    ":number"           : 'Por favor ingrese un valor numerico',
    ":email"            : 'Por favor ingrese una direccion de correo valida',
    "[max]"              : 'Por favor ingrese un numero menor que $1',
    "[min]"              : 'Por favor ingrese un numero mayor que $1'
});
$.tools.validator.fn("[data-equals]", "Las contraseñas no concuerdan", function(input) {
	var name = input.attr("data-equals"),
		 field = this.getInputs().filter("[name=" + name + "]");
	return input.val() == field.val() ? true : [name];
});

$("#mascara-precarga").remove();
$("#cargando").remove();
                