<?php 

if($first == "single_agent" ){

    $errors = [];
    $email = !empty(Secure($_POST['email']))? Secure($_POST['email']) : $kd->user->email;
    $isSent = '';
    $referencetrack = '';
    $uniqid =  random_str(4, '12345634608974');
    $student_id = [];
    $application_data = new stdClass();
    $grouped_applications = new stdClass();
    if(!empty($_POST['user_id']) && $_POST['user_id'] !== 0){
        $application_data->user_id = Secure($_POST['user_id']);
    }  
    $applicant_type = Secure($_POST['applicant_type']);
    $student_id = json_decode(Secure($_POST['multiple_applicants']));

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
    
       $data = array(
           'status' => 400,
           'message' => 'error'
        );
   

}