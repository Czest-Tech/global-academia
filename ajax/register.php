<?php
$color1       = '2ec0bc';
$color2       = '8ef9f6';
$errors       = array();
$erros_final  = '';
$active       = '';
$username     = '';
$email        = '';
$success      = '';
$account_type = '';
$firstname    = '';
$randon_divider = '';
$lastname     = '';
$session_id   = '';
$defaulGender = 'selectGender';
if (empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['c_password'])) {
    $data = array(
        'status' => '400',
        'errors' => array(
            'error_id' => '2',
            'error_text' => 'Bad Request, Invalid or missing parameter'
        )
    );
    echo json_encode($data);
    exit();
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = __('email_invalid_characters');
} else {

    $password        = Secure($_POST['password']);
    $c_password      = Secure($_POST['c_password']);
    $firstname       = Secure($_POST['first_name']);
    $lastname       = Secure($_POST['last_name']);
    $account_type = Secure($_POST["account_type"]);
    $randon_divider = random_str(4);
    $username = $firstname.'_'.$lastname.'_'.$randon_divider;   

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $email           = Secure($_POST['email']);
    // if (UsernameExists($username) {
    //     $username = substr($firstname,0, 3).'_'.$randon_divider.'_'.substr($lastname,0, 3);   

    // }
    if (strlen($firstname) <= 2 || strlen($firstname) > 32) {
        $errors[] = __('firstname_characters_length');
    }
    if (strlen($lastname) <= 2 || strlen($lastname) > 32) {
        $errors[] = __('lastname_characters_length');
    }
    if (!preg_match('/^[\w]+$/', $firstname)) {
        $errors[] = __('username_invalid_characters');
    }
    if (UserEmailExists($_POST['email'])) {
        $errors[] = __('email_exists');
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = __('email_invalid_characters');
    }
    if ($password != $c_password) {
        $errors[] = __('password_not_match');
    }
    if (strlen($password) < 4) {
        $errors[] = __('password_is_short');
    }
  //  $active = ($kd->config->validation == 'on') ? 0 : 1;
    $active = ($account_type == 'agent') ? 0 : 1;
    if (empty($errors)) {
        $email_code              = sha1(time() + rand(111, 999));
        $insert_data             = array(
            'username' => $username,
            'password' => $password_hashed,
            'email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'account_type' => $account_type,
            'access_level' => 0,
            'ip_address' => get_ip_address(),
            'active' => $active,
            'email_code' => $email_code,
            'last_active' => time(),  
            'registered' => date('Y') . '/' . intval(date('m'))
        );
        
        $insert_data['language'] = $kd->config->language;
        if (!empty($_SESSION['lang'])) {
            if (in_array($_SESSION['lang'], $langs)) {
                $insert_data['language'] = $_SESSION['lang'];
            }
        }
      
        $user_id = $db->insert(T_USERS, $insert_data);
        if (!empty($user_id)) {
            $session_id  = sha1(rand(11111, 99999)) . time() . md5(microtime());

            $insert_data = array(
                'user_id' => $user_id,
                'session_id' => $session_id,
                'time' => time()
            );
            $insert_request_data = array(
                'user_id' => $user_id,
                'approved' => 0,
                'created_at' => time()
            );
            if($account_type === "agent"){
                $submit_approval_Request = $db->insert(T_AGENT_REQUESTS, $insert_request_data);

            }
            $init_db_user_dashboard = $db->insert(T_APPLICANT_EDUCATION_INFO, array('user_id' => $user_id));
            $insert      = $db->insert(T_SESSIONS, $insert_data);
            $data        = array(
                'status' => 200,
                'mode' => 'done',
                'account_type' => $account_type,
                'post_register_action' => ($account_type == 'agent') ? __('your_account_await_approval') : __('successfully_joined_desc'),
                'message' => $success_icon . __('successfully_joined_desc'),
                'session_id' => $session_id
            );
        }
    } else {
        $errors_text = '';
        foreach ($errors as $key => $value) {
            $errors_text .= $error_icon . $value . "<br>";
        }
        $data['message'] = $errors_text;
        $data['status'] = 400;
    }
}
