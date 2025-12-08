<?php
session_start();
require_once 'FaiFramework/MainFaiFramework.php';
set_time_limit(300);
MainFaiFramework::route_request();