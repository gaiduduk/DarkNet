<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/usdt/api/utils.php";

$addresses = dataHistory([usdt, withdrawal_chain]);
$addresses = array_unique($addresses);

$response[result] = [];

foreach ($addresses as $address) {
    $ids = dataHistory([usdt, withdrawal, $address, chain]);
    foreach ($ids as $id) {
        if (dataGet([usdt, withdrawal, $address, $id, success]) == null) {
            $response[result][] = [
                address => $address,
                withdrawal_address => dataGet([usdt, withdrawal, $address, $id, withdrawal_address]),
                amount => dataGet([usdt, withdrawal, $address, $id, amount]),
                chain => dataGet([usdt, withdrawal, $address, $id, chain]),
                time => dataInfo([usdt, withdrawal, $address, $id, chain])[data_time],
                withdrawal_id => $id,
            ];
        }
    }
}

commit($response);