<script>
		
  function gameStart(id) {
	  
	  setSessionStorage();
	    
  Swal.fire({
  title: "<p class = 'title-green'>ИМЯ ЗЕЛЕНОЙ КОМАНДЫ</p>",
  input: 'text',
  background: 'transparent',
  customClass:'my-swal-green',
  inputAttributes: {
    autocapitalize: 'off'},
  showCancelButton: false,
  confirmButtonText: 'Ok',
  allowOutsideClick: false,
  
  preConfirm: (value) => {
    if (!value) {
		$(".swal2-validation-message").css('background', 'transparent');
        Swal.showValidationMessage("<p class = 'title-green'>Напишите имя команды</p>")}
	},
	
	}).then((result) => {
	if (result.isConfirmed) {
		sessionStorage.greenTeam = result.value;	
        Swal.fire({
		title: "<p class = 'title-blue'>ИМЯ СИНЕЙ КОМАНДЫ</p>",
		background: 'transparent',
		input: 'text',
		customClass:'my-swal-blue',
		inputAttributes: {
		autocapitalize: 'off'},
		showCancelButton: false,
		confirmButtonText: 'Ok',
		allowOutsideClick: false,
		
        preConfirm: (value) => {
		if (!value) {
			$(".swal2-validation-message").css('background', 'transparent');
			Swal.showValidationMessage("<p class = 'title-blue'>Напишите имя команды</p>")}
		},
		
		}).then((result) => {
		if (result.isConfirmed) {
			sessionStorage.blueTeam = result.value;
			Swal.fire({
			title: "<span class = 'title-green'>" +sessionStorage.greenTeam+"</span> <span class = 'white'> против</span> <span class = 'title-blue'>"+sessionStorage.blueTeam+ "</span>",
			background: 'transparent',
			imageUrl: '/web/images/23549.jpg',
			imageWidth: 550,
			imageHeight: 300,
			imageAlt: 'Custom image',
			confirmButtonText: 'Полетели!',
			allowOutsideClick: false,
			
			}).then((result) => {
			if (result.isConfirmed) {
			$("#main").removeClass('blueteam greenteam');
			$("#main").addClass('blueteam');
			$("#main").text(sessionStorage.blueTeam);
			
			createDynamicTable(id);}
			})
		}
		})  
	}
	})
	}
	
	function setSessionStorage(){
		sessionStorage.words_number = 0;
		sessionStorage.turn = 'blue';
		sessionStorage.green_cards = 8;
		sessionStorage.blue_cards = 9;
		sessionStorage.colour = 'hidden';
	}
	
	function createDynamicTable(id)
		{
			$.ajax({
            url: '/web/game/show',
            type: 'POST',
            data: {id: id},
            success: function (result) {
                let gameAllCards = JSON.parse(result)
                function addTable() {
                    var myTableDiv = document.getElementById("myDynamicTable");
                    var table = document.createElement('TABLE');
                    table.className = 'fixed';
					table.id = 'table_id';

                    var tableBody = document.createElement('TBODY');
                    table.appendChild(tableBody);

                    var m, n, gameFiveCards, chunk = 5;
                    for (m = 0, n = gameAllCards.length; m < n; m += chunk) {
                        gameFiveCards = gameAllCards.slice(m, m + chunk);
                        var tr = document.createElement('TR');
                        tableBody.appendChild(tr);

                        $.each(gameFiveCards, function (i, gameOneCard) {
                            var td = document.createElement('TD');
                            tr.appendChild(td);

                            var button = document.createElement('button');
                            button.innerHTML = gameOneCard.card_value;
							button.className = 'button';
						    button.setAttribute('data-colour', gameOneCard.colour);
							button.setAttribute('id', gameOneCard.card_id);
							button.setAttribute('onclick', 'game(this.id)');
					
                            td.appendChild(button)
                        })
                    }
                    myTableDiv.appendChild(table);
                }
                addTable();
			}
			})
	}
		
		
	function game(id) 
	{
		if (checkWordsNumber()){
			$("#" + id).attr("disabled","disabled");
			let colour =  $('#' +id).attr('data-colour');
			switch(colour){
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
			break;}    
					        
			result = collectData(colour);
		
            if (result.newTeam === 'true') {
                sessionStorage.words_number = 0;
				remove();
                } else {
				showActiveButton(sessionStorage.words_number);}

            if (sessionStorage.turn === 'blue') {
                $('#main').removeClass('greenteam');
                $('#main').addClass('blueteam');
				$('#main').text(sessionStorage.blueTeam);
            } else {
                $('#main').removeClass('blueteam');
                $('#main').addClass('greenteam');
				$('#main').text(sessionStorage.greenTeam);}
						
				$("#" + id).removeClass("button");
				
			if (result.winner) {
			showWinner(result.winner);}
		}
    }
			
			
	function collectData(colour)
    {
		//result.colour = $('#' +id).attr("data-colour");
		let result = new Array();
		defineWhoseTurn(colour);
		result.newTeam = defineNewTeam(colour); // true or false
        result.winner =  calculateProgress(colour);
		return result;
    }
	
	
	function defineWhoseTurn(colour)
    {
        if (colour === sessionStorage.turn && +sessionStorage.words_number >= 1) {
           sessionStorage.words_number--;
		   
        }
        if (colour !== sessionStorage.turn || +sessionStorage.words_number === 0) {
            sessionStorage.words_number = 0;
			
            if (sessionStorage.turn !== 'green') {
               sessionStorage.turn = 'green';
            } else {
                sessionStorage.turn = 'blue';
            }
        }
    }
	
	
	function defineNewTeam(colour)
    {
        if (colour === sessionStorage.turn && +sessionStorage.words_number >= 1) {
            return 'false';
        }
        return 'true';
    }
	
	
	function calculateProgress(colour)
    {
        if (colour === 'blue') {
            sessionStorage.blue_cards--;
            if (+sessionStorage.blue_cards === 0) {
                return 'blue';
            }
        }

        if (colour === 'green') {
            sessionStorage.green_cards--;
            if (+sessionStorage.green_cards === 0) {
                return 'green';
            }
        }

        if (colour === 'black') {
            if (sessionStorage.turn === 'green') {
                return 'green';
            }
            return 'blue';
        }
        return false;
    }
		
	function showWinner(winner)
	{
		if (winner === 'green') {
		Swal.fire({
		title: "<p class = 'title-green'>" +sessionStorage.greenTeam+  " всех сделали!!!!</p>",
		customClass:'my-swal-green',
		background: 'transparent',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'ОК!',
		
		}).then((result) => {
			if (result.isConfirmed) {
			$('#table_id').remove();
			$('#main').removeClass('blueteam greenteam');
			$('#main').addClass('blueteam');
			$('#main').text('Hello');
			remove();
			sessionStorage.clear();}
		})
        } else {	
		Swal.fire({
		title: "<p class = 'title-blue'>"+sessionStorage.blueTeam  + " всех сделали!!!!</p>",
		customClass:'my-swal-blue',
		background: 'transparent',
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'ОК!',
		
		}).then((result) => {
		if (result.isConfirmed) {
			$('#table_id').remove();
			$('#main').removeClass('blueteam greenteam');
			$('#main').addClass('blueteam');
			$('#main').text('Codenames');
			remove();
			sessionStorage.clear();}
			})
		}
	}
	
	function checkWordsNumber()
	{
		if (+sessionStorage.words_number === 0) {
		Swal.fire('Cначала выберите число слов');
		return false;}
		return true;
	}
	
	function guessNumber(id) 
	{
		$('.p').unbind();
		sessionStorage.words_number = id;
		showActiveButton(sessionStorage.words_number);	 
    }
    
	function remove()
	{
				$( "#1" ).removeClass('number')
				$( "#2" ).removeClass('number')
				$( "#3" ).removeClass('number')
				$( "#4" ).removeClass('number')
				$( "#5" ).removeClass('number');
	}
	
	
	function showActiveButton(words_number)
	{
				remove()
				if (+words_number === 5){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
				}
				if (+words_number === 4){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (+words_number === 3){
						$( "#1" ).addClass('number');
						$( "#2" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (+words_number === 2){
						$( "#1" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
				if (+words_number === 1){
						$( "#2" ).addClass('number');
						$( "#3" ).addClass('number');
						$( "#4" ).addClass('number');
						$( "#5" ).addClass('number');
				}
	}
	
	
	function addColourClass()
	{
		if (sessionStorage.colour === 'hidden') {
			$($('.button')).each(function (){
			$(this).addClass($( this ).attr( "data-colour" ));
			sessionStorage.colour = 'revealed';
			})
		} else {
			$($('.button')).each(function (){
			$(this).removeClass($( this ).attr( "data-colour" ));
			sessionStorage.colour = 'hidden';
			})
		}
	}
	
	</script>
	
	
	
	
	
	
	
	