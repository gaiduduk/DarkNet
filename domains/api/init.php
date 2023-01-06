<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/db/db.php";

// TODO test user pass

query("DROP TABLE IF EXISTS `files`;");
query("CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prev_key` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `key_hash` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `archived` int(1) DEFAULT 0,
  `data_hash` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `updated` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
/*
query("DROP TABLE IF EXISTS `limits`;");
query("CREATE TABLE IF NOT EXISTS `limits` (
`file_id` int(11) DEFAULT NULL,
`domain_postfix_length` varchar(64) COLLATE utf8_bin NOT NULL,
`hosting_expire_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
*/
