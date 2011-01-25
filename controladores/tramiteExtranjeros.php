<?
if ($_POST) {


    if ($_POST["dni"]) {
        $ente = $_POST['dni'];
        $tipo = $_POST['tipoTramite'];
        $datos = array(
            "dni" => $ente,
            "tipo" => $tipo,
            "tramites" => $_POST["opciones"]
        );
        $_SESSION["datosTramite"] = $datos;

        Html::redireccionar("formTramiteExtranjero");

    }
}
?>

<script type="text/javascript">







    function validar()
    {
        

        form = $("#myform").validator();
        if ($("input:checked").size() > 0)
        {
            if (form.data("validator").checkValidity())
            {
                form.data("validator").destroy();
                dni = $("#dniEnte").val();

                $.ajax({
                    url: 'ajax/checkDni.php',
                    type: 'POST',
                    data: 'dni=' + dni + '&checkExtranjero=true',
                    cache: false,
                    dataType: 'json',
                    success: function(data,ev){
                        if (data.respuesta == true)
                        {
                            /*
                            $("#dniExistente").slideDown('slow', function(){});
                            $("#dniExistente").removeClasse('escondido');
                             */
                            $("#dniExistente").dialog({
                                modal: true,
                                draggable: false,
                                width: 400,
                                title: "Que desea hacer?",
                                resizable: false,
                                closeOnEscape: false,
                                buttons: {

				"Editar Ultimo Tramite": function() {
                                        $("#tipoTramite").val("editarTramite");
					$("#myform").submit();
				},
				"Crear Tramite": function() {
                                        $("#tipoTramite").val("crearTramite");
					$("#myform").submit();
				}
			}

                            });
                        } else if (data.respuesta == false) {

                            $("#myform").submit();

                        } else {
                            alert (data.respuesta);
                        }


                    }
                })
            }
        } else {
            alert("Debe seleccionar por lo menos un tramite a realizar");
        }
    }
    $(document).ready(function(){
        $("select, input:text, input:checkbox, input:radio, input:file,input:submit, textarea").uniform();
        $("#myform").dialog({
            title       : "Tramites Extranjeros :: Seleccione categorias",
            autoload    : true,
            position    : [0,0],
            dialogClass : 'dialogo',
            draggable   : false,
            resizable   : false,
            closeOnEscape: false,
            width       : 400,
            buttons     : {
                "Comenzar Trámites": function(){
                    validar();
                }
            },
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
        });

        $("#myform").keypress(function(e){


            if (e.keyCode == '13'){

                validar();
                e.preventDefault();
            }

        });

    });

</script>
<form id="myform" method="POST" action="">
    <input type="hidden" name="tipoTramite" id="tipoTramite" value=""/>




    <table id="tblAcciones" border="0" width="100%" cellspacing="5" cellpadding="0">
        <tr>
            <td align="right">Cambio de Domicilio </td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="cambioDomicilio"></td>          
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="actualizacionMayor16"></td>
            <td align="right">Actualización Mayor 16</td>
        </tr>
        <tr>
            <td align="right">Reposición </td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="reposicion"></td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="identificacion"></td>
            <td align="right">Identificación</td>
        </tr>
        <tr>
            <td align="right">Rectificación </td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="rectificacion"></td>
            
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="cambioCategoria"></td>
            <td align="right">Cambio de Categoría</td>
        </tr>
        <tr>
            <td align="right">Nuevo Ejemplar </td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="nuevoEjemplar"></td>
            
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="prorroga"></td>
            <td align="right">Prórroga</td>
        </tr>
        <tr>
            <td align="right">Actualización Menor </td>
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="actualizacionMenor"></td>
            
            <td align="center" width="20"><input type="checkbox" name="opciones[]" value="nuevaTarjeta"></td>
            <td align="right">Nueva Tarjeta</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right; ">
                <label for="dni" style="margin: 10px 7px 0 0">D.N.I.:
                    <input name="dni" type="text" id="dniEnte" size="8" maxlength="8" required="required"/>
                </label>
            </td>

        </tr>



    </table>





</form>



<div id="dniExistente" class="escondido">

        <p style="text-align: center">Ya existen tramites con este DNI, que desea hacer?</p>

</div>