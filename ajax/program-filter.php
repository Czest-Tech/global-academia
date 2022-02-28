<?php
$filter_type = (isset($_GET['filter_type'])) ? Secure($_GET['filter_type']) : '';
$filter_search_keyword = (isset($_GET['filter_search_keyword'])) ? Secure($_GET['filter_search_keyword']) : '';
$department = (isset($_GET['department'])) ? $_GET['department'] : '';
$degree = (isset($_GET['degree'])) ? $_GET['degree'] : '';
$university = (isset($_GET['university'])) ? $_GET['university'] : '';

$location = (isset($_GET['location'])) ? $_GET['location'] : '';
$from = (isset($_GET['from'])) ? $_GET['from'] : '';
$to = (isset($_GET['to'])) ? $_GET['to'] : '';


if( empty($filter_type)){
    exit('Oops WE dont do that here :) add parameters');
}
//   $get_CAts = GetSearchCategory($filter_search_keyword);

$results = array();
$program_html = '';
$university_html = '';
$pagination_html = '';
switch ($filter_type){
    case 'program':

        if(!empty($filter_search_keyword)) {

            $db->where("( `department` LIKE '%$filter_search_keyword%' OR `university` LIKE '%$filter_search_keyword%')");
            
        }
        if(!empty($department) && $department != "All" ) {
            $db->where('department', $department);
        }
        if(!empty($university) && $university != "All" ) {
            $db->where('university', $university);
        }
        if(!empty($location)) {
            $db->where('location', $location);
        }
        if(!empty($to)) {
            $db->where("(`discounted_fees` < $to)");
        }
        if(!empty($from)) {
            $db->where("(`discounted_fees` >  $from)");
        }
      
        if(!empty($degree) && ($degree != 'english') && ($degree != 'turkish')) {
            $db->where('degree', $degree);
        }
        if(!empty($degree) && ($degree != 'english') && ($degree === 'turkish')) {
            $db->where('language', $degree);
        }
        if(!empty($degree) && ($degree === 'english') && ($degree != 'turkish')) {
            $db->where('language', $degree);
        }
        $page = (!empty($_GET['page-id'])) ? $_GET['page-id'] : 1;

        $db->pageLimit  = 30;
        $results = $db->orderBy('id', 'ASC')->objectbuilder()->paginate(T_PROGRAM, $page);
      
        $page_info = array(
            "pages" => $page,
            "link" => 'program',
            "totalPages" => $db->totalPages,
            'filter_search_keyword' => (isset($_GET['filter_search_keyword']))? $_GET['filter_search_keyword'] : '',
        );
          
        $pagination_html .=  LoadPage('cards/pagination',array(
             'PAGE' => $page_info
         ));
        foreach($results as $pd){
           
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

        $data['html'] = $program_html;
        $data['pagination'] = $pagination_html;
        $data['status'] = 200;

        break;
    case 'university':
        if(!empty($filter_search_keyword)) {

            $db->where("( `university` LIKE '%$filter_search_keyword%')");
            
        }
        if(!empty($department) && $department != "All" ) {
             
            $db->where('university', GetProgramUniversity($department));
        }
        if(!empty($university) && $university != "All" ) {
             
            $db->where('university ', $university);
        }
        if(!empty($location)) {
            $db->where('location', $location);
        }
        $page = (!empty($_GET['page-id'])) ? $_GET['page-id'] : 1;

        $db->pageLimit  = 30;
        $results = $db->objectbuilder()->paginate(T_UNIVERSITY, $page);
        $page_info = array(
            "pages" => $page,
            "link" => 'university',
            "totalPages" => $db->totalPages,
            'filter_search_keyword' => (isset($_GET['filter_search_keyword']))? $_GET['filter_search_keyword'] : '',

            
        );
          
        $pagination_html .=  LoadPage('cards/pagination',array(
             'PAGE' => $page_info
         ));
        //  var_dump($results);
        foreach($results as $ud){
          
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

        $data['html'] = $university_html;
        $data['pagination'] = $pagination_html;
        $data['status'] = 200;


        break;
    default:
        $data['status'] = 400;
        $data['message'] = 'opps bad code!';
        break;
}