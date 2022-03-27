<?php 

if ($first == 'reset-password') {
	if (!empty($_POST)) {
	    if (empty($_POST['password']) || empty($_POST['c_password']) || empty($_POST['email_code'])) {
	        $errors[] = lang("Please check your details");
	    } else {
	        $password        = secure($_POST['password']);
	        $c_password  = secure($_POST['c_password']);
	        $old_email_code = secure($_POST['email_code']);

	        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
	        if ($password != $c_password) {
	            $errors[] = lang("Passwords don't match");
	        } else if (strlen($password) < 4 || strlen($password) > 32) {
	            $errors[] = lang("Password is too short");
	        }

            if ( $music->config->maintenance_mode == 'on' ) {
                $errors[] = lang("Website maintenance mode is active");
            }
	        if (empty($errors)) {

	        	$user_id = $db->where('email_code', $old_email_code)->where('time_code_sent', time(),'>')->getValue(T_USERS, "id");
	        	if (!empty($user_id)) {
	        		$email_code = sha1(time() + rand(1111,9999));
		        	$update = $db->where('id', $user_id)->update(T_USERS, ['password' => $password_hashed, 'email_code' => '']);
		        	if ($update) {
		        		createUserSession($user_id);
			            $data = ['status' => 200];
		        	}
	        	}
	        	else{
	        		$errors[] = lang("Please check your details");
	        	}
            }
	    }
	}
}
if ($first == 'forgot-password') {
	if (!empty($_POST)) {
	    if (empty($_POST['email'])) {
	        $errors[] = lang("Please check your details");
	    } else {
	        $email        = secure($_POST['email']);

	        $getUser = $db->where("email = ?", array(
	            $email,
	        ))->getOne(T_USERS, ["password", "id", "active", "email_code"]);

	        if (empty($getUser)) {
	        	$errors[] = lang("This e-mail is not found");
	        }

            if ( $kd->config->maintenance_mode == 'on' ) {
                $errors[] = lang("Website maintenance mode is active");
            }

	        if (empty($errors)) {
	        	$user_id             = $getUser->id;
	            $email_code          = random_str(4, '12345634608974');
                $rest_user           = userData($user_id);
                $time = time() + (60 * 60 * 24);
	            $update              = $db->where('id', $getUser->id)->update(T_USERS, ['email_code' => $email_code,
	                                                                                    'time_code_sent' => $time]);

	            $update_data['USER_DATA'] = $rest_user;
	            $update_data['email_code'] = $email_code;
	            

	            $send_email_data = array(
	           		'from_email' => $kd->config->email,
	           		'from_name' => $kd->config->name,
	           		'to_email' => $email,
	           		'to_name' => $rest_user->name,
	           		'subject' => lang("Reset Password"),
	           		'charSet' => 'UTF-8',
	           		'message_body' => LoadPage('emails/reset-password', $update_data),
	           		'is_html' => true
	           	);

	            $send_message = SendMessage($send_email_data);
	            if ($send_message) {
	            	$data = array(
			            'status' => 200,
			            'message' => lang("Please check your inbox / spam folder for the reset email.")
			        );
	            } else {
	            	$errors[] = lang("Error found while sending the reset link, please try again later.");
		        }
            }
	    }
	}
}