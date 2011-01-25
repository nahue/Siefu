<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            <?php
            echo TITULO . " :: " . $controlador->obtenerNombre();
            ?>
        </title>
        <style type="text/css">
            @import "media/css/menu_style2.css";
            @import "media/css/960.css";
            @import "media/css/colorbox.css";
            @import "media/css/form.css";         
            @import "media/css/Aristo/jquery-ui-1.8.5.custom.css";
            @import "media/css/uniform.default.css";
            @import "media/css/formTramites.css";
            
            @import "media/css/custom.css";
        </style>

    </head>
    <body>
        <div id="mascara-precarga" style=""></div>
        <div id="cargando">
            <div class="cargando-indicador">
                <img src="media/img/extanim32.gif" width="32" height="32" style="margin-right:8px;float:left;vertical-align:top;"/>
                S.I.E.F.U. - <a href="http://siefu.tierradelfuego.gov.ar">tierradelfuego.gov.ar</a><br />
                <span id="cargando-msg">Cargando estilos e imagenes...</span>
            </div>
        </div>
        <script type="text/javascript">document.getElementById('cargando-msg').innerHTML = 'Cargando Librerias...';</script>
        <script type="text/javascript" src="media/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="media/js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="media/js/jquery.tools.min.js"></script>
        <script type="text/javascript" src="media/js/jquery.inputmask.js"></script>
        <script type="text/javascript" src="media/js/jquery-ui-1.8.6.custom.min.js"></script>
        <script type="text/javascript" src="media/js/jquery-ui.form.js"></script>
        <script type="text/javascript" src="media/js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="media/js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript">document.getElementById('cargando-msg').innerHTML = 'Inicializando...';</script>
        <script type="text/javascript" src="media/js/validator/efecto.js"></script>
        <script type="text/javascript" src="media/js/init.js"></script>
        

        <?php if ($controlador->obtenerNombre() != "Login"): ?>
                <div class="container_24">
                    <div class="header">
                    <img src="<?php echo ROOT_URL; ?>/media/img/headerSIEFU.png" title="S.I.E.F.U." style="/*width: 950px*/"/>
                    </div>
                    <div class="aristo-menu" >
                        <ul>
                            <li><a href="<?= Html::urlModulo('principal') ?>" >Menú PPal.</a></li>
                            <li><a href="<?= Html::urlModulo('principal') ?>" id="current">Trámites</a>
                                <ul>
                                    <!--<li><a href="<?= Html::urlModulo('agregarEnte') ?>">Agregar Ente</a></li>-->
                                    <li><a href="<?= Html::urlModulo('tramiteExtranjeros') ?>">Trámite Extranjeros</a></li>
                                    <li><a href="<?= Html::urlModulo('tramiteNacionales') ?>">Trámite Nacionales</a></li>
                                    <li><a href="<?= Html::urlModulo('anularBoleta') ?>">Anular Boleta</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= Html::urlModulo('contacto') ?>">Contacto</a></li>
                            <li><a href="<?= Html::urlModulo('logout') ?>">Salir</a></li>
                            <?php if($perfil->esAdmin()): ?>
                                <li class="extremoDerecho"><a href="<?= Html::urlModulo('admin') ?>">Administrar</a></li>
                            <?php endif ?>

                            <li class="extremoDerecho"><a href="<?= Html::urlModulo('miperfil') ?>">Mi Perfil</a></li>
                            <span class="extremoDerecho">Bienvenido: <?
                            echo $usuario = isset($_SESSION["usuario"]["usuario"]) ? $_SESSION["usuario"]["usuario"] : false  ?></span>

                        </ul>
                        
                    </div>
            <? endif; ?>
                    <div class="contenido">

<? if ( $controlador->get_perfil()->get_flash() ): ?>


    <div style="margin-top: 20px; padding: 0pt 0.7em;" class="ui-state-highlight ui-corner-all">
            <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>
            
                            <?= $controlador->get_perfil()->get_flash();?>
                               . </p>

    </div>

<? $controlador->get_perfil()->set_flash(null); ?>

<? endif ?>
