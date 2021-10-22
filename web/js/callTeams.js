<script>
function start(){
Swal.fire({
  title: "<p class = 'title-red'>ИМЯ КРАСНОЙ КОМАНДЫ</p>",
  input: 'text',
  background: 'transparent',
  $("table").remove();
  customClass:'my-swal-red',
  //closeOnConfirm: false,
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
 // showLoaderOnConfirm: true,
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
	  $.ajax({
            url: '/web/game-mode/red',
            type: 'POST',
            data: {nameRedTeam: result.value},
            success: function (result) {
				let redTeam = result
               Swal.fire({
  title: "<p class = 'title-blue'>ИМЯ СИНЕЙ КОМАНДЫ</p>",
  background: 'transparent',
  input: 'text',
  customClass:'my-swal-blue',
  //closeOnConfirm: false,
  inputAttributes: {
  autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
 // showLoaderOnConfirm: true,
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
	  $.ajax({
            url: '/web/game-mode/blue',
            type: 'POST',
            data: {nameBlueTeam: result.value},
            success: function (result) {
			let blueTeam = result
			Swal.fire({
 // title: "<p class = 'title-red'>" + redTeam  + " против " + blueTeam"</p>",
 title: "<span class = 'title-red'>" +redTeam+"</span> <span class = 'white'> против</span> <span class = 'title-blue'>"+blueTeam+ "</span>",
//  text: redTeam  + ' против ' + blueTeam,
	//text: "<p class = 'title-red'>redTeam  + ' против ' + blueTeam</p>",
  background: 'transparent',
  imageUrl: '/web/images/23549.jpg',
  imageWidth: 550,
  imageHeight: 300,
  imageAlt: 'Custom image',
  
   confirmButtonText: 'Полетели!',
  showLoaderOnConfirm: true,
  allowOutsideClick: false,
 }).then((result) => {
	if (result.isConfirmed) {
location='/web/game-mode/game';
		}
    })  
	}
 })
			}
 }) 
	}
}
)
	}
	}) 
}
      //  $(".swal2-container.in").css('background-color', 'green)');//changes the color of the overlay
</script> 