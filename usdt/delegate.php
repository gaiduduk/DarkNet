<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/data/api/utils.php";

$address = get_required(address);
$password = get_required(password);
$script = get_required(script);

$response[success] = dataWalletDelegate([usdt, wallet], $address, $password, $script);

commit($response);