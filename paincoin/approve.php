<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/dark_net/mail.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/dark_net/telegram.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/paincoin/utils.php";

$request_id = get_int_required("request_id");

description("approve");

$promo = random_id();

$request = dataGet(["requests", $request_id], $admin_token);


$keys = dataGet(["store"], $admin_token, true, 0, 5);

foreach ($keys as $domain_name => $key)
    dataDelete(["store", $domain_name], $admin_token);

dataCreate(["promos"], $admin_token);
dataSet(["promos", $promo], $admin_token, $keys);

dataSet(["requests", $request_id, "promo"], $admin_token, $promo);

$promo_url = $host_name . "/paincoin/promo.php?promo=$promo";
$reg_url = $host_name . "/dark_wallet/reg.html?login=" . $request["email"] . "&promo_url=$promo_url";

//$response["mail_send"] = mailSend($request["email"], "Вы выиграли paincoun", "For get coins go to follow link: $promo_url");
$response["promo_url"] = $promo_url;
$response["promo_count"] = dataCount(["promos", $promo], $admin_token);

echo json_encode($response);
