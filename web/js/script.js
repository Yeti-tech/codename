<script>

function startGame(){
	
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
		game_id = getGameId();
		   $.ajax({
            url: '/web/game/begin',
			dataType: 'json',
            type: 'POST',
            data: {start:JSON.stringify([game_id, blueTeam, greenTeam])},
            success: function (result) {
		//$("#main").addClass('blueteam');
		$("#main").text(result);
		revealTable();
			}
        })
		}
    })  
	}
 })
 }
			})
}


    function game(id) 
	{
	      
		if (checkWordsNumber()){
			$("#" + id).attr("disabled","disabled");
			game_id = getGameId(),
					$.ajax({
                    url: '/web/game/card',
					dataType: 'json',
                    type: 'POST',
					  data: {data:JSON.stringify([game_id, id])},
                    success: function (result) {
                     
						switch(result.colour)
						{
							case 'blue':
							$("#" + id).addClass('blue');
							break;
							case 'green':
							$("#" + id).addClass('green');
							break;
							case 'black':
							$("#" + id).addClass('black');
							break;
							case 'gray':
							$("#" + id).addClass('gray');
							break;
						}
                       
                        if (result.winner) {
							showWinner(result.winner, result.greenname, result.bluename);
                        }
						
                        if (result.newTeam === 'true') {
                            wordsNumber = 0;
							remove();

                        } else {
							number = result.number;
							test(number);
						}

                        if (result.turn === 'blue') {
                            $('#main').removeClass('greenteam');
                            $('#main').addClass('blueteam');
							$('#main').text(result.bluename);

                        } else {
                            $('#main').removeClass('blueteam');
                           $('#main').addClass('greenteam');
							$('#main').text(result.greenname);
                        }
						
						 $("#" + id).removeClass("button");
                }
            })
    }
}
	
	function checkWordsNumber()
	{
		
		if (typeof wordsNumber === 'undefined') {
		wordsNumber = 0
		}

		if (wordsNumber === 0) {
		Swal.fire('Cначала выберите число слов')
		return false
	}
	return true
	}
	
	function showWinner(winner, greenname, bluename){
		
		if (winner === 'green') {
								Swal.fire(greenname  + " " + "всех сделали!!!!")
                            } else {	
                                Swal.fire(bluename  + " " + "  всех сделали!!!!")
                            }
	}
	
	
function addColourClass(){

	if ($('#show').length) {
	$($('.button')).each(function (){
        $(this).addClass($( this ).attr( "data-*" ));
		$('#show').remove();
    })
	} else {
	 $($('.button')).each(function (){
       $(this).removeClass($( this ).attr( "data-*" ));
	 })
		 var special = document.getElementById("special");
                    var elem = document.createElement('span');
					 elem.id = 'show';
					 special.appendChild(elem);
		$(document.createElement('span')).attr('id', 'show');
}
}

 function foo(id) 
	{
		$('.p').unbind(),
		game_id = getGameId(),
        $.ajax({
			url: '/web/game/number',
			dataType: 'json',
            type: 'POST',
            data: {number:JSON.stringify([game_id, id])},
            success: function (result) {
				wordsNumber = 1;
				test(result);
			}
			 })
    }
               
			
       
	
	function remove()
	{
				$( "#1" ).removeClass('number')
				$( "#2" ).removeClass('number')
				$( "#3" ).removeClass('number')
				$( "#4" ).removeClass('number')
				$( "#5" ).removeClass('number');
	}
	
	
	function test(number){
		let i = number;
				remove()
				
				if (i === 5 || i === '5'){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
				}
				if (i === 4 || i === '4'){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (i === 3 || i === '3'){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (i === 2 || i === '2'){
						$( "#1" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (i === 1 || i === '1'){
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
	}
	
	
 function getGameId() {
	var game_id =  $("#special").attr('data-*');
	return game_id;
 }
 
 function revealTable()
 {
	 $("#table_id").removeAttr("hidden");
 }
	</script>
	