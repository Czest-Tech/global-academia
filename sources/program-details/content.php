<?php

$program_details_page = '';
if (isset($_GET['page'])) {
    $program_details_page = $_GET['page'];
}


$kd->page_url_   = $kd->config->site_url.'program-details/'.$program_details_page;
$kd->title       = __('program_details') . ' |  Apply in Turkey | Scholarships' . $kd->config->title;
$kd->page        = "program_details";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
    
$get_program = '';
$program_university_data = array();
$gp = '';
$kd->program_detailts = '';
$data = [];
if(!empty($program_details_page)){
 
    $gp = $db->where('id', Secure($program_details_page))->getOne(T_PROGRAM);

    
    $kd->title       =  $gp->university. '| '.$gp->department  .'  | Apply in Turkey | Scholarships'.  $kd->config->title;
    $kd->program_detailts->id = $program_details_page;
    $kd->program_details->image = GetUniversityImage($gp->university_id);
    $kd->program_details->logo = GetUniversityLogo($gp->university_id);
    $kd->program_detailts->university =  ($gp->university) ? $gp->university : ''; 
    $kd->program_detailts->tuition_fee = ($gp->tuition_fees) ? $gp->tuition_fees : '';
    $kd->program_detailts->discounted_fee = ($gp->discounted_fees) ? $gp->discounted_fees: '';
    $kd->program_detailts->university_id = $gp->university_id;
    $kd->program_detailts->duration = ($gp->duration) ? $gp->duration : '';
    $kd->program_detailts->location = ($gp->location) ? $gp->location : '';
    $kd->program_detailts->type = ($gp->degree) ? $gp->degree : '';
    $kd->program_detailts->department = ( $gp->department)? $gp->department : '';
    $kd->program_detailts->language = ($gp->language) ? $gp->language : '';
    $kd->program_detailts->description =  ($gp->description)? $gp->description : 'Nisi elit esse ut magna nostrud elit tempor labore nisi irure dolor laboris. Nostrud labore amet officia ipsum magna exercitation ex dolore minim Lorem enim proident. Labore et culpa deserunt culpa ea qui officia velit in adipisicing deserunt. Pariatur elit irure commodo ea id nulla minim esse qui velit. Mollit nisi aute non consequat excepteur mollit aliquip laboris ad do pariatur magna consectetur et.';
    $kd->program_detailts->requirements =  ($gp->requirement)? $gp->requirement : 'Nisi elit esse ut magna nostrud elit tempor labore nisi irure dolor laboris. Nostrud labore amet officia ipsum magna exercitation ex dolore minim Lorem enim proident. Labore et culpa deserunt culpa ea qui officia velit in adipisicing deserunt. Pariatur elit irure commodo ea id nulla minim esse qui velit. Mollit nisi aute non consequat excepteur mollit aliquip laboris ad do pariatur magna consectetur et.';
    $kd->program_detailts->discipline =  ($gp->discipline)? $gp->discipline : 'Nisi elit esse ut magna nostrud elit tempor labore nisi irure dolor laboris. Nostrud labore amet officia ipsum magna exercitation ex dolore minim Lorem enim proident. Labore et culpa deserunt culpa ea qui officia velit in adipisicing deserunt. Pariatur elit irure commodo ea id nulla minim esse qui velit. Mollit nisi aute non consequat excepteur mollit aliquip laboris ad do pariatur magna consectetur et.';

    
}
    



$kd->content     = LoadPage('program-details/content');