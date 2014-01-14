INSERT INTO `settings` (`set_label`, `set_name`, `set_val`, `set_category`, `set_type`, `display`) 
VALUES ('Enable HTTP Proxy Tunnel', 'CURLOPT_HTTPPROXYTUNNEL_VAL', '1', 'proxy', 'bool', '1');

INSERT INTO `settings` (`set_label`, `set_name`, `set_val`, `set_category`, `set_type`, `display`) 
VALUES ('Deactivate Proxy When Crawling Failed', 'PROXY_DEACTIVATE_CRAWL', '0', 'proxy', 'bool', '1');

INSERT INTO `settings` (`set_label`, `set_name`, `set_val`, `set_category`, `set_type`, `display`) 
VALUES ('Check With Another Proxy When Crawling Failed', 'CHECK_WITH_ANOTHER_PROXY_IF_FAILED', '0', 'proxy', 'bool', '1');

INSERT INTO `settings` (`set_label`, `set_name`, `set_val`, `set_category`, `set_type`, `display`) 
VALUES ('SMTP Mail Port', 'SP_SMTP_PORT', '25', 'system', 'small', '1');



ALTER TABLE `proxylist` ADD `checked` TINYINT( 1 ) NOT NULL DEFAULT '0';


INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'Forgot password?', 'Forgot password?');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'Request Password', 'Request Password');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'Your Password Reset Failed', 'Your Password Reset Failed');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'Your Password Reset Successfully', 'Your Password Reset Successfully');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'user_email_not_exist', 'User email is not exiting in system!');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'password_reset_success_message', 'Your password reset successfully. A confirmation mail send to email address. <br>Please check your inbox to get your new password.');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'internal_error_mail_send', 'An internal error occured while sending password reset mail!');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'to login to your account', 'to login to your account');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'login', 'Your account password is resetted and new password is', 'Your account password is resetted and new password is');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'common', 'Thank you', 'Thank you');

INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'panel', 'Proxy Settings', 'Proxy Settings');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'panel', 'Import Proxy', 'Import Proxy');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'settings', 'allsettingssaved', 'All settings saved successfully!');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'settings', 'CURLOPT_HTTPPROXYTUNNEL_VAL', 'Enable HTTP Proxy Tunnel');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'settings', 'SP_SMTP_PORT', 'SMTP Mail Port');

INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'common', 'Checked', 'Checked');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'label', 'Syntax', 'Syntax');

INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'proxy', 'enterproxynote', 'Enter proxy one per line in following format.');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'proxy', 'proxysyntax', 'Proxy Hostname, Proxy Port, Proxy Username, Proxy Password');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'panel', 'Valid', 'Valid');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'panel', 'Existing', 'Existing');

INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'button', 'Search', 'Search');

INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'settings', 'PROXY_DEACTIVATE_CRAWL', 'Deactivate Proxy When Crawling Failed');
INSERT INTO texts (`lang_code`, `category`, `label`, `content`) VALUES 
('en', 'settings', 'CHECK_WITH_ANOTHER_PROXY_IF_FAILED', 'Check With Another Proxy When Crawling Failed');

UPDATE `texts` SET `content` = 'Vil du virkelig ønsker at fortsætte?' WHERE `lang_code` LIKE 'da' AND `label` LIKE 'wantproceed';