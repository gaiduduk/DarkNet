<?php

include_once "login.php";

$result = array();

echo json_encode(array(
    "coins" => selectList("select coin_code from coins"),
    "have_coins" => select("select coin_code, count(*) as coin_count from domain_keys "
        . " where user_id = $user_id group by coin_code"),
));