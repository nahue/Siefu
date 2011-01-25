
<style type="text/css">
    label, input{

    }
    form label
    {
        width: 80px;
    }
    form p
    {
        display:block;
        margin: 10px 0 0 50px;
    }
    /*
    form label, form input
    {
        position: relative;
        display: block;
        top: 35px;
        left: 45px;
    }
    */
    form .errores
    {
        left:45px;
        display:block;
        position:relative;
        top:10px;
        width:200px;
    }
    .expose
    {
        border  : 0;
        width   : 400px;
        margin  : 0 auto;
    }

    .expose input
    {

    }

</style>
<link href="media/css/login-box.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    $(document).ready(function(){
        $("select, input:text, input:password, input:checkbox, input:radio, input:file").uniform();
        $("#footer").remove();
        $("#resetearContrasenia").dialog({
            modal: true,
            resizable: false,
            autoOpen: false,
            height: 200,
            width: 350,
            buttons: {
                "Enviar" : function(){
                    form = $("#resetearContrasenia").validator();
                    if (form.data("validator").checkValidity())
                    {
                        form.data("validator").destroy();
                        $.ajax({
                            url: 'ajax/resetPassword.php',
                            data: $("#resetearContrasenia").serialize(),
                            type: 'POST',
                            dataType: "json",
                            success: function(data){
                                if (data.respuesta == true)
                                {
                                    $( "#mailEnviado" ).dialog({
                                        modal: true,
                                        buttons: {
                                            Ok: function() {
                                                $("#resetearContrasenia").dialog("close");
                                                $( this ).dialog( "close" );
                                            }
                                        }
                                    });

                                }
                            }
                        });
                    }
                }
    },
    close: function(event, ui) {
        $("div.error").css('visibility','hidden');
    }
});
$( "#myform" ).dialog({
    autoOpen: true,
    height: 230,
    width: 350,
    position    : [0,0],
    dialogClass : 'dialogoLogin',
    modal: true,
    resizable: false,
    closable: false,
    draggable: false,
    closeOnEscape: false,

    title: "S.I.E.F.U. - Iniciar Sesion",
    buttons: {
        "Entrar" : function(){
            $("#myform").submit();
        },
        "Olvido su contraseña?": function(){
            $("#resetearContrasenia").dialog("open");
        }
    },
    open: function(event, ui) { $(".dialogoLogin .ui-dialog-titlebar-close").hide(); }
});
$("#logo").dialog({
    autoOpen: true,
    height: 267,
    width: 350,
    position    : [100,0],
    dialogClass : 'dialogoLogo',
    resizable: false,
    closable: false,
    draggable: false,
    closeOnEscape: false,
    open: function(event, ui) { 
        $(".dialogoLogo .ui-dialog-titlebar").hide();
        $(".dialogoLogo").css("border", "0");
    }
});

$("#myform").keypress(function(e){


    if (e.keyCode == '13'){

        $(this).submit();
    }

});
})

</script>
<h1 style="text-align:center">S.I.E.F.U.</h1>

<div id="contenedorLogin"></div>


<form action="" method="POST" id="myform">
    <p>
    <label for="usuario">Usuario: </label>
    <input name="usuario" required="required" title="Usuario" value="" size="30" maxlength="20" />
    </p>
    <p>
    <label for="contrasenia">Contraseña: </label>
    <input name="contrasenia" type="password" title="Contraseña" required="required" value="" size="30" maxlength="2048" />
    </p>
        <div class="errores">

    <?php
    if ($_POST) {
        $perfil = $this->get_perfil();

        if ($perfil->login($_POST["usuario"], $_POST["contrasenia"])) {
            Html::redireccionar();
        } else{ ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#myform").dialog( "option", "height", 270 );
                })

            </script>

            
                <? foreach ($perfil->obtenerErrores() as $error): ?>

                        * <?= $error ?> <br />


                <? endforeach; ?>
            
        <?
            }

                unset($perfil);
            }
    ?>
</div>
</form>

<div id="logo" style="background-color: #4f4f4f">
    <img src="media/img/header SIEFU222.png" width="320px"/>
</div>


<form id="resetearContrasenia" action="" method="POST">
    <label for="email">Email</label>
    <input name="email" required="true" type="email" size="30" />
</form>

<div id="mailEnviado" title="Nueva clave generada" style="display:none">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		En unos instantes sera enviado un email indicandole su nueva contraseña.
    </p>
    <p>
		Ingrese al sistema y cambiela <b>cuanto antes</b>.
    </p>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#contenedorLogin").append( $('.dialogoLogin'));
        $("#contenedorLogin").append( $('.dialogoLogo'));

    });
</script>