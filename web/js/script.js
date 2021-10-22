	<script>

    function game(id) 
	{
		if (checkWordsNumber()){
					$.ajax({
                    url: '/web/game-mode/ajax',
                    type: 'POST',
                    data: {id: id},
                    success: function (result) {
                        let obj = JSON.parse(result)
						
						switch(obj.colour)
						{
							case 'blue':
							$("#" + id).addClass('blue')
							break
							case 'red':
							$("#" + id).addClass('red')
							break
							case 'black':
							$("#" + id).addClass('black')
							break
							case 'gray':
							$("#" + id).addClass('gray')
							break
						}
                       
                        if (obj.winner) {
							showWinner(obj.winner, obj.redname, obj.bluename)
                        }
						
                        if (obj.newTeam === 'true') {
                            wordsNumber = 0;
							remove();

                        } else {
							number = obj.number
							test(number);
						}

                        if (obj.turn === 'blue') {
                            $('#main').removeClass('redteam')
                            $('#main').addClass('blueteam')
							$('#main').text(obj.bluename)

                        } else {
                            $('#main').removeClass('blueteam')
                            $('#main').addClass('redteam')
							$('#main').text(obj.redname)
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
    $($('.button')).each(function (){
        $(this).toggleClass($( this ).attr( "data-*" ));
    });
}

	</script>
	