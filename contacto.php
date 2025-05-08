<?php        
    session_start();
    $url = $_SESSION['url'];  
    $tramite = $_SESSION['name_tram'];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/tramite.css" />
<title> Visita Sistema Municipal de Tr&aacute;mites - Municipio de Veracruz, Veracruz</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/js-formularios-externos.js"></script>
</head>


    
<body>
    <div id="wrapper_contacto">
        
        <form id="form_usuarios" name="contacto" method="post" action="enviar_email.php">
        <fieldset>
                <legend align="center" class="alguna-duda"> COMPARTIR ENLACE</legend>
                
            <table>
                <tr>
                    <td></td>
                    <td></td>
                </tr>    
                
                <tr>
                    <td > <label>Para:  </label>
                        <span>  </span> 
                    </td>
                    <td> 
                        <input class="medium"  name="destinatario" value="Correo electr&oacute;nico" onClick="this.value=''" type="text"></input> </td>
                </tr>
                
                <tr>
                    <td> 
                          <label>De:  </label>
                          <span>  </span> 
                    </td>
                    <td> 
                        <input class="medium"  name="nombre_usu" value="Introduzca nombre" onClick="this.value=''" type="text"></input> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email: </label>
                        <span>  </span>
                    </td>
                    <td> <input class="medium"  name="remitente" type="text" value="Correo Electr&oacute;nico" onClick="this.value=''"></input> </td>
                </tr>

                <tr>
                    <td>
                        <label>Nota: </label>
                        <span> (opcional)</span>
                    </td>
                    <td> <textarea class="medium"   onClick="this.value=''" name="nota">COMENTARIOS</textarea> </td>
                </tr>

                <tr>
                    <td>
                        <input name="dominio" type="hidden" value="<?php echo $url; ?>"/>
                        <input name="tramite" type="hidden" value="<?php echo $tramite; ?>"/>
                    </td>
                    <td>
                    <input name="enviar" class="btn orange" type="submit" value="Enviar"/>
                    </td>
                </tr>
        </table>
                 </fieldset> 
     </form>
        
        <?php
           if(isset($_GET['valor']) && $_GET['valor'] == "true")
               echo '<div class="mensaje">Su correo ha sido enviado </div>';
           else
               if(isset($_GET['valor']) && $_GET['valor'] == "false")
                   echo '<div class="mensaje"> Ha ocurrido un error, lamentamos su correo no se ha enviado </div>';
        ?>
   </div>
</body>
</html>
