<script>

//begin()

//function begin() {
	//  $('#main').text(blueTeam)
	//$('#js').text('blueTeam');
	//if($('#js').classList.contains('active'))
	//if (document.getElementById("js"))
	
Swal.fire({
  title: 'Имя красной команды',
  input: 'text',
  closeOnConfirm: false,
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
  showLoaderOnConfirm: true,
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
	if (result.isConfirmed) {
	  $.ajax({
            url: '/web/game-mode/red',
            type: 'POST',
            data: {nameRedTeam: result.value},
            success: function (result) {
				let redTeam = result
               Swal.fire({
  title: 'Имя синей команды',
  input: 'text',
  closeOnConfirm: false,
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: false,
  confirmButtonText: 'Ok',
  showLoaderOnConfirm: true,
  allowOutsideClick: () => !Swal.isLoading()
 }).then((result) => {
	if (result.isConfirmed) {
	  $.ajax({
            url: '/web/game-mode/blue',
            type: 'POST',
            data: {nameBlueTeam: result.value},
            success: function (result) {
			let blueTeam = result
			Swal.fire({
  title: 'Полетели!',
  text: redTeam  + ' против ' + blueTeam,
  imageUrl: '/web/images/23549.jpg',
  imageWidth: 550,
  imageHeight: 300,
  imageAlt: 'Custom image',
   confirmButtonText: 'Ok',
  showLoaderOnConfirm: true,
  allowOutsideClick: () => !Swal.isLoading()
 }).then((result) => {
	if (result.isConfirmed) {
location='/web/game-mode/game';
			 //  $('#main').text(blueTeam)
			 //  beginGame
			   //whoFirst = rollDice(blueTeam, redTeam)
			  // alert('whoFirst')
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

	
	

</script> 