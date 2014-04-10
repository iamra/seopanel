--
-- Seo Panel 3.5.0 changes
--
UPDATE `searchengines` SET `regex` = '<li.*?<h3><a.*?RU=(.*?)\\/.*?>(.*?)<\\/a><\\/h3>.*?<div.*?>(.*?)<\\/div>' WHERE url like '%yahoo%';

--
-- Table structure for table `crawl_log`
--

CREATE TABLE IF NOT EXISTS `crawl_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `crawl_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'other',
  `ref_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `crawl_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crawl_referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crawl_cookie` text COLLATE utf8_unicode_ci NOT NULL,
  `crawl_post_fields` text COLLATE utf8_unicode_ci NOT NULL,
  `crawl_useragent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crawl_status` tinyint(4) NOT NULL DEFAULT '1',
  `proxy_id` int(11) unsigned NOT NULL,
  `log_message` text COLLATE utf8_unicode_ci NOT NULL,
  `crawl_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `crawl_status` (`crawl_status`),
  KEY `crawl_type` (`crawl_type`),
  KEY `ref_id` (`ref_id`),
  KEY `proxy_id` (`proxy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

---
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'panel', 'Log Manager', 'Log Manager');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'panel', 'Crawl Log Manager', 'Crawl Log Manager');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Success', 'Success');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Fail', 'Fail');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Reference', 'Reference');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Subject', 'Subject');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Cookie', 'Cookie');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'User agent', 'User agent');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'label', 'Referer', 'Referer');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'log', 'Clear All Logs', 'Clear All Logs');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'log', 'Crawl Log Details', 'Crawl Log Details');
INSERT INTO `texts` (`lang_code`, `category`, `label`, `content`) VALUES ('en', 'log', 'Post Fields', 'Post Fields');