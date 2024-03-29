<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/db/db.php";

query("DROP TABLE IF EXISTS `users`;");
query("CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `token` varchar(128) COLLATE utf8_bin NOT NULL,
    `inviter` int(11) NULL,
    `drop_id` int(11) NULL,
    `referrer_code` varchar(15) COLLATE utf8_bin NULL,
    `email` varchar(128) COLLATE utf8_bin NULL,
    `email_confirmed` int(11) NOT NULL DEFAULT -1,
    `email_confirm_code` int(11) NULL,
    PRIMARY KEY (`user_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `balances`;");
query("CREATE TABLE IF NOT EXISTS `balances` (
    `user_id` int(11) NOT NULL,
    `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
    `spot` double NOT NULL,
    `blocked` double NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `coins`;");
query("CREATE TABLE IF NOT EXISTS `coins` (
  `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `type` varchar(25) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NOT NULL,
  `created` int(11) NOT NULL,
  `supply` double NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `change24` double NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `ieo_user_id` int(11) NOT NULL,
  `staking_user_id` int(11) NOT NULL,
  `staking_apy` int(11) NOT NULL,
  `drop_user_id` int(11) NOT NULL,
  `last_trade_timestamp` int(11) NOT NULL DEFAULT 0,
  `domain_id` int(11) NOT NULL,
  `domain` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ticker`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `orders`;");
query("CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_sell` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `filled` double DEFAULT 0,
  `timestamp` int(11) NOT NULL,
   PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `candles`;");
query("CREATE TABLE IF NOT EXISTS `candles` (
    `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
    `period` int(11) NOT NULL,
    `time` int(11) NOT NULL,
    `open` double NOT NULL,
    `close` double NOT NULL,
    `high` double NOT NULL,
    `low` double NOT NULL,
    `volume` double NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `trades`;");
query("CREATE TABLE IF NOT EXISTS `trades` (
    `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
    `time` int(11) NOT NULL,
    `maker` int(11) NOT NULL,
    `taker` int(11) NOT NULL,
    `is_sell` int(11) NOT NULL,
    `price` double NOT NULL,
    `amount` double NOT NULL,
    `total` double NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `transfers`;");
query("CREATE TABLE IF NOT EXISTS `transfers` (
    `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(16) COLLATE utf8_bin NULL,
    `parameter` int(11) NULL,
    `from_user_id` int(11) NOT NULL,
    `to_user_id` int(11) NOT NULL,
    `ticker` varchar(10) COLLATE utf8_bin NOT NULL,
    `status` int(11) DEFAULT 1,
    `amount` int(11) NOT NULL,
    `time` int(11) NOT NULL,
   PRIMARY KEY (`transfer_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `drops`;");
query("CREATE TABLE IF NOT EXISTS `drops` (
    `drop_id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(16) COLLATE utf8_bin NULL,
    `ticker` varchar(16) COLLATE utf8_bin NULL,
    `total` int(11) NOT NULL,
    `rewarded` int(11) DEFAULT 0,
    `reward` int(11) NOT NULL,
   PRIMARY KEY (`drop_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `tracker`;");
query("CREATE TABLE IF NOT EXISTS `tracker` (
    `track_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `event_name` varchar(24) COLLATE utf8_bin NOT NULL,
    `time` BIGINT NOT NULL,
    `par1` varchar(64) COLLATE utf8_bin NULL,
    `par2` varchar(64) COLLATE utf8_bin NULL,
    `par3` varchar(64) COLLATE utf8_bin NULL,
    `par4` varchar(64) COLLATE utf8_bin NULL,
    `par5` varchar(64) COLLATE utf8_bin NULL,
   PRIMARY KEY (`track_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `tokens`;");
query("CREATE TABLE IF NOT EXISTS `tokens` (
    `domain_id` int(11) NOT NULL,
    `index` int(11) NOT NULL,
    `prev_key` varchar(128) COLLATE utf8_bin DEFAULT NULL,
    `key_hash` varchar(64) COLLATE utf8_bin DEFAULT NULL,
    `archived` int(1) DEFAULT 0,
    `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");

query("DROP TABLE IF EXISTS `keys`;");
query("CREATE TABLE IF NOT EXISTS `keys` (
    `key_id` int(11) NOT NULL AUTO_INCREMENT,
    `domain_id` int(11) NOT NULL,
    `index` int(11) NOT NULL,
    `key` varchar(128) COLLATE utf8_bin NOT NULL,
    `archived` int(1) DEFAULT 0,
   PRIMARY KEY (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
