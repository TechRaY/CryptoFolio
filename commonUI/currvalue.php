

<?php

$content =     file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR");
$result  = json_decode($content);

echo JSON.stringify($result);


?>