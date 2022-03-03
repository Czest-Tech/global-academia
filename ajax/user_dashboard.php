<?php 
  
    if ($first == 'get_user_applications') {
        $get_user_applications = $db->where("user_id", $kd->user->id)->get(T_APPLICATIONS);
      
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
        $update_education->first_name = Secure($_POST['first_name']);
        $update_education->type = "multiple";
        $update_education->last_name = Secure($_POST['last_name']);
        $update_education->created_at = time();
        $update_education->date_of_birth = Secure($_POST['date_of_birth']);
        $update_education->phone_number = Secure($_POST['phone_number']);
        $update_education->phone_number_2 = Secure($_POST['phone_number_2']);
        $update_education->fathers_name = Secure($_POST['fathers_name']);
        $update_education->mothers_name = Secure($_POST['mothers_name']);
        $update_education->passport_number = Secure($_POST['passport_number']);
        $update_education->nationality = Secure($_POST['nationality']);
        $update_education->country_of_residence = Secure($_POST['country_of_residence']);
        $update_educationa_data = $db->where('user_id', $kd->user->id)->update(T_APPLICANT_EDUCATION_INFO, ToArray($update_education));
        
        if($update_educationa_data){
            $get_data = $db->where('user_id', $kd->user->id)->get(T_APPLICANT_EDUCATION_INFO);

            $data = array(
                'status' => 200,
                'data' => $get_data,
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


