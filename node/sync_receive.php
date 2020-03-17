<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/node/domain_utils.php";

$domains = get("domains");
$servers = get("servers");

if ($domains == null)
    error("domains are null");

//set domains
$success_domains = [];
foreach ($domains as $domain) {
    if (domain_set($domain["domain_name"], $domain["domain_prev_key"], $domain["domain_key_hash"], $domain["server_repo_hash"]) !== false)
        $success_domains[] = $domain["domain_name"];
}

//set servers
foreach ($servers as $server) {
    if ($server["server_host_name"] != $host_name && in_array($server["domain_name"], $success_domains)) {
        if (scalar("select count(*) from servers "
                . " where domain_name = '" . uencode($server["domain_name"]) . "' "
                . " and server_host_name = '" . uencode($server["server_host_name"]) . "'") == 0) {
            insertList("servers", array(
                "domain_name" => $server["domain_name"],
                "server_repo_hash" => $server["server_repo_hash"],
                "server_host_name" => $server["server_host_name"],
                "server_set_time" => time(),
            ));
        } else if ($server["server_repo_hash"] != null) {
            update("update servers set server_repo_hash = '" . uencode($server["server_repo_hash"]) . "' "
                . " where domain_name = '" . uencode($server["domain_name"]) . "' "
                . " and server_host_name = '" . uencode($server["server_host_name"]) . "'");
        }
    }
}

//download last version
foreach ($success_domains as $domain_name) {

    $active_server_repo_hash = domain_get($domain_name)["server_repo_hash"];

    $self_server_repo_hash = scalar("select server_repo_hash from servers "
        . " where domain_name = '" . uencode($domain_name) . "' "
        . " and server_host_name = '" . uencode($host_name) . "'");

    if ($self_server_repo_hash != $active_server_repo_hash) {
        $server_host_name = scalar("select server_host_name from servers "
            . " where domain_name = '" . uencode($domain_name) . "' "
            . " and server_repo_hash = '" . uencode($active_server_repo_hash) . "' limit 1");

        $repo_string = http_post($server_host_name . "/node/file_get.php", array(
            "domain_name" => $domain["domain_name"],
        ));

        domain_repo_set($domain_name, $repo_string);
    }
}
