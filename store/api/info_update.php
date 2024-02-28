<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/wallet/api/utils.php";

$domain = get_required(domain);
$password = get_required(password);
$next_hash = get_required(next_hash);
$title = get_required(title);
$description = get_required(description);
$category = get_required(category);
$gas_address = get_required(gas_address);

dataSet([store, info, $domain], [
    title => $title,
    logo => "/store/img/screenshot2.png",
    preview => "/store/img/screenshot1.png",
    owner => $gas_address,
    description => $description,
    category => $category,
]);

/*$dir = $_SERVER["DOCUMENT_ROOT"];
foreach (scandir($dir) as $key => $value) {
    if ($value[0] != "." && is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
        $response[result][] = [
            domain => $value,
            hash => dataGet([$value, hash]),
            next_hash => dataGet([$value, next_hash]),
        ];
    }
}*/


$response[success] = true;
commit($response);