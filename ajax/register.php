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
if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['c_password'])) {
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
    $firstname       = Secure($_POST['firstname']);
    $lastname       = Secure($_POST['lastname']);
    $account_type = Secure($_POST["account_type"]);
    $randon_divider = random_str(4);
    $username = substr($firstname,0, 3).'_'.$randon_divider.'_'.substr($lastname,0, 3);   

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $email           = Secure($_POST['email']);
    // if (UsernameExists($username) {
    //     $username = substr($firstname,0, 3).'_'.$randon_divider.'_'.substr($lastname,0, 3);   

    // }
    if (strlen($_POST['firstname']) < 4 || strlen($_POST['firstname']) > 32) {
        $errors[] = __('firstname_characters_length');
    }
    if (strlen($_POST['lastname']) < 4 || strlen($_POST['lastname']) > 32) {
        $errors[] = __('lastname_characters_length');
    }
    if (!preg_match('/^[\w]+$/', $_POST['firstname'])) {
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
    $active = ($kd->config->validation == 'on') ? 0 : 1;
    if (empty($errors)) {
        $email_code              = sha1(time() + rand(111, 999));
        $insert_data             = array(
            'username' => $username,
            'password' => $password_hashed,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'account_type' => $account_type,
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
        var_dump($insert_data);
        $user_id = $db->insert(T_USERS, $insert_data);
        if (!empty($user_id)) {
            $session_id  = sha1(rand(11111, 99999)) . time() . md5(microtime());
            $insert_data = array(
                'user_id' => $user_id,
                'session_id' => $session_id,
                'time' => time()
            );
            $insert      = $db->insert(T_SESSIONS, $insert_data);
            $data        = array(
                'status' => 200,
                'mode' => 'done',
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
    }
}
