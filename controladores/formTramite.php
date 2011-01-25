<?php
$claseInput = "text";
$tramites = $_SESSION["datosTramite"]["tramites"];

if ($_SESSION["datosTramite"]["tipo"] == "editarTramite" || $_SESSION["datosTramite"]["tipo"] == "crearTramite") {

    $tablaEnte = Doctrine_Core::getTable("Ente")->findOneByDni($_SESSION["datosTramite"]["dni"]);
    $ente = $tablaEnte->toArray();

    $q = Doctrine_Query::create()
                    ->from("Domicilio d")
                    ->where("d.ente_id = ?", $ente["id"])
                    ->orderBy("d.id DESC");


    $domicilios = $q->execute();

    $domicilio = $domicilios->get(0);
    $domicilioAnterior = $domicilios->get(1);

    $educacional = Doctrine_Core::getTable("Educacional")->findOneBy("ente_id", $ente["id"]);
};
if ($_SESSION["datosTramite"]["tipo"] == "editarTramite") {
?>
    <script type="text/javascript">
        ente = {
            'dni'                   : '<?= $ente["dni"] ?>',
            'dni2'                  : '<?= $ente["dni2"] ?>',
            'apellido'              : '<?= $ente["apellido"] ?>',
            'nombre'                : '<?= $ente["nombre"] ?>',
            'veterano'              : '<?= $ente["veterano"] ?>',
            'sexo_id'               : '<?= $tablaEnte->Sexo->get("id") ?>',
            'fecha_nacimiento'      : '<?= Bd::FechaMysqlaFecha($ente["fecha_nacimiento"]) ?>',
            'pais_id'               : '<?= $tablaEnte->Pais->get("id") ?>',
            'provincia_nacimiento'  : '<?= $tablaEnte->provincia_nacimiento->get("descripcion") ?>',
            'localidad_nacimiento'  : '<?= $tablaEnte->localidad_nacimiento->get("descripcion") ?>',
            'partido_nacimiento'    : '<?= $tablaEnte->partido_nacimiento->get("descripcion") ?>',
            'id_estado_civil'       : '<?= $tablaEnte->EstadoCivil->get("id") ?>',
            'provincia'             : '<?= $domicilio->Provincia->get("descripcion") ?>',
            'partido_depto'         : '<?= $domicilio->PartidoDepto->get("descripcion") ?>',
            'localidad'             : '<?= $domicilio->Localidad->get("descripcion") ?>',
            'barrio'                : '<?= $domicilio->get("barrio") ?>',
            'calle'                 : '<?= $domicilio->Calle->get("descripcion") ?>',
            'nro_calle'             : '<?= $domicilio->get("nro_calle") ?>',
            'piso'                  : '<?= $domicilio->get("piso") ?>',
            'depto'                 : '<?= $domicilio->get("depto") ?>',
            'cod_postal'            : '<?= $domicilio->get("cod_postal") ?>',
            'telefono'              : '<?= $domicilio->get("telefono") ?>',

            /* DOMICILIO ANTERIOR */
            'provincia_anterior'    : '<?= $domicilioAnterior->Provincia->get("descripcion") ?>',
            'partido_depto_anterior': '<?= $domicilioAnterior->PartidoDepto->get("descripcion") ?>',
            'localidad_anterior'    : '<?= $domicilioAnterior->Localidad->get("descripcion") ?>',
            'barrio_anterior'       : '<?= $domicilioAnterior->get("barrio") ?>',
            'calle_anterior'        : '<?= $domicilioAnterior->Calle->get("descripcion") ?>',
            'nro_calle_anterior'    : '<?= $domicilioAnterior->get("nro_calle") ?>',
            'piso_anterior'         : '<?= $domicilioAnterior->get("piso") ?>',
            'depto_anterior'        : '<?= $domicilioAnterior->get("depto") ?>',
            'cod_postal_anterior'   : '<?= $domicilioAnterior->get("cod_postal") ?>',
            'telefono_anterior'     : '<?= $domicilioAnterior->get("telefono") ?>',
            'lee_escribe'           : '<?= $educacional["lee_escribe"] ?>',
            'mas_nivel_educacional' : '<?= $educacional["mas_nivel_educacional"] ?>',
            'carrera'               : '<?= $educacional["Carrera"]["descripcion"] ?>',
            'profesion'             : '<?= $educacional["profesion"] ?>',
            'titulo_posgrado'       : '<?= $educacional["titulo_posgrado"] ?>',
            'ocupacion'             : '<?= $educacional["ocupacion"] ?>',
            'cambios'               : '<?= $educacional["cambios"] ?>'


        };

    </script>
<?
}

if ($_SESSION["datosTramite"]["tipo"] == "crearTramite") {
?>
    <script type="text/javascript">
        ente = {
            'dni'                   : '<?= $ente["dni"] ?>',
            'dni2'                  : '<?= $ente["dni2"] ?>',
            'apellido'              : '<?= $ente["apellido"] ?>',
            'nombre'                : '<?= $ente["nombre"] ?>',
            'veterano'              : '<?= $ente["veterano"] ? 1 : 0 ?>',
            'sexo_id'               : '<?= $tablaEnte->Sexo->get("id") ?>',
            'fecha_nacimiento'      : '<?= Bd::FechaMysqlaFecha($ente["fecha_nacimiento"]) ?>',
            'pais_id'               : '<?= $tablaEnte->Pais->get("id") ?>',
            'provincia_nacimiento'  : '<?= $tablaEnte->provincia_nacimiento->get("descripcion") ?>',
            'localidad_nacimiento'  : '<?= $tablaEnte->localidad_nacimiento->get("descripcion") ?>',
            'partido_nacimiento'    : '<?= $tablaEnte->partido_nacimiento->get("descripcion") ?>',
            'id_estado_civil'       : '<?= $tablaEnte->EstadoCivil->get("id") ?>',
            'provincia_anterior'             : '<?= $domicilio->Provincia->get("descripcion") ?>',
            'partido_depto_anterior'         : '<?= $domicilio->PartidoDepto->get("descripcion") ?>',
            'localidad_anterior'             : '<?= $domicilio->Localidad->get("descripcion") ?>',
            'barrio_anterior'                : '<?= $domicilio->get("barrio") ?>',
            'calle_anterior'                 : '<?= $domicilio->Calle->get("descripcion") ?>',
            'nro_calle_anterior'             : '<?= $domicilio->get("nro_calle") ?>',
            'piso_anterior'                  : '<?= $domicilio->get("piso") ?>',
            'depto_anterior'                 : '<?= $domicilio->get("depto") ?>',
            'cod_postal_anterior'            : '<?= $domicilio->get("cod_postal") ?>',
            'telefono_anterior'              : '<?= $domicilio->get("telefono") ?>',
            'lee_escribe'           : '<?= $educacional["lee_escribe"] ?>',
            'mas_nivel_educacional' : '<?= $educacional["mas_nivel_educacional"] ?>',
            'carrera'               : '<?= $educacional["Carrera"]["descripcion"] ?>',
            'profesion'             : '<?= $educacional["profesion"] ?>',
            'titulo_posgrado'       : '<?= $educacional["titulo_posgrado"] ?>',
            'ocupacion'             : '<?= $educacional["ocupacion"] ?>',
            'cambios'               : '<?= $educacional["cambios"] ?>'
        };
        $(document).ready(function(){
            $("#domicilioAnterior input").attr("disabled",true);
        });

    </script>

<?
}
$listadoSexos = Doctrine_Core::getTable('Sexo')->findAll()->getData();
$listadoEC = Doctrine_Core::getTable('EstadoCivil')->findAll()->getData();
$paises = Doctrine_Core::getTable('Pais')->findAll()->getData();
$provincias = Doctrine_core::getTable('Provincia')->findAll()->getData();
?>
<script type="text/javascript">
    $(document).ready(function(){
        //$("#formTramite").form();
        $("select, input:text, input:checkbox, input:radio, input:file, input:submit, textarea").uniform();
        /*
         * ESTO SE CORRE SOLO SI
         * SE VA A EDITAR UN TRAMITE
         */
        if (typeof ente != "undefined")
        {
                
            $.each(ente,function(k,v){

                $("input[name='"+k+"']").val(v);

                $("select[name='"+k+"'] option[value="+v+"]").attr("selected", true);
                $("select[name='"+k+"']").change();
            });

        }

        $('.fecha').inputmask('d/m/y');

        //$('#boleta_prenumerada').inputmask('6734019999########00000#');
        $('.telefono').inputmask({mask:'(####) #############', placeholder: ' '});

        $("input.autocompletar").autocomplete({
            search : function (event,ui)
            {
                $(this).autocomplete( "option" , "source" , "ajax/autocompletar.php?id=" + this.id )
            }
            //source: 'ajax/autocompletar' +  + '.php'
        });



        $("#dni").val(<?= $_SESSION["datosTramite"]["dni"] ?>);
        $("#id_oficina_seccional").val(<?= $_SESSION['usuario']['Entidad']['numero'] ?>);
        $("#oficina_seccion").val('<?= $_SESSION['usuario']['Entidad']['descripcion'] ?>');

        $("#formTramite").validator({

            effect:'efecto'
            //lang: 'es'
        }).submit(function(e){
            var form = $(this);
            if (!e.isDefaultPrevented()) {


                var boleta = $("#boleta_prenumerada").val();
                
                
                $.getJSON("ajax/checkBoleta.php", { 'boleta' : boleta}, function(json){
                    if (json === true)  {


                        $.ajax({
                            url: "ajax/procesarFormulario.php",
                            type: 'POST',
                            dataType: 'json',
                            data: form.serialize(),
                            success: function(data){
                                if (data.respuesta == 'true')
                                {
                                    window.location.href = '<?= Html::urlModulo("mostrarTramite") ?>'
                                    /*
                                    $.colorbox({
                                        iframe: true,
                                        width: '100%',
                                        height: '100%',
                                        href: '<?= Html::urlModulo("generarPDF") ?>'
                                    });
                                    */
                                }
                            }
                            
                        });
                        return true;
                        
                    } else {

                        form.data("validator").invalidate(json);
                        return false;
                    }
                });

                e.preventDefault();

            }
        });

        $("#formTramite").bind("onFail", function(e, errors) {
            // we are only doing stuff when the form is submitted
            //if (e.originalEvent.type == 'submit') {

            // loop through Error objects and add the border color
            $.each(errors, function() {
                var input = this.input;
                input.addClass("errorBorder").focus(function() {
                    input.removeClass("errorBorder");

                });
                input.blur(function(){
                    input.removeClass("errorBorder");
                })
            });
            //}
        });



        $("#apellido").keypress(function(){
            $("#apellido_titular").val( $("#apellido").val());
        });

        $("#nombre").keypress(function(){
            $("#nombre_titular").val( $("#nombre").val());
        });

        $("#dni").keypress(function(){
            $("#dni_titular").val( $("#dni").val());
        });

        $("#mantenerDomicilio").change(function(){
            if ( $(this).attr('checked') == true )
            {
                $("#domicilioActual input:text").attr("disabled","1");

                inputs = $("table#domicilioActual input[type=text]");

                $.each(inputs,function(i,input){
                    //console.log($(input).attr("id")) ;
                    error = $(".error[rel='"+ $(input).attr("id") +"']");
                    $(error).css({
                        visibility:"hidden"
                    });
                });
            } else {
                $("#domicilioActual input:text").removeAttr("disabled");
            }
        });
        $("#omitirDomicilioAnterior").change(function(){
            if ( $(this).attr('checked') == true )
            {
                $("#domicilioAnterior input:text").attr("disabled","1");

                inputs = $("table#domicilioAnterior input[type=text]");

                $.each(inputs,function(i,input){
                    //console.log($(input).attr("id")) ;
                    error = $(".error[rel='"+ $(input).attr("id") +"']");
                    $(error).css({
                        visibility:"hidden"
                    });
                });
            } else {
                $("#domicilioAnterior input:text").removeAttr("disabled");
            }
        });
    });

</script>
<div id="prueba"></div>
<form id="formTramite" name="form1" method="post" action="">
    <h2>Registro Nacional de las Personas - Formulario Único</h2>

    <? if (!in_array("identificacion", $tramites)): ?>
        <table class="formulario">
            <tr>
                <td >Matricula</td>
                <td><input type="number" name="dni" id="dni" required="required" size="8" maxlength="8" readonly="readonly"/></td>
                <td >2da Matricula</td>
                <td><input type="text" name="dni2" id="dni2"  /></td>
            </tr>
            <tr>
                <td>Apellido/s</td>
                <td><input type="text" name="apellido" id="apellido" required="required" /></td>
                <td>Nombre/s</td>
                <td><input type="text" name="nombre" id="nombre" required="required" /></td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td>
                <?php echo Html::selectBox("sexo_id", $listadoSexos, "Seleccione un Sexo"); ?>

            </td>
            <td>Veterano de Guerra</td>
            <td><select id="veterano" name="veterano" required="required" type="number" data-message='Debe elegir una opcion'>
                    <option>Seleccione un valor</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select></td>
        </tr>
    </table>
    <? endif; ?>
                <h4>Bloque 1 - Datos del nacimiento</h4>
                <!-- SIEMPRE VA -->
                <table class="formulario">
                    <tr>
                        <td>Fecha de Nac.</td>
                        <td>
                            <input name="fecha_nacimiento" type="text" id="fecha_nacimiento" size="8" required="required" class="fecha"/>

                            (DD/MM/AAAA)
                        </td>
                        <td>Pais</td>
                        <td><?php echo Html::selectBox("pais_id", $paises, "Seleccione un Pais", 12); ?></td>
                    </tr>
                    <tr>
                        <td>Provincia - Estado</td>
                        <td><input type="text" name="provincia_nacimiento" class="autocompletar" id="provincia_nacimiento" required="required"/></td>
                        <td>Ciudad - Pueblo</td>
                        <td><input type="text" name="localidad_nacimiento" class="autocompletar" id="localidad_nacimiento" required="required"/></td>
                    </tr>
                    <tr>
                        <td>Partido/Depto</td>
                        <td>
                            <input type="text" name="partido_nacimiento" class="autocompletar" id="partido_nacimiento" required="required"/>
                        </td>
                        <td >Estado Civil</td>
                        <td>
                <?php echo Html::selectBox("id_estado_civil", $listadoEC, "Seleccione un Estado Civil"); ?>
            </td>
        </tr>
    </table>
    <h4>Datos del tramite iniciado</h4>
    <!-- SIEMPRE VA -->
    <table class="formulario">
        <tr>
            <td >Boleta Prenumerada nº</td>
            <td>
                <input type="number"  name="boleta_prenumerada"
                       id="boleta_prenumerada" required="true" title="Solo numeros"
                       size="30" maxlength="25"/>
            </td>
            <td >Fecha del Tramite</td>
            <td><input type="text" name="fecha_tramite" id="fecha_tramite" required="required" class="fecha" value="<?php echo Date('d/m/Y'); ?>"/></td>
        </tr>
        <tr>
            <td >Nº Of. Secc.</td>
            <td><input type="text" name="id_oficina_seccional" id="id_oficina_seccional" readonly="readonly"/></td>
            <td >Of Seccional De</td>
            <td><input type="text" name="oficina_seccion" id="oficina_seccion" rreadonly="readonly"/></td>
        </tr>
        <!--
        <tr>
            <td >Apellido/s Titular</td>
            <td><input type="text" name="apellido_titular" id="apellido_titular" readonly="readonly"/></td>
            <td >Nombre/s Titular</td>
            <td><input type="text" name="nombre_titular" id="nombre_titular" readonly="readonly"/></td>
        </tr>

        <tr>
            <td >Nº Matricula</td>
            <td><input type="text" name="dni_titular" id="dni_titular"/></td>
            <td ></td>
            <td></td>
        </tr>
        -->
    </table>
    <h4>Bloque 2 - Domicilio Actual</h4>
    <!-- SIEMPRE VA -->

    <table class="formulario" id="domicilioActual">
        <?php if ($_SESSION["datosTramite"]["tipo"] != "") {
 ?>
                    <tr>
                        <td>Mantener Domicilio</td>
                        <td><input type="checkbox" name="mantenerDomicilio" title="Mantener Domicilio" id="mantenerDomicilio" /></td>
                    </tr>

<? } ?>

                <tr>
                    <td >Provincia</td>
                    <td><input type="text" name="provincia" id="provincia" class="autocompletar" class="text" required="required"/></td>
                    <td >Partido - Dto</td>
                    <td><input type="text" name="partido_depto" id="partido_depto" class="autocompletar" class="text" required="required"/></td>
                </tr>
                <tr>
                    <td >Localidad</td>
                    <td><input type="text" name="localidad" class="autocompletar" id="localidad" class="text" required="required"/></td>
                    <td >Barrio - Monoblock - Edificio</td>
                    <td><input type="text" name="barrio" id="barrio" class="text" required="required"/></td>
                </tr>
                <tr>
                    <td >Calle</td>
                    <td><input type="text" name="calle" class="autocompletar" id="calle" class="text" required="required"/></td>
                    <td >Numero</td>
                    <td><input type="text" name="nro_calle" id="nro_calle" class="text" required="required"/></td>
                </tr>
                <tr>
                    <td >Piso</td>
                    <td><input type="text" name="piso" id="piso" class="text" required="required"/></td>
                    <td >Departamento</td>
                    <td><input type="text" name="depto" id="depto" class="text" required="required"/></td>
                </tr>
                <tr>
                    <td >Codigo Postal</td>
                    <td><input type="text" name="cod_postal" id="cod_postal" class="text" required="required"/></td>
                    <td >Telefono</td>
                    <td>
                        <input type="text" name="telefono" id="telefono" class="telefono" size="20" maxlength="20" required="required"/>
                    </td>
                </tr>
            </table>
    <?
                if (in_array("cambioDomicilio", $tramites)) {

                    include("tramites/b5_dom_anterior.php");
                }
    ?>
<? if (!in_array("identificacion", $tramites)): ?>
                    <h4>Bloque 3 - Capacidad Educacional</h4>
                    <!-- SIEMPRE VA -->
                    <table class="formulario">
                        <tr>
                            <td >Lee y escribe?</td>
                            <td><select name="lee_escribe" id="lee_escribe" required='required' type='number' data-message='Debe elegir una opcion'>
                                    <option>Seleccione un valor</option>
                                    <option value='0'>No</option>
                                    <option value='1'>Si</option>
                                </select></td>
                            <td >Max. Nivel educativo alcanzado</td>
                            <td><input type="text" name="mas_nivel_educacional" id="mas_nivel_educacional" required="required" type="text"/></td>
                        </tr>
                        <tr>
                            <td >Titulo Alcanzado</td>
                            <td><input type="text" name="carrera" id="carrera" class="autocompletar" required="required" type="text"/></td>
                            <td >Estudios de Post-Grado</td>
                            <td><input type="text" name="titulo_posgrado" id="titulo_posgrado" required="required" type="text"/></td>
                        </tr>
                        <tr>
                            <td >Profesión u oficio</td>
                            <td><input type="text" name="profesion" id="profesion" required="required" type="text"/></td>
                            <td >Ocupacion Habitual</td>
                            <td><input type="text" name="ocupacion" id="ocupacion" required="required" type="text"/></td>
                        </tr>
                        <tr>
                            <td >Cambios</td>
                            <td><input type="text" name="cambios" id="cambios" required="required" type="text"/></td>
                            <td></td>
                            <td></td>
                        </tr>

                    </table>
    <? endif; ?>
    <?php
                    if (in_array("identificacion", $tramites) || in_array("actualizacionMenor", $tramites) || in_array("actualizacionMayor16", $tramites))
                        include("tramites/b4_nacional.php");

                    if (in_array("reposicion", $tramites))
                        include("tramites/b6_reposicion.php");

                    if (in_array("rectificacion", $tramites))
                        include("tramites/b7_rectificacion.php");
    ?>
    <table class="formulario">
        <tr class="code">
            <td colspan="2"></td>
            <td colspan="2" style="width:170px"><input type="submit" value="Grabar"/></td>
        </tr>
    </table>
</form>
