UPDATE searchengines SET regex= '<li.*?class="?g.*?<a.*?href="\\/url\\?q=(.*?)&amp;sa=U.*?>(.*?)<\\/a>.*?<div.*?>(.*?)<cite>' WHERE url LIKE '%google%';

INSERT INTO texts(`id`, `lang_code`, `category`, `label`, `content`, `changed`) VALUES (NULL, 'en', 'plugin', 'Download Seo Panel Plugins', 'Download Seo Panel Plugins', CURRENT_TIMESTAMP);