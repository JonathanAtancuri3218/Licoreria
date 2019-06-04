<?php 
error_reporting(E_ALL ^ E_NOTICE);
if(!isset($_SESSION))session_start();
if(!$_SESSION['admin_id']){
$_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
require_once('../conexion.php'); ?>
<?php
	if($_POST['agregarUsuario'] == "agregarUsuario"){
        $usuario_id=$_SESSION['idUser'];
		$q="INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `nacionalidad`, `direccion`, `numero`, `comuna`, `usuario`, `contrasena`, `fecha`)
           VALUES (NULL, '$_POST[nombre]', '$_POST[email]', '$_POST[telefono]', '$_POST[nacionalidad]','$_POST[direccion]', '$_POST[numero]','$_POST[comuna]','$_POST[usuario]','$_POST[contrasena]',CURRENT_TIMESTAMP)";
        //echo($q);

		$resource=$conn->query($q);
		header("Location: listado_usuarios.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8"> 
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">
	
		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<title>Ingreso de de Usuarios</title>
		
		<style>
			#success_message{ 
				display: none;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
		<script type="text/javascript">
			  $(document).ready(function() {
    $('#agregarProducto').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Ingrese Nombre del Usuario'
                    }
                }
            },
			 email: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Ingrese el Email'
                    }
                }
            },
			telefono: {
                validators: {
                     stringLength: {
                        min: 10,
                    },
                    notEmpty: {
                        message: 'Ingrese Telefono(Mínimo 10 caracteres)'
                    }
                }
            },
			direccion: {
                validators: {
                     stringLength: {
                        min: 10,
                    },
                    notEmpty: {
                        message: 'Ingrese la direccion (Mínimo 10 caracteres)'
                    }
                }
            },
            sector: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Ingrese el sector  (Mínimo 5 caracteres)'
                    }
                }
            }, 
            usuario: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Ingrese el usuario (Mínimo 5 caracteres)'
                    }
                }
            },
            contrasena: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Ingrese la contrasena (Mínimo 5 caracteres)'
                    }
                }
            },             
           }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

           
            e.preventDefault();

        
            var $form = $(e.target);

           
            var bv = $form.data('bootstrapValidator');

           
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});
		</script>
	</head>
		<body>
         <?php 
            include("header.php"); 
            include("menu_admin.php"); 
        ?>
		    <div class="container">
			    <form class="well form-horizontal" method="post"  id="agregarUsuario" name="agregarUsuario" action="">
					<fieldset>

					<!-- Nombre de Formulario -->
					<legend><center><h2><b>Agregar  Usuario</b></h2></center></legend><br>

					<!-- Nombre input-->

					<div class="form-group">
					  <label class="col-md-4 control-label">Nombre</label>  
					  <div class="col-md-4 inputGroupContainer">
					  <div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  <input  name="nombre" id="nombre" placeholder="Ingrese Nombre del usuario" class="form-control"  type="text">
					    </div>
					  </div>
					</div>
					
					<!-- Email input-->
					      	<div class="form-group">
							  <label class="col-md-4 control-label">Email</label>  
							    <div class="col-md-4 inputGroupContainer">
							    <div class="input-group">
							        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							  		<input name="email" id="email" placeholder="Ingrese email" class="form-control"  type="text" style="text-transform: uppercase">
							    </div>
							  </div>
							</div>

                    	<!-- Telefono -->
					       
					<div class="form-group">
					  <label class="col-md-4 control-label">Telefono</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
					  	<input name="telefono" id="telefono" placeholder="Ingrese el telefono " class="form-control" type="text">
					    </div>
					  </div>
					</div>
					
					<!-- Nacionalidad -->
					       
					<div class="form-group">
					  <label class="col-md-4 control-label">Nacionalidad</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="nacionalidad" id="nacionalidad" placeholder="Ingrese la nacionalidad " class="form-control" type="text">
					    </div>
					  </div>
					</div>


					<!-- Direccion -->
                    <div class="form-group">
					  <label class="col-md-4 control-label">Direccion</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="direccion" id="direccion" placeholder="Ingrese la direccion " class="form-control" type="text">
					    </div>
					  </div>
					</div>

                    <!-- Numero -->
                    <div class="form-group">
					  <label class="col-md-4 control-label">Numero</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="numero" id="numero" placeholder="Ingrese el numero " class="form-control" type="text">
					    </div>
					  </div>
					</div>


                       <!-- Comuna -->
                       <div class="form-group">
					  <label class="col-md-4 control-label">Comuna</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="comuna" id="comuna" placeholder="Ingrese la comuna " class="form-control" type="text">
					    </div>
					  </div>
					</div>
                      <!-- Sector -->
                      <div class="form-group">
					  <label class="col-md-4 control-label">Sector</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="sector" id="sector" placeholder="Ingrese el sector " class="form-control" type="text">
					    </div>
					  </div>
					</div>
                      <!-- Usuario -->
                      <div class="form-group">
					  <label class="col-md-4 control-label">Usuario</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					  	<input name="usuario" id="usuario" placeholder="Ingrese el usuario " class="form-control" type="text">
					    </div>
					  </div>
					</div>

                     <!-- Contrasena -->
                     <div class="form-group">
					  <label class="col-md-4 control-label">Contrasena</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  	<input name="contrasena" id="contrasena" placeholder="Ingrese la contrasena " class="form-control" type="text">
					    </div>
					  </div>
					</div>

					<!-- Success message -->
					<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label"></label>
					  <div class="col-md-4"><br>
					   <input type="submit" class="btn btn-success" value="agregarUsuario" name="agregarUsuario" id="agregarUsuario">
					  </div>
					</div>

					</fieldset>
				</form>
			</div><!-- /.container -->

			<!-- /.hola -->
			 <?php 
                include("footer.php"); 
            ?>
		</body>
</html>