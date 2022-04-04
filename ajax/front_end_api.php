<?php 


if($first === "status"){

    if(empty($_POST['email'])){
        exit('oOPs No email');
    }
    $status_html = '';
    $getEmail = $_POST['email'];
    $button = '';
    $button1 = '';
    $applicaion_no = '';
    $applicant_data = $db->where('application_no',$getEmail )->getOne(T_APPLICATIONS);

    $applicant_data->name = $applicant_data->first_name . ' ' .$applicant_data->middle_name .' '. $applicant_data->last_name;
    $applicant_data->applicant_image = GetMedia($applicant_data->id_photo);
   
        $chats = $db->where('applicant_email',$applicant_data->email)->get(T_APPLICANT_CHAT);
       foreach($chats as $cts){
          if(!empty($cts->action_slug)){
              $cts->action = __($cts->action_slug);
          } else {
            $cts->action = '';
          }
       }

    $isSent = $db->where('email',$applicant_data->email)->get(T_APPLICANT_UNIVERSITIES);
    if($isSent){
        foreach($isSent as $key => $rd){
          
         
            $rd->university_name =  GetuniversityByID($rd->university_id);
            $rd->program_name = GetProgramByID($rd->program_id);
           
             $rd->application_status = __($rd->application_status);
             $rd->edit_request_translation = __($rd->edit_request);
             $rd->checked_translatino = __($rd->is_checked);
            $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);
           
        }
         
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'data' => $isSent,
           'applicant_info' => $applicant_data,
           'application_no' => '',
           'chats' => $chats,
           'timestamp' => $applicant_data->created_at
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'No Applications Found'
        );
    }


}
if($first == "send_applicant_message"){
        // if(empty($_POST['message'])){
        //     exit('oOPs No message');
        // }
        $message_data = new stdClass();
      
        foreach($new_message as $nm){
            $nm->file = GetMedia($nm->file);
        }
       
        $message_data->applicant_email = Secure($_POST['email']);
        $message_data->message = Secure($_POST['message']);
        if (!empty($_FILES['file']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['file']['tmp_name'],
                'size' => $_FILES['file']['size'],
                'name' => $_FILES['file']['name'],
                'type' => $_FILES['file']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'file'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $message_data->file = $file_upload['filename'];
            }
        }
        $message_data->from = Secure($_POST['name']);
        $message_data->to = 'admin';
      
        $send_msg = $db->insert(T_APPLICANT_CHAT, ToArray($message_data));

        if($send_msg){

            $new_message = $db->where('applicant_email', Secure($_POST['email']))->get(T_APPLICANT_CHAT);
            
            foreach($new_message as $cts){
               if(!empty($cts->action_slug)){
                   $cts->action = __($cts->action_slug);
               } else {
                 $cts->action = '';
               }
            }
            $data = array(
                'status' => 200,
                'chats' => $new_message,
                
             );
        } else {
            $data = array(
                'status' => 400,
                'message' => 'No Applications Found'
             );
        }

}
if($first == "view_application"){
       if(empty($_GET['id'])){
           exit("oooppps");
       }

       $get_init_data = $db->where('id', Secure($_GET['id']))->getOne(T_APPLICATIONS);
       $get_init_data->transcript_file = (GetMedia($get_init_data->transcript_file))? GetMedia($get_init_data->transcript_file) : '';

       $get_init_data->diploma_file = (GetMedia($get_init_data->diploma_file))? GetMedia($get_init_data->diploma_file) : '';
       $get_init_data->other_files = (GetMedia($get_init_data->other_files))? GetMedia($get_init_data->other_files) : '';
       $get_init_data->language_certificate = (GetMedia($get_init_data->language_certificate)) ? GetMedia($get_init_data->language_certificate) : '';
       $get_init_data->passport_file = (GetMedia($get_init_data->passport_file))? GetMedia($get_init_data->passport_file) : '';
       $get_init_data->id_photo = (GetMedia($get_init_data->id_photo))? GetMedia($get_init_data->id_photo) :'';
       
       $get_init_data->transcript = $get_init_data->transcript_file;     
       $get_init_data->diploma = $get_init_data->diploma_file;
       $get_init_data->other = $get_init_data->other_files;
       $get_init_data->language = $get_init_data->language_certificate;
       $get_init_data->passport = $get_init_data->passport_file;
       $get_init_data->photo = $get_init_data->id_photo;
       if(!empty($get_init_data->user_id) && HasEducationalInfo($get_init_data->user_id)){
         $get_init_data2 = $db->where('user_id', $get_init_data->user_id)->getOne(T_APPLICANT_EDUCATION_INFO);

         $get_init_data->transcript_file = (GetMedia($get_init_data2->transcript_file))? GetMedia($get_init_data2->transcript_file) : '';

       $get_init_data->diploma_file = (GetMedia($get_init_data2->diploma_file))? GetMedia($get_init_data2->diploma_file) : '';
       $get_init_data->other_files = (GetMedia($get_init_data2->other_files))? GetMedia($get_init_data2->other_files) : '';
       $get_init_data->language_certificate = (GetMedia($get_init_data2->language_certificate)) ? GetMedia($get_init_data2->language_certificate) : '';
       $get_init_data->passport_file = (GetMedia($get_init_data2->passport_file))? GetMedia($get_init_data2->passport_file) : '';
       $get_init_data->id_photo = (GetMedia($get_init_data2->id_photo))? GetMedia($get_init_data2->id_photo) :'';
       $get_init_data->language_certificate_name = $get_init_data2->language_certificate_name;
       $get_init_data->transcript_name = $get_init_data2->transcript_name;
       $get_init_data->diploma_name = $get_init_data2->diploma_name;
       
       $get_init_data->first_name = $get_init_data2->first_name;
       $get_init_data->last_name = $get_init_data2->last_name;
       $get_init_data->date_of_birth = $get_init_data2->date_of_birth;
       $get_init_data->phone_number = $get_init_data2->phone_number;
       $get_init_data->phone_number_2 = $get_init_data2->phone_number_2;
       $get_init_data->fathers_name = $get_init_data2->fathers_name;
       $get_init_data->mothers_name = $get_init_data2->mothers_name;

       $get_init_data->passport_number = $get_init_data2->passport_number;
       $get_init_data->nationality = $get_init_data2->nationality;
       $get_init_data->country_of_residence = $get_init_data2->country_of_residence;
   

   

       $get_init_data->transcript = $get_init_data2->transcript_file;     
       $get_init_data->diploma = $get_init_data2->diploma_file;
       $get_init_data->other = $get_init_data2->other_files;
       $get_init_data->language = $get_init_data2->language_certificate;
       $get_init_data->passport = $get_init_data2->passport_file;
       $get_init_data->photo = $get_init_data2->id_photo;
       $get_init_data->emai = $get_init_data2->email;
       }
      
       if($get_init_data){
           $get_university_data = $db->where('email', $get_init_data->email)->get(T_APPLICANT_UNIVERSITIES);
           $chats = $db->where('applicant_email', $get_init_data->email)->get(T_APPLICANT_CHAT);
           foreach($chats as $cts){
                if(!empty($cts->action_slug)){
                    $cts->action = __($cts->action_slug);
                } else {
                $cts->action = '';
                }
            }
           foreach($get_university_data as $key => $rd){
         
            $rd->university_name =  GetuniversityByID($rd->university_id);
            $rd->program_name = GetProgramByID($rd->program_id);
           
             $rd->application_status = __($rd->application_status);
            $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);
           
        }
         
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'data' => $get_university_data,
           'applicant_info' => $get_init_data,
           'application_no' => '',
           'chats' => $chats,
           'timestamp' => $get_init_data->created_at
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'No Applications Found'
        );
    }
   }
if($first == "send_admin_message"){
   
    $message_data = new stdClass();
    $isSentD = false;
 
   
    $message_data->applicant_email = Secure($_POST['email']);
    $message_data->message = Secure($_POST['message']);
    $update_id = $db->where('email', $_POST['email'])->getOne(T_APPLICATIONS);
    $action_l = $_POST['action_slug'];

    
    if (!empty($_FILES['file']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['file']['tmp_name'],
            'size' => $_FILES['file']['size'],
            'name' => $_FILES['file']['name'],
            'type' => $_FILES['file']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'file'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $message_data->file = $file_upload['filename'];
        }
    }
    if(!empty($action_l)){
        $message_data->action_slug = $action_l;
        $new_status['status'] = $action_l;

        
        $udpated_is = $db->where('id', $update_id->id)->update(T_APPLICATIONS,$new_status);

    }
    $message_data->from = 'admin';
    $message_data->to = Secure($_POST['name']);
   if(count((array)$message_data) !== 0){
     $send_msg = $db->insert(T_APPLICANT_CHAT, ToArray($message_data));
     if($send_msg) $isSentD = true;
   }

    if($isSentD){
        $status = $message_data->message;
        $notif_data = array(
            'notifier_id' => 0,
            'recipient_id' => $update_id->user_id,
            'application_no' => $update_id->uniqid,
            'type' => 'application_status',
            'text' => GetNotificationText(null, null,$status, 'message'), 
            'url' => ('/admin-cp/view-application?id='.$update_id->$uniqid),
            'time' => time(),
            'target' => 'all',
        );
        NotifyUser($notif_data);
        $new_message = $db->where('applicant_email', Secure($_POST['email']))->get(T_APPLICANT_CHAT);
        foreach($new_message as $cts){
            if(!empty($cts->action_slug)){
                $cts->action = __($cts->action_slug);
            } else {
            $cts->action = '';
            }
            $cts->file = GetMedia($cts->file);
        }
        $data = array(
            'status' => 200,
            'chats' => $new_message,
            
         );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'No Applications Found'
         );
    }

}
if($first === "university_status"){
   if(!isset($_GET['last_set_id']) && empty($_GET['last_set_id'])){
          exit("ooops");
   }
   
   $id = Secure($_GET['last_set_id']);
   $status = Secure($_GET['status']);
   $update_data['is_checked'] = $status;
   $update_status = $db->where('id', $id)->update(T_APPLICANT_UNIVERSITIES,$update_data);

   if($update_status){
    $update_status_respo = $db->where('id', $id)->getOne(T_APPLICANT_UNIVERSITIES);
    $status = __($update_status_respo->is_checked);
    $notif_data = array(
        'notifier_id' => 0,
        'recipient_id' => GetApplicantUserId($id),
        'application_no' => $update_status_respo->uniqid,
        'type' => 'application_status',
        'text' => GetNotificationText(GetuniversityByID($update_status_respo->university_id), GetProgramByID($update_status_respo->program_id),$status, 'status'), 
        'url' => ('/admin-cp/view-application?id='.$update_status_respo->$uniqid),
        'time' => time(),
        'target' => 'all',
    );
    NotifyUser($notif_data);
    $data = array(
        'status' => 200,    
     );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'error updating the db'
        );
    }
   
}
if($first === "send_edit_request"){
    if(!isset($_GET['id']) && empty($_GET['id'])){
           exit("ooops");
    }
    
    $id = Secure($_GET['id']);

    $update_data['edit_request'] = 'requested';
    $getEmail = $db->where('id',$id)->getOne(T_APPLICANT_UNIVERSITIES);
    $update_status = $db->where('id', $id)->update(T_APPLICANT_UNIVERSITIES,$update_data);
 
    if($update_status){
        $isSent = $db->where('email',$getEmail->email)->get(T_APPLICANT_UNIVERSITIES);
          if(isset($_GET['user_id'])){
                foreach($isSent as $allProgram){
                    $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                    $allProgram->program_id = GetProgramByID($allProgram->program_id);
                    $allProgram->application_status_slug =  __($allProgram->application_status);
                }
            } else {
                foreach($isSent as $key => $rd){
                
                    $rd->university_name =  GetuniversityByID($rd->university_id);
                    $rd->program_name = GetProgramByID($rd->program_id);
                
                    $rd->application_status = __($rd->application_status);
                    $rd->edit_request_translation = __($rd->edit_request);
                    $rd->checked_translatino = __($rd->is_checked);
                    $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);
                    
                }
            }

            
        $data = array(
            'status' => 200,  
            'data' =>   $isSent
        );
     } else {
         $data = array(
             'status' => 400,
             'message' => 'error updating the db'
         );
     }
    
}
if($first === "admin_approve_request"){
    if(!isset($_GET['id']) && empty($_GET['id'])){
           exit("ooops");
    }
    
    $id = Secure($_GET['id']);

    $update_data['edit_request'] = 'approved';
    $getEmail = $db->where('id',$id)->getOne(T_APPLICANT_UNIVERSITIES);
    $update_status = $db->where('id', $id)->update(T_APPLICANT_UNIVERSITIES,$update_data);
 
    if($update_status){
        $update_status_respo = $db->where('id', $id)->getOne(T_APPLICANT_UNIVERSITIES);

        $status = 'Edit request has been approved';

        $notif_data = array(
            'notifier_id' => 0,
            'recipient_id' => GetApplicantUserId($id),
            'application_no' => $update_status_respo->uniqid,
            'type' => 'application_status',
            'text' => GetNotificationText(GetuniversityByID($update_status_respo->university_id), GetProgramByID($update_status_respo->program_id),$status, 'edit_request'), 
            'url' => ('/admin-cp/view-application?id='.$update_status_respo->$uniqid),
            'time' => time(),
            'target' => 'all',
        );
        NotifyUser($notif_data);
        $get_university_data = $db->where('email', $getEmail->email)->get(T_APPLICANT_UNIVERSITIES);
        
        foreach($get_university_data as $key => $rd){
      
            $rd->university_name =  GetuniversityByID($rd->university_id);
            $rd->program_name = GetProgramByID($rd->program_id);
           
             $rd->application_status = __($rd->application_status);
             $rd->edit_request_translation = __($rd->edit_request);
             $rd->checked_translatino = __($rd->is_checked);
            $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);
        }
     $data = array(
         'status' => 200,    
         'data' => $get_university_data
      );
     } else {
         $data = array(
             'status' => 400,
             'message' => 'error updating the db'
         );
     }
    
}
if($first  ===  'applicant_change_program'){

    $get_add_programs = $db->get(T_PROGRAM);
    foreach($get_add_programs as $adp){
        $name_slug =  GetuniversityByID($adp->university_id) .' - '. GetProgramByID($adp->id);
    }
    if($get_add_programs){
        $data = array(
            'status' => 200,   
            'university_list' =>  $get_add_programs
         );
        } else {
            $data = array(
                'status' => 400,
                'message' => 'error updating the db'
            );
        }

}
if($first === "manage_applications"){

    $bew_arrat = $db->get(T_APPLICATIONS);
    $call_back_array = array();
    $get_all_users = $db->where('access_level', 4,'!=')->get(T_USERS);
    foreach($get_all_users as $all_user){
       array_push($call_back_array, $all_user->id);
    }
  
    foreach($bew_arrat as $vb){
        $name_F =  (!empty($vb->first_name))? $vb->first_name : ' ';
        $name_B =  (!empty($vb->last_name))? $vb->last_name : ' ';
        $vb->id_photo = GetMedia($vb->id_photo);
        $vb->name = $name_F.' '. $name_B;

        if(!empty($vb->user_id)){
          $logged_user_data =  $db->where('user_id', $vb->user_id)->getOne(T_APPLICANT_EDUCATION_INFO);
         
          if(!empty($logged_user_data)){
                $name_F =  $logged_user_data->first_name;
                $name_B = $logged_user_data->last_name;
                $vb->first_name =  $logged_user_data->first_name;
                $vb->last_name = $logged_user_data->last_name;
                $vb->nationality = $logged_user_data->nationality;
                $vb->date_of_birth = $logged_user_data->date_of_birth;
                $vb->phone_number = $logged_user_data->phone_number;
                $vb->id_photo = GetMedia($logged_user_data->id_photo);
                $vb->name = $name_F.' '. $name_B;
              unset($logged_user_data->id);
          }
        }
     
     
        $vb->university = ($vb->type === 'multiple')? 'MULTIPLE APPLICATION': GetuniversityByID($vb->university_id);
        $vb->program = ($vb->type === 'multiple')? 'MULTIPLE APPLICATION': GetProgramByID($vb->program_id); 
        $vb->signed_by_name =(!empty($vb->signed_by))? GetUserName($vb->signed_by) : ' ';
        $vb->sign_id = (!empty($vb->signed_by))? $vb->signed_by : ' ';
        $vb->status = (!empty($vb->status))?  __($vb->status) : ' ';
        $vb->active_applications =  (!empty($vb->email))? GetApplicationsCount($vb->email) : ' ';
    }
    if($bew_arrat){
        $data = array(
            'status' => 200,   
            'data' =>  $bew_arrat,
            'color_id' => $call_back_array
         );
        } else {
            $data = array(
                'status' => 400,
                'message' => 'error updating the db'
            );
     }
}
if($first === "delete_application"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
       $type = Secure($_GET['type']);
       $id = Secure($_GET['id']);
       $email_address = '';
       $email_data =  $db->where('id', $id)->getOne(T_APPLICANT_UNIVERSITIES );
       $email_address = $email_data->email;
        if($type === "programs"){
            $delete_program = $db->where('id', $id)->delete(T_APPLICANT_UNIVERSITIES);
            if($delete_program){

                $get_university_data = $db->where('email', $email_address)->get(T_APPLICANT_UNIVERSITIES);

        
            foreach($get_university_data as $key => $rd){  
                $rd->university_name =  GetuniversityByID($rd->university_id);
                $rd->program_name = GetProgramByID($rd->program_id);             
                $rd->application_status = __($rd->application_status);
                $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);            
            }
            $data = array(
                'status' => 200,            
                'data' => $get_university_data
            );
            } else {
                $data = array(
                    'status' => 400,
                    'message' => 'error',
                );
                
            }
        } 
        else {
                $delete_application = $db->where('id', $id)->delete(T_APPLICATIONS);
                $delete_program = $db->where('email', $email_address)->delete(T_APPLICANT_UNIVERSITIES);

                if($delete_application){
                    $bew_arrat = $db->get(T_APPLICATIONS);
                    foreach($bew_arrat as $vb){
                        $vb->id_photo = GetMedia($vb->id_photo);
                        $vb->name = $vb->first_name .' '. $vb->last_name; 
                        $vb->university = ($vb->type === 'multiple')? 'MULTIPLE APPLICATION': GetuniversityByID($vb->university_id);
                        $vb->program = ($vb->type === 'multiple')? 'MULTIPLE APPLICATION': GetProgramByID($vb->program_id); 
                        $vb->signed_by_name = GetUserName($vb->signed_by);
                        $vb->sign_id = $vb->signed_by;
                        $vb->status = __($vb->status);
                        $vb->active_applications = GetApplicationsCount($vb->email);
                    }
                    $data = array(
                        'status' => 200,            
                        'data' => $bew_arrat
                    );
                    } 
                else {
                    $data = array(
                        'status' => 400,
                        'message' => 'error',
                    );
                    
                }
            
            }
    }

}

if ($first == 'remove_agent_request') {
    if (!empty($_POST['ids']) && !empty($_POST['type']) && in_array($_POST['type'], array('approve','decline','delete'))) {

        
        foreach ($_POST['ids'] as $key => $value) {
            if (is_numeric($value) && $value > 0) {
                $request_id = Secure($value);
                if ($_POST['type'] == 'delete') {
                    $db->where('id',$request_id)->delete(T_AGENT_REQUESTS);
                }
                elseif ($_POST['type'] == 'decline') {
                   $db->where('id',$request_id)->update(T_AGENT_REQUESTS,array('status' => 2));
                }
                elseif ($_POST['type'] == 'approve') {
                    $request_data = $db->where('id',$request_id)->getOne(T_AGENT_REQUESTS);
                    if (!empty($request_data) && $request_data->status != 1) {
                        $requiring = $db->where('id',$request_data->user_id)->getOne(T_USERS);
                        if (!empty($requiring)) {
                            $db->where('id',$request_data->user_id)->update(T_USERS,array(
                                'active' => 1
                            ));
                            $update_data = array(
                                'URL' => $kd->site_url,
                                'NAME' =>  $requiring->first_name . ' '. $requiring->last_name,
                             );
                            $send_email_data = array(
                                'from_email' => $kd->config->email,
                                'from_name' => $kd->config->name,
                                'to_email' => $requiring->email,
                                'to_name' => $requiring->first_name . ' '. $requiring->last_name,
                                'subject' => __('account_registration_approval'),
                                'charSet' => 'UTF-8',
                                'message_body' => LoadPage('email/account_registration_approved', $update_data),
                                'is_html' => true
                            );
                            $send_message = SendMessage($send_email_data);

                            var_dump($send_message);
                        }
                    }
                    $db->where('id',$request_id)->update(T_AGENT_REQUESTS,array('status' => 1));
                }
            }
        }
        $data = array('status' => 200);
       
    } else {
        $data = array(
            'status' => 400,
            'message' => 'error',
        );
    }
}
if ($first == 'remove_single_agent_request' && !empty($_POST['id']) && !empty($_POST['a'])) {
    $request = (is_numeric($_POST['id']) && is_numeric($_POST['a']) && in_array($_POST['a'], array(1,2,3)));

    if ($request === true) {
        $request_id = Secure($_POST['id']);
        if ($_POST['a'] == 1) {
            $request_data = $db->where('id',$request_id)->getOne(T_AGENT_REQUESTS);
            if (!empty($request_data) && $request_data->status != 1) {
                $requiring = $db->where('id',$request_data->user_id)->getOne(T_USERS);
                if (!empty($requiring)) {
                    $db->where('id',$request_data->user_id)->update(T_USERS,array(
                        'active' =>1
                    ));

                    $update_data = array(
                        'URL' => $kd->config->site_url,
                        'NAME' =>  $requiring->first_name . ' '. $requiring->last_name,
                     );
                    $send_email_data = array(
                        'from_email' => $kd->config->email,
                        'from_name' => $kd->config->name,
                        'to_email' => $requiring->email,
                        'to_name' => $requiring->first_name . ' '. $requiring->last_name,
                        'subject' => __('account_registration_approval'),
                        'charSet' => 'UTF-8',
                        'message_body' => LoadPage('email/account_registration_approved', $update_data),
                        'is_html' => true
                    );
                    $send_message = SendMessage($send_email_data);

                }
            }
            $db->where('id',$request_id)->update(T_AGENT_REQUESTS,array('status' => 1));
        }
        else if ($_POST['a'] == 2) {
            $db->where('id',$request_id)->update(T_AGENT_REQUESTS,array('status' => 2));
        }
        else if ($_POST['a'] == 3) {
            $db->where('id',$request_id)->delete(T_AGENT_REQUESTS);
        }
        $data = array(
            'status' => 200,
            'message' => 'Success'
           
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'error',
        );
    }
}