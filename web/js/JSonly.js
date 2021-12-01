function gameStart(id) {

    setSessionStorage();
    $('#table_id').remove();

    Swal.fire({
        title: "<p class = 'title-green'>ИМЯ ЗЕЛЕНОЙ КОМАНДЫ</p>",
        input: 'text',
        background: 'transparent',
        customClass: 'my-swal-green',
        showCancelButton: false,
        confirmButtonText: 'Ok',
        allowOutsideClick: false,
        value: 'Значение по умолчанию',

        preConfirm: (value) => {
            if (!value) {
                $(".swal2-validation-message").css('background', 'transparent');
                Swal.showValidationMessage("<p class = 'title-green'>Напишите имя команды</p>")
            }
        },

    }).then((result) => {
        if (result.isConfirmed) {
            sessionStorage.greenTeam = result.value;
            Swal.fire({
                title: "<p class = 'title-blue'>ИМЯ СИНЕЙ КОМАНДЫ</p>",
                background: 'transparent',
                input: 'text',
                customClass: 'my-swal-blue',
                showCancelButton: false,
                confirmButtonText: 'Ok',
                allowOutsideClick: false,

                preConfirm: (value) => {
                    if (!value) {
                        $(".swal2-validation-message").css('background', 'transparent');
                        Swal.showValidationMessage("<p class = 'title-blue'>Напишите имя команды</p>")
                    }
                },

            }).then((result) => {
                if (result.isConfirmed) {
                    sessionStorage.blueTeam = result.value;
                    Swal.fire({
                        title: "<span class = 'title-green'>" + sessionStorage.greenTeam + "</span> <span class = 'white'> против</span> <span class = 'title-blue'>" + sessionStorage.blueTeam + "</span>",
                        background: 'transparent',
                        imageUrl: '/web/images/23549.jpg',
                        imageWidth: 550,
                        imageHeight: 300,
                        imageAlt: 'Custom image',
                        confirmButtonText: 'Полетели!',
                        allowOutsideClick: false,

                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#main").removeClass('blueteam greenteam').addClass('blueteam').text(sessionStorage.blueTeam);
                            createDynamicTable(id);
                        }
                    })
                }
            })
        }
    })
}

function setSessionStorage() {
    sessionStorage.words_number = 0;
    sessionStorage.turn = 'blue';
    sessionStorage.green_cards = 8;
    sessionStorage.blue_cards = 9;
    sessionStorage.colour = 'hidden';
}

function createDynamicTable(id) {
    $.ajax({
        url: '/web/game/show',
        type: 'POST',
        data: {id: id},
        success: function (result) {
            let gameAllCards = JSON.parse(result);
            addDynamicTable(gameAllCards);
        }
    })
}

function addDynamicTable(gameAllCards) {
    let myTableDiv = document.getElementById('myDynamicTable');
    let table = document.createElement('TABLE');
    table.className = 'fixed';
    table.id = 'table_id';

    let tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    let m, n, gameFiveCards, chunk = 5;
    for (m = 0, n = gameAllCards.length; m < n; m += chunk) {
        gameFiveCards = gameAllCards.slice(m, m + chunk);
        let tr = document.createElement('TR');
        tableBody.appendChild(tr);

        $.each(gameFiveCards, function (i, gameOneCard) {
            let td = document.createElement('TD');
            tr.appendChild(td);

            let button = document.createElement('button');
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

function game(id) {
    let result;
    if (checkWordsNumber()) {
        let card = $("#" + id);
        let colour = card.attr('data-colour');

        revealCardColour(card, colour);

        result = collectData(colour);

        if (result.newTeam === 'true') {
            changeTeam();
        } else {
            showActiveButton(sessionStorage.words_number);
        }

        if (result.winner) {
            showWinner(result.winner);
        }
    }
}

function revealCardColour(card, colour) {
    card.attr("disabled", "disabled");
    switch (colour) {
        case 'blue':
            card.addClass('blue').removeClass("button");
            break;
        case 'green':
            card.addClass('green').removeClass("button");
            break;
        case 'black':
            card.addClass('black').removeClass("button");
            break;
        case 'gray':
            card.addClass('gray').removeClass("button");
            break;
    }
}

function changeTeam() {
    sessionStorage.words_number = 0;
    remove();
    if (sessionStorage.turn === 'blue') {
        $('#main').removeClass('greenteam').addClass('blueteam').text(sessionStorage.blueTeam);
    } else {
        $('#main').removeClass('blueteam').addClass('greenteam').text(sessionStorage.greenTeam);
    }
}

function collectData(colour) {
    let result = [];
    defineWhoseTurn(colour);
    result.newTeam = defineNewTeam(colour);
    result.winner = calculateProgress(colour);
    return result;
}

function defineWhoseTurn(colour) {
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

function defineNewTeam(colour) {
    if (colour === sessionStorage.turn && +sessionStorage.words_number >= 1) {
        return 'false';
    }
    return 'true';
}


function remove() {

    $("#1").removeClass('number');
    $("#2").removeClass('number');
    $("#3").removeClass('number');
    $("#4").removeClass('number');
    $("#5").removeClass('number');
}

function calculateProgress(colour) {
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

function showWinner(winner) {
    if (winner === 'green') {
        Swal.fire({
            title: "<p class = 'title-green'>" + sessionStorage.greenTeam + " всех сделали!!!!</p>",
            customClass: 'my-swal-green',
            background: 'transparent',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ОК!',
        }).then((result) => {
            if (result.isConfirmed) {
                remove();
                sessionStorage.clear();
                sessionStorage.colour = 'hidden';
            }
        })
    } else {
        Swal.fire({
            title: "<p class = 'title-blue'>" + sessionStorage.blueTeam + " всех сделали!!!!</p>",
            customClass: 'my-swal-blue',
            background: 'transparent',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ОК!',
        }).then((result) => {
            if (result.isConfirmed) {
                remove();
                sessionStorage.clear();
                sessionStorage.colour = 'hidden';
            }
        })
    }
}

function checkWordsNumber() {
    if (+sessionStorage.words_number === 0) {
        Swal.fire('Cначала выберите число слов');
        return false;
    }
    return true;
}

function guessNumber(id) {
    sessionStorage.words_number = id;
    showActiveButton(sessionStorage.words_number);
}

function showActiveButton(words_number) {
    let one = $("#1");
    let two = $("#2");
    let three = $("#3");
    let four = $("#4");
    let five = $("#5");

    switch (+words_number) {
        case 5:
            one.addClass('number');
            two.addClass('number');
            three.addClass('number');
            four.addClass('number');
            five.removeClass('number');
            break;

        case 4:
            one.addClass('number');
            two.addClass('number');
            three.addClass('number');
            four.removeClass('number');
            five.addClass('number');
            break;

        case 3:
            one.addClass('number');
            two.addClass('number');
            three.removeClass('number');
            four.addClass('number');
            five.addClass('number');
            break;

        case 2:
            one.addClass('number');
            two.removeClass('number');
            three.addClass('number');
            four.addClass('number');
            five.addClass('number');
            break;

        case 1:
            one.removeClass('number');
            two.addClass('number');
            three.addClass('number');
            four.addClass('number');
            five.addClass('number');
            break;
    }
}

function addColourClass() {
    if (sessionStorage.colour === 'hidden') {
        $($('.button')).each(function () {
            $(this).addClass($(this).attr("data-colour"));
            sessionStorage.colour = 'revealed';
        })
    } else {
        $($('.button')).each(function () {
            $(this).removeClass($(this).attr("data-colour"));
            sessionStorage.colour = 'hidden';
        })
    }
}

    function addWords(id)
    {
        let myForm = document.getElementById('myForm');
        var f = document.createElement("form");
        f.setAttribute('class',"form");
        f.setAttribute('id',"ajax-form");

        var i = document.createElement("textarea");
        i.setAttribute('type',"text" );
        i.setAttribute('style', "width: 600px; height: 200px;  margin:auto");

        var s = document.createElement("span");
        s.setAttribute('class',"confirm");
        s.setAttribute('id',"send");
        s.setAttribute('onclick',"addNewWords()");

        var m = document.createElement("span");
        s.setAttribute('class',"confirmNewLibrary");
        s.setAttribute('id',"sendNewLibrary");
        s.setAttribute('onclick',"addNewWords()");

        f.appendChild(i);
        f.appendChild(s);
        f.appendChild(m);

        myForm.appendChild(f);
        $('#send').text('отправить');
    }

function addNewWords(){

    var data = {};
      $('#ajax-form').find ('textarea').each(function() {
          data[this.name] = $(this).val();
            });
    let json = JSON.stringify(data);

    $.ajax({
        url: '/web/game/ajax',
        type: 'POST',
        dataType: 'json',
        data: {words: json},
        success: function (result) {
            console.log(result);
            $('#ajax-form').remove();
        }
    })
}




	

	
	
	
	
	
	
	
	