<script>
let greenTeam;
let blueTeam;

Swal.fire({
  title: "<p class = 'title-green'>ИМЯ ЗЕЛЕНОЙ КОМАНДЫ</p>",
  input: 'text',
  background: 'transparent',
  customClass:'my-swal-green',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
  allowOutsideClick: false,
    preConfirm: (value) => {
    if (!value) {
		$(".swal2-validation-message").css('background', 'transparent');
      Swal.showValidationMessage(
        "<p class = 'title-green'>Напишите имя команды</p>"
      )
    }
	},
}).then((result) => {
	if (result.isConfirmed) {
				let greenTeam = result.value;

               Swal.fire({
  title: "<p class = 'title-blue'>ИМЯ СИНЕЙ КОМАНДЫ</p>",
  background: 'transparent',
  input: 'text',
  customClass:'my-swal-blue',
  inputAttributes: {
  autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
  allowOutsideClick: false,
      preConfirm: (value) => {
    if (!value) {
		 $(".swal2-validation-message").css('background', 'transparent');
      Swal.showValidationMessage(
        "<p class = 'title-blue'>Напишите имя команды</p>"
      )
    }
	},
 }).then((result) => {
	if (result.isConfirmed) {
			let blueTeam = result.value;
	
			Swal.fire({
  title: "<span class = 'title-green'>" +greenTeam+"</span> <span class = 'white'> против</span> <span class = 'title-blue'>"+blueTeam+ "</span>",
  background: 'transparent',
  imageUrl: '/web/images/23549.jpg',
  imageWidth: 550,
  imageHeight: 300,
  imageAlt: 'Custom image',
  
  confirmButtonText: 'Полетели!',
  allowOutsideClick: false,
 }).then((result) => {
	if (result.isConfirmed) {
		//$("#main").addClass('blueteam');
		$("#main").text(blueTeam); 
		revealTable();
			}
        })
		}
    })  
	}
 })
 </script>