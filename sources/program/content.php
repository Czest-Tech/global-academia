<?php


$kd->page        = 'program';
$kd->title       = $kd->config->title;
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
$pro_users        = array();
$kd->page_url_   = $kd->config->site_url;



$program_html = '';
$program_data = '';
$program_filter = '';
$program_list = '';
$university_list = '';
$pagination_html = '';
$page = (!empty($_GET['page-id'])) ? $_GET['page-id'] : 1;
$filter_search_keyword = (isset($_GET['filter_search_keyword']))? $_GET['filter_search_keyword'] : '';


$db->pageLimit  = 40;
$program_data = $db->orderBy('id', 'ASC')->objectbuilder()->paginate(T_PROGRAM, $page);
$page_info = array(
    "pages" => $page,
    "link" => 'program',
    "totalPages" => $db->totalPages,
    "filter_search_keyword" => $filter_search_keyword,
);
  
$pagination_html .=  LoadPage('cards/pagination',array(
     'PAGE' => $page_info
 ));
  
$program_filter = $db->get(T_PROGRAM);
foreach($program_filter as $key => $pf){
    
   $program_list .= LoadPage('cards/program_list',array(
       'id' => $pf->department,
       'name' => $pf->department
   ));
};
$university_filter = $db->get(T_UNIVERSITY);

foreach($university_filter as $key => $uf){
    
   $university_list .= LoadPage('cards/university_list',array(
       'id' => $uf->university,
       'name' => $uf->university
   ));
};




foreach($program_data as $pd){
        $program_html .= LoadPage('cards/program_cards',array(
            'id' => $pd->id,
            'university' => strtolower($pd->university),
            'university_id' => $pd->university_id,
            'department_id' => $pd->id,
            'tuition_fee' => $pd->tuition_fees,
            'discounted_fee' => $pd->discounted_fees,
            'duration' => strtolower($pd->duration),
            'location' => strtolower($pd->location),
            'type' => strtolower($pd->degree),
            'univerisity_logo' => GetUniversityLogo($pd->university_id),
            'department' => strtolower($pd->department),
            'language' => strtolower($pd->language)
        ));
}


$kd->content     = LoadPage('program/content',[
    "FILTER" =>  LoadPage('filter/content', array(
        'unversity' => $university_list,
        'program' => $program_list,
        'filter_search_keyword' => $filter_search_keyword
    )),
    "PROGRAM_CARD" => $program_html,
    "PAGINATION" => $pagination_html
]);


