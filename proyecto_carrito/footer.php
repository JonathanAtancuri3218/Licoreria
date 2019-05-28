    <div class="footer-top-area wow fadeIn">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-about-us">
                        <a href="index.php"><img src="img/portada.JPG" ></a>
                        <p>Nuestra tienda online tiene el objetivo de  llevar a su hogar un servicio  innovador en la venta de juegos,Consolas ,PC Gamer  , etc ,ofreciendo los mejores servicios para que puedas tener la mejor experiencia al momento de utilizar juegos de video.</p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/?lang=es" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title"> Usuario</h2>
                        <ul>
                            <?php if($_SESSION['user_id']){?>
                            <li><a href="mis-datos.php?id=<?php echo $_SESSION[user_id]?>"><i class="fa fa-user" aria-hidden="true"></i> Mis datos</a></li>
                            <li><a href="carrito.php"><i class="fa fa-shopping-cart"></i> Mi Carrito</a></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
                            <?php }else{?>
                            <li><a href="login.php"><i class="fa fa-sign-in"></i>Iniciar Sesión</a></li>
                            <li><a href="registro.php"><i class="fa fa-user"></i> Registrarse</a></li>
                            <?php }?>
                        </ul>                        
                    </div>
                </div>
                
           
            </div>
        </div>
    </div> <!-- End footer top area -->
    <footer class="footer-bottom-area wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2018 Proyecto de  Programacion Hypermedial</p>
                    </div>
                </div>
            </div>
        </div>
    </footer> 