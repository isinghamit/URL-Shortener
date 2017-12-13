<?php 

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Checks if a given password is acceptable.
    Parameters: password (String)
    Returns: Boolean
*/

class CheckPassword {
    
    private $password;

    public function __construct($password) {
        $this->password = $password;
    }

    public function check() {
        if (isset($this->password) && $this->password != "" && strlen($this->password) <= 128) 
            return true;
    }
}