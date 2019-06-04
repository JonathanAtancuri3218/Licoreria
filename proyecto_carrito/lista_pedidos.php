<?php 
error_reporting('E_ALL ^ E_NOTICE');
require_once("conexion.php")?>
<?php 
if(!$_SESSION['user_id']){
$_SESSION['volver']=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: login.php");


}
?>
<?php	

$id_factura=(int)$_SESSION['factura'];



$id_user=$_SESSION['user_id'];
	if(isset($_GET['idElm'])&& $_GET['idElm']<>""){
		$q="DELETE FROM compras WHERE 1 AND id='$_GET[idElm]'";
		$r=$conn->query($q);
    }
    //confirmar compra
    if($_POST['confirmar'] == "confirmar"){
		//print_r($_POST);
		// $q="INSERT INTO `compras` (`id`, `cantidad`, `fecha`, `id_factura`, `id_producto`) VALUES (NULL, '$_POST[cantidad]', CURRENT_TIMESTAMP,'$_SESSION[factura]','$_POST[id]')";

        $qc="UPDATE `factura` SET `subtotal` = '$_POST[subtotal]', `iva` = '$_POST[iva]', `total` = '$_POST[total]', `estado_pedido` = 'creado'
         WHERE `factura`.`id` = '$id_factura';";

echo $qc;

         $rc=$conn->query($qc);
        

      echo $_POST[subtotal]." iva ".$_POST[iva]." total ".$_POST[total]. "id fac ".$id_factura  ;
    

		header("Location: confirmacion.php?id_factura=$id_factura");
    }
    



    $query1="SELECT * FROM factura where id_cliente='$_SESSION[user_id]' order by fecha desc";
    $resource1=$conn->query($query1);
    
      $row1=$resource1->fetch_assoc();

  

    // echo  $row1 ['id'];
   
    $q="SELECT * FROM factura WHERE 1 AND id_cliente='$_SESSION[user_id]'and estado_pedido !='' ORDER BY fecha DESC";
    
      $r = $conn->query($q); 
      $t = $r->num_rows;

     
      

    // $query=" SELECT id, nombre, frase_promocional, precio, codigo, categoria ,imagen FROM productos ORDER BY fecha DESC";


  

      ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php");?>
    <style>
    .descuento{
        display: none;
        background-color: greenyellow;
    }  
    </style>
  </head>
  <body>
   
    <!-- header -->
    <?php include("header.php");?><!-- fin header -->
    <!-- Menu Principal -->
    <?php include("menu.php");?>    
    <!-- End Menu Principal -->
    
    
    
    <div class="product-big-title-area wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>lista facturas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                               
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                                <div class="table-responsive">
                                    <table cellspacing="0" class="shop_table cart">
                                        <thead>
                                            <tr>
                                                <!-- <th class="product-thumbnail"><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</th> -->
                                                <th class="product-name"><i class="fa fa-shopping-cart" aria-hidden="true"></i> factura</th>
                                                <th class="product-price"><i class="glyphicon glyphicon-calendar" aria-hidden="true"></i> fecha</th>
                                                <th class="product-total"aria-hidden="true"><i class="fa fa-usd" aria-hidden="true">total</th>
                                                <th class="product-subtotal"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> estado</th>
                                                <th><i aria-hidden="true"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> ver</th>
                                                <th><i class="fa fa-times" aria-hidden="true"></i> Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                           <?php while ($row = $r->fetch_assoc()){
                                               
                                              
                                              
                                               ?>
                                        
                                            <tr class="cart_item wow fadeIn">
                                                <!-- <td class="product-upper"> -->
                                               <?php 

                                               //echo '<img src="data:image/jpeg;base64,' . base64_decode( $row['imagen'] ) . '" />';
                                               
                                               
                                             //  echo '<img src="'.$row['imagen'].'" width="200px" height="200px">';


                                               //echo '<img src="'.$imgData['usu_img'].'" width="200px" height="200px">'; 

                                                 ?>

                                                <!-- </td> -->

                                                <td class="product-name">
                                                    <?php echo $row['id']?>

                                                    
                                                </td>

                                                <td class="product-price">
                                                                                             <?php 
                                                                                                   echo $cantidad=$row['fecha'] ;

                                                                                            ?>
                                                    </span> 
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                    <span class="amount">$<?php echo number_format($totalf=$row['total'], 0, ',', '.');?>
                                                        
                                   
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <!-- <span class="amount">$<?php echo number_format($sub=$precio*$cantidad); $subtotal+=$sub?></span>  -->
                                                <!-- </td> -->
                                                
                                                <?php 
                                                                                                   echo $cantidad=$row['estado_pedido'] 
                                                                                             ?>
                                               </td>
                                               <td>
                                                    <a href="confirmacion.php?idElm=<?php echo $row['id']?>"  class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                </td>
                                                <td>
                                                    <a href="carrito.php?idElm=<?php echo $row['id']?>" onClick="return confirm('¿Está seguro que desea eliminar esta compra?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                                </td>
                                            </tr>
                                            <?php }?>  
                                        </tbody>
                                    </table>
                                </div>
                            <div class="cart-collaterals wow fadeIn">
                            
                                
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include("footer.php");?><!-- End Footer -->
    <!-- JS -->
    <?php include("js.php");?><!-- End JS -->
  </body>
</html>