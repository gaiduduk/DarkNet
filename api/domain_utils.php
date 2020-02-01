<?php

include_once "../db.php";

function receive_domain_keys($user_id, $have_coin_code, $domain_keys){
    $success_domain_names = [];

    /*foreach ($domain_keys as $domain_key) {
        $domain_name = uencode($domain_key["domain_name"]);
        $domain_next_name = $domain_key["domain_next_name"];
        $domain_next_hash = hash("sha256", $domain_next_name);
        $domain = selectMap("select * from domains where domain_name = '$domain_name'");
        if ($domain != null && $domain["domain_next_hash"] == $domain_next_hash) {
            $domain_next_name = random_id();
            $domain_next_hash = hash("sha256", $domain_next_name);
            updateList("domains", array(
                "domain_next_hash" => $domain_next_hash,
                "domain_prev_name" => $domain_next_name,
            ), "domain_name", $domain_name);
            $success_domain_names[$domain_name] = $domain_next_name;
        }
    }*/

    /*$node_locations = selectList("select distinct node_location from domains where node_location <> '$node_url' limit 5") ?: $start_node_locations;
    foreach ($node_locations as $node_location) {
        $domain_list = select("select * from domains where domain_name in ('" . implode("','", $success_domain_names) . "') ");
        http_json_post($node_location, array("domains" => $domain_list));
    }*/

    foreach ($domain_keys as $domain_key) {
        insertList("domain_keys", array(
            "user_id" => $user_id,
            "coin_code" => $have_coin_code,
            "domain_name" => $domain_key["domain_name"],
            "domain_next_name" => $domain_key["domain_next_name"],
        ));
    }
    return $success_domain_names;
}


function getDomainKeys($user_id, $have_coin_code, $have_coin_count)
{
    $where = "where user_id = $user_id and coin_code = '$have_coin_code' limit $have_coin_count";
    $domain_keys = select("select domain_name, domain_next_name from domain_keys $where");
    query("delete from domain_keys $where");
    return $domain_keys;
}