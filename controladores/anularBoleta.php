<?php
if ($_POST)
{
    
}
?>

<script type="text/javascript">
$(document).ready(function(){
    $("select, input:text, input:checkbox, input:radio, input:file, textarea").uniform();
    $("#anularBoletaForm").dialog({
            title       : "Anular Boleta",
            autoload    : true,
            position    : [0,0],
            dialogClass : 'dialogo',
            draggable   : false,
            resizable   : false,
            width       : 400,
            
            
            
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
    });
    
    $("input#boleta_prenumerada").keyup(function(){
        if ($(this).val().length > 23)
        {
            
            var boleta = $("#boleta_prenumerada").val();
                       
            $.getJSON("ajax/checkBoleta.php", { 'boleta' : boleta}, function(json){
            if (json === true)  
            {
                $("#boletaInexistente").css('display','block');
            } 
            else
            {
                $("#boletaInexistente").css('display','none');
                console.log(json);
            }
            
            
            });
            
            
            
            
            
            
        }
    })
});
</script>


<form id="anularBoletaForm" method="POST">
    <table>
        <tr>
            <td>Boleta Prenumerada</td>
            <td><input type="text" id="boleta_prenumerada" name="boleta_prenumerada" size="30" maxlength="25"/></td>
            <td>
                <div id="boletaInexistente" class="error" style="height: 100%" >La boleta no existe o ya fue anulada.</div>
            </td>
        </tr>
    </table>
</form>