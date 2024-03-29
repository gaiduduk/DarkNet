<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/stock0/auth.php";

$promo_code = get_required("promo_code");

description(basename(__FILE__));
$promo = dataGet(["promos", $promo_code], $pass);
if ($promo == null) error("promo dont exist");


$success = dataDelete(["users", $login, "promos", $promo["domain_name"], $promo_code], $pass);
if ($promo == null) error("delete is not success");

$_GET["domain_name"] = $promo["domain_name"];

dataDelete(["promos", $promo_code], $pass);

include_once "promos.php";