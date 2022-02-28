<?php
$kd->page_url_   = $kd->config->site_url.'/test_page';
$kd->title       = __('test_page') . ' | ' . $kd->config->title;
$kd->page        = "test_page";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
$kd->content     = LoadPage('test_page/test_file');