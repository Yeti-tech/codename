
<style>
    body {
        background-image: url('/web/images/gory-sneg-dom.jpg'); /* Путь к фоновому изображению */
        background-color: #c7b39b; /* Цвет фона */
    }

    .my-swal-red {
        color: greenyellow;
        font-size: x-large;
        font-weight: 900;
        backdrop-filter: blur(2px);
    }

    .my-swal-blue {
        color: #00ffff;
        font-size: x-large;
        font-weight: 900;
        backdrop-filter: blur(2px);
    }

    .white {
        color: white;
        font-size: x-large;
        font-weight: 700;

    }
    .title-red {
        color: greenyellow;
    }

    .title-blue {
        color: #00ffff;
    }

    .swal2-validation-message::before {
        visibility: hidden;
    }

    .swal2-inputerror {
        border-color: #0b2e13 !important;
    }

    .swal2-title{
        background-color: transparent;
    }
    .swal2-modal{
        background-color: transparent;
    }
    .swal2-image{
        border-radius: 10px;
        border: 3px solid #fff;
    }


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>

<?php require_once("E:\OSPanel\domains\codename\web\js\callTeams.js")?>
