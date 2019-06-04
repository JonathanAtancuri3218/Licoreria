<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once("../conexion.php")?>
<?php 
if(!$_SESSION['admin_id']){
$_SESSION['volver']=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
?>
<?php	
$factura_vista=$_GET['idElm'];
$id_usuario=(int)$_SESSION['admin_id'];
$id_factura=(int)$_SESSION['factura'];
echo $factura_vista;

if ($factura_vista == ''){
    $q="SELECT p.nombre as nombre , c.cantidad as cantidad, p.precio as precio FROM compras c
        inner join productos p on p.id=c.id_producto
    inner join factura f on f.id=c.id_factura
where f.id_cliente=$id_usuario and f.id ='$id_factura'" ;
}else{
    $q="SELECT p.nombre as nombre , c.cantidad as cantidad, p.precio as precio FROM compras c
    inner join productos p on p.id=c.id_producto
inner join factura f on f.id=c.id_factura
where f.id_cliente=$id_usuario and f.id ='$factura_vista'" ;
}


    //   $q="SELECT * FROM compras WHERE 1 AND cliente='$_SESSION[user_id]' ORDER BY fecha DESC";
      $r = $conn->query($q); 
      $t = $r->num_rows;

       $q="INSERT INTO `factura` (`id`, `id_cliente`, `fecha`) VALUES (NULL, '$id_usuario',  CURRENT_TIMESTAMP)";
      $resource=$conn->query($q);
      
      $qu="SELECT * from factura where id_cliente='$id_usuario'and estado_pedido = ''";
      $res=$conn->query($qu);
      $row3=$res->fetch_assoc();
      $cod_factura=(int)$row3['id'];
      $_SESSION['factura']=(int)$cod_factura;

?>
<!DOCTYPE html>
<html lang="es">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Font Awezome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        
<link href="../css/buscar.css" rel="stylesheet" type="text/css">
  <head>
   
    <style>
    .descuento{
        display: none;
    }  
    </style>

    
  </head>
  <body>
    <!-- header -->

    <!-- Menu Principal -->
    <?php include("menu_admin.php");?>    
    <!-- End Menu Principal -->
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Gracias por Visitarnos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
            
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">

                            <h2></h2>
                            <div class="table-responsive col-xs-12">
                                    <table cellspacing="0" class="shop_table cart">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail"><i class="fa fa-file-image-o" aria-hidden="true"></i> Foto</th>
                                                <th class="product-name"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Producto</th>
                                                <th class="product-price"><i class="fa fa-usd" aria-hidden="true"></i> Precio</th>
                                                <th class="product-quantity">Cantidad</th>
                                                <th class="product-subtotal"><i class="fa fa-usd" aria-hidden="true"></i> Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php while ($row = $r->fetch_assoc()){?>
                                            <tr class="cart_item wow fadeIn">
                                                <td class="product-thumbnail">
                                                  <img width="145" height="145" alt="<?php echo $row['nombre']?>" class="shop_thumbnail" src="img/<?php echo $row['codigo']?>.jpg">
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
                                                        <?php echo $cantidad=$row['cantidad']?>
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">$<?php echo number_format($sub=$precio*$cantidad); $subtotal+=$sub?></span> 
                                                </td>
                                            </tr>
                                            <?php }?>  
                                        </tbody>
                                    </table>
                                </div>
                            <div class="cart_totals col-xs-12 wow fadeIn">
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
                                        </tbody>
                                    </table>
                                </div>
                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
     
    ?>
   
  </body>
</html>