<?php
if (empty($CONFIG["database"]["DB_HOST"])) {
    die('Need to setup SQL connection in .config');
}
require $PATH.'/app/classes/db.php';
db::connect($CONFIG["database"]["DB_HOST"], $CONFIG["database"]["DB_USERNAME"], $CONFIG["database"]["DB_PASSWORD"], $CONFIG["database"]["DB_DATABASE"]);
db::query(file_get_contents($PATH.'/app/panx-worker/auth-resource/table.sql'), array());
info_msg("The table `users` created");
db::query(file_get_contents($PATH.'/app/panx-worker/auth-resource/table_tokens.sql'), array());
info_msg("The table `users_tokens` created");
db::query(file_get_contents($PATH.'/app/panx-worker/auth-resource/recaptcha_fails.sql'), array());
info_msg("The table `recaptcha_fails` created");

