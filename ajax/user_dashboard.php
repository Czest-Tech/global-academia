<?php 
  
    if ($first == 'get_user_applications') {
        if($kd->user->account_type == "applicant"){
            $get_user_applications = $db->where("user_id", $kd->user->id)->getOne(T_APPLICATIONS);
            $get_univiversities = $db->where("email", $get_user_applications->email)->get(T_APPLICANT_UNIVERSITIES);
            $get_pending_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "queued")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            $get_accepted_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "accepted")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            $get_rejected_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "rejected")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            $get_user_notificatins = $db->where('recipient_id', $kd->user->id)->get(T_USER_NOTIFACATIONS);
            $get_user_notificatins_count = $db->where('recipient_id', $kd->user->id)->where("seen", 0)->getValue(T_USER_NOTIFACATIONS, "count(*)");

            foreach($get_univiversities as $allProgram){
                $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                $allProgram->program_id = GetProgramByID($allProgram->program_id);
                $allProgram->payment_receipt_file = GetMedia( $allProgram->payment_receipt_file);
                $allProgram->application_status_slug =  __($allProgram->application_status);
                $allProgram->name = $kd->user->first_name . ' ' . $kd->user->last_name;
            }
            foreach($get_user_notificatins as $nf){
                if($nf->type == "application_status"){
                $nf->subject = "Application status update";


                } else {
                    $nf->subject = "New message from Global Academia";

                }
                $nf->url = UrlLink($nf->url);
            }

        
            if( $get_user_applications) {
                
                $data = array(
                    'status' => 200,
                    'user_data' => $kd->user,
                    'application_data' => $get_user_applications,
                    'applied_to_universities' => $get_univiversities,
                    'number_of_applications' => count($get_univiversities),
                    'number_of_pending_applications' => $get_pending_application_count,
                    'number_of_accepted_applications' => $get_accepted_application_count,
                    'number_of_rejected_applications' => $get_rejected_application_count,
                    'user_notifications' => $get_user_notificatins,
                    'user_new_notification_count' => $get_user_notificatins_count,
                    // 'user_number_of_applicaions' => GetUserAppliedToUniversities($email, 'applicant')


                );
            } else {
                
                $send_errors_data = array(
                    'status' => 400,
                    'message' => "ERROR",
                
                );
            }
        } 
        elseif($kd->user->account_type == "agent"){
            $get_user_notificatins = $db->where('recipient_id', $kd->user->id)->get(T_USER_NOTIFACATIONS);
            $get_user_notificatins_count = $db->where('recipient_id', $kd->user->id)->where("seen", 0)->getValue(T_USER_NOTIFACATIONS, "count(*)");
            $get_applicant_unversities = $db->where('applied_by', $kd->user->id)->get(T_APPLICANT_UNIVERSITIES);
            $get_pending_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "queued")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            $get_accepted_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "accepted")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            $get_rejected_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "rejected")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
            foreach($get_applicant_unversities as $allProgram){
                $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                $allProgram->program_id = GetProgramByID($allProgram->program_id);
                $allProgram->application_status_slug =  __($allProgram->application_status);
                $allProgram->name = GetstudentName($allProgram->student_id);
                $allProgram->payment_receipt_file = GetMedia($allProgram->payment_receipt_file);

            }
            foreach($get_user_notificatins as $nf){
                if($nf->type == "application_status"){
                $nf->subject = "Application status update";


                } else {
                    $nf->subject = "New message from Global Academia";

                }
                $nf->url = UrlLink($nf->url);
            }

       
            $get_user_applications = '';
            $get_univiversities = array();
           
           

        
            if( true) {
                
                $data = array(
                    'status' => 200,
                    'user_data' => $kd->user,
                    'application_data' => $get_user_applications,
                    'applied_to_universities' => $get_applicant_unversities,
                    'number_of_applications' => count($get_applicant_unversities),
                    'number_of_pending_applications' => $get_pending_application_count,
                    'number_of_accepted_applications' => $get_accepted_application_count,
                    'number_of_rejected_applications' => $get_rejected_application_count,
                    'user_notifications' => $get_user_notificatins,
                    'user_new_notification_count' => $get_user_notificatins_count,
                    // 'user_number_of_applicaions' => GetUserAppliedToUniversities($email, 'applicant')


                );
            } else {
                
                $send_errors_data = array(
                    'status' => 400,
                    'message' => "ERROR",
                
                );
            }
        }
    }

    if($first  === 'user_data'){
        $data = array(
            'status' => 200,
            'data' => $kd->user
        );
    }
    if($first  === 'update_education_user_info'){
        $update_education = new stdClass();
        $isSent = '';
       
        $update_education->type = "multiple";
        $update_education->created_at = time();
        $update_education->date_of_birth = Secure($_POST['date_of_birth']);
        $update_education->phone_number = Secure($_POST['phone']);
        $update_education->phone_number_2 = Secure($_POST['phone_2']);
        $update_education->fathers_name = Secure($_POST['fathers_name']);
        $update_education->mothers_name = Secure($_POST['mothers_name']);
        $update_education->passport_number = Secure($_POST['passport']);
        $update_education->first_name  = $kd->user->first_name;
        $update_education->last_name  = $kd->user->last_name;

        $update_education->nationality = Secure($_POST['nationality']);
        $update_education->country_of_residence = Secure($_POST['country_of_residence']);
        if($db->where('user_id', $kd->user->id)->getOne(T_APPLICANT_EDUCATION_INFO)){
          $update_educationa_data = $db->where('user_id', $kd->user->id)->update(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
        } else {
            $update_education->user_id =  $kd->user->id;
            $update_educationa_data = $db->insert(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));

        }
        if($update_educationa_data){
            $get_data = $db->where('user_id', $kd->user->id)->get(T_APPLICANT_EDUCATION_INFO);

            $data = array(
                'status' => 200,
                'data' => $get_data,
                'user_data' => $kd->user,
               
             );
        } else {
            $data = array(
                'status' => 401,
                'message' => __('your_application_was_submited'),
                'url' => UrlLink($redirectlink)
             );
        }
    }
    if($first  === 'update_education_documents'){
        $update_education = new stdClass();
        $isSent = '';
        if (!empty($_FILES['id_photo']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['id_photo']['tmp_name'],
                'size' => $_FILES['id_photo']['size'],
                'name' => $_FILES['id_photo']['name'],
                'type' => $_FILES['id_photo']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'id_photo'
            );
            $update_education->id_photo_name = $_FILES['id_photo']['name'];
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->id_photo = $file_upload['filename'];
                
            }
        }
        
        if (!empty($_FILES['passport_file']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['passport_file']['tmp_name'],
                'size' => $_FILES['passport_file']['size'],
                'name' => $_FILES['passport_file']['name'],
                'type' => $_FILES['passport_file']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'passport_file'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->passport_file = $file_upload['filename'];
                $update_education->passport_name = $_FILES['passport_file']['name'];
            }
        }
        if (!empty($_FILES['diploma_file']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['diploma_file']['tmp_name'],
                'size' => $_FILES['diploma_file']['size'],
                'name' => $_FILES['diploma_file']['name'],
                'type' => $_FILES['diploma_file']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'diploma_file'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->diploma_file = $file_upload['filename'];
                $update_education->diploma_name = $_FILES['diploma_file']['name'];
            }
        }
        if (!empty($_FILES['transcript_file']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['transcript_file']['tmp_name'],
                'size' => $_FILES['transcript_file']['size'],
                'name' => $_FILES['transcript_file']['name'],
                'type' => $_FILES['transcript_file']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'transcript_file'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->transcript_file = $file_upload['filename'];
                $update_education->transcript_name = $_FILES['transcript_file']['name'];
            }
        }
        if (!empty($_FILES['language_certificate']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['language_certificate']['tmp_name'],
                'size' => $_FILES['language_certificate']['size'],
                'name' => $_FILES['language_certificate']['name'],
                'type' => $_FILES['language_certificate']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'language_certificate'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->language_certificate = $file_upload['filename'];
                $update_education->language_certificate_name = $_FILES['language_certificate']['name'];
            }
        }
        if (!empty($_FILES['other_files']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['other_files']['tmp_name'],
                'size' => $_FILES['other_files']['size'],
                'name' => $_FILES['other_files']['name'],
                'type' => $_FILES['other_files']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'other_files'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->other_files = $file_upload['filename'];
            }
        }
 
        if($db->where('user_id',Secure($_POST['user_id']))->getOne(T_APPLICANT_EDUCATION_INFO)){
            $update_educationa_data = $db->where('user_id',Secure($_POST['user_id']))->update(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
          } else {
              $update_education->user_id = Secure($_POST['user_id']);
              $update_educationa_data = $db->insert(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
  
          }
        if($update_educationa_data){
            $get_data = $db->where('user_id', $kd->user->id)->get(T_APPLICANT_EDUCATION_INFO);

            $data = array(
                'status' => 200,
                'data' => $get_data,
                'user_data' => $kd->user,
             );
        } else {
            $data = array(
                'status' => 401,
                'message' => __('your_application_was_submited'),
             );
        }
    }

if($first === "get_user_messages"){
    $new_message = $db->where('applicant_email', $kd->user->email)->get(T_APPLICANT_CHAT);
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
}
// if($first === "get_user_settings"){
//     $settings = new stdClass();
//     $user_settings = UserData($kd->user->id);
//     $settings->  
    
//     $data = array(
//         'status' => 200,
//         'data' => 
//     );
     
// }

if($first === "get_user_application"){

    if(!empty($_GET['user_id']) && !empty($_GET['id']) ){
        $get_univiversities = $db->where("id", Secure($_GET['id']))->get(T_APPLICANT_UNIVERSITIES);
        
        foreach($get_univiversities as $allProgram){
            $allProgram->university_id = GetuniversityByID($allProgram->university_id);
            $allProgram->program_id = GetProgramByID($allProgram->program_id);
            $allProgram->application_status_slug =  __($allProgram->application_status);
        }


        $data = array(
            'status' => 200,
            'applicant_university' => $get_univiversities,
            'applicant_info' => $kd->user
        );
    } else  {
         
        $data = array(
            'status' => 400,
            'message' => "ERROR",
        
        );
    }
}

if($first === "get_agent_students"){
    $get_univiversities = array();
    if($kd->user->account_type === "agent"){
       
        if(isset($_GET['api_type']) && Secure($_GET['api_type']) === 'single'  && !empty(Secure($_GET['id']))) {
  
            $get_applicant_data = $db->where('applied_by', $kd->user->id)->where('id',Secure($_GET['id']))->getOne(T_APPLICANT_UNIVERSITIES);

            $agent_students = $db->where('agent_id', $kd->user->id)->where('id',$get_applicant_data->student_id)->getOne(T_AGENT_STUDENTS);
            $get_univiversities = $db->where("email", $agent_students->email)->get(T_APPLICANT_UNIVERSITIES);
            $agent_students->transcript_file = GetMedia($agent_students->transcript_file);
            $agent_students->id_photo = GetMedia($agent_students->id_photo);
            $agent_students->language_certificate = GetMedia($agent_students->language_certificate);
            $agent_students->passport_file = GetMedia($agent_students->passport_file);
            $agent_students->passport_file = GetMedia($agent_students->passport_file);
            foreach($get_univiversities as $allProgram){
                $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                $allProgram->program_id = GetProgramByID($allProgram->program_id);
                $allProgram->application_status_slug =  __($allProgram->application_status);
            }
        }
        else if(isset($_GET['api_type'])  && Secure($_GET['api_type']) === 'get_student'  && !empty(Secure($_GET['id']))){
       
            $agent_students = $db->where('id',Secure($_GET['id']))->getOne(T_AGENT_STUDENTS);
            if($agent_students){
                    $agent_students->transcript_file = GetMedia($agent_students->transcript_file);
                    $agent_students->id_photo = GetMedia($agent_students->id_photo);
                    $agent_students->language_certificate = GetMedia($agent_students->language_certificate);
                    $agent_students->passport_file = GetMedia($agent_students->passport_file);
                    $agent_students->passport_file = GetMedia($agent_students->passport_file);
                $get_univiversities = $db->where("email", $agent_students->email)->get(T_APPLICANT_UNIVERSITIES);
                if($get_univiversities){
                    
                    foreach($get_univiversities as $allProgram){
                        $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                        $allProgram->program_id = GetProgramByID($allProgram->program_id);
                        $allProgram->application_status_slug =  __($allProgram->application_status);
                    }
                }
            }
            
        } 
        else {
            $agent_students = $db->where('agent_id', $kd->user->id)->get(T_AGENT_STUDENTS);
        }
        

        if($agent_students){
            $data = array(
                'status' => 200,
                'applicant_info' => $agent_students,
                'applicant_university' => $get_univiversities,
                
            );
        } else {
            $data = array(
                'status' => 301,
                'data' => [],
                'message' => 'no records'
                
            );
        } 
    } else {
        $get_univiversities = $db->where("id", Secure($_GET['id']))->get(T_APPLICANT_UNIVERSITIES);
        
        foreach($get_univiversities as $allProgram){
            $allProgram->university_id = GetuniversityByID($allProgram->university_id);
            $allProgram->program_id = GetProgramByID($allProgram->program_id);
            $allProgram->application_status_slug =  __($allProgram->application_status);
        }
       
        $get_student_info  = $db->where('user_id', $kd->user->id)->getOne(T_APPLICANT_EDUCATION_INFO);
        $get_student_info->first_name = $kd->user->first_name;
        $get_student_info->last_name =  $kd->user->last_name;
        $get_student_info->email = $kd->user->email;
        $get_student_info->transcript_file = GetMedia($get_student_info->transcript_file);
        $get_student_info->id_photo = GetMedia($get_student_info->id_photo);
        $get_student_info->language_certificate = GetMedia($get_student_info->language_certificate);
        $get_student_info->passport_file = GetMedia($get_student_info->passport_file);
        $get_student_info->passport_file = GetMedia($get_student_info->passport_file);

     

        $data = array(
            'status' => 200,
            'applicant_university' => $get_univiversities,
            'applicant_info' => $get_student_info
        );
    }
    
  
}
if($first  === "add_agent_student"){
    $update_education = new stdClass();
    $isSent = '';
    $randon_divider = random_str(3);

    $firstname       = Secure($_POST['first_name']);
    $lastname       = Secure($_POST['last_name']);
    $username = $firstname.'_'.$lastname.'_'.$randon_divider;   

    $update_education->type = "multiple";
    $update_education->username = $username;
    $update_education->created_at = time();
    $update_education->time = time();
    $update_education->first_name = $firstname;
    $update_education->last_name = $lastname;
    $update_education->date_of_birth = Secure($_POST['date_of_birth']);
    $update_education->email = Secure($_POST['email']);
    $update_education->phone_number = Secure($_POST['phone_number']);
    $update_education->phone_number_2 = Secure($_POST['phone_number_2']);
    $update_education->agent_id = $kd->user->id;
    $update_education->fathers_name = Secure($_POST['fathers_name']);
    $update_education->time = time();
    $update_education->mothers_name = Secure($_POST['mothers_name']);
    $update_education->passport_number = Secure($_POST['passport_number']);
    $update_education->nationality = Secure($_POST['nationality']);
    $update_education->country_of_residence = Secure($_POST['country_of_residence']);
    $update_educationa_data = $db->insert(T_AGENT_STUDENTS, ToArray($update_education));
    
    if($update_educationa_data){

        $get_data = $db->where('agent_id', $kd->user->id)->get(T_AGENT_STUDENTS);

        $data = array(
            'status' => 200,
            'data' => $get_data,
            'message' => "user added"
           
         );
    } else {
        $data = array(
            'status' => 401,
            'message' => __('error'),
            'url' => UrlLink($redirectlink)
         );
    }
    
}
if($first  === "update_agent_student"){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $update_education = new stdClass();
        $isSent = '';
        $randon_divider = random_str(4);
    
        $firstname       = Secure($_POST['first_name']);
        $lastname       = Secure($_POST['last_name']);
    
        


    $update_education->type = "multiple";
    $update_education->first_name = $firstname;
    $update_education->last_name = $lastname;
    $update_education->date_of_birth = Secure($_POST['date_of_birth']);
    $update_education->email = Secure($_POST['email']);
    $update_education->phone_number = Secure($_POST['phone_number']);
    $update_education->phone_number_2 = Secure($_POST['phone_number_2']);
    $update_education->agent_id = $kd->user->id;
    $update_education->fathers_name = Secure($_POST['fathers_name']);
    $update_education->mothers_name = Secure($_POST['mothers_name']);
    $update_education->passport_number = Secure($_POST['passport_number']);
    $update_education->nationality = Secure($_POST['nationality']);
    $update_education->country_of_residence = Secure($_POST['country_of_residence']);     
    $update_educationa_data = $db->where('id', Secure($_POST['id']))->update(T_AGENT_STUDENTS, ToArray($update_education));
   
        if($update_educationa_data){
            $get_data = $db->where('agent_id', $kd->user->id)->get(T_AGENT_STUDENTS);
    
            $data = array(
                'status' => 200,
                'data' => $get_data,
                'message' => __('success')
               
             );
        } else {
            $data = array(
                'status' => 401,
                'message' => __('error'),
             );
        }
        
    }else {
        $data = array(
            'status' => 400,
            'message' => __('error'),
         );
    }
   
}
if($first  === "delete_agent_student"){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        
        $delet_educationa_data = $db->where('id', Secure($_POST['id']))->getOne(T_AGENT_STUDENTS);
        if($delet_educationa_data){
             $db->where("email", $delet_educationa_data->email)->delete(T_APPLICANT_UNIVERSITIES);
             $db->where('id', Secure($_POST['id']))->delete(T_AGENT_STUDENTS);

            $get_data = $db->where('agent_id', $kd->user->id)->get(T_AGENT_STUDENTS);
    
            $data = array(
                'status' => 200,
                'data' => $get_data,
                'message' => __('success')
               
             );
        } else {
            $data = array(
                'status' => 401,
                'message' => __('error'),
                'url' => UrlLink($redirectlink)
             );
        }
        
    }else {
        $data = array(
            'status' => 400,
            'message' => __('error'),
            'url' => UrlLink($redirectlink)
         );
    }
   
}
if ($first == 'save-settings') {
    $submit_data = array();
    foreach ($_POST as $key => $settings_to_save) {
        if ($key != 'ffmpeg_binary_file') {
            $submit_data[$key] = $settings_to_save;
        }
        else{
            if (empty($settings_to_save)) {
                $submit_data[$key] = $settings_to_save;
            }
            if (file_exists($settings_to_save)) {
                $submit_data[$key] = $settings_to_save;
            }
        }
    }
    $update = false;
    if (!empty($submit_data)) {
        foreach ($submit_data as $key => $value) {
          
            
                $update = $db->where('id', $kd->user->id)->update(T_USERS, array($key  => $value));
            }
        

        
    }
    if ($update) {
        $data = array('status' => 200);
    }
}
if($first === "get_agent_applicant_list"){

    if($kd->user->account_type === "agent"){
        $get_user = $db->where('agent_id', $kd->user->id)->get(T_AGENT_STUDENTS);

        if($get_user){
            $data = array(
                'status' => 200,
                'students' => $get_user
                
            );
        } else {
            $data = array(
                'status' => 301,
                'data' => [],
                'message' => 'no records'
                
            );
        } 
    }else {
        $data = array(
            'status' => 401,
            'message' => 'access denied'
            
        );
    } 
}
if($first == "upload_missing"){
    $errors = [];
    $application_data = new stdClass();
    $redirectlink = "status";

    if (!empty($_FILES['id_photo']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['id_photo']['tmp_name'],
            'size' => $_FILES['id_photo']['size'],
            'name' => $_FILES['id_photo']['name'],
            'type' => $_FILES['id_photo']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'id_photo'
        );
        $application_data->id_photo_name = $_FILES['id_photo']['name'];
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->id_photo = $file_upload['filename'];
            
        }
    }
   
    if (!empty($_FILES['passport_file']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['passport_file']['tmp_name'],
            'size' => $_FILES['passport_file']['size'],
            'name' => $_FILES['passport_file']['name'],
            'type' => $_FILES['passport_file']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'passport_file'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->passport_file = $file_upload['filename'];
            $application_data->passport_name = $_FILES['passport_file']['name'];
        }
    }
    if (!empty($_FILES['diploma_file']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['diploma_file']['tmp_name'],
            'size' => $_FILES['diploma_file']['size'],
            'name' => $_FILES['diploma_file']['name'],
            'type' => $_FILES['diploma_file']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'diploma_file'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->diploma_file = $file_upload['filename'];
            $application_data->diploma_name = $_FILES['diploma_file']['name'];
        }
    }
    if (!empty($_FILES['transcript_file']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['transcript_file']['tmp_name'],
            'size' => $_FILES['transcript_file']['size'],
            'name' => $_FILES['transcript_file']['name'],
            'type' => $_FILES['transcript_file']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'transcript_file'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->transcript_file = $file_upload['filename'];
            $application_data->transcript_name = $_FILES['transcript_file']['name'];
        }
    }
    if (!empty($_FILES['language_certificate']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['language_certificate']['tmp_name'],
            'size' => $_FILES['language_certificate']['size'],
            'name' => $_FILES['language_certificate']['name'],
            'type' => $_FILES['language_certificate']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'language_certificate'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->language_certificate = $file_upload['filename'];
            $application_data->language_certificate_name = $_FILES['language_certificate']['name'];
        }
    }
    if (!empty($_FILES['other_files']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['other_files']['tmp_name'],
            'size' => $_FILES['other_files']['size'],
            'name' => $_FILES['other_files']['name'],
            'type' => $_FILES['other_files']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'other_files'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $application_data->other_files = $file_upload['filename'];
        }
    }
 
    $upload_missing_filest = $db->where('id',Secure($_POST['id']))->update(T_AGENT_STUDENTS,ToArray($application_data)); 
    
    if($upload_missing_filest){

        $agent_students = $db->where('id',Secure($_POST['id']))->getOne(T_AGENT_STUDENTS);
        if($agent_students){
            $get_univiversities = $db->where("email", $agent_students->email)->get(T_APPLICANT_UNIVERSITIES);
            if($get_univiversities){
                $agent_students->transcript_file = GetMedia($agent_students->transcript_file);
                $agent_students->id_photo = GetMedia($agent_students->id_photo);
                $agent_students->language_certificate = GetMedia($agent_students->language_certificate);
                $agent_students->passport_file = GetMedia($agent_students->passport_file);
                $agent_students->passport_file = GetMedia($agent_students->passport_file);
                foreach($get_univiversities as $allProgram){
                    $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                    $allProgram->program_id = GetProgramByID($allProgram->program_id);
                    $allProgram->application_status_slug =  __($allProgram->application_status);
                }
            }
        }
        $data = array(
            'status' => 200,
            'applicant_info' => $agent_students,
            'applicant_university' => $get_univiversities,
            
        );
    } else {
        $data = array(
            'status' => 400,
            'error' => 'not updated',
            
        );
    }   

}
if($first  === 'upload_receipt'){
    if(!empty($_POST['id'])) {
        $update_education = new stdClass();
        $isSent = '';
        if (!empty($_FILES['payment_receipt_file']['tmp_name'])) {
            $file_info = array(
                'file' => $_FILES['payment_receipt_file']['tmp_name'],
                'size' => $_FILES['payment_receipt_file']['size'],
                'name' => $_FILES['payment_receipt_file']['name'],
                'type' => $_FILES['payment_receipt_file']['type'],
                'crop' => array('width' => 400, 'height' => 400),
                'mode' => 'id_photo'
            );
            $update_education->payment_receipt_file_name = $_FILES['payment_receipt_file']['name'];
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $update_education->payment_receipt_file = $file_upload['filename'];
                
            }
            $uplouad_receipt = $db->where('id',Secure($_POST['id']))->update(T_APPLICANT_UNIVERSITIES, ToArray($update_education));
            if($uplouad_receipt){
                $data = array(
                    'status' => 200,
                    'message' => lang('receipt uploaded'),
                    
                );
            }
        } else{
            $data = array(
                'status' => 400,
                'error' => lang('file name can not be empty'),
                
            );
        }
    } else {
        $data = array(
            'status' => 400,
            'error' => lang('id can not be empty'),
            
        );
    }   
  


}
if($first  === "delete_agent_application"){
    if(isset($_GET['id']) && !empty($_GET['id'])){
        
        $delet_educationa_data = $db->where('id', Secure($_GET['id']))->delete(T_APPLICANT_UNIVERSITIES);
        if($delet_educationa_data){
            if($kd->user->account_type == "applicant"){
                $get_user_applications = $db->where("user_id", $kd->user->id)->getOne(T_APPLICATIONS);
                $get_univiversities = $db->where("email", $get_user_applications->email)->get(T_APPLICANT_UNIVERSITIES);
                $get_pending_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "queued")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                $get_accepted_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "accepted")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                $get_rejected_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "rejected")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                $get_user_notificatins = $db->where('recipient_id', $kd->user->id)->get(T_USER_NOTIFACATIONS);
                $get_user_notificatins_count = $db->where('recipient_id', $kd->user->id)->where("seen", 0)->getValue(T_USER_NOTIFACATIONS, "count(*)");
    
                foreach($get_univiversities as $allProgram){
                    $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                    $allProgram->program_id = GetProgramByID($allProgram->program_id);
                    $allProgram->payment_receipt_file = GetMedia( $allProgram->payment_receipt_file);
                    $allProgram->name = $kd->user->first_name . ' ' . $kd->user->last_name;

                    $allProgram->application_status_slug =  __($allProgram->application_status);
                }
                foreach($get_user_notificatins as $nf){
                    if($nf->type == "application_status"){
                    $nf->subject = "Application status update";
    
    
                    } else {
                        $nf->subject = "New message from Global Academia";
    
                    }
                    $nf->url = UrlLink($nf->url);
                }
    
            
                if( $get_user_applications) {
                    
                    $data = array(
                        'status' => 200,
                        'user_data' => $kd->user,
                        'application_data' => $get_user_applications,
                        'applied_to_universities' => $get_univiversities,
                        'number_of_applications' => count($get_univiversities),
                        'number_of_pending_applications' => $get_pending_application_count,
                        'number_of_accepted_applications' => $get_accepted_application_count,
                        'number_of_rejected_applications' => $get_rejected_application_count,
                        'user_notifications' => $get_user_notificatins,
                        'user_new_notification_count' => $get_user_notificatins_count,
                        // 'user_number_of_applicaions' => GetUserAppliedToUniversities($email, 'applicant')
    
    
                    );
                } else {
                    
                    $send_errors_data = array(
                        'status' => 400,
                        'message' => "ERROR",
                    
                    );
                }
            } 
            elseif($kd->user->account_type == "agent"){
                $get_user_notificatins = $db->where('recipient_id', $kd->user->id)->get(T_USER_NOTIFACATIONS);
                $get_user_notificatins_count = $db->where('recipient_id', $kd->user->id)->where("seen", 0)->getValue(T_USER_NOTIFACATIONS, "count(*)");
                $get_applicant_unversities = $db->where('applied_by', $kd->user->id)->get(T_APPLICANT_UNIVERSITIES);
                $get_pending_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "queued")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                $get_accepted_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "accepted")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                $get_rejected_application_count =  $db->where('applied_by', $kd->user->id)->where("is_checked", "rejected")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
                foreach($get_applicant_unversities as $allProgram){
                    $allProgram->university_id = GetuniversityByID($allProgram->university_id);
                    $allProgram->program_id = GetProgramByID($allProgram->program_id);
                    $allProgram->application_status_slug =  __($allProgram->application_status);
                    $allProgram->name = GetstudentName($allProgram->student_id);
                    $allProgram->payment_receipt_file = GetMedia($allProgram->payment_receipt_file);
    
                }
                foreach($get_user_notificatins as $nf){
                    if($nf->type == "application_status"){
                    $nf->subject = "Application status update";
    
    
                    } else {
                        $nf->subject = "New message from Global Academia";
    
                    }
                    $nf->url = UrlLink($nf->url);
                }
    
           
                $get_user_applications = '';
                $get_univiversities = array();
               
               
    
            
                if( true) {
                    
                    $data = array(
                        'status' => 200,
                        'user_data' => $kd->user,
                        'application_data' => $get_user_applications,
                        'applied_to_universities' => $get_applicant_unversities,
                        'number_of_applications' => count($get_applicant_unversities),
                        'number_of_pending_applications' => $get_pending_application_count,
                        'number_of_accepted_applications' => $get_accepted_application_count,
                        'number_of_rejected_applications' => $get_rejected_application_count,
                        'user_notifications' => $get_user_notificatins,
                        'user_new_notification_count' => $get_user_notificatins_count,
                        // 'user_number_of_applicaions' => GetUserAppliedToUniversities($email, 'applicant')
    
    
                    );
                } else {
                    
                    $send_errors_data = array(
                        'status' => 400,
                        'message' => "ERROR",
                    
                    );
                }
            }
        } else {
            $data = array(
                'status' => 401,
                'message' => __('error'),
                'url' => UrlLink($redirectlink)
             );
        }
        
    }else {
        $data = array(
            'status' => 400,
            'message' => __('error'),
            'url' => UrlLink($redirectlink)
         );
    }
   
}
if($first == "update_user_info"){
    $user_id = Secure($_POST['user_id']);
    $first_name = Secure($_POST['first_name']);
    $last_name = Secure($_POST['last_name']);

    $data_save = new StdClass();
    $data_save->last_name = $last_name;
    $data_save->first_name = $first_name;

    $update =  $db->where('id', $user_id)->update(T_USERS,ToArray($data_save));
    $data =  $db->where('user_id', $user_id)->update(T_APPLICANT_EDUCATION_INFO,ToArray($data_save));
    if($update){
        $data = array(
            'status' => 200           
        );

    } else {
        $data = array(
            'status' => 400,
            'message' => __('error')
            
         );
    }


}