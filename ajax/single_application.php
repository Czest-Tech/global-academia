<?php

if ($first == "single_agent") {
    $count = 0;
    $errors = [];
    $email = !empty(Secure($_POST['email'])) ? Secure($_POST['email']) : $kd->user->email;
    $isSent = '';
    $referencetrack = '';
    $uniqid =  random_str(4, '12345634608974');
    $student_id = [];
    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    if (!empty($_POST['user_id']) && $_POST['user_id'] !== 0) {
        $application_data->user_id = Secure($_POST['user_id']);
    }
    $applicant_type = Secure($_POST['applicant_type']);
    $student_id = json_decode(Secure($_POST['multiple_applicants']));

    if ($applicant_type === "agent") {


        if (!empty($student_id)) {
            foreach ($student_id as $sid) {
                $get_applicant_info = $db->where('id', $sid)->getOne(T_AGENT_STUDENTS);


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
                $application_data->email = $get_applicant_info->email;
                $application_data->fathers_name = Secure($_POST['fathers_name']);
                $application_data->mothers_name = Secure($_POST['mothers_name']);
                $application_data->time = time();

                $application_data->passport_number = Secure($_POST['passport_number']);
                $application_data->nationality = Secure($_POST['nationality']);
                $application_data->country_of_residence = Secure($_POST['country_of_residence']);
                $application_data->middle_name = Secure($_POST['middle_name']);
                $application_data->applicant_type = Secure($_POST['applicant_type']);
                $application_data->applied_by = $kd->user->id;

                $application_data->application_no = random_str(4, '12345634608974');


                $application_sent = false;
                $check_email_exists = $db->where('email', $get_applicant_info->email)->getOne(T_APPLICATIONS);

                if ($check_email_exists) {
                    $grouped_applications->uniqid =  random_str(4, '12345634608974');
                    $grouped_applications->email = $get_applicant_info->email;
                    $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
                    $grouped_applications->applied_by = $kd->user->id;
                    $grouped_applications->student_id = $sid;

                    $grouped_applications->university_id = Secure($_POST['university_id']);
                    $grouped_applications->program_id = Secure($_POST['program_id']);
                    $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                    $referencetrack = $check_email_exists->application_no;
                } else {
                    $isSent = $db->insert(T_APPLICATIONS, ToArray($application_data));
                    if ($isSent) {
                        $referencetrack = $uniqid;
                        $grouped_applications->uniqid =  random_str(4, '12345634608974');
                        $grouped_applications->email = $get_applicant_info->email;
                        $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
                        $grouped_applications->applied_by = $kd->user->id;
                        $grouped_applications->student_id = $sid;

                        $grouped_applications->university_id = Secure($_POST['university_id']);
                        $grouped_applications->program_id = Secure($_POST['program_id']);
                        $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                    }
                }
                $count += 1;
            }

            if (count($student_id) == $count) {

                $redirectlink = "";
                $redirectlink = "university-details/" . $application_data->university_id;
                $message = 'Your Application was Recieved ' . $kd->config->name;
                $update_data = array(
                    'UNIVERSITY' =>  GetuniversityByID($application_data->university_id),
                    'PROGRAM' => GetProgramByID($application_data->program_id),
                    'TRACKING_CODE' =>  $referencetrack,
                    'URL' => UrlLink('status'),
                    'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name . ' ' . $application_data->last_name,
                );
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $application_data->email,
                    'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name . ' ' . $application_data->last_name,
                    'subject' => 'Application Recieved',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_sent', $update_data),
                    'is_html' => true
                );
                $send_message = SendMessage($send_email_data);
                // SendSMSMessage($application_data->phone_number, $message);

                $notif_data = array(
                    'notifier_id' => $kd->user->id,
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
            } else {
                $data = array(
                    'status' => 400,
                    'message' => 'error'
                );
            }
        }
    }
}
if ($first == "single_applicant") {
    $count = 0;
    $errors = [];
    $email = !empty(Secure($_POST['email'])) ? Secure($_POST['email']) : $kd->user->email;
    $isSent = '';
    $referencetrack = '';
    $uniqid =  random_str(4, '12345634608974');
    $student_id = [];
    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    if (!empty($_POST['user_id']) && $_POST['user_id'] !== 0) {
        $application_data->user_id = Secure($_POST['user_id']);
    }
    $applicant_type = Secure($_POST['applicant_type']);
    $student_id = Secure($_POST['user_id']);

    if ($applicant_type === "applicant") {
         $sid = $kd->user->id;

        if (!empty($student_id)) {

            $get_applicant_info = $db->where('id', $student_id)->getOne(T_USERS);


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
            $application_data->email = $get_applicant_info->email;
            $application_data->fathers_name = Secure($_POST['fathers_name']);
            $application_data->mothers_name = Secure($_POST['mothers_name']);
            $application_data->time = time();

            $application_data->passport_number = Secure($_POST['passport_number']);
            $application_data->nationality = Secure($_POST['nationality']);
            $application_data->country_of_residence = Secure($_POST['country_of_residence']);
            $application_data->middle_name = Secure($_POST['middle_name']);
            $application_data->applicant_type = Secure($_POST['applicant_type']);
            $application_data->applied_by = $kd->user->id;

            $application_data->application_no = random_str(4, '12345634608974');


            $application_sent = false;
            $check_email_exists = $db->where('email', $get_applicant_info->email)->getOne(T_APPLICATIONS);

            if ($check_email_exists) {
                $grouped_applications->uniqid =  random_str(4, '12345634608974');
                $grouped_applications->email = $get_applicant_info->email;
                $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
                $grouped_applications->applied_by = $kd->user->id;
                $grouped_applications->student_id = $sid;

                $grouped_applications->university_id = Secure($_POST['university_id']);
                $grouped_applications->program_id = Secure($_POST['program_id']);
                $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                $referencetrack = $check_email_exists->application_no;
                if ($push_application_data) {
                    $application_sent = true;
                }
            } else {
                $isSent = $db->insert(T_APPLICATIONS, ToArray($application_data));
                if ($isSent) {
                    $referencetrack = $uniqid;
                    $grouped_applications->uniqid =  random_str(4, '12345634608974');
                    $grouped_applications->email = $get_applicant_info->email;
                    $grouped_applications->applicant_type = Secure($_POST['applicant_type']);
                    $grouped_applications->applied_by = $kd->user->id;
                    $grouped_applications->student_id = $sid;

                    $grouped_applications->university_id = Secure($_POST['university_id']);
                    $grouped_applications->program_id = Secure($_POST['program_id']);
                    $push_application_data = $db->insert(T_APPLICANT_UNIVERSITIES, ToArray($grouped_applications));
                    if ($push_application_data) {
                        $application_sent = true;
                    }
                }
            }
            if ($application_sent) {

                $redirectlink = "";
                $redirectlink = "university-details/" . $application_data->university_id;
                $message = 'Your Application was Recieved ' . $kd->config->name;
                $update_data = array(
                    'UNIVERSITY' =>  GetuniversityByID($application_data->university_id),
                    'PROGRAM' => GetProgramByID($application_data->program_id),
                    'TRACKING_CODE' =>  $referencetrack,
                    'URL' => UrlLink('status'),
                    'NAME' =>  $application_data->first_name . ' ' .  $application_data->middle_name . ' ' . $application_data->last_name,
                );
                $send_email_data = array(
                    'from_email' => $kd->config->email,
                    'from_name' => $kd->config->name,
                    'to_email' => $application_data->email,
                    'to_name' => $application_data->first_name . ' ' .  $application_data->middle_name . ' ' . $application_data->last_name,
                    'subject' => 'Application Recieved',
                    'charSet' => 'UTF-8',
                    'message_body' => LoadPage('email/application_sent', $update_data),
                    'is_html' => true
                );
                $send_message = SendMessage($send_email_data);
                // SendSMSMessage($application_data->phone_number, $message);

                $notif_data = array(
                    'notifier_id' => $kd->user->id,
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
            } else {
                $data = array(
                    'status' => 400,
                    'message' => 'error'
                );
            }
        }
    }
}
if($first == "single_guest" ){

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
    
    } else {
        $data = array(
           'status' => 400,
           'message' => 'error'
        );
    }
    

   

}