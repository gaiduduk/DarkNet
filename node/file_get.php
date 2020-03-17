<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/node/domain_utils.php";

$domain_name = get_required("domain_name");

$path = get("path");
$path = trim($path, "/");

if ($path == null) {
    $accept = getallheaders()["Accept"];
    if (strpos($accept, "text/html") !== false) {
        $path = "index.html";
    } else {
        die(domain_repo_get($domain_name));
    }
}

if ($path != null)
    $file = selectMap("select * from files where domain_name = '" . uencode($domain_name) . "' and file_path = '" . uencode($path) . "'");

if ($file != null) {
    header("Content-type: " . get_mime_type(basename($file["file_path"])));
    readfile($_SERVER["DOCUMENT_ROOT"] . "/node/files/" . $file["file_hash"]);
} /*else {
    header("Content-type: text/directory;application/json;charset=utf-8");
    $result = array();
    $children = select("select * from files where server_group_id = " . $domain["server_group_id"]
        . " and file_level = " . (substr_count($path, "/") + 1)
        . " and file_path like '" . uencode($path) . "%'");
    foreach ($children as $child)
        $result[] = array(
            "path" => $child["file_path"],
            "size" => $child["file_size"],
        );
    usort($result, function ($a, $b) {
        if ($a["size"] == 0 && $b["size"] != 0) return -1;
        if ($a["size"] != 0 && $b["size"] == 0) return 1;
        return strcmp($a["path"], $b["path"]);
    });
    echo json_encode($result);
}*/
