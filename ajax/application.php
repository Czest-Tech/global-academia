<?php 

if($first == "single" ){

    $errors = [];
    $email = !empty(Secure($_POST['email']))? Secure($_POST['email']) : $kd->user->email;
    $isSent = '';
    $referencetrack = '';
    $uniqid =  random_str(4, '12345634608974');

    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    if(!empty($_POST['user_id']) && $_POST['user_id'] !== 0){
        $application_data->user_id = Secure($_POST['user_id']);
    }  
    $application_data->applicant_type = Secure($_POST['applicant_type']);

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
    
        $application_data->university_id = Secure($_POST['university_id']);
        $application_data->program_id = Secure($_POST['program_id']);
        $application_data->first_name = Secure($_POST['first_name']);
        $application_data->created_at = time();
        $application_data->last_name = Secure($_POST['last_name']);
        $application_data->date_of_birth = Secure($_POST['date_of_birth']);
        $application_data->phone_number = Secure($_POST['phone_number']);
        $application_data->phone_number_2 = Secure($_POST['phone_number_2']);
        $application_data->email = $email;
        $application_data->fathers_name = Secure($_POST['fathers_name']);
        $application_data->mothers_name = Secure($_POST['mothers_name']);
        $application_data->passport_number = Secure($_POST['passport_number']);
        $application_data->nationality = Secure($_POST['nationality']);
        $application_data->country_of_residence = Secure($_POST['country_of_residence']);
        $application_data->middle_name = Secure($_POST['middle_name']);
    
    $application_data->application_no = $uniqid;


    $application_sent = false;
    $check_email_exists = $db->where('email', $email)->getOne(T_APPLICATIONS);
    if($check_email_exists){
        $grouped_applications->uniqid = $uniqid;
        $grouped_applications->email = $email;
        $grouped_applications->university_id = Secure($_POST['university_id']);
        $grouped_applications->program_id = Secure($_POST['program_id']);
        $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
        $referencetrack = $check_email_exists->application_no;
        if($push_application_data){
            $application_sent = true;
        }
      
    } else {
       $isSent = $db->insert(T_APPLICATIONS, ToArray($application_data));
       if($isSent){
            $referencetrack = $uniqid;
            $grouped_applications->email = $email;
            $grouped_applications->university_id = Secure($_POST['university_id']);
            $grouped_applications->program_id = Secure($_POST['program_id']);
            $grouped_applications->uniqid = $uniqid;
            $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
            if($push_application_data){
                $application_sent = true;
            }
        } 
    }

    if($application_sent){
       
        $redirectlink = "";
        $redirectlink = "university-details/".$application_data->university_id;
        $message = 'Your Application was Recieved '. $kd->config->name;
        $update_data = array(
           'UNIVERSITY' =>  GetuniversityByID($application_data->university_id),
           'PROGRAM' => GetProgramByID($application_data->program_id),
           'TRACKING_CODE' =>  $referencetrack,
           'URL' => UrlLink('status'),
           'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
        );
        $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $application_data->email,
            'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
            'subject' => 'Application Recieved',
            'charSet' => 'UTF-8',
            'message_body' => LoadPage('email/application_sent', $update_data),
            'is_html' => true
        );
        $send_message = SendMessage($send_email_data);
        // SendSMSMessage($application_data->phone_number, $message);
        
        $notif_data = array(
            'notifier_id' => 0,
            'recipient_id' => 2,
            'job_id' => '0',
            'type' => 'job_applied',
            'text' => ' Applied at <b>'.GetuniversityByID($application_data->university_id). '</b> in'.GetProgramByID($application_data->program_id).'</b>', 
            'url' => ('/admin-cp/view-application?id='.$uniqid),
            'time' => time(),
            'target' => 'all',
        );
        Notify($notif_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'url' => UrlLink($redirectlink)
        );
    
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    

   

}
if($first == "single_agent" ){

    $errors = [];
    $email = !empty(Secure($_POST['email']))? Secure($_POST['email']) : $kd->user->email;
    $isSent = '';
    $referencetrack = '';
    $uniqid =  random_str(4, '12345634608974');

    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    if(!empty($_POST['user_id']) && $_POST['user_id'] !== 0){
        $application_data->user_id = Secure($_POST['user_id']);
    }  
    $applicant_type = Secure($_POST['applicant_type']);
    $student_id = Secure($_POST['multiple_applicants']);
    if($applicant_type === "agent"){
      

        if(!empty($student_id)){
            foreach($student_id as $sid){
                $get_applicant_info = $db->where('id', $sid)->getOne(T_AGENT_STUDENTS);

                var_dump($get_applicant_info);
            }
        }
    }
     
    
    $application_data->application_no = $uniqid;


    $application_sent = false;
    $check_email_exists = $db->where('email', $email)->getOne(T_APPLICATIONS);
    // if($check_email_exists){
    //     $grouped_applications->uniqid = $uniqid;
    //     $grouped_applications->email = $email;
    //     $grouped_applications->university_id = Secure($_POST['university_id']);
    //     $grouped_applications->program_id = Secure($_POST['program_id']);
    //     $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
    //     $referencetrack = $check_email_exists->application_no;
    //     if($push_application_data){
    //         $application_sent = true;
    //     }
      
    // } else {
    //    $isSent = $db->insert(T_APPLICATIONS, ToArray($application_data));
    //    if($isSent){
    //         $referencetrack = $uniqid;
    //         $grouped_applications->email = $email;
    //         $grouped_applications->university_id = Secure($_POST['university_id']);
    //         $grouped_applications->program_id = Secure($_POST['program_id']);
    //         $grouped_applications->uniqid = $uniqid;
    //         $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
    //         if($push_application_data){
    //             $application_sent = true;
    //         }
    //     } 
    // }

    // if($application_sent){
       
    //     $redirectlink = "";
    //     $redirectlink = "university-details/".$application_data->university_id;
    //     $message = 'Your Application was Recieved '. $kd->config->name;
    //     $update_data = array(
    //        'UNIVERSITY' =>  GetuniversityByID($application_data->university_id),
    //        'PROGRAM' => GetProgramByID($application_data->program_id),
    //        'TRACKING_CODE' =>  $referencetrack,
    //        'URL' => UrlLink('status'),
    //        'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
    //     );
    //     $send_email_data = array(
    //         'from_email' => $kd->config->email,
    //         'from_name' => $kd->config->name,
    //         'to_email' => $application_data->email,
    //         'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
    //         'subject' => 'Application Recieved',
    //         'charSet' => 'UTF-8',
    //         'message_body' => LoadPage('email/application_sent', $update_data),
    //         'is_html' => true
    //     );
    //     $send_message = SendMessage($send_email_data);
    //     // SendSMSMessage($application_data->phone_number, $message);
        
    //     $notif_data = array(
    //         'notifier_id' => 0,
    //         'recipient_id' => 2,
    //         'job_id' => '0',
    //         'type' => 'job_applied',
    //         'text' => ' Applied at <b>'.GetuniversityByID($application_data->university_id). '</b> in'.GetProgramByID($application_data->program_id).'</b>', 
    //         'url' => ('/admin-cp/view-application?id='.$uniqid),
    //         'time' => time(),
    //         'target' => 'all',
    //     );
    //     Notify($notif_data);
    //     $data = array(
    //        'status' => 200,
    //        'message' => __('your_application_was_submited'),
    //        'url' => UrlLink($redirectlink)
    //     );
    
    // } else {
    //     $data = array(
    //        'status' => 400,
    //        'message' => 'error'
    //     );
    // }
    

   

}
if($first == "single_missing"){
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
    if(isset($_POST["change_program_id"]) && !empty($_POST["change_program_id"])){
        $university_id_fet = $db->where('id',$_POST["change_program_id"])->getOne(T_PROGRAM);

        $update['program_id'] = $_POST["change_program_id"];
        $update['university_id'] = $university_id_fet->university_id;
        $update["edit_request"] = "none";
        if($update){
            $updade_program = $db->where('id', Secure($_POST['id']))->update(T_APPLICANT_UNIVERSITIES, $update);
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
    $getEmail = $db->where('id', Secure($_POST['id']))->getOne(T_APPLICANT_UNIVERSITIES);
 
    $fet_email = $getEmail->email;

    if(!empty($getEmail->email) && count((array)$application_data) !==0){             
        $get_id = $db->where('email', $fet_email)->getOne(T_APPLICATIONS);
      
        $db->where('id', $get_id->id)->update(T_APPLICATIONS,ToArray($application_data));
    }
   
   
   
        $notif_data = array(
            'notifier_id' => 0,
            'recipient_id' => 2,
            'job_id' => '0',
            'type' => 'job_applied',
            'text' => 'Missing Documents updated</b>', 
            'url' => ('/admin-cp/manage-applications'),
            'time' => time(),
            'target' => 'all',
        );
        Notify($notif_data);
        $data = array(
        'status' => 200,
        'message' => __('your_application_was_submited'),
        'url' => UrlLink($redirectlink)
        );
  
    

}
if($first == "single_update" ){
    $errors = [];
    $application_data = new stdClass();
    // if(empty($_POST['university_id'])){
    //     exit("Ooop! We dont work like crooocks !");
    // }
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

    $isSent = '';
    $uniqid = Secure($_POST['uniqid']);
    $application_data->university_id = Secure($_POST['university_id']);
    $application_data->program_id = Secure($_POST['program_id']);
    $application_data->first_name = Secure($_POST['first_name']);
    $application_data->last_name = Secure($_POST['last_name']);
    $application_data->date_of_birth = Secure($_POST['date_of_birth']);
    $application_data->phone_number = Secure($_POST['phone_number']);
    $application_data->phone_number_2 = Secure($_POST['phone_number_2']);
    $application_data->email = Secure($_POST['email']);
    $application_data->fathers_name = Secure($_POST['fathers_name']);
    $application_data->mothers_name = Secure($_POST['mothers_name']);
    $application_data->passport_number = Secure($_POST['passport_number']);
    $application_data->nationality = Secure($_POST['nationality']);
    $application_data->country_of_residence = Secure($_POST['country_of_residence']);
    $application_data->application_no = $uniqid;
    $application_data->middle_name = Secure($_POST['middle_name']);
    
    $isSent = $db->where('id', Secure($_POST['application_id']))->update(T_APPLICATIONS, ToArray($application_data));
    if($isSent){
        $redirectlink = "";
        $redirectlink = "university-details/".$application_data->university_id;
        $message = 'Your Application was Recieved '. $kd->config->name;
        $update_data = array(
          'UNIVERSITY' =>  GetuniversityByID($application_data->university_id),
          'PROGRAM' => GetProgramByID($application_data->program_id),
           'URL' => UrlLink('status'),
           'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
        );
        // $send_email_data = array(
        //     'from_email' => $kd->config->email,
        //     'from_name' => $kd->config->name,
        //     'to_email' => $application_data->email,
        //     'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
        //     'subject' => 'Application Recieved',
        //     'charSet' => 'UTF-8',
        //     'message_body' => LoadPage('email/application_sent', $update_data),
        //     'is_html' => true
        // );
        // $send_message = SendMessage($send_email_data);
        // SendSMSMessage($application_data->phone_number, $message);
        
        $notif_data = array(
            'notifier_id' => 0,
            'recipient_id' => 2,
            'job_id' => '0',
            'type' => 'job_applied',
            'text' => 'Applied at <b>'.GetuniversityByID($application_data->university_id).'</b>in'.GetProgramByID($application_data->program_id).'</b>', 
            'url' => ('/admin-cp/view-application?id='.$uniqid),
            'time' => time(),
            'target' => 'all',
        );
        Notify($notif_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'url' => UrlLink($redirectlink)
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }

   

}
if($first == "status"){
    if(empty($_POST['email'])){
        exit('oOPs No email');
    }
    $status_html = '';
    $getEmail = $_POST['email'];
    $button = '';
    $button1 = '';
    $applicaion_no = '';
    $isSents = $db->where('reference_id',$getEmail )->getOne(T_APPLICATIONS);
     $isSent = $db->where('application_no',$isSents->application_no)->get(T_APPLICATIONS);
    if($isSent){
        foreach($isSent as $key => $rd){
            $applicaion_no = $rd->application_no;
            if($rd->status == 'diploma_missing' || $rd->status == 'transcript_missing' || $rd->status == 'passport_missing' || $rd->status == 'stamp_missing_on_transcript'|| $rd->status == 'stamp_missing_on_diploma'|| $rd->status == 'translation_of_transcript_missing'|| $rd->status == 'translation_of_highschool_diploma_missing'){
                $button = " <div class='add_missing'><a href='{{LINK edit_application}}/".$rd->id."' class='add_missing_documents'>".__($rd->status)."</a></div>";
            } 
            
            if($rd->ischecked === 'accepted') {
                $button1 = "<a href='".GetMedia($rd->acceptance_letter)."' class='accepted' download>". __('accepted_click_to_download_your_accpetance_letter')."</a>";

            }else if($rd->ischecked === 'rejected') {
                $button1 = '<a class="rejected">'.__('rejected').' </a>';
            } else {
                $button1 = '<a class="rejected">'.__('applied').' </a>';
            }
            $status_html .= LoadPage('cards/status', array(
                'university' => GetuniversityByID($rd->university_id),
                'program' =>  GetProgramByID($rd->program_id),
                'photo' => GetMedia($rd->id_photo),
                'status' => $rd->status,
                'name' => $rd->first_name . ' ' .$rd->middle_name .' '. $rd->last_name,
                'add_missing' => $button,
                'note' => $rd->note,
                'id' => $rd->id,
                'acceptance' => $button1
            ));
        }
         
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'html' => $status_html,
           'application_no' => $applicaion_no,
           'timestamp' => $isSents->created_at
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'No Applications Found'
        );
    }

}
if($first == "applicant_save_note"){
  $applicant_note  = $_GET['applicant_note'];
  $id  = $_GET['id'];
  $getdata = [];
    
  $getdata['applicant_note'] = $applicant_note;
 
 
 $isSent = $db->where('application_no',$id)->update(T_APPLICATIONS,$getdata );

 if($isSent){

 
   $data = array(
      'status' => 200,
      'message' => __('note_sent'),
   );
} else {
   $data = array(
      'status' => 400,
      'message' => 'error'
   );
}

}
if($first == "resend_status_id"){
    if(empty($_POST['email'])){
        exit('oOPs No email');
    }
    $getEmail = Secure($_POST['email']);
    $isSent = $db->where('passport_number',$getEmail )->get(T_APPLICATIONS);
    if($isSent){
        foreach($isSent as $rens){

            $update_data = array(
                'UNIVERSITY' =>  GetuniversityByID($rens->university_id),
                'PROGRAM' => GetProgramByID($rens->program_id),
                'SINGLE_CODE' => $rens->reference_id,
                'MULTIPLE_CODE' => $rens->application_no,
                'URL' => UrlLink('status'),
                'NAME' =>  $rens->first_name . ' ' .  $rens->middle_name .' '. $rens->last_name,
            );
            $send_email_data = array(
                'from_email' => $kd->config->email,
                'from_name' => $kd->config->name,
                'to_email' => $rens->email,
                'to_name' =>  $rens->first_name . ' ' .  $rens->middle_name .' '. $rens->last_name,
                'subject' => 'Application Code',
                'charSet' => 'UTF-8',
                'message_body' => LoadPage('email/application_resend', $update_data),
                'is_html' => true
            );
            $send = SendMessage($send_email_data);
            
            
        }

        $data = array(
            'status' => 200,
            'message' => __('your_application_was_submited'),
            
            
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'error'
        );
    }
}
if($first == "change_status"){
    if(empty($_GET['id'])){
        exit('oOPs No Id');
    }
    $data = array();
    $status_html = '';
     $getdata = [];
    
     $getdata['status'] = $_GET['status'];
     $update_data = array(
          'UNIVERSITY' =>   $_GET['university_name'],
          'PROGRAM' =>  $_GET['program_name'],
           'URL' => UrlLink('status'),
           'NAME' =>   $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
        );
    
    $isSent = $db->where('application_no', Secure($_GET['id']))->update(T_APPLICATIONS,$getdata );
    
    $send_acceptance = $db->where('application_no', Secure($_GET['id']))->get(T_APPLICATIONS);
    
    // var_dump($send_acceptance);
    if($isSent){

         
         $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $_GET['applicant_email'],
            'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
            'subject' => 'Application Status Updated',
            'charSet' => 'UTF-8',
            'message_body' => LoadPage('email/application_status', $update_data),
            'is_html' => true
        );
        $send = SendMessage($send_email_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'html' => $status_html,
           'data' =>$send_acceptance
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    

}
if($first == "send_single_notification"){
    if(empty($_GET['id'])){
        exit('oOPs No Id');
    }
    $data = array();
    $status_html = '';
     $getdata = [];
     $application_no = Secure($_GET['application_no']);
    
    $getdata['note'] = Secure($_GET['note']);
    $getdata['signed_by'] = Secure($_GET['signed_by']);
    
    
    $get_email_Data = $db->where('application_no', $application_no)->get(T_APPLICATIONS);
    if($get_email_Data){
         
         foreach($get_email_Data as $looped_data){
             if(!empty(GetMedia($looped_data->acceptance_letter))){
                $update_data = array(
                    'UNIVERSITY' =>   $_GET['university_name'],
                    'PROGRAM' =>  $_GET['program_name'],
                     'URL' => UrlLink('status'),
                     'NAME' =>   $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
                     'acceptance_letter_url'=> GetMedia($looped_data->acceptance_letter), 

                  );
              
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $_GET['applicant_email'],
                    'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
                    'subject' => 'Acceptance Lettter',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_accepted', $update_data),
                    'is_html' => true
                );
                $send = SendMessage($send_email_data);
             } else {
                $update_data = array(
                    'UNIVERSITY' =>   $_GET['university_name'],
                    'PROGRAM' =>  $_GET['program_name'],
                     'URL' => UrlLink('status'),
                     'NAME' =>   $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],

                  );
                 
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $_GET['applicant_email'],
                    'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
                    'subject' => 'Application Status Updated',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_status', $update_data),
                    'is_html' => true
                );
                $send = SendMessage($send_email_data); 
             }

         }
  

         
       
        $data = array(
           'status' => 200,
           'message' => __('status_email_successifully_sent'),
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
}
if($first == "change_status_note"){
    if(empty($_POST['id'])){
        exit('oOPs No Id');
    }
    $data = array();
    $status_html = '';
     $getdata = [];
     $application_no = Secure($_POST['id']);
    
    // $getdata['note'] = Secure($_POST['note']);
    if(!empty($_POST['signed_by'])){
       $getdata['signed_by'] = Secure($_POST['signed_by']);
    }
    if(!empty($_POST['commision'])){
        $getdata['commision'] = Secure($_POST['commision']);
    }
    $isSent = $db->where('id', Secure($_POST['id']))->update(T_APPLICATIONS,$getdata );
    $get_email_Data = $db->where('application_no', $application_no)->get(T_APPLICATIONS);
    if($get_email_Data){
         
         foreach($get_email_Data as $looped_data){
             if(!empty(GetMedia($looped_data->acceptance_letter))){
                $update_data = array(
                    'UNIVERSITY' =>   $_POST['university_name'],
                    'PROGRAM' =>  $_POST['program_name'],
                     'URL' => UrlLink('status'),
                     'NAME' =>   $_POST['first_name'] . ' ' .  $_POST['middle_name'] .' '. $_POST['last_name'],
                     'acceptance_letter_url'=> GetMedia($looped_data->acceptance_letter), 

                  );
              
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $_POST['applicant_email'],
                    'to_name' => $_POST['first_name'] . ' ' .  $_POST['middle_name'] .' '. $_POST['last_name'],
                    'subject' => 'Acceptance Lettter',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_accepted', $update_data),
                    'is_html' => true
                );
                $send = SendMessage($send_email_data);
             } else {
                $update_data = array(
                    'UNIVERSITY' =>   $_POST['university_name'],
                    'PROGRAM' =>  $_POST['program_name'],
                     'URL' => UrlLink('status'),
                     'NAME' =>   $_POST['first_name'] . ' ' .  $_POST['middle_name'] .' '. $_POST['last_name'],

                  );
                 
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $_POST['applicant_email'],
                    'to_name' => $_POST['first_name'] . ' ' .  $_POST['middle_name'] .' '. $_POST['last_name'],
                    'subject' => 'Application Status Updated',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_status', $update_data),
                    'is_html' => true
                );
                $send = SendMessage($send_email_data); 

                   
               
             }

         }
    }
   
    if($isSent){

         
        //  $send_email_data = array(
        //     'from_email' => $kd->config->email,
        //     'from_name' => $kd->config->name,
        //     'to_email' => $_GET['applicant_email'],
        //     'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
        //     'subject' => 'Application Status Updated',
        //     'charSet' => 'UTF-8',
        //     'message_body' => LoadPage('email/application_status', $update_data),
        //     'is_html' => true
        // );
        // $send = SendMessage($send_email_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'html' => $status_html
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    

}
if($first == "checked"){
    if(empty($_GET['id'])){
        exit('oOPs No Id');
    }
    $id =  Secure($_GET['id']);
    $value = Secure($_GET['value']);

       $getdata = [];
  
    $getdata["ischecked"] = $value;
    $data = array();
    $status_html = '';
  
    
 

    
    
    $isSent = $db->where('id', $id)->update(T_APPLICATIONS,$getdata );
    if($isSent){

         
        //  $send_email_data = array(
        //     'from_email' => $kd->config->email,
        //     'from_name' => $kd->config->name,
        //     'to_email' => $_GET['applicant_email'],
        //     'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
        //     'subject' => 'Application Status Updated',
        //     'charSet' => 'UTF-8',
        //     'message_body' => LoadPage('email/application_status', $update_data),
        //     'is_html' => true
        // );
        // $send = SendMessage($send_email_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'html' => $status_html
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    

}
if($first == "multiple" ){
    $errors = [];
    $universities_re = array();
    $referencetrack = "";
    $universities_re = json_decode($_POST['multi']);
    $count = 0;
    $counts = 0;

        $application_data = new stdClass();
        $grouped_applications = new stdClass();
        $application_data->applicant_type = Secure($_POST['applicant_type']);

        // if(empty($_POST['university_id'])){
        //     exit("Ooop! We dont work like crooocks !");
        // }
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
        $applicant_type = Secure($_POST['applicant_type']);

        $email = ($applicant_type == "guest")? Secure($_POST['email']) : $kd->user->email;
        $isSent = '';
        $uniqid =  random_str(4, '120340567890');
        $application_data->first_name = Secure($_POST['first_name']);
        $application_data->type = "multiple";
        $application_data->last_name = Secure($_POST['last_name']);
        $application_data->created_at = time();

        $application_data->date_of_birth = Secure($_POST['date_of_birth']);
        $application_data->phone_number = Secure($_POST['phone_number']);
        $application_data->phone_number_2 = Secure($_POST['phone_number_2']);
        $application_data->email = Secure($_POST['email']);
        $application_data->fathers_name = Secure($_POST['fathers_name']);
        $application_data->mothers_name = Secure($_POST['mothers_name']);
        $application_data->passport_number = Secure($_POST['passport_number']);
        $application_data->nationality = Secure($_POST['nationality']);
        $application_data->country_of_residence = Secure($_POST['country_of_residence']);
        $application_data->application_no = $uniqid;
        $application_data->user_id = (IS_LOGGED == true)? $kd->user->id : NULL;
        $application_data->middle_name = Secure($_POST['middle_name']);
        $application_sent = false;
        $push_application_data;
     
       
    foreach( $universities_re  as $kp){  
        $application_data->university_id = Secure($kp->university_id);
        $application_data->program_id = Secure($kp->id);  
        $check_email_exists = $db->where('email', $email)->getOne(T_APPLICATIONS);
        if($check_email_exists){
            $applican_exists = true;
            $referencetrack = $check_email_exists->application_no;
            $grouped_applications->uniqid = $uniqid;
            $grouped_applications->email = $email;
            $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
            $grouped_applications->applied_by = $kd->user->id;
            $grouped_applications->student_id = Secure($_POST['user_id']);  
            $grouped_applications->university_id = Secure($kp->university_id);
            $grouped_applications->program_id = Secure($kp->id);
            $grouped_applications->priority = $counts;
            $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
            if($push_application_data){
                $ref_code['reference_id'] = $isSent.'-'.$uniqid;
                $db->where('id', $push_application_data)->update(T_APPLICANT_UNIVERSITIES,$ref_code);
                $count += 1;
            }

        } else {
        $isSent = $db->insert(T_APPLICATIONS, ToArray($application_data));
        $referencetrack = $uniqid;
        $grouped_applications->email = $email;
        $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
        $grouped_applications->applied_by = $kd->user->id;
        $grouped_applications->student_id = Secure($_POST['user_id']);  
        $grouped_applications->university_id = Secure($_POST['university_id']);
        $grouped_applications->program_id = Secure($_POST['program_id']);
        $grouped_applications->priority = $counts;
        $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
        if($push_application_data){
            $ref_code['reference_id'] = $isSent.'-'.$uniqid;
            $db->where('id', $push_application_data)->update(T_APPLICANT_UNIVERSITIES,$ref_code);
            $count += 1;
        }

        }
        $counts += 1;
      
    }
    if($count === count($universities_re)){
        $counts = 0;
        $redirectlink = "";
        $redirectlink = "university-details/".$application_data->university_id;
        $message = 'Your Application was Recieved '. $kd->config->name;
      
        $update_data = array(
            'UNIVERSITY' =>  "MULTIPLE APPLICATION",
            'PROGRAM' => "MULTIPLE APPLICATION",
            'TRACKING_CODE' =>  $referencetrack,
            'URL' => UrlLink('status'),
            'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
         );
        $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $application_data->email,
            'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
            'subject' => 'Application Recieved',
            'charSet' => 'UTF-8',
            'message_body' => LoadPage('email/application_sent', $update_data),
            'is_html' => true
        );
        $send_message = SendMessage($send_email_data);
        // SendSMSMessage($application_data->phone_number, $message);
        
        $notif_data = array(
            'notifier_id' => (IS_LOGGED)? $kd->user->id : 0,
            'recipient_id' => 0,
            'application_id' => '0',
            'type' => 'new_application',
            'text' => ' Applied at <b>' . GetuniversityByID($application_data->university_id) . '</b> in' . GetProgramByID($application_data->program_id) . '</b>',
            'url' => ('/admin-cp/view-application?id=' . $uniqid),
            'time' => time(),
            'target' => 'all',
        );
        Notify($notif_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'url' => UrlLink($redirectlink)
        );
    }
     else {
        $redirectlink = "";
        $redirectlink = "university-details/".$application_data->university_id;
        $message = 'Your Application was Recieved '. $kd->config->name;
       
        $update_data = array(
            'UNIVERSITY' =>  "MULTIPLE APPLICATION",
            'PROGRAM' => "MULTIPLE APPLICATION",
            'TRACKING_CODE' =>  $referencetrack,
            'URL' => UrlLink('status'),
            'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
         );
        $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $application_data->email,
            'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name .' '. $application_data->last_name,
            'subject' => 'Application Recieved',
            'charSet' => 'UTF-8',
            'message_body' => LoadPage('email/application_sent', $update_data),
            'is_html' => true
        );
        $send_message = SendMessage($send_email_data);
        // SendSMSMessage($application_data->phone_number, $message);
        
        $notif_data = array(
            'notifier_id' => (IS_LOGGED)? $kd->user->id : 0,
            'recipient_id' => 0,
            'application_id' => '0',
            'type' => 'new_application',
            'text' => ' Applied at <b>' . GetuniversityByID($application_data->university_id) . '</b> in' . GetProgramByID($application_data->program_id) . '</b>',
            'url' => ('/admin-cp/view-application?id=' . $uniqid),
            'time' => time(),
            'target' => 'all');
        Notify($notif_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'url' => UrlLink($redirectlink)
        );
    }

   

}

if($first == "send_update_request"){
    if(empty($_GET['id'])){
        exit('oOPs No Id');
    }
    $id =  Secure($_GET['id']);
   
    
    $data = array();
    $status_html = '';
  
    
    $getdata["request_update"] = Secure($_GET['request_updates']);
    
    $isSent = $db->where('id', $id)->update(T_APPLICATIONS,$getdata );
    if($isSent){

         
        //  $send_email_data = array(
        //     'from_email' => $kd->config->email,
        //     'from_name' => $kd->config->name,
        //     'to_email' => $_GET['applicant_email'],
        //     'to_name' => $_GET['first_name'] . ' ' .  $_GET['middle_name'] .' '. $_GET['last_name'],
        //     'subject' => 'Application Status Updated',
        //     'charSet' => 'UTF-8',
        //     'message_body' => LoadPage('email/application_status', $update_data),
        //     'is_html' => true
        // );
        // $send = SendMessage($send_email_data);
        $data = array(
           'status' => 200,
           'message' => __('your_application_was_submited'),
           'html' => $status_html
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    
 
}
if($first == 'upload_acceptance'){
    if(empty($_POST['id'])){
    
        exit('oOPs No Id');
    }
    $getdata = [];
    $id =  Secure($_POST['id']);
    if (!empty($_FILES['file_na']['tmp_name'])) {
        $file_info = array(
            'file' => $_FILES['file_na']['tmp_name'],
            'size' => $_FILES['file_na']['size'],
            'name' => $_FILES['file_na']['name'],
            'type' => $_FILES['file_na']['type'],
            'crop' => array('width' => 400, 'height' => 400),
            'mode' => 'file_na'
        );
        $file_upload = ShareFile($file_info);
        if (!empty($file_upload['filename'])) {
            $getdata["acceptance_letter"] = $file_upload['filename'];
        }
    }

    $isSent = $db->where('id', $id)->update(T_APPLICANT_UNIVERSITIES,$getdata );
    if($isSent){
         $email_data =  $db->where('id', $id)->getOne(T_APPLICANT_UNIVERSITIES );
        $get_university_data = $db->where('email', $email_data->email)->get(T_APPLICANT_UNIVERSITIES);
       
        foreach($get_university_data as $key => $rd){
      
         $rd->university_name =  GetuniversityByID($rd->university_id);
         $rd->program_name = GetProgramByID($rd->program_id);
        
          $rd->application_status = __($rd->application_status);
         $rd->acceptance_letter_url = GetMedia($rd->acceptance_letter);
        
     }
        $data = array(
            'status' => 200,
            'message' => __('your_application_was_submited'),
            'url' => UrlLink('admin-cp/view-application?id='.$id),
            'data' => $get_university_data
         );
     } else {
         $data = array(
            'status' => 400,
            'message' => 'error',
            'url' => UrlLink('admin-cp/view-application?id='.$id)
         );
     
   }
  }


  if ($first == 'get_lang_key') {
 
     if(empty($_GET['lang_name']) && empty($_GET['id'])){
         exit();
     }
    $html     = '';
    
    $lang_key = Secure($_GET['id']);
    $lang_nm  = Secure($_GET['lang_name']);
    $langs    = $db->where('lang_key',$lang_key)->getOne(T_LANGS,array($lang_nm));

    if (!empty($langs)) {
        foreach ($langs as $key => $lang_value) {
            $html .= LoadAdminPage('edit-lang/form-list',array(
                'KEY' => ($key),
                'LANG_KEY' => ucfirst($key),
                'LANG_VALUE' => $lang_value,
            ));
        }
    }

    else {
        $html = "<h4 class='text-center'>Keyword not found</h4>";
    }

    $data['status'] = 200;
    $data['html']   = $html;
}
if ($first == 'edit_program') {
    
    
    $universities = new stdClass();
    if (!empty($_FILES['image'])) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['image']['tmp_name'],
                'size' => $_FILES['image']['size'],
                'name' => $_FILES['image']['name'],
                'type' => $_FILES['image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    $universities->university_id   = Secure($_POST['university_id']);
    $universities->department      = Secure($_POST['department']);
    $universities->language      = Secure($_POST['language']);
    $universities->degree      = Secure($_POST['degree']);
    $universities->duration      = Secure($_POST['duration']);
    $universities->tuition_fees      = Secure($_POST['tuition_fees']);
    $universities->discounted_fees      = Secure($_POST['discounted_fees']);
    $universities->university = GetuniversityByID(Secure($_POST['university_id']));

    $universities->discipline      = Secure($_POST['discipline']);
 
    $update                        = $db->where('id',Secure($_POST['id']) )->update(T_PROGRAM, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        
    } else {
        
        $data = array(
            'status' => 400,
            'message' => "ERROR"
        );
       
    }
    
}
if ($first == 'add_program') {
    
    
    $universities = new stdClass();
    if (!empty($_FILES['image'])) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['image']['tmp_name'],
                'size' => $_FILES['image']['size'],
                'name' => $_FILES['image']['name'],
                'type' => $_FILES['image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    $universities->university_id   = Secure($_POST['university_id']);
    $universities->department      = Secure($_POST['department']);
    $universities->language      = Secure($_POST['language']);
    $universities->degree      = Secure($_POST['degree']);
    $universities->duration      = Secure($_POST['duration']);
    $universities->tuition_fees      = Secure($_POST['tuition_fees']);
    $universities->discounted_fees      = Secure($_POST['discounted_fees']);
    $universities->discipline      = Secure($_POST['discipline']);
    $universities->university = GetuniversityByID(Secure($_POST['university_id']));
 
    $update                        = $db->insert(T_PROGRAM, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
        exit();
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
        exit();
    }
    exit();
}
if($first == 'delete_application'){
    if(empty($_GET['id'])){
        exit('oOPs No Id');
    }
    $data = array();
    $status_html = '';
    $getdata = [];
    
    
    
    $isSent = $db->where('id', Secure($_GET['id']))->delete(T_APPLICATIONS);
    if($isSent){

         
       
        $data = array(
           'status' => 200,
           'message' => 'Program successfully removed from the application list',
           'url' => UrlLink('admin-cp/manage-applications')
        );
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    
}

if ($first == "export_univesity") {
    $file_type = $_POST['file_type'];
    
    $universities_data = $db->get(T_UNIVERSITY);

    $file_link =  DBToExcel($universities_data,$file_type);
    
    if ($file_link) {
        
        $data = array(
            'status' => 200,
            'message' => 'successfully',
            'download_url' => UrlLink($file_link) 
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
        );
    }
    
    
    
    
}
if ($first == "export_program") {
    $file_type = $_POST['file_type'];
    
    $program_data = $db->get(T_PROGRAM);

    $file_link =  DBToExcelProgram($program_data,$file_type);
    
    if ($file_link) {
        
        $data = array(
            'status' => 200,
            'message' => 'successfully',
            'download_url' => UrlLink($file_link) 
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
        );
    }
    
    
    
    

}
if($first == 'import_programs'){
    if (!empty($_FILES["import_excel"])) {
        $allowed_extension = array(
            'xls',
            'csv',
        );
        $file_array        = explode(".", $_FILES["import_excel"]["name"]);
        $file_extension    = end($file_array);
        $full_data         = $_FILES["import_excel"];
        if (in_array($file_extension, $allowed_extension)) {
            $dataa = ExcelToDB($full_data, $file_extension);
            foreach ($dataa as $row) {
                
                $programs = array(
                    // 'id' => $row[0],
                    'main_image' => $row[1],
                    'university' => $row[2],
                    'department' => $row[3],
                    'language' => $row[4],
                    'degree' => $row[5],
                    'duration' => $row[6],
                    'discounted_fees' => $row[7],
                    'description' => $row[8],
                    'requirement' => $row[9],
                    'discipline' => $row[10],
                    'location' => $row[11],
                    'remember_token' => $row[12],
                    
                    'university_id' => $row[16],
                   
                  
                );
     
              $sent_g =  $db->insert(T_PROGRAM, $programs);
           
            }
        }
        $data = array(
            'status' => 200,
            'message' => 'successfully'
            
            
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
            
        );
    }
}
if ($first == "import") {
    
    
    if (!empty($_FILES["import_excel"])) {
        $allowed_extension = array(
            'xls',
            'csv',
            'xlsx'
        );
        $file_array        = explode(".", $_FILES["import_excel"]["name"]);
        $file_extension    = end($file_array);
        $full_data         = $_FILES["import_excel"];
        
        if (in_array($file_extension, $allowed_extension)) {
            $dataa = ExcelToDB($full_data, $file_extension);
            foreach ($dataa as $row) {
                
                $university = array(
                    'university' => $row[1],
                    'location' => $row[2],
                    'university_type' => $row[3],
                    'foundation' => $row[4],
                    'lang_edu_en' => $row[5],
                    'lang_edu_tk' => $row[6],
                    'sp_facilitie' => $row[7],
                    'sp_teams' => $row[8],
                    'st_associations' => $row[9],
                    'laboratories' => $row[10],
                    'asso_degrees' => $row[11],
                    'undergraduate_program' => $row[12],
                    'master_programs' => $row[13],
                    'ph_d_programs' => $row[14],
                    'international_students' => $row[15],
                    'total_students' => $row[16],
                    'study_mode' => $row[17],
                    'dormitory' => $row[18],
                    'female' => $row[19],
                    'male' => $row[20],
                    'library' => $row[21],
                    'wifi' => $row[22],
                    'gym' => $row[23],
                    'cafeteria' => $row[24],
                    'copy_center' => $row[25],
                    'hairdresser' => $row[26],
                    'atm' => $row[27],
                    'car_park' => $row[28],
                    'bank' => $row[29],
                    'security' => $row[30],
                    'vertural_court' => $row[31],
                    'walking_track' => $row[32],
                    'barrier_free' => $row[33],
                    'tennis_court' => $row[34],
                    'dining_hall' => $row[36],
                    'auditorium' => $row[37],
                    'medial_center' => $row[38],
                    'hospital' => $row[39],
                    'bachelor' => $row[40],
                    'master' => $row[41],
                    'certificate' => $row[42],
                    'phd' => $row[43],
                    'associate_degree' => $row[44],
                    'medicine_health' => $row[45],
                    'pharmacy' => $row[46],
                    'dentisy' => $row[47],
                    'engineering' => $row[48],
                    'computer_science' => $row[49],
                    'agriculture' => $row[50],
                    'art_design' => $row[51],
                    'business_management' => $row[52],
                    'education_traning' => $row[53],
                    'sports' => $row[54],
                    'journalism' => $row[55],
                    'law' => $row[56],
                    'natural_science' => $row[57],
                    'social_science' => $row[58],
                    'medicine' => $row[59],
                    'applied_science' => $row[60]
                );
                 $db->insert(T_UNIVERSITY, $university);
            }
        }
        $data = array(
            'status' => 200,
            'message' => 'successfully'
            
            
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
            
        );
    }
    
    
}
if ($first == 'university_department') {
    
    
    $universities = new stdClass();
    
    $universities->university_id   = $_POST['university_id'];
    $universities->department      = $_POST['department'];
    $universities->department_slag = slugify($_POST['department'], '_');
    $update                        = $db->insert(T_DEPARTMENTS, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
    }
    exit();
}
if ($first == 'university_edit' && !empty($_POST['university_id'])) {
    
    $university_id = $_POST['university_id'];
    $universities  = new stdClass();
    if ($_FILES['main_image'] != null) {
        if (!empty($_FILES['main_image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['main_image']['tmp_name'],
                'size' => $_FILES['main_image']['size'],
                'name' => $_FILES['main_image']['name'],
                'type' => $_FILES['main_image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'main_image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    if ($_FILES['university_logo'] != null) {
        if (!empty($_FILES['university_logo']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['university_logo']['tmp_name'],
                'size' => $_FILES['university_logo']['size'],
                'name' => $_FILES['university_logo']['name'],
                'type' => $_FILES['university_logo']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'university_logo'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->university_logo = $file_upload['filename'];
            }
        }
        
    }
    $universities->title                  = $_POST['university_title'];
    $universities->description            = $_POST['description'];
    $universities->university             = $_POST['university_name'];
    $universities->location               = $_POST['location'];
    $universities->university_type        = $_POST['university_type'];
    $universities->foundation             = $_POST['foundation'];
    $universities->lang_edu_en            = $_POST['lang_edu_en'];
    $universities->lang_edu_tk            = $_POST['lang_edu_tr'];
    $universities->sp_facilitie           = $_POST['sp_facilities'];
    $universities->sp_teams               = $_POST['sports_teams'];
    $universities->st_associations        = $_POST['student_associations'];
    $universities->laboratories           = $_POST['Laboratories'];
    $universities->asso_degrees           = $_POST['associate_degrees'];
    $universities->undergraduate_program  = $_POST['undergraduate_programs'];
    $universities->master_programs        = $_POST['master_programs'];
    $universities->ph_d_programs          = $_POST['PH_P_programs'];
    $universities->international_students = $_POST['international_students'];
    $universities->total_students         = $_POST['total_students'];
    $universities->study_mode             = $_POST['study_mode'];
    
    
    $universities->dormitory           = $_POST['dormitory'] == "on" ? "1" : "0";
    $universities->female              = $_POST['f_domitory'] == "on" ? "1" : "0";
    $universities->male                = $_POST['m_domitory'] == "on" ? "1" : "0";
    $universities->library             = $_POST['library'] == "on" ? "1" : "0";
    $universities->wifi                = $_POST['wifi'] == "on" ? "1" : "0";
    $universities->gym                 = $_POST['gym'] == "on" ? "1" : "0";
    $universities->cafeteria           = $_POST['cafeteria'] == "on" ? "1" : "0";
    $universities->copy_center         = $_POST['copy_center'] == "on" ? "1" : "0";
    $universities->hairdresser         = $_POST['hairdresser'] == "on" ? "1" : "0";
    $universities->atm                 = $_POST['atm'] == "on" ? "1" : "0";
    $universities->car_park            = $_POST['car_park'] == "on" ? "1" : "0";
    $universities->bank                = $_POST['bank'] == "on" ? "1" : "0";
    $universities->security            = $_POST['security'] == "on" ? "1" : "0";
    $universities->vertural_court      = $_POST['virtual_court'] == "on" ? "1" : "0";
    $universities->walking_track       = $_POST['walking_track'] == "on" ? "1" : "0";
    $universities->barrier_free        = $_POST['barrier_free_campus'] == "on" ? "1" : "0";
    $universities->tennis_court        = $_POST['tennis_court'] == "on" ? "1" : "0";
    $universities->dining_hall         = $_POST['dining_hall'] == "on" ? "1" : "0";
    $universities->auditorium          = $_POST['auditorium'] == "on" ? "1" : "0";
    $universities->medial_center       = $_POST['medial_first_aid'] == "on" ? "1" : "0";
    $universities->hospital            = $_POST['hospital'] == "on" ? "1" : "0";
    $universities->bachelor            = $_POST['bachelor'] == "on" ? "1" : "0";
    $universities->master              = $_POST['master'] == "on" ? "1" : "0";
    $universities->certificate         = $_POST['certificate'] == "on" ? "1" : "0";
    $universities->phd                 = $_POST['phd'] == "on" ? "1" : "0";
    $universities->associate_degree    = $_POST['associate_degree'] == "on" ? "1" : "0";
    $universities->medicine_health     = $_POST['medicine_health'] == "on" ? "1" : "0";
    $universities->pharmacy            = $_POST['pharmacy'] == "on" ? "1" : "0";
    $universities->dentisy             = $_POST['dentistry'] == "on" ? "1" : "0";
    $universities->engineering         = $_POST['engineering'] == "on" ? "1" : "0";
    $universities->computer_science    = $_POST['computer_it'] == "on" ? "1" : "0";
    $universities->agriculture         = $_POST['agriculture_forestry'] == "on" ? "1" : "0";
    $universities->art_design          = $_POST['arts_design_architecture'] == "on" ? "1" : "0";
    $universities->business_management = $_POST['business_management'] == "on" ? "1" : "0";
    $universities->education_traning   = $_POST['education_traning'] == "on" ? "1" : "0";
    $universities->engineering1        = $_POST['engineering1'] == "on" ? "1" : "0";
    $universities->sports              = $_POST['sports'] == "on" ? "1" : "0";
    $universities->journalism          = $_POST['journalism_media'] == "on" ? "1" : "0";
    $universities->law                 = $_POST['law '] == "on" ? "1" : "0";
    $universities->medicine_health1    = $_POST['medicine_health1'] == "on" ? "1" : "0";
    $universities->natural_science     = $_POST['Natural_mathematics'] == "on" ? "1" : "0";
    $universities->social_science      = ($_POST['social_science'] == "on") ? "1" : "0";
    $universities->medicine            = ($_POST['medicine'] === "on") ? "1" : "0";
    $universities->applied_science     = ($_POST['applied_science'] = "on") ? "1" : "0";
    
    $update = $db->where('id', $_POST['university_id'])->update(T_UNIVERSITY, ToArray($universities));
    
    
    header("Content-type: application/json");
    if ($update) {
        $data = array(
            'status' => 200
        );
       
    } else {
        $data = array(
            'status' => 400,
            'message' => $send_errors
        );
        
    }
    exit();
}