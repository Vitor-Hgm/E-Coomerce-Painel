<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://<?=$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]?>">
    <title>Painel E-coomerce</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Summer Note -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

</head>
<body>
    <?php       
    
    if (($_POST) && (!isset($_SESSION["ecoomercepainel"])) && (!$_POST)) {

        require "../app/views/index/login.php";
    }else if ((!isset($_SESSION["ecoomercepainel"])) && ($_POST)) {

    }else {

    }

    ?>

    <main>
        <?php 

            echo $_GET["param"];

        ?>
    </main>
</body>
</html>