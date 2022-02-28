<?php

$university_details_page = '';
if (isset($_GET['page'])) {
    $university_details_page = $_GET['page'];
}


$kd->page_url_   = $kd->config->site_url.'program-details/'.$program_details_page;
$kd->title       = __('program_details') . '  | Apply in Turkey | Scholarships'.  $kd->config->title;
$kd->page        = "university_details";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
    
$get_program = '';
$university_data = array();
$gp = '';
$kd->university_detailts = '';
$data = [];
$university = new class{};
if(!empty($university_details_page)){
 
    $gp = $db->where('id', Secure($university_details_page))->getOne(T_UNIVERSITY);
    $kd->university = $gp;
    $kd->title       = $gp->university. '  | Apply in Turkey | Scholarships'.  $kd->config->title;
    
    $university->id = $university_details_page;
    $university->library = $gp->library;
    $university->wifi = $gp->wifi;
    $university->gym = $gp->gym;
    $university->cafeteria  = $gp->cafeteria;
    $university->hairdresser= $gp->hairdresser;
    $university->car_park  = $gp->car_park;
    $university->bank = $gp->bank;
    $university->security = $gp->security;
    $university->vertural_court =  $gp->vertural_court;
    $university->walking_track =  $gp->walking_track;
    $university->barrier_free =  $gp->barrier_free;
    $university->tennis_court =  $gp->tennis_court;
    $university->dining_hall =  $gp->dining_hall;
    $university->auditorium =  $gp->auditorium;
    $university->medial_center =  $gp->medial_center;
    $university->location =  $gp->location;
    $university->university_type =  $gp->university_type;
    $university->foundation =  $gp->foundation;
    $university->lang_edu_en =  $gp->lang_edu_en;
    $university->lang_edu_tk =  $gp->lang_edu_tk;
    $university->sp_facilitie =  $gp->sp_facilitie;
    $university->st_associations =  $gp->st_associations;
    $university->laboratories =  $gp->laboratories;
    $university->study_mode =  $gp->study_mode;
    $university->international_students =  $gp->international_students;
    $university->total_students =  $gp->total_students;
    $university->asso_degrees =  $gp->associate_degree;
    $university->undergraduate_program =  $gp->undergraduate_program;
    $university->master_programs =  $gp->master;
    $university->ph_d_programs =  $gp->phd;
    $university->dormitory =  $gp->dormitory;
    $university->male =  $gp->male;
    $university->description =  $gp->description;
    $university->title =  $gp->title;
}
$departments_all = $db->where('university_id', Secure($university_details_page))->get(T_DEPARTMENTS);
    



$kd->content = LoadPage('university-details/content');