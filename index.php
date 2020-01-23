<?php
require_once __DIR__.'/Controllers/Painter.php';


if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if (isset($_POST['data']['function']))
{
    $img = imagecreatetruecolor(400, 400);
    $pointer = new Painter();
    $function = $_POST['data']['function'];

    $img = $pointer->$function($img, $_POST['data']);

    ob_start();
    imagepng($img);
    $imgData=ob_get_clean();
    imagedestroy($img);

    echo '<img src="data:image/png;base64,'.base64_encode($imgData).'" />';
//        echo $imgData;
    die;
}

unset($_SESSION['lines']);

function draw()
{
    $img = imagecreatetruecolor(400, 400);

    ob_start();
    imagepng($img);
    $imgData=ob_get_clean();
    imagedestroy($img);

    return $imgData;


}

?>

<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Grafika</title>
    <meta name="description" content="O czym">
    <meta name="keywords" content="slowa kluczowe">
    <meta name="author" content="Jan Kowalski">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script src="js/myJs.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>

    <div  class="card-img-overlay container-fluid bg-secondary pt-5">
        <div class="row col-md-10 offset-md-1">

            <div class="col-5 p-0">
                <div id="lineSettings" class="border shadow p-2" >
                    <h5>Linia</h5><br>
                    <form class="col-12" method="post" action="">
                        <div class="row mr-0">
                            <label for="line_x1" class="ml-1 mr-1" >POCZĄTEK: x1: </label>
                            <input type="number" id="line_x1" name="line_x1" value="" placeholder="np. 50" style="width: 70px"> px
                            <label for="line_y1" class="ml-3 mr-1">y1: </label>
                            <input type="number" id="line_y1"  name="line_y1" value="" placeholder="np. 50" style="width: 70px"> px
                        </div><br>
                        <div class="row mr-0">
                            <label for="line_x2" class="mx-1" >KONIEC: x2: </label>
                            <input type="number" id="line_x1" name="line_x2" value="" placeholder="np. 100" style="width: 70px">
                            <label for="line_y2" class="mx-1">y2: </label>
                            <input type="number" id="line_y1"  name="line_y2" value="" placeholder="np. 100" style="width: 70px">
                        </div><br>
                        <label for="colorLine">KOLOR: </label>
                        <select class=" col-4" name="color" id="colorLine">
                            <option>Red</option>
                            <option>Green</option>
                            <option>Blue</option>
                        </select><br>
                        <button id="drawLine" class="btn btn-light col-4">Rysuj</button>
                    </form>
                </div>
            </div>
            <div class="col-6 offset-1 ">
                <div id="fieldToDraw" class="w-100 h-100" >
                    <?php echo '<img src="data:image/png;base64,'.base64_encode(draw()).'" />'; ?>
                </div>
                <button id="clearFieldButton" class="btn btn-light col-5 mt-1 text-center">Wyczyść pole</button>
            </div>
        </div>

    </div>

</body>

