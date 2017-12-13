<?php

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Gets the URLs linked to a PID.
    Parameters: PID (String), password (String)
    Returns: String
*/

include_once("EncryptDecrypt.php");

class GetTargetURL {

    private $PID;
    private $password;

    public function __construct($PID, $password) {
        $this->PID = $PID;
        $this->password = $password;
    }

    public function get() {

        $URLs = json_decode(file_get_contents("json/urls.json"), true);

        $targetURL = $URLs[$this->PID]["target_url"];
        $iframeURL = $URLs[$this->PID]["iframe_url"];

        $encryptDecrypt = new EncryptDecrypt([$targetURL, $iframeURL], $this->password);
        $response = $encryptDecrypt->decrypt();

        return $response;
    }
}