<?php


$kd->mode        = 'all';
$kd->page        = 'status';
$kd->title       = $kd->config->title;
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
$pro_users        = array();
$kd->page_url_   = $kd->config->site_url;
$kd->content     = LoadPage('status/content');

