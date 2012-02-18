ALTER TABLE `backlinkresults` DROP `yahoo`, DROP `altavista`, DROP `alltheweb`;
ALTER TABLE `backlinkresults` ADD `alexa` INT( 11 ) NOT NULL AFTER `msn`;
ALTER TABLE `auditorreports` DROP `yahoo_backlinks`, DROP `yahoo_indexed`;
ALTER TABLE `saturationresults` DROP `yahoo`;

UPDATE searchengines SET regex= '<li.*?class="?g.*?<a.*?href="\\/url\\?q=(.*?)&amp;sa=U.*?>(.*?)<\\/a>.*?<div.*?>(.*?)<cite>' WHERE url LIKE '%google%';

INSERT INTO texts(`id`, `lang_code`, `category`, `label`, `content`, `changed`) VALUES (NULL, 'en', 'plugin', 'Download Seo Panel Plugins', 'Download Seo Panel Plugins', CURRENT_TIMESTAMP);
INSERT INTO texts(`id`, `lang_code`, `category`, `label`, `content`, `changed`) VALUES (NULL, 'en', 'settings', 'getallpluginfree', 'Also get all <b>plugins</b> we develop for <b>Free!</b>', CURRENT_TIMESTAMP);