<?php 

if($first == 'get_applications'){
    $get_applications = $db->get(T_APPLICATIONS);

    if($get_applications){

        $data = array(
            'status' => 200,
            'data' => $get_applications
         );
     } else {
         $data = array(
            'status' => 400,
            'message' => 'error'
         );
     }
    
}