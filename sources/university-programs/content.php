<?php


$kd->page        = 'program';
$kd->title       = $kd->config->title;
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
$pro_users        = array();
$kd->page_url_   = $kd->config->site_url;
$page_id = $_GET['page'];


$program_html = '';
$university_name = '';
$no_programs = "<div class='no_programs'> <h1>". __('this_university_has_no_active_programs')."</h1></div>";
$program_data = '';
$program_filter = '';
$filter_data = '';
$program_list = '';
$university_list = '';
$pagination_html = '';
$page = (!empty($_GET['page-id'])) ? $_GET['page-id'] : 1;

$db->pageLimit  = 30;

if(!empty($page_id)){

    $program_data = $db->where('university_id', $page_id)->orderBy('id', 'ASC')->objectbuilder()->paginate(T_PROGRAM, $page);
    $university_filter = $db->where('id', $page_id)->getOne(T_UNIVERSITY);
    $university_name = $university_filter->university;
} 
if(!empty($program_data)){
$page_info = array(
    "pages" => $page,
    "link" => 'program',
    "totalPages" => $db->totalPages,
);
  
$pagination_html .=  LoadPage('cards/pagination',array(
     'PAGE' => $page_info
 ));
  
 
$program_filter = $db->where('university_id', $page_id)->get(T_PROGRAM);
foreach($program_filter as $key => $pf){
    
   $program_list .= LoadPage('cards/program_list',array(
       'id' => $pf->department,
       'name' => $pf->department
   ));
};



    
   $university_list .= LoadPage('cards/university_list',array(
       'id' => $university_filter->university,
       'name' => $university_filter->university
   ));





foreach($program_data as $pd){
        
        $program_html .= LoadPage('cards/program_cards',array(
            'id' => $pd->id,
            'university' => $pd->university,
            'university_id' => $pd->university_id,
            'department_id' => $pd->id,
            'tuition_fee' => $pd->tuition_fees,
            'discounted_fee' => $pd->discounted_fees,
            'duration' => $pd->duration,
            'location' => $pd->location,
            'type' => $pd->degree,
            'univerisity_logo' => GetUniversityLogo($pd->university_id),
            'department' => $pd->department,
            'language' => $pd->language
        ));
}
$filter_data =  LoadPage('filter/content', array(
    'unversity' => $university_list,
    'program' => $program_list
));
}

$kd->content     = LoadPage('university/programs',[
    "FILTER" => $filter_data,
    "PROGRAM_CARD" => (!empty($program_html))? $program_html : $no_programs,
    "PAGINATION" => $pagination_html,
    "UNIVERSITY_NAME" => (!empty($university_name))? $university_name : ''
]);


