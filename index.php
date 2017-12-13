<?php
    /* 
        Name: TacoCF 
        Author: Oskar
        File Changed: 21/11/2017 
    */

    include("class/URL/ShortenURL.php");
    include("class/util/CheckURL.php");
    include("class/util/CheckPassword.php");
    include("class/ReCaptcha.php");

    if (isset($_POST["shorten"])) {
        // ReCaptcha related. See Recaptcha.php
        $secretKey = "";
        $client = $_POST["g-recaptcha-response"];

        $reCaptcha = new ReCaptcha($secretKey, $client);

        $response = $reCaptcha->postCaptcha();
    }

    // If Captcha was solved successfully
    if ($response["success"]) {

        // Checks if the given URL meets all requirements
        $checkURL = new CheckURL([$_POST["long_url"]]);
        $response = $checkURL->check();

        if ($response[0]) {
            $longURL = $_POST["long_url"];

            if (isset($_POST["password"])) 
                $password = $_POST["password"];

            if (isset($_POST["iframe_url"]))
                $iframeURL = $_POST["iframe_url"];

            // Shortens the given TargetURL and IframeURL
            $shortenURL = new ShortenURL($longURL, $iframeURL, $password);
            $shortenedURL = $shortenURL->shorten();
        } 
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
            <h1>TacoCF</h1>
            <form action="" method="POST">
                <input type="url" name="long_url" autocomplete="off" placeholder="Long URL">
                <div id="trigger" style="display:none">
                    <input type="url" name="iframe_url" autocomplete="off" placeholder="IFrame URL (optional)">
                    <input type="password" name="password" placeholder="Password (optional)">
                </div>
                <input type="url" name="shortened_url" autocomplete="off" placeholder="Tacofied URL" onClick="this.select();" readonly value="<?php echo $shortenedURL ?>">
                <div align="center" class="g-recaptcha" data-sitekey=""></div> 
                
                <input class="button-shorten" name="shorten" type="submit" value="Shorten">
                <input class="button-advanced" id="showhide" name="shorten" type="button" value="+">
            </form>
        </div>
    </body>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#showhide").click(function(){
                $("#trigger").toggle();
            });
        });
    </script>
</html>