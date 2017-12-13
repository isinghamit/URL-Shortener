<?php 
    /* 
        Name: TacoCF 
        Author: Oskar
        File Changed: 21/11/2017 
    */


    include("class/util/CheckURL.php");
    include("class/URL/GetTargetURL.php");

    $PID = $_GET["url"];

    if (isset($_POST["decrypt"])) {
        if (isset($_POST["password"]))
            $password = $_POST["password"];
          
        // checks if the given password meets all requirements.
        $getTargetURL = new GetTargetURL($PID, $password);
        $targetURL = $getTargetURL->get();

        // Checks if the given URL meets the requirements after decrypting it with the given password.
        $checkURL = new CheckURL([$targetURL[0]]);
        $checkResponse = $checkURL->check();

        if ($checkResponse[0]) 
            header("Location: {$targetURL[0]}");
    }

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
		<div class="taco" align="center">
			<img src="img/taco.gif" alt = "">
		</div>
		
        <div class="form-style-6">
            <h1>This URL seems to be encrypted!</h1>
            <form action="" method="POST">
                <input type="password" name="password" autocomplete="off" placeholder="Password">
                <input name="decrypt" style="width:100%" type="submit" value="Decrypt">
            </form>
        </div>
    </body>
</html>

