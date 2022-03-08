<?php 
  
    if ($first == 'get_user_applications') {
        $get_user_applications = $db->where("user_id", $kd->user->id)->getOne(T_APPLICATIONS);
        $get_univiversities = $db->where("email", $get_user_applications->email)->get(T_APPLICANT_UNIVERSITIES);
        $get_pending_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "queued")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
        $get_accepted_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "accepted")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
        $get_rejected_application_count =  $db->where("email", $get_user_applications->email)->where("is_checked", "rejected")->getValue(T_APPLICANT_UNIVERSITIES, "count(*)");
        $get_user_notificatins = $db->where('recipient_id', $kd->user->id)->get(T_USER_NOTIFACATIONS);
        $get_user_notificatins_count = $db->where('recipient_id', $kd->user->id)->where("seen", 0)->getValue(T_USER_NOTIFACATIONS, "count(*)");

        foreach($get_univiversities as $allProgram){
            $allProgram->university_id = GetuniversityByID($application_data->university_id);
            $allProgram->program_id = GetProgramByID($application_data->program_id);
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
                'user_new_notification_count' => $get_user_notificatins_count


            );
        } else {
            
            $send_errors_data = array(
                'status' => 400,
                'message' => "ERROR",
            
            );
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
        $update_education->nationality = Secure($_POST['nationality']);
        $update_education->country_of_residence = Secure($_POST['country_of_residence']);
        $update_educationa_data = $db->where('user_id', $kd->user->id)->update(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
        
        if($update_educationa_data){
            $get_data = $db->where('user_id', $kd->user->id)->get(T_APPLICANT_EDUCATION_INFO);

            $data = array(
                'status' => 200,
                'data' => $get_data,
                'user_data' => $kd->user,
                'url' => UrlLink($redirectlink)
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
 
        $update_educationa_data = $db->where('user_id', $kd->user->id)->update(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
        
        if($update_educationa_data){
            $get_data = $db->where('user_id', $kd->user->id)->get(T_APPLICANT_EDUCATION_INFO);

            $data = array(
                'status' => 200,
                'data' => $get_data,
                'user_data' => $kd->user,
                'url' => UrlLink($redirectlink)
             );
        } else {
            $data = array(
                'status' => 401,
                'message' => __('your_application_was_submited'),
                'url' => UrlLink($redirectlink)
             );
        }
    }


