<?php

?>
<style>

    html { overflow:  hidden; }
    body::before {
        content: '';
        position: fixed;
        left: 0; right: 0;
        top: 0; bottom: 0;
        z-index: -1;
        background: url('/web/images/gory-sneg-dom.jpg') center / cover no-repeat;
        filter: opacity(25%);
    }

    body.stop-scrolling {
        overflow: hidden;
    }
</style>

<link href="/stylesheets/style2.css" rel="stylesheet" />
<link href="../../web/css/style.css" rel="stylesheet" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

<span class = "btn btn-blue"></span>

<button id = "newGame" class = "new-game">Новая игра</button>
<button id = "duet" class = "new-duet-game">Игра Дуэт</button>
<button id = "rules" class = "rules">Правила</button>
<p id="team-name"></p>

<p id="1" class="guess-number" hidden = "hidden">1</p>
<p id="2" class="guess-number" hidden = "hidden">2</p>
<p id="3" class="guess-number" hidden = "hidden">3</p>
<p id="4" class="guess-number" hidden = "hidden">4</p>
<p id="5" class="guess-number" hidden = "hidden">5</p>

<span id='myDynamicTable'></span>
<span id='myForm'></span>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>

<script> <?php require(__DIR__.'/../../web/js/JSonly.js')?> </script>





