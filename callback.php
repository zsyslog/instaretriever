<?php

require_once('config.php');

if (isset($_REQUEST['code'])) {

    $code = $_REQUEST['code'];
    
    $url = "https://api.instagram.com/oauth/access_token"; 
    $access_token_parameters = array( 
            'client_id' => CLIENT_ID, 
            'client_secret' => CLIENT_SECRET, 
            'grant_type' => 'authorization_code', 
            'redirect_uri' => REDIRECT_URI, 
            'code'=> $code 
    ); 
    
    $curl = curl_init($url); 
    curl_setopt($curl,CURLOPT_POST,true); 
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $result = curl_exec($curl); 
    curl_close($curl); 
    
    $data = json_decode($result);
    ?>
    <h1>Instagram Retriever Example</h1>
    <h2>Parameters:</h2>
    <pre>
    <?php print_r($access_token_parameters); ?>
    </pre>
    <h2>Token response</h2>
    <pre>
    <?php print_r($data->access_token); ?>
    </pre>
    <?php
    $url = "https://api.instagram.com/v1/users/7419994/media/recent/?access_token=".$data->access_token;
    $response_json = file_get_contents($url);
    $insta_response = json_decode($response_json);
    ?>
    <h2>JSON encoded user data response</h2>
    <pre>
    <?php print_r($insta_response); ?>
    </pre>
<?php            
} else {
    header('location:http://instagr.am/');
}

?>