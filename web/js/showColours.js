<script>
    function showColours(id) {

		if(typeof tableExists === 'undefined' || tableExists === "0") {
        $.ajax({
            url: '/web/game-mode/show',
            type: 'POST',
            data: {id: id},
            success: function (result) {
                let gameAllCards = JSON.parse(result)

                function addTable() {
                    var myTableDiv = document.getElementById("myDynamicTable");
					myTableDiv.className = 'lower';
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
                            button.className = gameOneCard.colour;
                            td.appendChild(button)
                        })
                    }
                    myTableDiv.appendChild(table);
                }
                addTable();
				tableExists = "1";
            }
        })
		} else {
		   $("#table_id").remove();
		tableExists = "0";

		}
	}     public function actionShow()
    {
       if (isset($_POST['id'])) {
           $game_cards = GameCard::find()->all();
           $i = 0;
           foreach ($game_cards as $game_card) {

               $result[$i]['card_value'] = $game_card->getWord();
               $result[$i]['colour'] = $game_card->getColour($game_card->getCardId());
               $i++;
           }

           return json_encode($result,JSON_UNESCAPED_UNICODE);
       }
        return $result[] = "Ajax failed";
    }
</script>