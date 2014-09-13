<?php
/*
Plugin Name: Wordpress VN oEmbed
Version: 1.0.0
Description: Hoox Hỗ trợ oEmbed cho các website chia sẻ nhạc ở Việt Nam
Author: Vô Minh
Plugin URI: http://laptrinh.senviet.org
*/

include dirname(__FILE__) . '/scb/load.php';
include_once dirname(__FILE__) . '/core.php';
function _wpvne_init()
{
    Wpos_Code::instance()->init();
}

scb_init('_wpvne_init');
