<?php

$kd->apply_university = '';
$kd->apply_program = '';
$kd->apply_page = '';

if (isset($_GET['page']) && isset($_GET['university']) && isset($_GET['program']) && !empty($_GET['page']) && !empty($_GET['university']) && !empty($_GET['program'])){    
    $kd->apply_university = $_GET['university'];

    $kd->apply_program = $_GET['program'];  

    $kd->apply_page = $_GET['page'];
} 



$kd->page_url_   = $kd->config->site_url.'/'.$kd->apply_page .'/'.$kd->apply_university .'/'. $kd->apply_program;
$kd->title       = __('apply') . ' | ' . $kd->config->title;
$kd->page        = "apply";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;

$countries = '';
foreach ($kd->countries_name as $key => $value) {

    $countries .= '<option value="' . $value . '">' . $value . '</option>';
}


$kd->content     = LoadPage('apply/content',  array('COUNTRIES_LAYOUT' => $countries));