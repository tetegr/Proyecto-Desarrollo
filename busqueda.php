<?php
    require_once 'admin/class/Conexion.php';
    require_once 'admin/class/Dependencia.php';
    require_once 'admin/class/Tramite.php';
    require_once 'admin/class/Rubro.php';
    require_once 'admin/class/Configuracion.php';
    
    $resultado = false;
    if(isset($_POST['opcion']))
    {    
    switch ($_POST['opcion'])
    {
       case 1: $tramite = new Tramite();
               $tramite->set_palabra_Tramite($_POST['frase']);
               $resultado = $tramite->get_palabra_Tramite();
               $count = mysql_num_rows($resultado); 
               break;
       case 2: if($_POST['id_dependencia']!=0)
               {
                    $dependencia = new Dependencia();
                    $id_dependencia = $_POST['id_dependencia'];
                    $dependencia->set_id_dep($id_dependencia);
                    $resultado= $dependencia->get_tramites_por_dependencia();
                    $count = mysql_num_rows($resultado);
                    break;
               }
               else
                   header("Location:index.php");
                   
               
       case 3: 
               if($_POST['id_rubro']!=0)
               {    
                $rubro = new Rubro();
                $id_rubro = $_POST['id_rubro'];
                $rubro->set_id_rubro($id_rubro);
                $resultado = $rubro->get_tram_rubro();
                $count = mysql_num_rows($resultado);
                break;
               } 
               else
                   header("Location:index.php");
       default:
               break;
           
   }
    }
    else
        $count = 0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Your description">
<meta name="keywords" content="keyword1 keyword2">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">
<title>Sistema Municipal de Trámites - Municipio de Veracruz, Veracruz</title>

<!-- SET: FAVICON -->
<!--<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">-->
<link href="http://tramites.veracruzmunicipio.gob.mx/templates/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!-- END: FAVICON -->

<!-- SET: STYLESHEET -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="css/dd.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<link rel="stylesheet" type="text/css" href="font-awesome-4.1.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!-- END: STYLESHEET -->


<!-- SET: SCRIPTS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.dd.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
                $(".resnav").click(function(){
                    $("#nav").slideToggle();
                });
            });	

    $(document).ready(function(){
            if ($(window).width() < 800) {
                        $("#nav ul li a").click(function(){
                            //$()(".subnav").slideToggle();
                            $(this).parent().find('.subnav').slideToggle();
                        });
            }
    });	

    $(document).ready(function(){
            if ($(window).width() > 470) {
            $(".tienes ul li a").mouseover(function(){
                        $(this).parent().find(".hablacontent").fadeIn("slow");
                        });
                    $(".tienes ul li a").mouseleave(function(){
                        $(this).parent().find(".hablacontent").fadeOut("slow");

                        });
                    }
                });

    $(document).ready(function(){
            if ($(window).width() < 470) {
            $(".tienes ul li a").mouseover(function(){
                        $(this).parent().find(".hablacontent").slideDown("slow");
                        });
                    $(".tienes ul li a").mouseleave(function(){
                        $(this).parent().find(".hablacontent").slideUp("slow");

                        });
                    }
                });
</script>


<link rel="stylesheet" href="css/paginador/style.css">
<link rel="stylesheet" href="css/paginador/jPages.css">
<link rel="stylesheet" href="css/paginador/animate.css">
<link rel="stylesheet" href="css/paginador/github.css">
<link rel="stylesheet" href="css/paginador/paginador.css">

<script type="text/javascript" src="js/js-paginador/highlight.pack.js"></script>
<script type="text/javascript" src="js/js-paginador/tabifier.js"></script>
<script src="js/js-paginador/js.js"></script>
<script src="js/js-paginador/jPages.js"></script>

<script>
  /* when document is ready */
  $(function(){

    /* initiate the plugin */
    $("div.holder").jPages({
      containerID  : "itemContainer",
      perPage      : 10,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
      endRange     : 1
    });

  });
  </script>


<style>
    .vpb_info   { 
                    font-size: 10px;
                    color:#C30E2E;
                }
    .txtError{ border: 1px solid #C2112A !important;}            
         
</style>
<script type="text/javascript">
    

function validacion() 
{
    
    $("#frase").removeClass("txtError");        
    if($('#frase').val() == "")
    {
        $("#frase").addClass("txtError");
        $("#mensaje").html('<br clear="all"><div class="vpb_info" align="left">Por favor introduzca datos para continuar la búsqueda. Gracias.</div>');
        $("#frase").focus();
        return false;
    }    
    if( !(/^([a-z-A-Z-Ñ-á-é-í-ó-ú\s]+)$/.test($('#frase').val()))) 
    {
        //alert('Solo se aceptan letras');
        $("#mensaje").html('<br clear="all"><div class="vpb_info" align="left">Sólo letras.</div>');
        $("#frase").addClass("txtError");
        $("#frase").focus();
        return false;
    }
   
  // Si el script ha llegado a este punto, todas las condiciones
  // se han cumplido, por lo que se devuelve el valor true
  return true;
}


</script>

<!-- FANCYBOX   -->
<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="js/fancybox.js"></script>
<!-- FINALIZA FANCYBOX -->


<script>
  function nobackbutton()
  {
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
  }

</script>
</head>

<body onload="nobackbutton();">

<!-- wrapper starts -->
<div class="wrapper">
	
    
            <div class="navcontent">
            </div>

            <!-- maincontent Starts -->
            <div class="maincontent">
            
                <!-- container starts -->
                <div class="container">
                
                	<div class="row">
                    <div class="container_in1">
                        <!-- container starts -->
                        <div class="content_container">
                                    
                                  <!-- LINKS START -->
                                   <div class="links">
                                     <ul>
                                       <li><a href="http://tramites.veracruzmunicipio.gob.mx/app/">Inicio</a></li>
                                       <!--<li><a href="http://tramites.veracruzmunicipio.gob.mx/app/">Trámites y Servicios </a></li>-->
                                       <!--<li class="no_bg"><span>Resultados trámites</span></li>-->
                                     </ul>
                                     <div class="clear"></div>
                                   </div>
                                   <!-- LINKS END -->
                                   
                                   
                                   <div class="tramitescontent">
                                   	<h2>Busqueda y consulta de trámites</h2>
                                    
                                    <div class="tramitescontentleft">
                                    
                                    
                                    	<div class="resultados">
                                    	
                                        <?php if($_POST['id_dependencia'] != 20 && $_POST['id_dependencia'] != 19 )
                                        {    
                                        ?>
                                        <h3>_Resultados:</h3>
                                        <?php
                                        }
                                        else
                                            echo '<p class="titulo_busqueda" style="text-align:center; margin-top:15px;"><b>SECCIÓN EN MANTENIMIENTO</b></p>';    
                                        ?>  
                                            
                                        <?php    
                                        if($count!=0)
                                        {?>    
                                            <h4>Su búsqueda <span></span> ha encontrado los siguientes resultados:</h4>
                                        <?php 
                                            if($resultado)
                                            {   
                                                
                                                echo ' <ul id="itemContainer" class="pagination" style="min-height:260px;">';
                                                $i=1;
                                                while($row = mysql_fetch_array($resultado))
                                                {?>    
                                                    <a href="<?php echo $row['t_tram_url_amigable'];?>"><li><span><?php echo $i .'. ';?></span><?php echo ' '.$row['s_tram_nom'];?></li></a>
                                                     
                                                <?php
                                                  $i = $i +1 ;
                                                }                                        
                                                echo '</ul>';
                                               echo '<div class="holder"></div>';
                                              // echo '</div>';
                                            }
                                                                                    
                                        
                                        }
                                         else
                                            if($_POST['id_dependencia'] == 20 || $_POST['id_dependencia'] == 19  || $count!=0)
                                            {    

                                                echo '<p> Favor de comunicarse al <b><span>2-00-20-00</span> ó a <b><span>info@veracruzmunicipio.gob.mx</span></b><br> para obtener información de estos trámites</b></p>';
                                            }
                                            else
                                                {    echo '<h4>No se encontraron registros:</h4>';
                                                     echo '<div class="clear"></div>';
                                                }  

                                        
                                        
                                          
                                        ?> 
                                    </div>
                                    	 
                                    	<div class="tramitescontentleftin">
                                    	<h3>Buscar de nuevo:</h3>
                                        <div class="tramitesearch">
                                            <form id="form_frase" action="busqueda.php" method="post" onsubmit="return validacion()"> 	
                                            <textarea class="forminner" name="frase" id="frase" cols="" rows="" onclick="this.value=''" placeholder="Ejemplo: Alineamiento, Asentamiento, Deslinde"></textarea>
                                                <input type="hidden" name="opcion" value="1"></input>
                                            <input class="forminner2" name="" type="submit" value="BUSCAR TRÁMITE">	
                                            </form>
                                            <div id="mensaje"></div>
                                            <div class="clear"></div>
                                        </div>
                                        <h4>También puedes buscar por tipo de:</h4>
                                        <ul>
                                            <li>
                                                <form action="busqueda.php" method="post">
                                                    <select name="id_dependencia" onchange="this.form.submit()">
                                                        <option value="0"> Dependencia </option>
                                            <?php
                                                $dependencia = new Dependencia();
                                                $resultado = $dependencia->get_dep();
                                                while ($row= mysql_fetch_array($resultado)) // recorre los clientes uno por uno hasta el fin de la tabla
                                                {
                                                    echo '<option value="', $row['n_dep_id'], '">', $row['s_dep_nom'], '</option>';
                                                }
                                                echo '<input type="hidden" name="opcion" value="2">';
                                            ?>      
                                                    </select>
                                                </form>    

                                            </li>
                                            <li>
                                                <form action="busqueda.php" method="post">
                                                    <select name="id_rubro" onchange="this.form.submit()">
                                                        <option value="0" selected="selected" name="id_rubro">Buscar por rubro</option>
                                                        <?php 
                                                        $rubro = new Rubro();
                                                        $res =  $rubro->get_rubro();
                                                        while ($row= mysql_fetch_array($res)) // recorre los clientes uno por uno hasta el fin de la tabla
                                                        {
                                                            echo '<option value="', $row['n_rubro_id'],'">',$row['s_rubro_nom'],'</option>';
                                                        }
                                                        echo '<input type="hidden" name="opcion" value="3">';
                                                        ?>    
                                                    </select>
                                                </form>
                                            </li>
                                        </ul>
                                        <div class="clear"></div>
                                    </div>
                                    </div>
                                    <div class="tramitescontentright">
                                    	<div class="buscadomain buslist">
                                    	<div class="buscado">
                                        	<h2><span><i class="fa fa-file-text"></i></span>TRÁMITES MÁS BUSCADOS</h2>
                                            <ul>
                                            	<?php
                                                $tramite = new Tramite();
                                                $result = $tramite->get_lista_masbuscado_Tramite();
                                                $cont = $num_oficinas = mysql_num_rows($result);
                                                if($cont != 0)
                                                {   
                                                    while($row=  mysql_fetch_array($result))
                                                        echo '<a href="',$row['t_tram_url_amigable'],'"><li>'.$row['s_tram_nom'].'</li></a>'; 
                                                }
                                                else
                                                {   
                                                    echo '<li><span style="color:red;"> No hay trámites en la lista de lo más buscados</span></li>';
                                                }    
                                                ?>
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                        </div>
                                        
                                       
                                        <div class="clear"></div>
                                        
                                    </div>
                                    <div class="clear"></div>
                                   </div>
                                   
                        
                        
                                  
                        </div>
                        <!-- container ends -->
                        </div>
                    </div>
                
                
                </div>
                <!-- container ends -->
                
             </div>                
            	
            
            
            
            <div class="clear"></div>
            
            </div>
            <!-- maincontent ends -->
            <div class="clear"></div>
            
            
            
            
            
            
            

<!-- wrapper ends -->
<?php
      include('script_google_analytics.php');
?>
</body>
</html>