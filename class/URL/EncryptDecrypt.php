<?php 

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Encrypts/Decrypts a given URL string.
    Parameters: URL (Array), password (String)
    Returns: Array
*/

class EncryptDecrypt {

    private $URL;
    private $password;

    public function __construct($URL, $password) {
        $this->URL = $URL;
        $this->password = $password;
    } 

    public function encrypt() {
        $encryptionMethod = "AES-256-CBC";

        for ($i = 0; $i < count($this->URL); $i++)
            $encrypted[$i] = openssl_encrypt($this->URL[$i], $encryptionMethod, $this->password);

        return $encrypted;
    }

    public function decrypt() {
        $encryptionMethod = "AES-256-CBC";

        for ($i = 0; $i < count($this->URL); $i++)
            $decrypted[$i] = openssl_decrypt($this->URL[$i], $encryptionMethod, $this->password);

        return $decrypted;
    }
}