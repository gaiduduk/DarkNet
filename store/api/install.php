<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/wallet/api/utils.php";

$domain = get_required(domain);
$app_domain = get_required(app_domain);

upload($domain, $app_domain, "/store/apps/$app_domain.zip");

$response[success] = true;
commit($response);
