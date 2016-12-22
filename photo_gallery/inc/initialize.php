<?php

defined("DS") ?null : define("DS",DIRECTORY_SEPARATOR);
defined("SITE_ROOT") ? null : define("SITE_ROOT",DS."media".DS."sf_sandbox".DS."webbasic".DS."photo_gallery");
defined("LIB_PATH") ? null : define("LIB_PATH",SITE_ROOT.DS."inc");
defined("LOG_FILE_PATH") ? null : define("LOG_FILE_PATH",SITE_ROOT . DS . "logs" . DS . "logs.txt");
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database-object.php");
require_once(LIB_PATH.DS."user.php");
require_once(LIB_PATH.DS."photograph.php");
require_once(LIB_PATH.DS."comment.php");
