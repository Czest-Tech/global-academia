<?php


$kd->page        = 'university';
$kd->title       = $kd->config->title;
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;
$pro_users        = array();
$kd->page_url_   = $kd->config->site_url;

$university_html = '';
$university_data = '';

$program_html = '';
$program_data = '';
$program_filter = '';
$program_list = '';
$university_list = '';
$pagination_html = '';



$page = (!empty($_GET['page-id'])) ? $_GET['page-id'] : 1;
$filter_search_keyword = (isset($_GET['filter_search_keyword']))? $_GET['filter_search_keyword'] : '';


$db->pageLimit  = 40;
$university_data = $db->orderBy('id', 'ASC')->objectbuilder()->paginate(T_UNIVERSITY, $page);
$page_info = array(
    "pages" => $page,
    "link" => 'university',
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


foreach($university_data as $ud){
        $university_html .= LoadPage('cards/university_cards',array(
            'id' => $ud->id,
            'university' => $ud->university,
            'foundation' => $ud->foundation,
            'university_logo' => (GetMedia($ud->university_logo))?  GetMedia($ud->university_logo): "https://www.usnews.com/dims4/USNEWS/e836bb8/2147483647/thumbnail/640x420/quality/85/?url=http%3A%2F%2Fmedia.beam.usnews.com%2Fb0%2F5a49fe7ceb6d77f5ad2824c373a297%2Fucf_47862357.jpg",
            'main_image' => (GetMedia($ud->main_image))?  GetMedia($ud->main_image): "https://www.usnews.com/dims4/USNEWS/e836bb8/2147483647/thumbnail/640x420/quality/85/?url=http%3A%2F%2Fmedia.beam.usnews.com%2Fb0%2F5a49fe7ceb6d77f5ad2824c373a297%2Fucf_47862357.jpg",
            'location' => $ud->location,
            'total_students' => $ud->total_students,
            'university_type' => $ud->university_type,
            'total_programs' => TotalPrograms($ud->id),
           
        ));
}

$kd->content     = LoadPage('university/content', [
     "FILTER" =>  LoadPage('filter/content',array(
        'unversity' => $university_list,
        'program' => $program_list,
        'filter_search_keyword' => $filter_search_keyword
    )),
     "UNIVERSITY_CARD" => $university_html,
     "PAGINATION" => $pagination_html
]);

