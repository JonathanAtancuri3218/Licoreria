<?php 
error_reporting(E_ALL ^ E_NOTICE);
if(!isset($_SESSION))session_start();
if(!$_SESSION['admin_id']){
$_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
require_once('../conexion.php'); ?>
<?php
	if($_POST['enviar'] == "Modificar"){
        $usuario_id=$_SESSION['idUser'];
		$q="UPDATE `proveedores` SET `nombre` = '$_POST[nombre]', `contacto` = '$_POST[contacto]', `telefono` = '$_POST[telefono]', `direccion` = '$_POST[direccion]','$usuario_id' WHERE `proveedores`.`id` = $_POST[id];";
        $resource=$conn->query($q);
        
		header("Location: listado_proveedores.php");
	}
?>
<?php
//if($_GET[id]==0){
       //header("Location: listado_productos.php"); 
        //}
$query=" SELECT * FROM proveedores WHERE id='$_GET[id]'";
$resource = $conn->query($query); 
$total = $resource->num_rows;
$row = $resource->fetch_assoc();

$rowColores = $row["colores"];
$arrayColores = explode(",",$rowColores);
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
		<title>Modificar Proveedores</title>
		
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
    $('#Modificar').bootstrapValidator({
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
                        message: 'Ingrese Nombre del Proveedor'
                    }
                }
            },
			 codigo: {
                validators: {
                     stringLength: {
                        min: 6,
                    },
                    notEmpty: {
                        message: 'Ingrese Codigo del Producto (Mínimo 6 caracteres)'
                    }
                }
            },
			 categoria: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Ingrese la cetegoría del Producto'
                    }
                }
            },
			disponibilidad: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Ingrese la categoría del Producto'
                    }
                }
            },
			frase_promocional: {
                validators: {
                     stringLength: {
                        min: 20,
                    },
                    notEmpty: {
                        message: 'Ingrese Frase Promocional (Mínimo 20 caracteres)'
                    }
                }
            },
			descripcion: {
                validators: {
                     stringLength: {
                        min: 20,
                    },
                    notEmpty: {
                        message: 'Ingrese Descripción Del Producto (Mínimo 20 caracteres)'
                    }
                }
            },
           	unidad: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione Mínimo un color'
                    }
                }
            },
            precio: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Ingrese Precio del Producto'
                    }
                }
            },              
           }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
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
			    <form class="well form-horizontal" method="post"  id="Modificar" name="Modificar">
					<fieldset>

					<!-- Nombre de Formulario -->
					<legend><center><h2><b>Modificar Proveedores</b></h2></center></legend><br>

					<!-- Nombre input-->

					<div class="form-group">
					  <label class="col-md-4 control-label">Nombre</label>  
					  <div class="col-md-4 inputGroupContainer">
					  <div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					  <input  name="nombre" id="nombre" placeholder="Ingrese Nombre del Proveedor" class="form-control"  type="text" value="<?php echo $row['nombre']?>">
					    </div>
					  </div>
					</div>
					
					<!-- contacto input-->
					      	<div class="form-group">
							  <label class="col-md-4 control-label">Contacto</label>  
							    <div class="col-md-4 inputGroupContainer">
							    <div class="input-group">
							        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
							  		<input name="contacto" id="contacto" placeholder="Ingrese el Contacto" class="form-control"  type="text" style="text-transform: uppercase" value="<?php echo $row['contacto']?>">
							    </div>
							  </div>
							</div>

					<!-- Telefono  -->
					       	      
					<div class="form-group">
					  <label class="col-md-4 control-label">Telefono</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-align-left"></i></span>
                            <input name="telefono" id="telefono"  placeholder="Ingrese el Telefono" class="form-control" type="text" value="<?php echo $row['telefono']?>">
					    </div>
					  </div>
					</div>

					<!-- Direccion -->
					       	      
					<div class="form-group">
					  <label class="col-md-4 control-label">Direccion</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-align-left"></i></span>
				    	<textarea name="direccion" id="direccion"  placeholder="Ingrese la Direccion" class="form-control" type="text"><?php echo $row['direccion']?></textarea>
					    </div>
					  </div>
					</div>
					
					
					<!-- Success message -->
					<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label"></label>
					  <div class="col-md-4"><br>
					   <input type="submit" class="btn btn-success" name="enviar" value="Modificar" id="agregarProveedor">
					  </div>
					</div>

					</fieldset>
					<input type="hidden" name="id" id="id" value="<?php echo $row['id']?>">
				</form>
				
			</div><!-- /.container -->
			 <?php 
                include("footer.php"); 
            ?>
		</body>
</html>