<?php
    $perfil = new Perfil();
    $perfil->logout();
    header("Location: ".ROOT_URL);
?>
