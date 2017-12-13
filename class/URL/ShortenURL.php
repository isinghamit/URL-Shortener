<?php 

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Shortens a given URL and assignes a PID to it.
    Parameters: longURL (String), iframeURL (String), password (String)
    Returns: String
*/

include_once("EncryptDecrypt.php");
include_once("../util/CheckURL.php");
include_once("../util/CheckPassword.php");

class ShortenURL {

    private $longURL;
    private $iframeURL;
    private $PID;
    private $password;

    public function __construct($longURL, $iframeURL, $password) {
        $this->longURL = $longURL;
        $this->iframeURL = $iframeURL;
        $this->password = $password;
    }

    public function shorten() {
        $URLs = json_decode(file_get_contents("json/urls.json"), true);

        if ($this->password == null)
            $this->password = "";

        $checkURL = new CheckURL([$this->longURL, $this->iframeURL]);
        $response = $checkURL->check();

        if ($response[0]) {
            do {
                $PID = substr(sha1(microtime()), 0, 9);
            } while (isset($URLs[$PID]));
    
            $encryptDecrypt = new EncryptDecrypt([$this->longURL, $this->iframeURL], $this->password);
            $response = $encryptDecrypt->encrypt();
    
            $URLs[$PID]["target_url"] = $response[0];
            $URLs[$PID]["iframe_url"] = $response[1];
            
            file_put_contents("json/urls.json", json_encode($URLs));
    
            return "https://" . $_SERVER['HTTP_HOST'] . "/{$PID}"; 

        }
    } 
}