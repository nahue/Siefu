<?
if ($_POST) {

    $usuario = Doctrine_Core::getTable("Usuario")->findOneById($_SESSION["usuario"]["id"]);

    if ($usuario->pass == $_POST["contraseniaActual"]) {
        $usuario->pass = $_POST["contraseniaNueva"];
        $usuario->save();
        $respuesta[] = "Contraseña reemplazada Correctamente";
    } else {
        $error[] = "Contraseña Actual Erronea";
    }
    /*

     * */
}
?>
<script type="text/javascript">
    function validar()
    {

        form = $("#perfilForm").validator();
        if (form.data("validator").checkValidity())
        {
            form.data("validator").destroy();
            $("#perfilForm").submit();
        }

    };
    $(document).ready(function(){
        $("select, input:text, input:checkbox, input:radio, input:file, textarea").uniform();
        $("perfilForm").validator();
        $("#miperfil").dialog({
            draggable: false,
            autoload    : true,
            position    : [0,0],
            dialogClass : 'dialogo',
            width: 600,
            title: "Mi Perfil",
            resizable: false,
            closeOnEscape: false,
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            buttons: {
                "Guardar" : function(){
                    validar();
                }
            }

        });

        $("#tabs").tabs({ fx: { opacity: 'toggle' } });
    });
</script>
<?php if (isset($error)): ?>
    <div style="padding: 0pt 0.7em;" class="ui-state-error ui-corner-all">
        <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
            <? foreach ($error as $e): ?>
                            <strong>Error:</strong> <?= $e ?>. </p>

            <? endforeach;?>
    </div>
<? endif; ?>

<?php if (isset($respuesta)): ?>
        <div style="margin-top: 20px; padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all">
            <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>
                <? foreach ($respuesta as $r): ?>
                            <strong>Respuesta:</strong> <?= $r ?>. </p>

            <? endforeach;?>
        </div>

<? endif; ?>
<div id="miperfil">
    <form id="perfilForm" action="" method="POST">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Contraseña</a></li>

            </ul>
            <div id="tabs-1">
                <label for="contraseniaActual">Contraseña Actual</label>
                <input name="contraseniaActual" type="password" required="true" />
                <label for="contraseniaNueva">Contraseña Nueva</label>
                <input name="contraseniaNueva" type="password" required="true" />
                <label for="confirmaContraseniaNueva">Confirma Contraseña Nueva</label>
                <input name="confirmaContraseniaNueva" type="password" data-equals="contraseniaNueva" />
            </div>

        </div>
    </form>
</div>
