<?php 

if ($first == 'reset_password') {
	
	    if (empty($_POST['password']) || empty($_POST['c_password']) || empty($_POST['code'])) {
	        $errors[] = lang("Please check your details");
            $data = array(
                'status' => 400,
                'message' => 'No Applications Found',
                'error' => $errors
             );
             echo json_encode($data);
             exit();
	    } else {
	        $password        = secure($_POST['password']);
	        $c_password  = secure($_POST['c_password']);
	        $old_email_code = secure($_POST['code']);

	        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
	        if ($password != $c_password) {
	            $errors[] = lang("Passwords don't match");
	        } else if (strlen($password) < 4 || strlen($password) > 32) {
	            $errors[] = lang("Password is too short");
	        }

           
	        if (empty($errors)) {

	        	$user_id = $db->where('email_code', $old_email_code)->where('time_code_sent', time(),'>')->getValue(T_USERS, "id");
	        	if (!empty($user_id)) {
	        		$email_code = sha1(time() + rand(1111,9999));
		        	$update = $db->where('id', $user_id)->update(T_USERS, ['password' => $password_hashed, 'email_code' => '']);
		        	if ($update) {
		        		
			            $data = array(
                            'status' => 200,
                            'message' => lang("Password Changed")
                        );	 
		        	}
	        	}
	        	else{
	        		$errors[] = lang("Please check your details");
                    $data = array(
                        'status' => 400,
                        'message' => 'Password reset error',
                        'error' => $errors
                     );
                     echo json_encode($data);
                     exit();
	        	}
            }
	    
	}
}
if ($first == 'forgot-password') {
	if (!empty($_POST['email'])) {
	    if (empty($_POST['email'])) {
	        $errors[] = lang("Please check your details");
	    } else {
	        $email        = secure($_POST['email']);

	        $getUser = $db->where("email = ?", array(
	            $email,
	        ))->getOne(T_USERS, ["password", "id", "active", "email_code"]);

	        if (empty($getUser)) {
	        	$errors[] = lang("This e-mail is not found");
                $data = array(
                    'status' => 400,
                    'message' => 'No Records Found',
                    'error' => $errors
                 );
                 echo json_encode($data);
                 exit();
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
	            $kd->email_code = $email_code;
	            $kd->username = $rest_user->name;

	            $send_email_data = array(
	           		'from_email' => $kd->config->email,
	           		'from_name' => $kd->config->name,
	           		'to_email' => $email,
	           		'to_name' => $rest_user->name,
	           		'subject' => lang("Reset Password"),
	           		'charSet' => 'UTF-8',
	           		'message_body' => LoadPage('email/reset-password', $update_data),
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
	} else {
        $errors[] = lang("Email cannot be empty");
        $data = array(
            'status' => 400,
            'message' => 'Field can not be empty',
            'error' => $errors
         );
         echo json_encode($data);
         exit();
    }
}
if ($first == 'comfirm_code') {
	if (!empty($_POST['code'])) {
	    if (empty($_POST['code'])) {
	        $errors[] = lang("Please check your details");
	    } else {
	        $code        = secure($_POST['code']);

	        $getUser = $db->where("email_code", $code)->getOne(T_USERS);

	        if (empty($getUser)) {
	        	$errors[] = lang("incorrect code");
                $data = array(
                    'status' => 400,
                    'message' => 'Code not found',
                    'error' => $errors
                 );
                 echo json_encode($data);
                 exit();
	        }
	        if (empty($errors) && ($getUser->email_code == $code)) {	        	           
                $data = array(
                    'status' => 200,
                    'code' =>  $code,
                    'message' => lang("code correct")
                );	             
            } 
            else {
                $errors[] = lang("code not comfirmed");
                $data = array('status' => 400,'error'=>$errors);
		    }
	    }
	}else {
        $errors[] = lang("code cannot be empty");
        $data = array(
            'status' => 400,
            'message' => 'Filed can not be empty',
            'error' => $errors
         );
         echo json_encode($data);
         exit();
    }
}