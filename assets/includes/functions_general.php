<?php
function lang($string = '') {
    global $lang_array, $db;
    $string = trim($string);
    $stringFromArray = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','_', $string));
    if (in_array($stringFromArray, array_keys($lang_array))) {
        return __($stringFromArray); //$lang_array[$stringFromArray];
    }
    $insert = $db->insert(T_LANGS, ['lang_key' => $stringFromArray, 'english' => secure($string)]);
    $lang_array[$stringFromArray] = $string;
    return $string;
}
function LoadPage($page_url = '', $data = array(), $set_lang = true) {
    global $kd, $lang_array, $config, $fl_currpage, $countries_name;
    $page = './themes/' . $config['theme'] . '/layout/' . $page_url . '.html';
    if (!file_exists($page)) {
        die("File not Exists : $page");
    }
    $page_content = '';
    ob_start();
    require($page);
    $page_content = ob_get_contents();
    ob_end_clean();
    if ($set_lang == true) {
        $page_content = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($lang_array) {
            return lang($m[1]);
        }, $page_content);
    }
    if (!empty($data) && is_array($data)) {
        foreach ($data as $key => $replace) {
            if ($key == 'USER_DATA') {
                $replace = ToArray($replace);
                $page_content = preg_replace_callback("/{{USER (.*?)}}/", function($m) use ($replace) {
                    return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
                }, $page_content);
            } else {
                if( is_array($replace) || is_object($replace) ){
                    $arr = explode('_',$key);
                    $k = strtoupper($arr[0]);
                    $replace = ToArray($replace);
                    $page_content = preg_replace_callback("/{{".$k." (.*?)}}/", function($m) use ($replace) {
                        return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
                    }, $page_content);
                }else{
                    $object_to_replace = "{{" . $key . "}}";
                    $page_content      = str_replace($object_to_replace, $replace, $page_content);
                }
            }
        }
    }
    if (IS_LOGGED == true) {
        $replace = ToArray($kd->user);
        $page_content = preg_replace_callback("/{{ME (.*?)}}/", function($m) use ($replace) {
            return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
        }, $page_content);
    }
    $page_content = preg_replace("/{{LINK (.*?)}}/", UrlLink("$1"), $page_content);
    $page_content = preg_replace_callback("/{{CONFIG (.*?)}}/", function($m) use ($config) {
        return (isset($config[$m[1]])) ? $config[$m[1]] : '';
    }, $page_content);
    return $page_content;
}
function ToObject($array) {
    $object = new stdClass();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $value = ToObject($value);
        }
        if (isset($value)) {
           if(!empty($value)){
            $object->$key = $value;
            }
        }
    }
    return $object;
}

function ToArray($obj) {
    if (is_object($obj))
        $obj = (array) $obj;
    if (is_array($obj)) {
        $new = array();
        foreach ($obj as $key => $val) {
            $new[$key] = ToArray($val);
        }
    } else {
        $new = $obj;
    }
    return $new;
}
function UrlLink($string) {
    global $site_url;
    return rtrim($site_url ,'/') . str_replace('//','/','/' . $string);
}
function db_langs() {
    global $db;
    $data   = array();
    $t_lang = T_LANGS;
    try {
        $query  = $db->rawQuery("DESCRIBE `$t_lang`");
    } catch (Exception $e) {

    }
    foreach ($query as $column) {
        $data[] = $column->Field;
    }
    unset($data[0]);
    unset($data[1]);
    return $data;
}
function Secure($string, $censored_words = 1, $br = true) {
    global $mysqli;
    if(!is_array($string)) {

        $string = trim($string);
        $string = mysqli_real_escape_string($mysqli, $string);
        $string = htmlspecialchars($string, ENT_QUOTES);

        if ($br == true) {
            $string = str_replace('\r\n', " <br>", $string);
            $string = str_replace('\n\r', " <br>", $string);
            $string = str_replace('\r', " <br>", $string);
            $string = str_replace('\n', " <br>", $string);
        } else {
            $string = str_replace('\r\n', "", $string);
            $string = str_replace('\n\r', "", $string);
            $string = str_replace('\r', "", $string);
            $string = str_replace('\n', "", $string);
        }
        $string = stripslashes($string);
        $string = str_replace('&amp;#', '&#', $string);
        $string = preg_replace("/{{(.*?)}}/", '', $string);

    }
    return $string;
}
function GetUserFromSessionID($session_id, $platform = 'web') {
    global $db;
    if (empty($session_id)) {
        return false;
    }
    $platform   = Secure($platform);
    $session_id = Secure($session_id);
    $return     = $db->where('session_id', $session_id);
    $return     = $db->where('platform', $platform);
    return $db->getValue(T_SESSIONS, 'user_id');
}
function IsLogged() {
   if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $id = GetUserFromSessionID($_SESSION['user_id']);
        if (is_numeric($id) && !empty($id)) {
            return true;
        }
    }
    else if (!empty($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
        $id = GetUserFromSessionID($_COOKIE['user_id']);
        if (is_numeric($id) && !empty($id)) {
            return true;
        }
    }
    else {
        return false;
    }
}
function verify_api_auth($user_id,$session_id, $platform = 'phone') {
    global $db;
    if (empty($session_id) || empty($user_id)) {
        return false;
    }
    $platform   = Secure($platform);
    $session_id = Secure($session_id);
    $user_id    = Secure($user_id);

    $db->where('session_id', $session_id);
    $db->where('user_id', $user_id);
    $db->where('platform', $platform);
    return ($db->getValue(T_SESSIONS, 'COUNT(*)') == 1);
}
function get_langs($lang = 'english') {
    global $db;
    $data   = array();
    $t_lang = T_LANGS;
    try {
        $query  = $db->rawQuery("SELECT `lang_key`, `$lang` FROM `$t_lang`");
        foreach ($query as $item) {
            $data[$item->lang_key] = $item->$lang;
        }
    } catch (Exception $e) {}
    return $data;
}
function CheckIfUserCanRegister($num = 10) {
    global $kd, $sqlConnect;
    if (IS_LOGGED == true) {
        return false;
    }
    $ip = get_ip_address();
    if (empty($ip)) {
        return true;
    }
    $time      = time() - 3200;
    $query     = mysqli_query($sqlConnect, "SELECT COUNT(`id`) as count FROM " . T_USERS . " WHERE `ip_address` = '{$ip}' AND `last_active` > {$time}");
    $sql_query = mysqli_fetch_assoc($query);
    if ($sql_query['count'] > $num) {
        return false;
    }
}

function UsernameExists($username = '') {
    global $db;
    return ($db->where('username', Secure($username))->getValue(T_USERS, 'count(*)') > 0) ? true : false;
}
function UserEmailExists($email = '') {
    global $db;
    return ($db->where('email', Secure($email))->getValue(T_USERS, 'count(*)') > 0) ? true : false;
}
function get_ip_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP))
                    return $ip;
            }
        } else {
            if (filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && filter_var($_SERVER['HTTP_X_FORWARDED'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && filter_var($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && filter_var($_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP))
        return $_SERVER['HTTP_FORWARDED'];
    return $_SERVER['REMOTE_ADDR'];
}
function GenerateKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
    $charset = '';
    if ($uselower) {
        $charset .= "abcdefghijklmnopqrstuvwxyz";
    }
    if ($useupper) {
        $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    if ($usenumbers) {
        $charset .= "123456789";
    }
    if ($usespecial) {
        $charset .= "~@#$%^*()_+-={}|][";
    }
    if ($minlength > $maxlength) {
        $length = mt_rand($maxlength, $minlength);
    } else {
        $length = mt_rand($minlength, $maxlength);
    }
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
    }
    return $key;
}
function GetBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    // First get the platform?
    if (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    } elseif (preg_match('/iphone|IPhone/i', $u_agent)) {
        $platform = 'IPhone Web';
    } elseif (preg_match('/android|Android/i', $u_agent)) {
        $platform = 'Android Web';
    } else if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $u_agent)) {
        $platform = 'Mobile';
    } else if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif(preg_match('/Firefox/i',$u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif(preg_match('/Chrome/i',$u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif(preg_match('/Safari/i',$u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif(preg_match('/Opera/i',$u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif(preg_match('/Netscape/i',$u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        } else {
            $version= $matches['version'][1];
        }
    } else {
        $version= $matches['version'][0];
    }
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern,
        'ip_address' => get_ip_address()
    );
}
function getPageFromPath($path = '') {
    if (empty($path)) {
        return false;
    }
    $path = explode("/", $path);
    $data = array();
    $data['link1'] = array();
    if (!empty($path[0])) {
        $data['page'] = $path[0];
    }
    if (!empty($path[1])) {
        unset($path[0]);
        $data['link1'] = $path;
    }
    return $data;
}
function CreateSession() {
    $hash = sha1(rand(1111, 9999));
    if (!empty($_SESSION['hash'])) {
        $_SESSION['hash'] = $_SESSION['hash'];
        return $_SESSION['hash'];
    }
    $_SESSION['hash'] = $hash;
    return $hash;
}
function GetThemes() {
    global $kd;
    $themes = glob('themes/*', GLOB_ONLYDIR);
    return $themes;
}
function createUserSession($user_id = 0,$platform = 'web') {
    global $db,$sqlConnect, $kd;
    if (empty($user_id)) {
        return false;
    }
    $session_id          = sha1(rand(11111, 99999)) . time() . md5(microtime() . $user_id);
    $insert_data         = array(
        'user_id' => $user_id,
        'session_id' => $session_id,
        'platform' => $platform,
        'time' => time()
    );

    $insert              = $db->insert(T_SESSIONS, $insert_data);
   
    $_SESSION['user_id'] = $session_id;
    setcookie("user_id", $session_id, time() + (10 * 365 * 24 * 60 * 60), "/");
    $kd->loggedin = true;

  //  $query_two = mysqli_query($sqlConnect, "DELETE FROM " . T_APP_SESSIONS . " WHERE `session_id` = '{$session_id}'");
    // if ($query_two) {
    //     $ua = serialize(GetBrowser());
    //     $delete_same_session = $db->where('user_id', $user_id)->where('platform_details', $ua)->delete(T_APP_SESSIONS);
    //     $query_three = mysqli_query($sqlConnect, "INSERT INTO " . T_APP_SESSIONS . " (`user_id`, `session_id`, `platform`, `platform_details`, `time`) VALUES('{$user_id}', '{$session_id}', 'web', '$ua'," . time() . ")");
    //     if ($query_three) {
    //         return $session_id;
    //     }
    // }
}
function br2nl($st) {
    $breaks = array(
        "<br />",
        "<br>",
        "<br/>"
    );
    return str_ireplace($breaks, "\r\n", $st);
}
function Resize_Crop_Image($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
    $imgsize = @getimagesize($source_file);
    $width   = $imgsize[0];
    $height  = $imgsize[1];
    $mime    = $imgsize['mime'];
    switch ($mime) {
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image        = "imagegif";
            break;
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image        = "imagepng";
            break;
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image        = "imagejpeg";
            break;
        default:
            return false;
            break;
    }
    $dst_img    = @imagecreatetruecolor($max_width, $max_height);
    $src_img    = $image_create($source_file);
    $width_new  = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    if ($width_new > $width) {
        $h_point = (($height - $height_new) / 2);
        @imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else {
        $w_point = (($width - $width_new) / 2);
        @imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }
    @$image($dst_img, $dst_dir, $quality);


    if ($dst_img)
        @imagedestroy($dst_img);
    if ($src_img)
        @imagedestroy($src_img);
}
function CompressImage($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);
    if ($info['mime'] == 'image/jpeg') {
        $image = @imagecreatefromjpeg($source_url);
        @imagejpeg($image, $destination_url, $quality);
    } elseif ($info['mime'] == 'image/gif') {
        $image = @imagecreatefromgif($source_url);
        @imagegif($image, $destination_url, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = @imagecreatefrompng($source_url);
        @imagepng($image, $destination_url);
    }
}
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
function LoadAdminLinkSettings($link = '') {
    global $site_url;
    return $site_url . '/admin-cp/' . $link;
}
function LoadAdminLink($link = '') {
    global $site_url;
    return $site_url . '/admin-panel/' . $link;
}
function LoadAdminPage($page_url = '', $data = array(), $set_lang = true) {
    global $kd, $lang_array, $config, $db;
    $page = './admin-panel/pages/' . $page_url . '.html';
    if (!file_exists($page)) {
        return false;
    }
    $page_content = '';
    ob_start();
    require($page);
    $page_content = ob_get_contents();
    ob_end_clean();
    if ($set_lang == true) {
        $page_content = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($lang_array) {
            return (isset($lang_array[$m[1]])) ? $lang_array[$m[1]] : '';
        }, $page_content);
    }
    if (!empty($data) && is_array($data)) {
        foreach ($data as $key => $replace) {
            if ($key == 'USER_DATA') {
                $replace = ToArray($replace);
                $page_content = preg_replace_callback("/{{USER (.*?)}}/", function($m) use ($replace) {
                    return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
                }, $page_content);
            } else {
                if( is_array($replace) || is_object($replace) ){
                    $arr = explode('_',$key);
                    $k = strtoupper($arr[0]);
                    $replace = ToArray($replace);
                    $page_content = preg_replace_callback("/{{".$k." (.*?)}}/", function($m) use ($replace) {
                        return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
                    }, $page_content);
                }else{
                    $object_to_replace = "{{" . $key . "}}";
                    $page_content      = str_replace($object_to_replace, $replace, $page_content);
                }
            }
        }
    }
    if (IS_LOGGED == true) {
        $replace = ToArray($kd->user);
        $page_content = preg_replace_callback("/{{ME (.*?)}}/", function($m) use ($replace) {
            return (isset($replace[$m[1]])) ? $replace[$m[1]] : '';
        }, $page_content);
    }
    $page_content = preg_replace("/{{LINK (.*?)}}/", UrlLink("$1"), $page_content);
    $page_content = preg_replace_callback("/{{CONFIG (.*?)}}/", function($m) use ($config) {
        return (isset($config[$m[1]])) ? $config[$m[1]] : '';
    }, $page_content);
    return $page_content;
}
function ChatExists($id) {
    global $db, $kd;

  if (!empty($id)){
     $chat_exits = $db->where("user_one", $kd->user->id)->where("user_two", $id)->getValue(T_CHATS, 'count(*)');
            if (!empty($chat_exits)) {
                $db->where("user_two", $kd->user->id)->where("user_one", $id)->update(T_CHATS, array('time' => time()));
                $db->where("user_one", $kd->user->id)->where("user_two", $id)->update(T_CHATS, array('time' => time()));
                if ($db->where("user_two", $kd->user->id)->where("user_one", $id)->getValue(T_CHATS, 'count(*)') == 0) {
                    $db->insert(T_CHATS, array('user_two' => $kd->user->id, 'user_one' => $id,'time' => time()));
                }
            } else {
                $db->insert(T_CHATS, array('user_one' => $kd->user->id, 'user_two' => $id,'time' => time()));
                if (empty($db->where("user_two", $kd->user->id)->where("user_one", $id)->getValue(T_CHATS, 'count(*)'))) {
                    $db->insert(T_CHATS, array('user_two' => $kd->user->id, 'user_one' => $id,'time' => time()));
                }
            }

        }

            return $chat_exits;
  
}
function UpdateAdminDetails() {
    global $kd, $db;

    $get_number_of_applicants = $db->getValue(T_APPLICATIONS, 'count(*)');
    $db->where('name', 'get_number_of_applicants')->update(T_CONFIG, array('value' => $get_number_of_applicants));

    $reports_count = $db->getValue(T_REPORTS, 'count(*)');
     $db->where('name', 'reports_count')->update(T_CONFIG, array('value' => $reports_count));

    $get_total_universities = $db->getValue(T_UNIVERSITY, 'count(*)');
     $db->where('name', 'get_total_universities')->update(T_CONFIG, array('value' => $get_total_universities));
     $get_total_agents = $db->where('account_type', 'agent')->getValue(T_USERS, 'count(*)');
    $db->where('name', 'get_total_agents')->update(T_CONFIG, array('value' => $get_total_agents));

    // $get_sales_count = number_format($db->getValue(T_REPORTS, 'SUM(final_price)'), 2);
    // $update_sales_count = $db->where('name', 'total_sales')->update(T_CONFIG, array('value' => $get_sales_count));

    $get_users_count = $db->getValue(T_USERS, 'count(*)');
    $update_users_count = $db->where('name', 'total_users')->update(T_CONFIG, array('value' => $get_users_count));

    $get_active_users = $db->where('active', '1')->getValue(T_USERS, 'count(*)');
    $db->where('name', 'get_active_users')->update(T_CONFIG, array('value' => $get_active_users));

    $get_total_application_to_universities = $db->getValue(T_APPLICANT_UNIVERSITIES, 'count(*)');
    $db->where('name', 'get_total_application_to_universities')->update(T_CONFIG, array('value' => $get_total_application_to_universities));

    $get_unactive_users_count = $db->where('active', '0')->getValue(T_USERS, 'count(*)');
     $db->where('name', 'total_unactive_users')->update(T_CONFIG, array('value' => $get_unactive_users_count));
    $get_students_with_missing_documents = $db->where('language_certificate', NULL)->orWhere('diploma_file', NULL)->orWhere('passport_file', NULL)->orWhere('transcript_file', NULL)->getValue(T_APPLICANT_EDUCATION_INFO, 'count(*)');
    $db->where('name', 'get_students_with_missing_documents')->update(T_CONFIG, array('value' => $get_students_with_missing_documents));

    $user_statics = array();
    $songs_statics = array();

    $months = array('1','2','3','4','5','6','7','8','9','10','11','12');
    $date = date('Y');

    foreach ($months as $value) {
        $monthNum  = $value;
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $user_statics[] = array('month' => $monthName, 'new_users' => $db->where('registered', "$date/$value")->getValue(T_USERS, 'count(*)'));
        $songs_statics[] = array('month' => $monthName, 'new_songs' => $db->where('YEAR(FROM_UNIXTIME(`time`))', "$date")->where('MONTH(FROM_UNIXTIME(`time`))', "$value")->getValue(T_APPLICATIONS, 'count(*)'));
    }
    $update_user_statics = $db->where('name', 'user_statics')->update(T_CONFIG, array('value' => json_encode($user_statics)));
    $update_songs_statics = $db->where('name', 'songs_statics')->update(T_CONFIG, array('value' => json_encode($songs_statics)));

    $update_saved_count = $db->where('name', 'last_admin_collection')->update(T_CONFIG, array('value' => time()));
}
function QuestionData(&$question, $api = false){
    global $db,$kd,$lang;
    $user = UserData($question->user_id);

    if($user === false){
        return false;
    }
    $answer = '';
    $final_q = '';
    $question->post_type = GetQuestionType($question);

    if($api === true ){
        if($question->is_anonymously === 1){
            $question->type = 'anonymous';
        }else{
            $question->type = 'normal';
        }
        if(isset($question->photo)) {
            if ($question->photo !== NULL && !empty($question->photo)) {
                $question->type = 'photo_poll';
            }
        }

        $question->ask_user_data = [];
        if(isset($question->ask_user_id)) {
            if($question->ask_user_id > 0 && $question->ask_question_id > 0 ){
                $question->type = 'answer';
                $question->ask_user_data = UserData($question->ask_user_id);
            }
        }
        if(isset($question->ask_user_id)) {
            if($question->ask_user_id > 0 && $question->ask_question_id == 0 ){
                $question->type = 'asked';
                $question->ask_user_data = UserData($question->ask_user_id);
            }
        }
        $question->replay_user_data = [];
        if(isset($question->replay_user_id)) {
            if ($question->replay_user_id > 0 && $question->replay_question_id > 0) {
                $question->type = 'reply';
                $question->replay_user_data = UserData($question->replay_user_id);
            }
        }
        $question->shared_user_data = [];
        if(isset($question->shared_user_id)) {
            if ($question->shared_user_id > 0 && $question->shared_question_id > 0) {
                $question->type = 'share';
                $question->shared_user_data = UserData($question->shared_user_id);
            }
        }
    }

    $oreinal_question = PostMarkup($question->question);

    $question->oreinal_question = $oreinal_question;
    $question->decoded_oreinal_question = strip_tags(htmlspecialchars_decode($oreinal_question));

    $question->user_full_data = $user;
    $question->profile_user_id = $question->user_id;
    $question->user_full_name = $user->name;
    $question->user_username = $user->username;
    $question->user_avatar = $user->avatar;
    if($api === true){
        $question->user_full_data = $user;
    }
    if( $question->shared_user_id > 0 || $question->ask_user_id > 0 ){

        if( $question->shared_user_id > 0 ) {
            $is_shared_question_exists = $db->where('id',$question->shared_question_id)->getValue(T_QUESTIONS, 'count(*)');
            if($is_shared_question_exists){
                $kd_user = UserData($question->shared_user_id);
                $question->ask_user_username = $kd_user->username;
                $question->ask_user_name = $kd_user->name;
            }else{
                $question->ask_user_name = '';
            }
            $final_q = nl2br( $oreinal_question );
        }else if($question->ask_user_id > 0 &&  $question->ask_question_id == 0 ) {
            $kd_user = UserData($question->ask_user_id);
            $question->user_full_name = $kd_user->name;
            $question->user_username = $kd_user->username;
            $question->ask_user_username = $user->username;
            $question->ask_user_name = $user->name;
            $question->user_avatar = $kd_user->avatar;

            $final_q = nl2br( $oreinal_question );
        }else if($question->ask_user_id > 0 &&  $question->ask_question_id > 0 ) {
            $kd_user = UserData($question->ask_user_id);
            $question->ask_user_username = $kd_user->username;
            $question->ask_user_name = $kd_user->name;
            $q = $db->where('id',$question->ask_question_id)->getOne(T_QUESTIONS,array('question'));
            $a = $db->where('id',$question->id)->getOne(T_QUESTIONS,array('question'));
            $question->oreinal_question = nl2br(PostMarkup($q->question));
            $question->answer = nl2br(PostMarkup($a->question));
        }else{
            $question->ask_user_name = '';
        }

    }else{
        $final_q = $oreinal_question;
        $question->ask_user_name = '';
    }

    $question->question = nl2br(PostMarkup($final_q));

    $question->like_count = $db->where('question_id',$question->id)->getValue(T_LIKES, 'count(*)');
    $question->like_count = ( $question->like_count > 0 ) ? $question->like_count : '';
    $question->url  = UrlLink('post/' . $question->id);

    $question->IsReported = false;

    $question->is_liked = false;
    $question->is_voted = false;
    $question->vote_count = 0;

    $question->progress_cont1 = 0;
    $question->progress_cont2 = 0;

    if (IS_LOGGED == true) {
        if( $question->ask_user_id == 0 && $question->ask_question_id == 0 && $kd->user->id == $question->user_id){
            $question->isowner = true;
        }

        else if( $question->replay_user_id > 0 && $question->replay_question_id > 0 ){
            $question->isowner = true;
        }

        else if( $question->ask_user_id > 0 && $question->ask_question_id > 0 && $kd->user->id == $question->user_id ) {
            $question->isowner = true;
        }

        else{
            if( $question->ask_user_id > 0 && $question->ask_question_id == 0 && $kd->user->id == $question->ask_user_id) {
                $question->isowner = true;
            }else{
                $question->isowner = false;
            }
        }

        $question->is_liked = IsQuestionLiked($kd->user->id, $question->id);
        $question->is_voted = IsQuestionVoted($question->id);

        $vote_exist  = $db->where('question_id', $question->id)->where('user_id',$kd->user->id)->getOne(T_QUESTIONS_VOTES,array('count(*) as total'));
        if ($vote_exist->total > 0) {
            $question->vote_count = $vote_exist->total;
        }
        
        $question->IsReported = IsQuestionReported($kd->user->id, $question->id);
    }

    if( isset( $question->photo ) ) {
        if ($question->photo !== '') {
            $photo_poll = json_decode($question->photo);
            $question->choice1_id = (isset($photo_poll->choice1_id)) ? $photo_poll->choice1_id : '';
            $question->choice1_url = (isset($photo_poll->choice1_url)) ? $photo_poll->choice1_url : '';
            $question->choice2_id = (isset($photo_poll->choice2_id)) ? $photo_poll->choice2_id : '';
            $question->choice2_url = (isset($photo_poll->choice2_url)) ? $photo_poll->choice2_url : '';

            $Percentages = GetVotePercentages($question->choice1_id, $question->choice2_id);
            $question->progress_cont1 = $Percentages[$question->choice1_id];
            $question->progress_cont2 = $Percentages[$question->choice2_id];
        }
    }

    if( $question->type == 'photo_poll' && $question->ask_question_id > 0 ) {
        $pho = $db->where('id',$question->ask_question_id)->getOne(T_QUESTIONS,array('photo'));
        if( isset($pho->photo) && !empty($pho->photo) ){
            $photo_poll = json_decode($pho->photo);
            $question->choice1_id = (isset($photo_poll->choice1_id)) ? $photo_poll->choice1_id : '';
            $question->choice1_url = (isset($photo_poll->choice1_url)) ? $photo_poll->choice1_url : '';
            $question->choice2_id = (isset($photo_poll->choice2_id)) ? $photo_poll->choice2_id : '';
            $question->choice2_url = (isset($photo_poll->choice2_url)) ? $photo_poll->choice2_url : '';

            $Percentages = GetVotePercentages($question->choice1_id, $question->choice2_id);
            $question->progress_cont1 = $Percentages[$question->choice1_id];
            $question->progress_cont2 = $Percentages[$question->choice2_id];
            
        }
    }

    $question->is_replay = false;

    global $config;
    $censored_words = @explode(",", $config['censored_words']);
    foreach ($censored_words as $censored_word) {
        $censored_word = trim($censored_word);
        $question->question        = str_replace($censored_word, '****', $question->question);
    }


    return $question;
}
function GetQuestionType($question){
    global $kd;
    $type = array();
    if($question->is_anonymously === 1){
        $type['anonymous'] = 'anonymous';
    }else{
        $type['normal'] = 'normal';
    }
    if(isset($question->photo)) {
        if ($question->photo !== NULL && !empty($question->photo)) {
            $type['photo_poll'] = 'photo_poll';
        }
    }
    if(isset($question->ask_user_id)) {
        if($question->ask_user_id > 0 && $question->ask_question_id > 0 ){
            $type['answer'] = 'answer';
        }
    }
    if(isset($question->ask_user_id)) {
        if($question->ask_user_id > 0 && $question->ask_question_id == 0 ){
            $type['asked'] = 'asked';
        }
    }
    if(isset($question->replay_user_id)) {
        if ($question->replay_user_id > 0 && $question->replay_question_id > 0) {
            $type['reply'] = 'reply';
        }
    }
    if(isset($question->shared_user_id)) {
        if ($question->shared_user_id > 0 && $question->shared_question_id > 0) {
            $type['share'] = 'share';
        }
    }

    if (IS_LOGGED == true) {
        if(isset($question->ask_user_id)) {
            if ($question->ask_user_id == 0 && $question->ask_question_id == 0 && $kd->user->id == $question->user_id) {
                $type['owner'] = 'owner';
            }
        }
        if(isset($question->ask_user_id)) {
            if ($question->ask_user_id > 0 && $question->ask_question_id > 0 && $kd->user->id == $question->user_id) {
                $type['owner'] = 'owner';
            }
        }
        if(isset($question->shared_user_id)) {
            if ($question->shared_user_id > 0 && $question->shared_question_id > 0 && $kd->user->id == $question->user_id) {
                $type['owner'] = 'owner';
            }
        }
        if(isset($question->replay_user_id)) {
            if ($question->replay_user_id > 0 && $question->replay_question_id > 0 && $kd->user->id == $question->user_id) {
                $type['owner'] = 'owner';
            }
        }
    }

    return $type;
}
function PostMarkup($text, $link = true, $hashtag = true, $mention = true) {
    if ($link == true) {
        $link_search = '/\[a\](.*?)\[\/a\]/i';
        if (preg_match_all($link_search, $text, $matches)) {
            foreach ($matches[1] as $match) {
                $match_decode     = urldecode($match);
                $match_decode_url = $match_decode;
                $count_url        = mb_strlen($match_decode);
                if ($count_url > 50) {
                    $match_decode_url = mb_substr($match_decode_url, 0, 30) . '....' . mb_substr($match_decode_url, 30, 20);
                }
                $match_url = $match_decode;
                if (!preg_match("/http(|s)\:\/\//", $match_decode)) {
                    $match_url = 'http://' . $match_url;
                }
                $text = str_replace('[a]' . $match . '[/a]', '<a href="' . strip_tags($match_url) . '" target="_blank" class="hash" rel="nofollow">' . $match_decode_url . '</a>', $text);
            }
        }
    }
  
    if ($hashtag == true) {
        $hashtag_regex = '/(#\[([0-9]+)\])/i';
        preg_match_all($hashtag_regex, $text, $matches);
        $match_i = 0;
        foreach ($matches[1] as $match) {
            $hashtag  = $matches[1][$match_i];
            $hashkey  = $matches[2][$match_i];
            $hashdata = GetHashtag($hashkey);
            if (is_array($hashdata)) {
                $hashlink = '<a href="' . UrlLink('hashtag/' . $hashdata['tag']) . '" data-load="?link1=hashtag&hashtag='.$hashdata['tag'].'" class="hash">#' . $hashdata['tag'] . '</a>';
                $text     = str_replace($hashtag, $hashlink, $text);
            }
            $match_i++;
        }
    }
    if ($mention == true) {
        $mention_regex = '/@\[([0-9]+)\]/i';
        if (preg_match_all($mention_regex, $text, $matches)) {
            foreach ($matches[1] as $match) {
                $match         = Secure($match);
                $match_user    = UserData($match);
                $match_search  = '@[' . $match . ']';
                $match_replace = '<span style="display: none;">@' . $match_user->username . '</span><span class="user-popover" data-id="' . $match_user->id . '"><a href="' . UrlLink('@' . $match_user->username) . '" class="hash" data-load="?link1=timeline&id=' . $match_user->username . '">' . $match_user->name . '</a></span>';
                if (isset($match_user->id)) {
                    $text = str_replace($match_search, $match_replace, $text);
                }
            }
        }
    }
    return $text;
}
function GetHashtagPostCount($tag_id){
    global $sqlConnect;
    if (empty($tag_id) or !is_numeric($tag_id) or $tag_id < 1) {
        return false;
    }
    $tag      = Secure($tag_id);
    $search_string = "#[" . $tag . "]";
    $query_one     = "SELECT COUNT(`id`) AS `tags` FROM " . T_QUESTIONS . " WHERE `question` LIKE '%{$search_string}%'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    if (mysqli_num_rows($sql_query_one) == 1) {
        $sql_fetch_one = mysqli_fetch_assoc($sql_query_one);
        return $sql_fetch_one['tags'];
    }
}
function GetSearchHash($s_query) {
    global $sqlConnect;
    $search_query = str_replace('#', '', Secure($s_query));
    $data         = array();
    $query        = mysqli_query($sqlConnect, "SELECT * FROM " . T_HASHTAGS . " WHERE `tag` LIKE '%{$search_query}%' ORDER BY `trend_use_num` DESC LIMIT 10");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['url'] = UrlLink('hashtag/' . $fetched_data['tag']);
        $data[]              = $fetched_data;
    }
    return $data;
}
function GetHashtag($tag = '', $type = true) {
    global $sqlConnect;
    $create = false;
    if (empty($tag)) {
        return false;
    }
    $tag     = Secure($tag);
    $md5_tag = md5($tag);
    if (is_numeric($tag)) {
        $query = " SELECT * FROM " . T_HASHTAGS . " WHERE `id` = {$tag}";
    } else {
        $query  = " SELECT * FROM " . T_HASHTAGS . " WHERE `hash` = '{$md5_tag}' ";
        $create = true;
    }
    $sql_query   = mysqli_query($sqlConnect, $query);
    $sql_numrows = mysqli_num_rows($sql_query);
    $week        = date('Y-m-d', strtotime(date('Y-m-d') . " +2day"));
    if ($sql_numrows == 1) {
        $sql_fetch = mysqli_fetch_assoc($sql_query);
        return $sql_fetch;
    } elseif ($sql_numrows == 0 && $type == true) {
        if ($create == true) {
            $hash          = md5($tag);
            $query_two     = " INSERT INTO " . T_HASHTAGS . " (`hash`, `tag`, `last_trend_time`,`expire`) VALUES ('{$hash}', '{$tag}', " . time() . ", '$week')";
            $sql_query_two = mysqli_query($sqlConnect, $query_two);
            if ($sql_query_two) {
                $sql_id = mysqli_insert_id($sqlConnect);
                $data   = array(
                    'id' => $sql_id,
                    'hash' => $hash,
                    'tag' => $tag,
                    'last_trend_time' => time(),
                    'trend_use_num' => 0
                );
                return $data;
            }
        }
    }
}
function IsQuestionLiked($user_id, $question_id){
    global $db;
    if (empty($user_id)||empty($question_id)) {
        return false;
    }
    $question = $db->where('question_id',$question_id)->where('user_id',$user_id)->getOne(T_LIKES);
    if($question){
        return true;
    }else{
        return false;
    }
}
function IsQuestionVoted($question_id){
    global $kd,$db;
    if(IS_LOGGED === false ){return false;}
    $can_vote = false;
    $vote_exist  = $db->where('question_id', $question_id)->where('user_id',$kd->user->id)->getOne(T_QUESTIONS_VOTES,array('count(*) as total'));
    if ($vote_exist->total > 0) {
        $can_vote = true;
    }
    return $can_vote;
}
function IsQuestionReported($user_id, $question_id){
    global $db;
    if (empty($user_id)||empty($question_id)) {
        return false;
    }
    $question = $db->where('question_id',$question_id)->where('user_id',$user_id)->getOne(T_REPORTS);
    if($question){
        return true;
    }else{
        return false;
    }
}
function GetQuestionAnswers($id){
    global $kd,$db;
    $data = $db->where('ask_question_id',$id)->getOne(T_QUESTIONS,array('count(*) as total'));
    return $data->total;
}

function GetQuestionShares($id){
    global $kd,$db;
    $data = $db->where('shared_question_id',$id)->getOne(T_QUESTIONS,array('count(*) as total'));
    return $data->total;
}
function GetQuestionReply($id){
    global $kd,$db;
    $data = $db->where('replay_question_id',$id)->getOne(T_QUESTIONS,array('count(*) as total'));
    return $data->total;
}
function GetTotalAdsEarning(){
    global $db;
    $data = $db->rawQuery('SELECT SUM(`'.T_USERADS_DATA.'`.spend) AS total FROM `'.T_USERADS_DATA.'`');
    return number_format($data[0]->total,2, '.', '');
}
function slugify($text, string $divider = '-')
    {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}
function GetuniversityByID($id){
  global $db;
   
  $name = $db->where('id', $id)->getOne(T_UNIVERSITY); 
  
  if($name){
    return $name->university;
  } else {
    return "university not found";
  }
}
function GetProgramByID($id){
  global $db;
   
  $name = $db->where('id', $id)->getOne(T_PROGRAM); 
  
  if($name){
    return $name->department;
  } else {
    return "university not found";
  }
}
function GetNotification($args = array()){
    global $kd, $db;
    $options  = array(
        "recipient_id" => 0,
        "type" => null,
        "target" => null,
    );

    $args         = array_merge($options, $args);
    $recipient_id = $args['recipient_id'];
    $type         = $args['type'];
    $target       = $args['target'];
    $data         = array();
    $t_notif      = T_NOTIFICATIONS;

    $limit = 20;
    if( $type == 'all' ) {
        $limit = 40;
    }

    if( $type == 'only_new'){
        $db->where('seen','0');
    }
    $where = "((`target` = '{$target}') OR (`target` = 'all'))";
     
     $db->where($where);

    $db->where('recipient_id',$recipient_id);
    if ($type == 'new') {
        $data = $db->where('seen',0)->getValue($t_notif,'count(*)');
    }

    else{
        $query      = $db->orderBy('id','DESC')->get($t_notif,$limit);
        foreach ($query as $notif_data_row) {
            $data[] = ToArray($notif_data_row);
        }
    }

    $db->where('recipient_id',$recipient_id);
    $db->where('time',(time() - 432000));
    $db->where('seen',0,'>');
    $db->delete($t_notif);

    return $data;
}
function NotifyUser($data = array()){
    global $db;
    if (empty($data) || !is_array($data)) {
        return false;
    }

    if( isset($data['notifier_id']) && isset($data['recipient_id']) ){
        if( $data['notifier_id'] == $data['recipient_id'] ){
            return false;
        }
    }
    $t_notif = T_USER_NOTIFACATIONS;
    $query   = $db->insert($t_notif,$data);
//    if ($jb->config->push_notifications == 1) {
//        NotificationWebPushNotifier();
//    }
    return $query;
}
function Notify($data = array()){
    global $db;
    if (empty($data) || !is_array($data)) {
        return false;
    }

    if( isset($data['notifier_id']) && isset($data['recipient_id']) ){
        if( $data['notifier_id'] == $data['recipient_id'] ){
            return false;
        }
    }
    $t_notif = T_NOTIFICATIONS;
    $query   = $db->insert($t_notif,$data);
//    if ($jb->config->push_notifications == 1) {
//        NotificationWebPushNotifier();
//    }
    return $query;
}
function RunInBackground($data = array()) {
    ob_end_clean();
    header("Content-Encoding: none");
    header("Connection: close");
    ignore_user_abort();
    ob_start();
    if (!empty($data)) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    $size = ob_get_length();
    header("Content-Length: $size");
    ob_end_flush();
    flush();
    session_write_close();
    if (is_callable('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
}