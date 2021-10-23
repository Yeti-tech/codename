<script>

Swal.fire({
  title: "<p class = 'title-red'>ИМЯ КРАСНОЙ КОМАНДЫ</p>",
  input: 'text',
  background: 'transparent',
  customClass:'my-swal-red',
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
        "<p class = 'title-red'>Напишите имя команды</p>"
      )
    }
	},
}).then((result) => {
	if (result.isConfirmed) {
				let redTeam = result.value;

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
  title: "<span class = 'title-red'>" +redTeam+"</span> <span class = 'white'> против</span> <span class = 'title-blue'>"+blueTeam+ "</span>",
  background: 'transparent',
  imageUrl: '/web/images/23549.jpg',
  imageWidth: 550,
  imageHeight: 300,
  imageAlt: 'Custom image',
  
  confirmButtonText: 'Полетели!',
  allowOutsideClick: false,
 }).then((result) => {
	if (result.isConfirmed) {
		game_id = getGameId();
		   $.ajax({
            url: '/web/game/begin',
			dataType: 'json',
            type: 'POST',
            data: {start:JSON.stringify([game_id, blueTeam, redTeam])},
            success: function (result) {
		//$("#main").addClass('blueteam');
		$("#main").text(result);
			}
        })
		}
    })  
	}
 })
 }
			})
 
 function getGameId() {
	var game_id =  $("#special").attr('data-*');
	return game_id;
 }
  
</script> 