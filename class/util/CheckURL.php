<?php

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Checks if a given url is acceptable.
    Parameters: URL (Array)
    Returns: Array
*/


class CheckURL {

    private $URL;

    public function __construct($URL) {
        $this->URL = $URL;
    }

    public function check() {
        for ($i = 0; $i < count($this->URL); $i++) {
            if (isset($this->URL[$i]) && $this->URL[$i] != "" && strlen($this->URL[$i]) <= 512 && filter_var($this->URL[$i], FILTER_VALIDATE_URL)) 
                $response[$i] = true;
            else 
                $response[$i] = false;

        }

        return $response;
    }
}