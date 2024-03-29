<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/stock0/auth.php";

$dialog_id = get_required("dialog_id");
$text = get_required("text");
$domain_name = get("domain_name");
$count = get("count");

description(basename(__FILE__));

$opponent = pairOpponent($dialog_id, $login);

if ($opponent == null) error("opponent not found");

$unread_messages = dataGet(["users", $login, "dialogs", $dialog_id], $pass);
if ($unread_messages != null) dataDelete(["users", $login, "dialogs", $dialog_id], $pass);
dataSet(["users", $login, "dialogs", $dialog_id], $pass, $unread_messages + 1);

$unread_messages = dataGet(["users", $opponent, "dialogs", $dialog_id], $pass);
if ($unread_messages != null) dataDelete(["users", $opponent, "dialogs", $dialog_id], $pass);
dataSet(["users", $opponent, "dialogs", $dialog_id], $pass, $unread_messages + 1);

$response["success"] = dataAdd(["dialogs", $dialog_id, "messages"], array(
    "login" => $login,
    "text" => $text,
    "domain_name" => $domain_name,
    "count" => $count,
    "time" => time(),
)) ? true : false;

if ($response["success"] == false) error("message add error");

echo json_encode($response);