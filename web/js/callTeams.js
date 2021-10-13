<script>

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
  text: 'Начинают   ' + ' ' + blueTeam,
  imageUrl: '/web/images/23549.jpg',
  imageWidth: 550,
  imageHeight: 300,
  imageAlt: 'Custom image',
})
			   $('#main').text(blueTeam)
			   //whoFirst = rollDice(blueTeam, redTeam)
			  // alert(whoFirst)
		}
    })  
	}
 })
			}
 }) 
	}
}
)


function changeTeam(blueTeam){
	$('#main').text(blueTeam)
}
	
	function rollDice(blueTeam, redTeam)
	{
		rand = randomInteger(1, 2)
		if(rand === 1)
		{
			return redTeam
		}
		else {
			return blueTeam
		}
	}
	
	

</script> 