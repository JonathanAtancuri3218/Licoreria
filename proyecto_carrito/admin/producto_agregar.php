<?php 
error_reporting(E_ALL ^ E_NOTICE);
if(!isset($_SESSION))session_start();
if(!$_SESSION['admin_id']){
$_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
header("Location: index.php");
}
require_once('../conexion.php'); ?>
<?php

if(isset($_POST["submit"])){
	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check !== false){
			$image = $_FILES['image']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
	if($_POST['agregarProducto'] == "agregarProducto"){
		$unidad=$_POST[Unidad];
	
		$q="INSERT INTO `productos` (`id`, `nombre`, `codigo`, `categoria`, `proveedor`,`frase_promocional`, `unidad`, `precio`, `disponibilidad`, `descripcion`, `promocion`, `fecha`)
		 VALUES (NULL, '$_POST[nombre]', '$_POST[id]', '$_POST[categoria]','$_POST[id]', '$_POST[frase_promocional]', '$unidad', '$_POST[precio]', '$_POST[disponibilidad]', '$_POST[descripcion]', '$_POST[promocion]', CURRENT_TIMESTAMP)";
		//echo($q);

		// INSERT INTO `productos` (`id`, `nombre`, `codigo`, `categoria`, `proveedor`, `frase_promocional`, `unidad`, `precio`, `disponibilidad`, `descripcion`, `promocion`, `fecha`, `imagen`, `imagenes`)
		//  VALUES (NULL, 'FSXCF', '202', 'SASA', '200', 'ASD', 'Unid', '2.50', '1', 'HOLA', '', CURRENT_TIMESTAMP, '', '');




		$resource=$conn->query($q);
		header("Location: listado_productos.php");
			}}}
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
		<title>Ingreso de Productos</title>
		
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
                        message: 'Ingrese Nombre del Producto'
                    }
                }
            },
			proveedor: {
                validators: {
                     stringLength: {
                    },
                    notEmpty: {
                        message: 'Selecione algun proveedor'
                    }
                }
            },
			 codigo: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Ingrese Codigo del Producto (Mínimo 1 caracteres)'
                    }
                }
            },
			 categoria: {
                validators: {
                     stringLength: {
                        
                    },
                    notEmpty: {
                        message: 'Selecione alguna categoria'
                    }
                }
            },
			disponibilidad: {
                validators: {
                     stringLength: {
                    },
                    notEmpty: {
                        message: 'Seleccione alguna opcion'
                    }
                }
            },
			frase_promocional: {
                validators: {
                     stringLength: {
                        min: 10,
                    },
                    notEmpty: {
                        message: 'Ingrese Frase Promocional (Mínimo 10 caracteres)'
                    }
                }
            },
			descripcion: {
                validators: {
                     stringLength: {
                        min: 20,
                    },
                    notEmpty: {
                        message: 'Ingrese Descripción Del Producto (Mínimo 10 caracteres)'
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
			    <form class="well form-horizontal" method="post"  id="agregarProducto" name="registro">
					<fieldset>

					<!-- Nombre de Formulario -->
					<legend><center><h2><b>Mantenedor de Productos</b></h2></center></legend><br>
                    
					
					<!-- Nombre input-->
                        <div class="form-group">
							  <label class="col-md-4 control-label">Nombre</label>  
							    <div class="col-md-4 inputGroupContainer">
							    <div class="input-group">
							        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
							  		<input name="nombre" id="nombre" placeholder="Ingrese el Nombre" class="form-control"  type="text" style="text-transform: uppercase">
							    </div>
							  </div>
							</div>



					<!-- Proveedor input-->
					<div class="form-group">
					<label class="col-md-4 control-label">PROVEEDOR</label>
					<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

					

          <?php
  
             $sql=mysqli_query($conn,"SELECT id , nombre from proveedores");
          //echo($q);
         // mysqli_close($conn);
          $resource=mysqli_num_rows($sql);                  


       ?>
       <select name="id" id="id" class="form-control selectpicker">
	   <option value=" " >Seleccione un proveedor</option>
       <?php
       if($resource > 0){
	    while($proveedor=mysqli_fetch_array($sql)){
		  
        ?>

  <option value="<?php echo $proveedor["id"];?>"><?php echo $proveedor["id"] ?> <?php echo $proveedor["nombre"];?></option>
<?php
	  }
	}

?>
</select>	
</div>
</div>
</div>	
			
					<!-- Codigo input-->
					      	<div class="form-group">
							  <label class="col-md-4 control-label">Código</label>  
							    <div class="col-md-4 inputGroupContainer">
							    <div class="input-group">
							        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
							  		<input name="codigo" id="codigo" placeholder="Ingrese Código" class="form-control"  type="text" style="text-transform: uppercase">
							    </div>
							  </div>
							</div>


									

					<!-- Categoría input-->
					       
					<div class="form-group">
					<label class="col-md-4 control-label">Categoría</label>
					<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>

					

          <?php
  
             $sql2=mysqli_query($conn,"SELECT id, categoria from productos");
          //echo($q);
          mysqli_close($conn);
          $resource2=mysqli_num_rows($sql2);                  
       ?>
       <select name="categoria" id="categoria" class="form-control selectpicker">
	   <option value=" " >Seleccione una categoria</option>
       <?php
       if($resource2 > 0){
	    while($categoria=mysqli_fetch_array($sql2)){
        ?>

  <option value="<?php echo $categoria["categoria"];?>"><?php echo $categoria["categoria"] ?> <?php echo $categoria["id"];?></option>
<?php
	  }
	}

?>
</select>	
</div>
</div>
</div>	
			
					<!-- Frase Promocional -->
					       	      
					<div class="form-group">
					  <label class="col-md-4 control-label">Frase Promocional</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-align-left"></i></span>
				    	<textarea name="frase_promocional" id="frase_promocional" cols="30" rows="10" placeholder="Ingrese Frase Promocional" class="form-control" type="text"></textarea>
					    </div>
					  </div>
					</div>
					
					<!-- Select Colores -->
					<div class="form-group"> 
					 	<label class="col-md-4 control-label">Unidad de medida</label>
							<div class="col-md-4 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
									<select name="unidad[]" id="colores" class="form-control selectpicker" >
										<option value=" " >Seleccione Unidad de Medida</option>
									 	<option value="Unidad">Unid</option>
								
									</select>
								</div>
							</div>
					</div>
					<!-- Precio -->
					       
					<div class="form-group">
					  <label class="col-md-4 control-label">Precio</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
					  	<input name="precio" id="precio" placeholder="Ingrese Precio $" class="form-control" type="text">
					    </div>
					  </div>
					</div>


					<!-- Disponibilidad -->
					 <div class="form-group">
						 <label class="col-md-4 control-label">Disponibilidad</label>
						 <div class="col-md-4 inputGroupContainer">        	      
							<div class="radio">
							  <label><input type="radio" name="disponibilidad" value="1" required>Si</label>
							</div>
							<div class="radio">
							  <label><input type="radio" name="disponibilidad" value="0" required>No</label>
							</div>
						 </div>
					</div>

					<!-- Descripción -->
					       	      
					<div class="form-group">
					  <label class="col-md-4 control-label">Descripción</label>  
					    <div class="col-md-4 inputGroupContainer">
					    <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				    	<textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Ingrese Descripción" class="form-control" type="text"></textarea>
					    </div>
					  </div>
					</div>
					
					<!-- En Promoción -->
					 <div class="form-group">
						 <label class="col-md-4 control-label">En Promoción</label>
						 <div class="col-md-4 inputGroupContainer">        	      
							<div class="radio">
							  <label><input type="radio" name="promocion" value="1" required>Si</label>
							</div>
							<div class="radio">
							  <label><input type="radio" name="promocion" value="0" required>No</label>
							</div>
						 </div>
					</div>
        <br>
					<div class="form-group">
					  <label class="col-md-4 control-label">Imagen</label>  
					   
					       
									<input type="file" name="image"/>
								
					  	</div>
					  </div>
					</div>
					<br>
					<!-- Success message -->
					<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label"></label>
					  <div class="col-md-4"><br>
					   <input type="submit" class="btn btn-success" value="agregarProducto" name="agregarProducto" id="agregarProducto">
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