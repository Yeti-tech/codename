<script>

    function foo(id) 
	{
		$('.p').unbind()
        $.ajax({
            url: '/web/game-mode/number',
            type: 'POST',
            data: {number: id},
            success: function (result) {
                wordsNumber = 1
				let number = result
				test(number)
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
	
	</script>