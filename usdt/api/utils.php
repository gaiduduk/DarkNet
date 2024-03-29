<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/wallet/api/utils.php";

const PROVIDERS = [
    "BSC" => [
        title => "BSC BEP-20",
        contract => '0x55d398326f99059ff775485246999027b3197955',
        comisiion => 1,
        deposit_addresses => [
            "0x1e0426Ba2E77eDdf7FfB19C57B992c4dcC6455F4",
        ],
        interval_sec => 60 * 5,
    ],
    "TRON" => [
        title => "Tron TRC-20",
        contract => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
        comisiion => 2,
        deposit_addresses => [
            "TPWZ6TNgYBCh18Bf4EVfKesoHHRJ4w8SgT",
            "TSXvWWCsysLQoPujPCEbYQySXP66ZvN57b",
        ],
        interval_sec => 60 * 5,
    ],
];

