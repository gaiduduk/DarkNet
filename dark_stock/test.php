<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/dark_wallet/test.php";

$user1_token = requestNotEquals("localhost/dark_stock/reg.php",
    array("login" => "user1", "password" => "123",), "token", null)["token"];
$user2_token = requestNotEquals("localhost/dark_stock/reg.php",
    array("login" => "user2", "password" => "123",), "token", null)["token"];


requestEquals("localhost/dark_stock/income.php",
    array("login" => "user1", "domain_name" => "PAIN", "count" => 3000), "added", 3000);
requestEquals("localhost/dark_stock/income.php",
    array("login" => "user2", "domain_name" => "HRP", "count" => 2), "added", 2);


requestEquals("localhost/dark_stock/account.php",
    array("token" => $user1_token), "account.PAIN", 3000);
requestEquals("localhost/dark_stock/account.php",
    array("token" => $user2_token), "account.HRP", 2);



$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 1000, "want_count" => 1), "push_request", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 1000, "want_count" => 3), "push_request", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 1000, "want_count" => 2), "push_request", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user2_token, "give" => "HRP", "want" => "PAIN", "give_count" => 2, "want_count" => 1000), "satisfied", 2);

requestEquals("localhost/dark_stock/account.php",
    array("token" => $user1_token), "account.PAIN", 1500);
requestEquals("localhost/dark_stock/account.php",
    array("token" => $user1_token), "account.HRP", 2);
requestEquals("localhost/dark_stock/account.php",
    array("token" => $user2_token), "account.PAIN", 1500);
requestEquals("localhost/dark_stock/account.php",
    array("token" => $user2_token), "account.HRP", 0);


/*$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 1, "want_count" => 1000), "limit", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 3, "want_count" => 1000), "limit", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "PAIN", "want" => "HRP", "give_count" => 2, "want_count" => 1000), "limit", true);
$result = requestEquals("localhost/dark_stock/limit.php",
    array("token" => $user1_token, "give" => "HRP", "want" => "PAIN", "give_count" => 500, "want_count" => 1), "limit", false);*/

echo json_encode($result);

/*requestEquals("localhost/dark_stock/requests.php",
    array(
        "give" => "HRP",
        "want" => "PAIN"
    ), "limit", true);



$hrp_received = requestNotEquals("localhost/dark_stock/output.php",
    array(
        "token" => $user1_token,
        "domain_name" => "HRP",
        "output_count" => 1000,
    ), "keys", null);


requestEquals("localhost/dark_wallet/save.php",
    array(
        "token" => $user1_token,
        "domain_name" => "HRP",
        "keys" => $hrp_received,
    ), "added", 1000);*/


