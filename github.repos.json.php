<?php

$url = "https://api.github.com/users/thinkphp/repos?sort=created";
               
$output = get($url);

echo$output;

function get($url) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSLVERSION,3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
    $data = curl_exec($ch);
    curl_close($ch); 
    if(empty($data)) {return 'server timeout';}
                 else {return $data;}
}

?>