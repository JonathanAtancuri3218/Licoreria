<?php 
error_reporting('E_ALL ^ E_NOTICE');
if(!isset($_SESSION))session_start();
if(!$_SESSION['admin_id']){
$_SESSION['volver']=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
require_once('../conexion.php'); ?>
<?php
$id_user=$_SESSION['admin_id'];
if(isset($_GET['idElm'])&& $_GET['idElm']<>""){
		$q="DELETE FROM compras WHERE 1 AND id='$_GET[idElm]'";
		$r=$conn->query($q);
	}
$max=5;
$pag=0;
if(isset($_GET['pag']) && $_GET['pag'] <>""){
$pag=$_GET['pag'];
}
$inicio=$pag * $max;
$sql="SELECT f.id ,c.nombre, f.fecha ,f.total, f.estado_pedido FROM factura f
INNER JOIN clientes c  WHERE f.id_cliente = c.id and f.estado_pedido != ''"; 

$resultado = $conn->query($sql);

?>
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Usuarios</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Font Awezome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        
        <link href="../css/buscar.css" rel="stylesheet" type="text/css">

        
        <style>
            img{
                max-width: 40%;
            }
        </style>
    <?php include("head.php");?>
    <style>
    .descuento{
        display: none;
        background-color: greenyellow;
    }  
    </style>
  </head>
</head>
<body>
    <?php 
      include("menu_admin.php"); 
    ?>
    <div class="container">                 
      <ul class="pager">
       <?php if($pag-1 >= 0){?>
        <li><a href="listado_ventas.php?pag=<?php echo $pag -1?>&total=<?php echo $total?>">Anterior</a></li>
        <?php } ?>
        | <?php echo ($inicio + 1) ?> a <?php echo min($inicio + $max, $total) ?> | de <?php echo $total ?>
        
        <?php if($pag +1 <= $total_pag ){?>
        <li><a href="listado_ventas.php?pag=<?php echo $pag +1?>&total=<?php echo $total?>">Siguiente</a></li>
        <?php } ?>
      </ul>
    </div>
    <div class="container">
    <br>
  
      <h2>Ventas</h2> 

      
      <br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                 	<th>Estado Pedido</th>
                   <th> Ver </th>
                 	<th>Anular</th>


                  </tr>
                </thead>
                <tbody>
                 <?php  
                                  if ($resultado > 0) {
                 while ($row = $resultado->fetch_assoc()){?>
                  <tr>
                  <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['id']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['nombre']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['fecha']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['total']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['estado_pedido']?></td>
                    <td>
                    <a href="listado_facturas.php?id=<?php echo $row['id']?>"  class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                    </td>
                    <td>
                     <a href="../carrito.php?idElm=<?php echo $row['id']?>" onClick="return confirm('¿Está seguro que desea eliminar esta factura')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                     </td>
                  </tr>
                  <?php }
                  } else {
                    echo "0 resultados encontrados";
                }?>
                </tbody>
            </table>      
        </div>
      
    </div>
    
    <?php 
      include("footer.php"); 
    ?>
        <!-- jQuery --> 
        <script
          src="https://code.jquery.com/jquery-3.2.1.js"
          integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
          crossorigin="anonymous"></script>       
                <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
        <script type="text/javascript">
            $(document).ready(function(){
            $("tr:odd").css("background-color", "#efefef"); 
            $("tr:even").css("background-color", "#f7f7f7"); 
                });
        </script>
</body>
</html>