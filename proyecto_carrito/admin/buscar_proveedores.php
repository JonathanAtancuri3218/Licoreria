<?php 
error_reporting(E_ALL ^ E_NOTICE);
if(!isset($_SESSION))session_start();
if(!$_SESSION['admin_id']){
$_SESSION['volver']=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
require_once('../conexion.php'); ?>
<?php
if(isset($_GET['idElm'])&& $_GET['idElm']<>""){
		$q="DELETE FROM clientes WHERE 1 AND id='$_GET[idElm]'";
		$r=$conn->query($q);
	}
$max=5;
$pag=0;
if(isset($_GET['pag']) && $_GET['pag'] <>""){
$pag=$_GET['pag'];
}

$busqueda=strtolower($_GET['busqueda']);
if(empty($busqueda)){
  header("location:listado_proveedores.php" );
} 

 $query="SELECT id, nombre, contacto, telefono, direccion FROM proveedores 
        WHERE (id LIKE '%$busqueda%' OR
                nombre LIKE '%$busqueda%' OR
                contacto LIKE '%$busqueda%' OR
                telefono LIKE '%$busqueda%' OR
                direccion LIKE '%$busqueda%')
         ORDER BY id ASC";

$resultado = $conn->query($query);

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
</head>
<body>
    <?php 
      include("header.php"); 
      include("menu_admin.php"); 
    ?>
    <div class="container">                 
      <ul class="pager">
       
      </ul>
    </div>
    <div class="container">
    <br>
    <form method="POST" action="agregar_proveedores.php">
    <input type="submit" class="btn btn-success" id="agregarUsuario"  name="agregarUsuario" value="Agregar Usuario" />
    </form>

 <br>
 <h2>Listado de Proveedores</h2> 

<form action="buscar_proveedores.php" method="get" class=form-search>
<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda;?>">
<input type="submit" value="Buscar" class="btn_search"  >
</form>
<br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                  <th>ID</th>
                    <th>Nombre del Proveedor</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Direccion</th>
                    <th>Modificar</th>
                 	<th>Eliminar</th>
                  </tr>   
                </thead>
                <tbody>
                 <?php  
                 
             	  
                 while ($row = $resultado->fetch_assoc()){?>
                  <tr>
                  <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['id']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['nombre']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['contacto']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['telefono']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><?php echo $row['direccion']?></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><a href="proveedor_modificar.php?id=<?php echo $row['id']?>" class="btn btn-md btn-success"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></td>
                    <td class="col-xs-3 col-sm-3 col-md-4 col-lg-3"><a href="listado_proveedores.php?idElm=<?php echo $row['id']?>" class="btn btn-md btn-danger" onClick="return confirm('¿Está seguro que desea eliminar este Proveedor?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                  </tr>


                  <?php }
                  
  
                   ?>

<?php 
// Resultado, número de registros y contenido.
echo $registros;
echo $texto; 
?>
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