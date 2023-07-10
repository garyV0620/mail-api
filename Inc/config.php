<?php
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE_NAME", "php_training");
define("PREFIX", "");
define("DNS", 'mysql:host=' .DB_HOST. ';dbname=' . DB_DATABASE_NAME .'; port= "3360"');

define("EMAIL_USERNAME", "vgary0620@gmail.com");
define("EMAIL_PASSWORD", "vxqdnigbkpzikxtz");

define("EMAIL_HOST", "smtp.gmail.com");
define("API_KEY", "GASC");
define("DEBUG_EMAIL", ['off'=>0,'client'=>1,'on'=>2]); // 0 = off (for production use) - 1 = client messages - 2 = client and server messages