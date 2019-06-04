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
   
    //   $q="SELECT * FROM compras WHERE 1 AND cliente='$_SESSION[user_id]' ORDER BY fecha DESC";
    $q=" SELECT  p.nombre as nombre,  c.cantidad as cantidad,  p.precio as precio FROM compras c
    inner join productos p on p.id=c.id_producto
    inner join factura f on f.id=c.id_factura
    where f.id_cliente='$id_user' and f.estado_pedido='' order by cantidad desc";
      $r = $conn->query($q); 
      $t = $r->num_rows;
      
    $query=" SELECT id, nombre, frase_promocional, precio, codigo, categoria ,imagen FROM productos ORDER BY fecha DESC";


  

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
                        <h2>Carrito De Compras</h2>
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
                                                <th class="product-thumbnail"><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</th>
                                                <th class="product-name"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Producto</th>
                                                <th class="product-price"><i class="fa fa-usd" aria-hidden="true"></i> Precio</th>
                                                <th class="product-quantity">Cantidad</th>
                                                <th class="product-subtotal"><i class="fa fa-usd" aria-hidden="true"></i> Total</th>
                                                <th><i class="fa fa-cart-plus" aria-hidden="true"></i> Cantidad</th>
                                                <th><i class="fa fa-times" aria-hidden="true"></i> Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                           <?php while ($row = $r->fetch_assoc()){?>
                                           

                              
                                            <tr class="cart_item wow fadeIn">
                                                <td class="product-upper">
                                               <?php 

                                               //echo '<img src="data:image/jpeg;base64,' . base64_decode( $row['imagen'] ) . '" />';
                                               
                                               
                                               echo '<img src="'.$row['imagen'].'" width="200px" height="200px">';


                                               //echo '<img src="'.$imgData['usu_img'].'" width="200px" height="200px">'; 

                                                 ?>

                                                </td>

                                                <td class="product-name">
                                                    <?php echo $row['nombre']?>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">$<?php echo number_format($precio=$row['precio'], 0, ',', '.');?>
                                                    </span> 
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">

                                                        <?php 
                                                                                                           
                                                        echo $cantidad=$row['cantidad'] 
                                                        ?>
                                   
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">$<?php echo number_format($sub=$precio*$cantidad); $subtotal+=$sub?></span> 
                                                </td>
                                                <td>
                                                    <a href="modificar.php?id=<?php echo $row['id'];?>&codigo=<?php echo $row['codigo'];?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="modificar"></span></a>
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
                            
                                <div class="cart_totals col-sm-6 col-xs-12">
                                    <h2>Total Carrito</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                           

    
                                            <tr>
                                        
                                                <td>Subtotal</td>
                                                <td>$<?php echo number_format($subtotal=($subtotal+$envio)-$descuento, 0, ',', '.');?></td>
                                            </tr>
                                            <tr>
                                                <td>iva 12%</td>
                                                <td>$<?php echo number_format($iva = $subtotal*0.12, 0, ',', '.');?></td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Total Pedido</th>
                                                <td><strong><span class="amount">$<?php echo number_format($total = $subtotal+$iva, 0, ',', '.');?></span></strong> </td>
                                            </tr>
                                            <tr>
                                                <td>Confirme Su Compra</td>
                                                <td>
                                                    <form id="confirmar" name="confirmar"method="post" action="">
                                                        <input type="submit" name="confirmar" id="confirmar" value="confirmar" class="btn btn-success">
                                                        <!-- <input type="hidden" name="factura" id="factura" value="<?php echo $row1['id']?>">  -->
                                                        <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal?>"> 
                                                        <input type="hidden" name="iva" id="iva" value="<?php echo $iva?>"> 
                                                        <input type="hidden" name="total" id="total" value="<?php echo $total?>"> 
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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