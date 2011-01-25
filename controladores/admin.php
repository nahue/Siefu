
<? if (!$this->get_perfil()->esAdmin())
    die("Necesita ser Administrador para ingresar a este modulo");

    $entidades = Doctrine_Core::getTable("Entidades")->findAll()->toArray();
    fb::log($entidades);
    if ($_POST)
    {
        $usuario = new Usuario();
        $usuario->nombre = $_POST["nombre"];
        $usuario->usuario = $_POST["usuario"];
        $usuario->apellido = $_POST["apellido"];
        $usuario->admin = $_POST["esAdmin"] == "on" ? 1 : 0;
        $usuario->email = $_POST["email"];
        $usuario->Entidad_id = $_POST["entidad_id"];
        $claveAleatoria = Crypt::claveAleatoria();
        $usuario->pass = $claveAleatoria;

        if($this->get_perfil()->notificarUsuario($_POST["email"],$_POST["nombre"], $claveAleatoria))
        {
            $usuario->save();
            $this->get_perfil()->set_flash("Usuario ". $_POST["usuario"] ." dado de alta correctamente");
            Html::redireccionar("admin");
        } else {
            $this->get_perfil()->set_flash("Ocurrio un error");
            Html::redireccionar("admin");
        }

    }


?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("select, input:text, input:password, input:checkbox, input:radio, input:file").uniform();

            $("#altaUsuario").dialog({
                autoOpen: true,
                height: 340,
                width: 390,
                position    : [0,0],
                title: 'Alta de Usuario',
                dialogClass : 'dialogo',
                resizable: false,
                closable: false,
                draggable: false,
                closeOnEscape: false,
                buttons: {
                    "Guardar" : function(){
                        form = $("#altaUsuario").validator();
                        if (form.data("validator").checkValidity())
                        {
                            form.data("validator").destroy();
                            /*
                             $.ajax({
                                url: 'ajax/altaUsuario.php',
                                data: form.serialize(),
                                type: 'POST',
                                dataType: 'json',
                                success: function(data){
                                    console.log(data);                                }
                            })
                             */
                            form.submit();
                            
                        }
                    }
                },
                open: function(event, ui) { $(".dialogo .ui-dialog-titlebar-close").hide(); }
            })
        });
    </script>
    <form id="altaUsuario" action="" method="POST">
        <table>
            <tr>
                <td>
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" required="true" type="text"/>
                </td>

                <td>
                    <label for="apellido">Apellido:</label>
                    <input name="apellido" required="true" type="text"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="usuario">Usuario:</label>
                    <input name="usuario" required="required" type="text"/>
                </td>
                <td>
                    <label for="email">E-Mail:</label>
                    <input name="email" required="required" type="email" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="entidad_id">Entidad</label>
                <?php echo Html::selectBox("entidad_id", $entidades); ?>
            </td>
            <td>
                <label for="esAdmin">Administrador?</label>
                <input type="checkbox" name="esAdmin"/>
            </td>
        </tr>
    </table>


</form>

