	<script>

    function game(id) 
	{
		var wordsNumber = 0;
		 let clickId = id;
            if (wordsNumber === 1) {
				swal("Cначала выберите число слов")
            } else {
					$.ajax({
                    url: '/web/game-mode/ajax',
                    type: 'POST',
                    data: {id: id},
                    success: function (result) {
                        let obj = JSON.parse(result)
						alert(obj.colour);
                        if (obj.colour === 'blue') {
                            $("#" + clickId).addClass('blue')
                        }
                        if (obj.colour === 'red') {
                            $("#" + clickId).addClass('red')
                        }
                        if (obj.colour === 'black') {
                            $("#" + clickId).addClass('black')
                        }
                        if (obj.colour === 'gray') {
                            $("#" + clickId).addClass('gray')
                        }
                        if (obj.winner) {
                            if (obj.winner === 'red') {
								name = obj.redname;
                                swal("всех сделали!!!!")
                            } else {
                                swal("Синие всех сделали!!!!")
                            }
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
	</script>
	