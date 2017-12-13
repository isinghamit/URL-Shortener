<?php 
    /* 
        Name: TacoCF 
        Author: Oskar
        File Changed: 21/11/2017 
    */

    include("class/URL/GetTargetURL.php");

    if (isset($_GET["url"]) && $_GET["url"] !== null)
        $PID = $_GET["url"];

    // Gets the target url
    $getTargetURL = new GetTargetURL($PID, "");
    $response = $getTargetURL->get();

    // If a target linked to the PID has been found...
    if ($response[0] != "") {
        if ($response[1] == null) 
            header("Location: {$response[0]}");
        else {
            if (isset($_POST["skip"])) 
                header("Location: {$response[0]}");
        }
    } else 
        header("Location: encrypted.php?url={$PID}");



?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Oskar">
        <meta name="description" content="A simple URL shortener.">
        <meta name="page-topic" content="Computer">
        <meta name="page-type" content="URL Shortener">
        <meta http-equiv="content-language" content="en">
        <meta name="robots" content="index, follow">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>TacoCF</title>

        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="img/icon.png" type="image/png">
    </head>
    
    <body>
        <div class="adsys-banner">
            <img class="adsys-taco" src="img/taco.gif" alt="">
            <form action="" method="POST">
                <input type="submit" name="skip" class="adsys-skip" value="Skip">
            </form>
        </div>
        <iframe class="adsys-iframe" src="<?php echo $response[1] ?>"></iframe>
    </body>
</html>


    