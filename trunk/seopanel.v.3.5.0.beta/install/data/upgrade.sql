--
-- Seo Panel 3.5.0 changes
--
UPDATE `searchengines` SET `regex` = '<li.*?<h3><a.*?RU=(.*?)\\/.*?>(.*?)<\\/a><\\/h3>.*?<div.*?>(.*?)<\\/div>' WHERE url like '%yahoo%';
