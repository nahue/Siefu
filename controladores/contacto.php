<style type="text/css">
    textarea{
        -moz-border-radius:4px 4px 4px 4px;
        background-color:#666666;
        border:1px solid #444444;
        color:#DDDDDD;
        font-size:12px;
        padding:5px;
        
    }

    table td{
        text-align:right;
}
    table td input
    {
        float:left;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("select, input:text, input:checkbox, input:radio, input:file, textarea").uniform();
        $("#myform").dialog({
            title       : "Formulario de Contacto",
            autoload    : true,
            position    : [0,0],
            dialogClass : 'dialogo',
            draggable   : false,
            resizable   : false,
            width       : 400,
            buttons     : {
                "Enviar Consulta": function(){
                    if (formulario.data("validator").checkValidity())
                {
                    $.ajax({
                        url: 'ajax/enviarMail.php',
                        type: 'POST',
                        data: $("#myform").serialize(),
                        cache: false,
                        dataType: 'json',
                        success: function(data){
                            if (data.respuesta == "true")
                                {
                                    alert("Su consulta fue enviada correctamente.");
                                } else {
                                    alert(data.respuesta);
                                }
                        }
                    });
                }
                }
            },
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
        });
        formulario = $("#myform").validator();


    });
</script>
<form id="myform" method="POST">
    <table>
        <tr>
            <td>Nombre y Apellido: </td>
            <td><input type="text" name="nombre_apelido" size="30" required="required"/></td>
        </tr>
        <tr>
            <td>Correo Electrónico: </td>
            <td><input type="email" name="correo_electronico" size="30" required="required"/></td>
        </tr>
        <tr>
            <td>Mensaje: </td>
            <td><textarea col="20" rows="7" type="text" name="mensaje" style="width:257px" required="required"></textarea></td>
        </tr>

    </table>
</form>