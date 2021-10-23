	<script>

    function game(id) 
	{
		if (checkWordsNumber()){
			game_id = getGameId(),
					$.ajax({
                    url: '/web/game/card',
					dataType: 'json',
                    type: 'POST',
					  data: {data:JSON.stringify([game_id, id])},
                  //  data: {id: id},
                    success: function (result) {
                       // var obj = JSON.parse(result);
						//console.log(result.colour);
						switch(result.colour)
						{
							case 'blue':
							$("#" + id).addClass('blue');
							break;
							case 'red':
							$("#" + id).addClass('red');
							break;
							case 'black':
							$("#" + id).addClass('black');
							break;
							case 'gray':
							$("#" + id).addClass('gray');
							break;
						}
                       
                        if (result.winner) {
							showWinner(result.winner, result.redname, result.bluename);
                        }
						
                        if (result.newTeam === 'true') {
                            wordsNumber = 0;
							remove();

                        } else {
							number = result.number;
							test(number);
						}

                        if (result.turn === 'blue') {
                            $('#main').removeClass('redteam');
                            $('#main').addClass('blueteam');
							$('#main').text(result.bluename);

                        } else {
                            $('#main').removeClass('blueteam');
                           $('#main').addClass('redteam');
							$('#main').text(result.redname);
                        }
                }
            })
    }
}
	
	function checkWordsNumber()
	{
		//var wordsNumber 
		//alert(wordsNumber)
		if (typeof wordsNumber === 'undefined') {
		wordsNumber = 0
		}

		//if(wordsNumber === undefined )
		//{
		//	wordsNumber = 0
		//}
		if (wordsNumber === 0) {
		Swal.fire('Cначала выберите число слов')
		return false
	}
	return true
	}
	
	function showWinner(winner, redname, bluename){
		
		if (winner === 'red') {
								Swal.fire(redname  + " " + "всех сделали!!!!")
                            } else {	
                                Swal.fire(bluename  + " " + "  всех сделали!!!!")
                            }
	}
	
	
function addColourClass(){

	if ($('#show').length) {
		console.log('fgg');
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
	</script>
	