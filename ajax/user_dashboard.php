<?php 
  
  if ($first == 'get_user_applications') {

     $get_user_applications = $db->where("email", $kd->user->email)->get(T_APPLICATIONS);
     var_dump( $get_user_applications);
    
    
    if ( $get_user_applications) {
        
        $data = array(
            'status' => 200,
            'data' => $get_user_applications
        );
        echo json_encode($data);
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
   }

   if($first  === 'user_data'){
        $data = array(
            'status' => 200,
            'data' => $kd->user
        );
   }


    exit();
}