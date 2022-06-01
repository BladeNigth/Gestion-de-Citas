function eliminarU(user){
	var evento = "evento=eliminarUsuario&user="+user;
    Swal.fire({
        title: '¿Estás seguro de eliminar a este Psicologo? ',
        text: user,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminalo!'
        }).then((result) => {
        if (result.value) {
            $.ajax({  
            url: '../controlador/evento.php',
            type: "POST",
            data: evento,
			dataType: "html",
            success: function () {
                Swal.fire({
                    type: 'success',
                    title: 'Operacion exitosa',
                    text: 'El Psicologo fué eliminado',
                  }).then(function() {
                window.location = "ListaPsicologos.php";
            });
            },
            error: function(error){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'El Psicologo no pudo ser eliminado'
                  })
            }
        });

        }
       
})}

function eliminarPaciente(user){
	var evento = "evento=eliminarPaciente&user="+user;
	Swal.fire({
		title: '¿Estás seguro de eliminar a este paciente? ',
		text: user,
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Eliminalo!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '../controlador/evento.php',
				type: "POST",
				data: evento,
				dataType: "html",
				success: function () {
					Swal.fire({
						type: 'success',
						title: 'Operacion exitosa',
						text: 'El paciente fué eliminado',
					}).then(function() {
						window.location = "ListaPacientes.php";
					});
				},
				error: function(error){
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'El paciente no pudo ser eliminado'
					})
				}
			});

		}

	})}


function cambiarcontraU(user){
	var evento = "evento=CambiarContra&user="+user;

}

function MensajeError(error){
	Swal.fire({
         type: 'error',
         title: 'Oops...',
         text: error
             })
}
function MensajeErrorR(mensaje){
	 Swal.fire({
       	  type: 'error',
          title: 'Oops...',
          text: mensaje,
          }).then(function() {
           window.close();
		 });
}

function Probando(mensaje){
	Swal.fire({
			type: 'error',
		 title: 'Oops...',
		 text: mensaje,
		 }).then(function() {
		  window.close();
		});
}


function Cambioc(mensaje){
	
	
	 Swal.fire({
       	  type: 'success',
          title: 'Operacion exitosa',
          text: mensaje,
          }).then(function() {
          window.location = "profile.php";
		 });
}
function CambiocA(mensaje){
	 Swal.fire({
       	  type: 'success',
          title: 'Operacion exitosa',
          text: mensaje,
          }).then(function() {
          window.location = "PerfilA.php";
		 });
}
 
function MensajeCorrecto(mensaje){
	 Swal.fire({
       	  type: 'success',
          title: 'Operacion exitosa',
          text: mensaje
	 })

}
function Agendar(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje
	}).then(function() {
		window.location = "iniciop.php";
	});
}
function EditarU(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'profile.php'
	});
	
}
function EditA(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'perfilA.php'
	});
	
}
function EditPsicologo(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'perfilPsicologo.php'
	});

}
function EditPaciente(mensaje){
    // radicado 4433221008105486
    Swal.fire({
        type: 'success',
        title: 'Operacion exitosa',
        text: mensaje,
    }).then(function(){
        window.location = 'perfilPaciente.php'
    });
}
function EditarUA(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
			window.location = 'ListaPsicologos.php'
	});
}
function EditarPacienteA(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'ListaPacientes.php'
	});
}
function Mensajeo(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'indexA.php'
	});
}
function MensajetA(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'indexA.php'
	});
}
function MensajetU(mensaje){
	Swal.fire({
		type: 'success',
		title: 'Operacion exitosa',
		text: mensaje,
	}).then(function(){
		window.location = 'index.php'
	});
}
