--
-- Seo Panel 3.7.0 changes
--

INSERT INTO `settings` (`set_label`, `set_name`, `set_val`, `set_category`, `set_type`, `display`) 
VALUES ('Maximum number of proxies used in single execution', 'CHECK_MAX_PROXY_COUNT_IF_FAILED', '3', 'proxy', 'small', '1');

UPDATE `settings` SET `set_category` = 'proxy' WHERE set_name='SP_ENABLE_PROXY';
UPDATE `settings` SET `set_category` = 'report' WHERE set_name='SP_CRAWL_DELAY';
UPDATE `settings` SET `set_category` = 'report' WHERE set_name='SP_USER_GEN_REPORT';



INSERT INTO texts(`lang_code`, `category`, `label`, `content`) VALUES ('en', 'settings', 'CHECK_MAX_PROXY_COUNT_IF_FAILED', 'Maximum number of proxies used in single execution');