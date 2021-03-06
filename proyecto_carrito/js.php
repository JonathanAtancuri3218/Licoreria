     <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.js"></script>
    
    <!-- jQuery Menu Pegajoso -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- jQuery WOW -->
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
        
    <!-- Script Principales -->
    <script src="js/main.js"></script>
    
    
    
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
		<script type="text/javascript">
			  $(document).ready(function() {
        $('#formulario').bootstrapValidator({
      
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
                        message: 'Ingrese su Nombre'
                    }
                }
            },
             apellido: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Ingrese su Apellido'
                    }
                }
            },
			 usuario: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'EL Usuario debe tener al menos 8 caracteres'
                    }
                }
            },
			 contrasena: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'La contraseña debe tener al menos 8 caracteres'
                    }
                }
            },
			email: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese una dirección de Email'
                    },
                    emailAddress: {
                        message: 'Ingrese una dirección de Email Válida'
                    }
                }
            },

            numero: {
                validators: {
                     stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Ingrese la numeración de Calle'
                    }
                }
            },
            direccion: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Ingrese el Nombre de la calle'
                    }
                }
            },
            comuna: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Ingrese El sector de  su residencia'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Introduzca al menos 10 caracteres y no más de 200 caracteres.'
                    },
                   
                }
            },
            telefono: {
                validators: {
                  stringLength: {
                        min: 9, 
                    notEmpty: {
                        message: 'Ingrese un teléfono válido.'
                     }
                }
            },
			nacionalidad: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione una Nacionalidad'
                    }
                }
            },
            
        }
    }
})
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") 
                $('#formulario').data('bootstrapValidator').resetForm();

            
            e.preventDefault();

        
            var $form = $(e.target);

            
            var bv = $form.data('bootstrapValidator');

        
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});
		</script>
    