<?php




// $kd->page_url_   = $kd->config->site_url.'/'.$kd->apply_page .'/'.$kd->apply_university .'/'. $kd->apply_program;
$kd->title       = __('apply') . ' | ' . $kd->config->title;
$kd->page        = "multiple_applications";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;

$countries = '';
foreach ($kd->countries_name as $key => $value) {

    $countries .= '<option value="' . $value . '">' . $value . '</option>';
}


$kd->content     = LoadPage('apply/multiple_applications',  array('COUNTRIES_LAYOUT' => $countries));