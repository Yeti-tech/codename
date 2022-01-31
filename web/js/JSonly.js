
addEventListeners();

function addEventListeners() {

    $("#newGame").on("click", function() {
        clearSessionStorage();
        gameStart(this.id);
    });

    $(".guess-number").on("click", function() {
        guessNumber(this.id);
    });

    $(".btn-blue").on("click", function() {
        showAllColours();
    });

    $("#duet").on("click", function() {
        clearSessionStorage();
        sessionStorage.duet = 'true';
        gameStart(this.id);
    });

    $("#rules").on("click", function() {
    rules();
    });
}

function rules(){
    Swal.fire({
        title: false,
        width: 1200,
        padding: '3em',
        color: 'black',
        customClass: {
            confirmButton: 'position',
        },
        allowOutsideClick: true,
        showCancelButton: false,
        showConfirmButton: true,
        html: "<div class=\"align-left\"><b>1) </b> Разделитесь на две команды, выберите лидера.</div>" +
            "<br>" +
            "<div class=\"align-left\"><b>2)</b> Лидеры команд смотрят на цвета, выписывают слова своего цвета, затем скрывают цвета от участников.</div>" +
            "<br>" +
            "<img src='/web/images/game.png' alt='kkk'>" +
            "<br><br>" +
            "<div class=\"align-left\"><b>3)</b> Цель лидера - объяснить как можно больше слов своего цвета своей команде одним словом.</div>" +
            "<br>" +
                    "<div class=\"align-left\"> Нельзя называть однокоренные слова. Также обходите стороной черное слово - это автоматический проигрыш.</div>" +
            "<br>" +
            "<img src='/web/images/number.png' alt='kkk'>" +
            "<br><br>" +
            "<div class=\"align-left\">Можно загадать ассоциацию, которая позволит команде отгадать от одного до пяти слов за один ход.</div>" +
            "<br><br>"
    })
}

function hideElements(){

    $('#table_id').remove();
    $('#team-name').hide();
    $('.guess-number').each(function() {
        this.hidden = "hidden";
    });
}

function gameStart(id) {

    hideElements();

    let green_team = sessionStorage.greenTeam;
    let blue_team = sessionStorage.blueTeam;

    if (green_team == null) {
        green_team = 'Лягушки';
    }
    if (blue_team == null) {
        blue_team = 'Сосульки';
    }
    Swal.fire({
        allowOutsideClick: false,
        background: 'transparent',
        width: 600,
        html:
            '<p class = \'title-green\'>ИМЯ ЗЕЛЕНОЙ КОМАНДЫ</p>' +
            '<input id="green-team" class="green-team-input" type="text" value="' + green_team + '">' +
            '<br><br><br><br><br>' +
            '<p class="title-blue">ИМЯ СИНЕЙ КОМАНДЫ</p>' +
            '<input id="blue-team" class="blue-team-input" value="' + blue_team + '">',
        preConfirm: () => {
            return new Promise(function (resolve) {
                if ($("#green-team").val() === "" || $("#blue-team").val() === "") {
                    Swal.showValidationMessage("<p>Напишите имя команды!</p>");
                    setTimeout(hideValidationMessage, 3000);
                }
                resolve([
                    $('#green-team').val(),
                    $('#blue-team').val(),
                ])
            })
        }
    })
        .then((result) => {
            sessionStorage.greenTeam = result.value[0];
            sessionStorage.blueTeam = result.value[1];
            Swal.fire({
                title: "<span class = 'green-name-confirm'>" + sessionStorage.greenTeam + "</span> <span class = 'team-versus-team'>" +
                    " против</span> <span class = 'blue-name-confirm'>" + sessionStorage.blueTeam + "</span>",
                background: 'transparent',
                imageUrl: '/web/images/23549.jpg',
                imageWidth: 550,
                imageHeight: 300,
                imageAlt: 'helicopter',
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 3000,
            }).then(() => {
                createDynamicTable(id);
                removeWordsNumber();
            })
        })
}

function defineWhoFirst() {
    if (Math.floor(Math.random() * 2) === 0) {
        return {teamColor: 'blueteam', teamName: sessionStorage.blueTeam};
    }
    return {teamColor:'greenteam', teamName: sessionStorage.greenTeam}
}

function hideValidationMessage() {
    $(".swal2-validation-message").hide();
}

function createDynamicTable(id) {

    $.ajax({
        url: '/web/game/show',
        type: 'POST',
        data: {id: id},
        success: function (result) {
            addDynamicTable(JSON.parse(result));
        }
    })
}

function addDynamicTable(gameAllCards) {

    let firstTeam = defineWhoFirst();
    setSessionStorage(firstTeam['teamColor']);
    $("#team-name").removeClass().addClass(firstTeam['teamColor']).text(firstTeam['teamName']);
    $('#team-name').show();
    let colors = defineColours(firstTeam['teamColor']);

    let myTableDiv = $("#myDynamicTable");
    let table = $("<table class = 'fixed' id = 'table_id'></table>");
    let tbody = $("<tbody></tbody>");
    myTableDiv.append(table);
    table.append(tbody);
    let m, n, gameFiveCards, chunk = 5;
    for (m = 0, n = gameAllCards.length; m < n; m += chunk) {
        gameFiveCards = gameAllCards.slice(m, m + chunk);
        let tr = $("<tr></tr>");
        tbody.append(tr)
        $.each(gameFiveCards, function (i, gameOneCard) {
            let td = $("<td></td>");
            tr.append(td);
            let button = $("<button></button>");
            button.html(gameOneCard.card_value);
            button.addClass('neutral-button');
            button.attr('id', gameOneCard.card_id);
            $(button).on( "click", function() {
               game(this.id);
            });
            td.append(button);
        })
    }
    $('.neutral-button').each(function(i,elem) {
        $(elem).attr('data-colour', colors[i]);
    });
    $('.guess-number').each(function(i,elem) {
               $(elem).removeAttr("hidden");
           });
}

function defineColours(firstTeamColor) {

    if(sessionStorage.duet === 'true') {
        let colors = [
            'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'black', 'blue',
            'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
            'gray', 'gray', 'gray', 'gray', 'gray',
        ];
        return shuffle(colors);
    }
    if (firstTeamColor === 'blueteam') {
        let colors = [
            'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'black', 'blue',
            'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
            'gray', 'gray', 'gray', 'gray',
        ];
        return shuffle(colors);
    }
        let colors = [
            'green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'black', 'green',
            'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
            'gray', 'gray', 'gray', 'gray',
        ]
        return shuffle(colors);
}

function shuffle(colors) {
    for (let i = colors.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [colors[i], colors[j]] = [colors[j], colors[i]];
    }
    return colors;
}

function game(id) {
    let result;
    if (checkWordsNumber()) {
        const audio = new Audio("../../web/walkie-talkie.mp3");
        audio.play();

        let card = $("#" + id);
        let colour = card.attr('data-colour');
        revealCardColour(card, colour);
        result = collectData(colour);
        if (result.newTeam === true) {
            changeTeam();
        } else {
            showWordsNumber(sessionStorage.words_number);
        }
        if (result.winner) {
            showWinner(result.winner);
            return true;
        }
        if (+sessionStorage.blue_cards === 0 || +sessionStorage.green_cards === 0){
            if(sessionStorage.player === 'green') {
                revealWinner('blue')
           } else {
               revealWinner('green');
           }
        }
    }
}

function revealOpponentCard(opponentColor) {

    let opponent_card = randOpponentCard(collectOpponentCards(opponentColor));
    let card = $("#" + opponent_card.id);
    revealCardColour(card, opponentColor);
   }

function collectOpponentCards(opponentColor){
       let opponent_cards = [];
       if(opponentColor === 'green') {
           $('button[data-colour = "green"]:not(:disabled)').each(function(i, id) {
                   opponent_cards[i] = id;
           })
           sessionStorage.green_cards--;
       } else {
        $('button[data-colour = "blue"]:not(:disabled)').each(function(i, id) {
            opponent_cards[i] = id;
           });
           sessionStorage.blue_cards--;
   }
       return opponent_cards;
   }

function randOpponentCard(opponent_cards){
       let size = Object.keys(opponent_cards).length;
       return opponent_cards[Math.floor(Math.random()*size)];
   }

function collectData(colour) {
    let result = [];
    result.newTeam = defineWhoseTurn(colour);
    result.winner = calculateProgress(colour);
    return result;
}

function defineWhoseTurn(colour) {

    if (colour === sessionStorage.turn && +sessionStorage.words_number >= 1) {
        sessionStorage.words_number--;
    }
    if (colour !== sessionStorage.turn || +sessionStorage.words_number === 0) {
        removeWordsNumber();
        sessionStorage.words_number = 0;
        if (sessionStorage.duet !== 'true') {
            if (sessionStorage.turn !== 'green') {
                sessionStorage.turn = 'green';
            } else {
                sessionStorage.turn = 'blue';
            }
        } else {
            if (sessionStorage.player === 'blue') {
                revealOpponentCard('green');
                return false;
            } else {
                revealOpponentCard('blue');
                return false;
            }
        }
        return true;
    }
    return false;
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
            if (sessionStorage.duet === 'true') {
                revealWinner('blue');
                return false;
            }
            return 'green';
        } else {
            if (sessionStorage.duet === 'true') {
                revealWinner('green');
                return false;
            }
            return 'blue';
        }
    }
    return false;
}

function revealCardColour(card, colour) {
    card.attr("disabled", "disabled");
    switch (colour) {
        case 'blue':
            card.addClass('blue').removeClass("neutral-button");
            break;
        case 'green':
            card.addClass('green').removeClass("neutral-button");
            break;
        case 'black':
            card.addClass('black').removeClass("neutral-button");
            break;
        case 'gray':
            card.addClass('gray').removeClass("neutral-button");
            break;
    }
}

function changeTeam() {
    sessionStorage.words_number = 0;
    removeWordsNumber();
    if (sessionStorage.turn === 'blue') {
        $('#team-name').removeClass('greenteam').addClass('blueteam').text(sessionStorage.blueTeam);
    } else {
        $('#team-name').removeClass('blueteam').addClass('greenteam').text(sessionStorage.greenTeam);
    }
}

function removeWordsNumber() {
    $("#1").removeClass('non-active-number');
    $("#2").removeClass('non-active-number');
    $("#3").removeClass('non-active-number');
    $("#4").removeClass('non-active-number');
    $("#5").removeClass('non-active-number');
}

function revealWinner(winner){

    if (winner === 'green') {
        Swal.fire({
            title: "<p class = 'winner-green'>" + sessionStorage.greenTeam + " всех сделали!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + sessionStorage.blueTeam + " всех сделали!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    }
    removeWordsNumber();
}

function clearSessionStorage(){
    sessionStorage.removeItem("words_number");
    sessionStorage.removeItem("green_cards");
    sessionStorage.removeItem("blue_cards");
    sessionStorage.removeItem("turn");
    sessionStorage.removeItem("player");
    sessionStorage.removeItem("duet");
    sessionStorage.colour = 'hidden';
}

function showWinner(winner) {
    if(sessionStorage.duet === 'true') {
        if (sessionStorage.player === 'green') {
            if (+sessionStorage.blue_cards === 0) {
                revealWinner('blue');
            } else {
                duetShowWinnerGreen()
            }
        } else {
            if (+sessionStorage.green_cards === 0) {
                revealWinner('green');
            } else {
                duetShowWinnerBlue()
            }
        }
    } else {
            revealWinner(winner);
        }
    }

function duetShowWinnerGreen(){
    if (+sessionStorage.blue_cards === 8) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " В это невозможно поверить!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 7) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " В это невозможно поверить!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 6) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Миссия невыполнима</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 5) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Ого!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 4) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Неплохо для первого раза</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 3) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Вы знаете, что можете лучше </p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 2) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Вы же играли для участия, правда?</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.blue_cards === 1) {
        Swal.fire({
            title: "<p class = 'winner-green'>" + " Эйнштейн тоже не сразу все понял</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    }
}

function duetShowWinnerBlue(){
    if (+sessionStorage.green_cards === 8) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " В это невозможно поверить!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    }
    if (+sessionStorage.green_cards === 7) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " В это невозможно поверить!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 6) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Миссия невыполнима</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 5) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Ого!</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 4) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Неплохо для первого раза</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 3) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Вы знаете, что можете лучше </p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 2) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Вы же играли для участия, правда?</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    } else if (+sessionStorage.green_cards === 1) {
        Swal.fire({
            title: "<p class = 'winner-blue'>" + " Эйнштейн тоже не сразу все понял</p>",
            background: 'transparent',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 5000,
        })
    }
}

function checkWordsNumber() {
    if (+sessionStorage.words_number === 0) {
        Swal.fire({
            showConfirmButton: false,
            title: 'Cначала выберите число слов!',
            timer: 1200,
        })
        return false;
    }
    return true;
}

function guessNumber(id) {
    sessionStorage.words_number = id;
    showWordsNumber();
}

function showWordsNumber() {
    let one = $("#1");
    let two = $("#2");
    let three = $("#3");
    let four = $("#4");
    let five = $("#5");

    switch (+sessionStorage.words_number ) {
        case 5:
            one.addClass('non-active-number');
            two.addClass('non-active-number');
            three.addClass('non-active-number');
            four.addClass('non-active-number');
            five.removeClass('non-active-number');
            break;

        case 4:
            one.addClass('non-active-number');
            two.addClass('non-active-number');
            three.addClass('non-active-number');
            four.removeClass('non-active-number');
            five.addClass('non-active-number');
            break;

        case 3:
            one.addClass('non-active-number');
            two.addClass('non-active-number');
            three.removeClass('non-active-number');
            four.addClass('non-active-number');
            five.addClass('non-active-number');
            break;

        case 2:
            one.addClass('non-active-number');
            two.removeClass('non-active-number');
            three.addClass('non-active-number');
            four.addClass('non-active-number');
            five.addClass('non-active-number');
            break;

        case 1:
            one.removeClass('non-active-number');
            two.addClass('non-active-number');
            three.addClass('non-active-number');
            four.addClass('non-active-number');
            five.addClass('non-active-number');
            break;
    }
}

function showAllColours() {
    if (sessionStorage.colour === 'hidden') {
        $($('.neutral-button')).each(function () {
            $(this).addClass($(this).attr("data-colour"));
            sessionStorage.colour = 'revealed';
        })
    } else {
        $($('.neutral-button')).each(function () {
            $(this).removeClass($(this).attr("data-colour"));
            sessionStorage.colour = 'hidden';
        })
    }
}

function setSessionStorage(firstTeamColor) {

    sessionStorage.words_number = 0;
    sessionStorage.colour = 'hidden';

    if(sessionStorage.duet === 'true') {
        console.log(typeof(sessionStorage.duet));
        sessionStorage.green_cards = 8;
        sessionStorage.blue_cards = 8;
        if(firstTeamColor === 'blueteam') {
            sessionStorage.player = 'blue';
            sessionStorage.turn = 'blue';
        } else {
            sessionStorage.player = 'green';
            sessionStorage.turn = 'green';
        }
        return true;
    }
    if(firstTeamColor === 'blueteam') {
        sessionStorage.turn = 'blue';
        sessionStorage.green_cards = 8;
        sessionStorage.blue_cards = 9;
    } else {
        sessionStorage.turn = 'green';
        sessionStorage.green_cards = 9;
        sessionStorage.blue_cards = 8;
    }
    return true;
}

	
	
	
	
	
	
	
	