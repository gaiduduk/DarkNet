<?php

include_once "db.php";

query("DROP TABLE IF EXISTS `actions`;");
query("
CREATE TABLE IF NOT EXISTS `actions` (
`action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action_amount` double NOT NULL,
  `action_currency` varchar(5) COLLATE utf8_bin NOT NULL,
  `action_complete` int(11) NOT NULL,
  `action_datetime` int(11) NOT NULL,
  `user_sender` int(11) NOT NULL,
  `user_receiver` int(11) NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `users`;");
query("
CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_token` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");


insertRow("users", array(
    "user_id" => 1,
    "user_email" => "darkcoin.store2@gmail.com",
    "user_token" => "123",
));
insertRow("users", array(
    "user_id" => 2,
    "user_email" => "darkcoin.store2@gmail.com",
    "user_token" => 321,
));

insertRow("actions", array(
    "action_amount" => 123,
    "action_currency" => "RUB",
    "action_complete" => "0",
    "action_datetime" => time(),
    "user_sender" => 2,
    "user_receiver" => 1,
));