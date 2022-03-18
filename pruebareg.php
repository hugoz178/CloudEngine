<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>	
	<title></title>
</head>
<body>
	<form id="form">
		<div class="form-group">
				<input type="text" name="usuario" id="Usuario">
		</div>
		<div class="form-group">
			<input type="text" name="contrasena" id="contrasena">
		</div>
	</form>

</body>
</html>

<script type="text/javascript">

//java

$( "#form" ).bootstrapValidator({

   feedbackIcons: {
 
     valid: 'glyphicon glyphicon-ok',
 
     invalid: 'glyphicon glyphicon-remove',
 
     validating: 'glyphicon glyphicon-refresh'
 
   },
 
   fields: {
 
     usuario: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes ingresar tu nombre de usuario.'
 
         },

         regexp: {

                regexp: /[a-zs]/i,

                message: 'El nombre de usuario no permite el uso de dígitos ni caracteres especiales.\n'

          },

         stringLength: {
 
           min: 5,

           max: 15,
 
           message: 'Tu nombre de usuario debe de tener por lo menos 5 caracteres de longitud y 15 como máximo.'
 
         }
 
       }
 
     },

	contrasena: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes ingresar una contraseña.'
 
         },
 
         stringLength: {
 
           min: 5,
     max:25,
 
           message: 'Maximo 5 caracteres y maximo 25.\n'
 
         },

         identical: {
                        field: 'confirmar',
                        message:'Confirma tu contraseña. '
                    }

 
       }
 
     }   
 

  }
 
});

</script>