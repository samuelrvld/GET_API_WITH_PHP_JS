<?php
$url = 'https://api.coindesk.com/v1/bpi/currentprice.json';
$response =file_get_contents($url);


if($response === FALSE) {
    die('Datanya ga ada COKKK !!!');
}

$data = json_decode($response, true);
print_r($data);

?>

