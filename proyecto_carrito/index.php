<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('conexion.php');
?>
 <?php
$max=12;
$pag=0;
if(isset($_GET['pag']) && $_GET['pag'] <>""){
$pag=$_GET[pag];
}
$inicio=$pag * $max;
$query=" SELECT * FROM productos ORDER BY fecha DESC";
$query_limit= $query ." LIMIT $inicio,$max";
$resource = $conn->query($query_limit);
if (isset($_GET['total'])) {
$total = $_GET['total'];
} else {
$resource_total = $conn -> query($query);
$total = $resource_total->num_rows;
}
$total_pag = ceil($total/$max)-1;
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
   
    <!-- header -->
    <?php include("header.php");?>
            
    <!-- Menu Principal -->
    <?php include("menu.php");?>    
    <!-- End Menu Principal -->
    <!-- Slider Area -->
    
    
    <div class="promo-area wow fadeIn">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
               <h2 class="section-title wow fadeIn">Sobre Nosotros</h2>
               <article class="col-md-6 wow fadeIn">
                   <h3>Mision</h3>
                   <p>Brindar a nuestros clientes la mas variada seleccion de licores importados y 
                      nacionales ofreciendo calidad en nuestros productos y el mejor servicio
                       para satisfacer los gustos mas exigentes
                   </p>
                   
               </article>
               <article class="col-md-6 wow fadeIn">
                   <h3>Vision</h3>
                   <p> Ser el market de licores mas reconocido a nivel nacional 
por su variedad, calidad de producto y servicios.</p>
               </article>
            </div>
        </div>
    </div> <!-- End promo area -->
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <h2 class="section-title">Últimos Productos </h2>
                <?php  while ($row = $resource->fetch_assoc()){?>
                <div class="col-md-4 wow fadeIn">
                    <div class="single-product-widget">
                        <div class="single-wid-product">
                            <a href="producto.php?id=<?php echo $row['id']?>"><img src="<?php echo $row['imagen']?>" alt="" class="product-thumb img-thumbnail"></a>
                            <h2><a href="producto.php?id=<?php echo $row['id']?>"><?php echo $row['nombre']?></a></h2>
                            <div class="product-wid-price">
                               <ins>$ <?php echo $row['precio']?> <?php echo $row['unidad']?></ins> 
                            </div>                            
                        </div>
                    </div>
                </div>
                 <?php }?>
                <center>
                    <a href="tienda.php" class="btn btn-success">Ver todos los Productos</a>
                </center>
            </div>
        </div>
    </div> <!-- End product widget area -->
    <!-- Footer -->
    <?php include("footer.php");?><!-- End Footer -->
    <!-- JS -->
    <?php include("js.php");?><!-- End JS -->
  </body>
</html>