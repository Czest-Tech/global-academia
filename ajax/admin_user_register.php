<?php
$color1       = '2ec0bc';
$color2       = '8ef9f6';
$errors       = array();
$erros_final  = '';
$active       = '';
$username     = '';
$email        = '';
$success      = '';
$session_id   = '';
$defaulGender = 'selectGender';
if (empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['c_password'])) {
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
    $user_name_create = Secure($_POST['first_name']).' '.Secure($_POST['last_name']);
    $username        = slugify($user_name_create,'_').''.random_str(3, '12345634608974');
    $password        = Secure($_POST['password']);
    $c_password      = Secure($_POST['c_password']);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $email           = Secure($_POST['email']);
    if (UsernameExists($username)) {
        $errors[] = __('username_is_taken');
    }
    if (strlen($username) < 4 || strlen($username) > 32) {
        $errors[] = __('username_characters_length');
    }
    if (!preg_match('/^[\w]+$/', $username)) {
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
    $active = 1;
    if (empty($errors)) {
        $email_code              = sha1(time() + rand(111, 999));
        $insert_data             = array(
            'username' => $username,
            'password' => $password_hashed,
            'email' => $email,
            'ip_address' => get_ip_address(),
            'active' => $active,
            'email_code' => $email_code,
            'first_name' => Secure($_POST['first_name']),
            'last_name' => Secure($_POST['last_name']),
            'last_active' => time(),
            'admin' => ($_POST['access_level'] != 4)? 1 : 0,
            'access_level' => Secure($_POST['access_level']),
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
          
            $data        = array(
                'status' => 200,
                'mode' => 'done',
                'message' => $success_icon . __('successfully_joined_desc'),
               
            );
        }
    } else {
        $errors_text = '';
        foreach ($errors as $key => $value) {
            $errors_text .= $error_icon . $value . "<br>";
        }
        $data['message'] = $errors_text;
    }
}