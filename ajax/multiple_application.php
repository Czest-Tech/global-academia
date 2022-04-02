<?php 


if($first == "multiple" ){
    $errors = [];
    $universities_re = array();
    $referencetrack = "";
    $universities_re = json_decode($_POST['multi']);
    $count = 0;
    $counts = 0;
    $student_id = [];

    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    $application_data->applicant_type = Secure($_POST['applicant_type']);
    $student_id = json_decode(Secure($_POST['multiple_applicants']));
       
       
    if (!empty($student_id)) {
            foreach ($student_id as $sid) {
                $get_applicant_info = $db->where('id', $sid)->getOne(T_AGENT_STUDENTS);
                
                $applicant_type = Secure($_POST['applicant_type']);

                $email = ($applicant_type == "guest")? Secure($_POST['email']) : $kd->user->email;
                $isSent = '';
                $uniqid =  random_str(4, '120340567890');
                $get_applicant_info->type = "multiple";
                $get_applicant_info->created_at = time();

                $get_applicant_info->applicant_type = Secure($_POST['applicant_type']);
                $get_applicant_info->applied_by = $kd->user->id;        
               
                $application_sent = false;
                $push_application_data;          
                foreach( $universities_re  as $kp){  
                    $get_applicant_info->university_id = Secure($kp->university_id);
                    $get_applicant_info->program_id = Secure($kp->id);  
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
                            $ref_code['reference_id'] = $uniqid;
                            $db->where('id', $push_application_data)->update(T_APPLICANT_UNIVERSITIES,$ref_code);
                            $count += 1;
                        }

                    } else {
                    $isSent = $db->insert(T_APPLICATIONS, ToArray($get_applicant_info));
                    $referencetrack = $uniqid;
                    $grouped_applications->email = $email;
                    $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
                    $grouped_applications->applied_by = $kd->user->id;
                    $grouped_applications->student_id = Secure($_POST['user_id']);  
                    $grouped_applications->university_id =  Secure($kp->university_id);
                    $grouped_applications->program_id =  Secure($kp->id);
                    $grouped_applications->priority = $counts;
                    $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                    if($push_application_data){
                        $ref_code['reference_id'] = $uniqid;
                        $db->where('id', $push_application_data)->update(T_APPLICANT_UNIVERSITIES,$ref_code);
                        $count += 1;
                    }

                    }
                
                }
            }
    }
    if($application_data->applicant_type == 'applicant'){
        $applicant_type = Secure($_POST['applicant_type']);
        $get_applicantEducational_info = $db->where('user_id', $kd->user->id)->getOne(T_APPLICANT_EDUCATION_INFO);
        $email = $kd->user->email;
        $isSent = '';
        
        $uniqid =  random_str(4, '120340567890');
        $get_applicantEducational_info->applied_by = $kd->user->id;  
     
    
        $get_applicantEducational_info->created_at = time();
        $get_applicantEducational_info->type = "multiple";
        $application_sent = false;
        $push_application_data;          
        foreach( $universities_re  as $kp){  
            $get_applicantEducational_info->university_id = Secure($kp->university_id);
            $get_applicantEducational_info->program_id = Secure($kp->id);  
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
                var_dump($grouped_applications);
                $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                if($push_application_data){
                    $ref_code['reference_id'] = $uniqid;
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

    }
    if($application_data->applicant_type == 'guest'){
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
        $application_data->email = $email;
        $application_data->fathers_name = Secure($_POST['fathers_name']);
        $application_data->mothers_name = Secure($_POST['mothers_name']);
        $application_data->passport_number = Secure($_POST['passport_number']);
        $application_data->nationality = Secure($_POST['nationality']);
        $application_data->country_of_residence = Secure($_POST['country_of_residence']);
        $application_data->application_no = random_str(4, '120340567890');
        $application_data->applicant_type = Secure($_POST['applicant_type']);
        $application_data->applied_by = Secure($_POST['user_id']);       
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
                $grouped_applications->applied_by = Secure($_POST['user_id']);
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
            $grouped_applications->applied_by = Secure($_POST['user_id']);
            $grouped_applications->student_id = Secure($_POST['user_id']);  
            $grouped_applications->university_id = Secure($kp->university_id);

            $grouped_applications->program_id =  Secure($kp->id);
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
            'NAME' =>  $application_data->first_name . ' '. $application_data->last_name,
         );
        $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $email,
            'to_name' => $application_data->first_name . '  '. $application_data->last_name,
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
        $redirectlink = "university";
        $message = 'Your Application was Recieved '. $kd->config->name;
       
        $update_data = array(
            'UNIVERSITY' =>  "MULTIPLE APPLICATION",
            'PROGRAM' => "MULTIPLE APPLICATION",
            'TRACKING_CODE' =>  $referencetrack,
            'URL' => UrlLink('status'),
            'NAME' =>  $application_data->first_name . ' '. $application_data->last_name,
         );
        $send_email_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $email,
            'to_name' => $application_data->first_name . ' '. $application_data->last_name,
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