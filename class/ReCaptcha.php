<?php 

/* 
    Name: TacoCF 
    Author: Oskar
    File Changed: 21/11/2017 

    Description: Custom ReCaptcha Integration.
    Parameters: secretKey (String), userResponse (String)
    Returns: JSON Object
*/


class ReCaptcha {

    private $secretKey;
    private $userResponse;
    
    public function __construct($secretKey, $userResponse) {
        $this->secretKey = $secretKey;
        $this->userResponse = $userResponse;
    }


    public function postCaptcha() {
        $fieldsString = '';
        $fields = array(
            'secret' => $this->secretKey, 
            'response' => $this->userResponse
        );

        foreach($fields as $key=>$value)
        $fieldsString .= $key . '=' . $value . '&';
        $fieldsString = rtrim($fieldsString, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}