<?php

if (IS_LOGGED == false) {
    $data = array(
        'status' => 400,
        'error' => 'Not logged in'
    );
    echo json_encode($data);
    exit();
}
if (IsAdmin() == false) {
    $data = array(
        'status' => 400,
        'error' => 'Not admin'
    );
    echo json_encode($data);
    exit();
}
if ($first == 'test_sms_message') {
    $message      = 'This is a test message from ' . $kd->config->name;
    $send_message = SendSMSMessage($kd->config->sms_phone_number, $message);
    if ($send_message === true) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
        $data['error']  = $send_message;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'search_in_pages') {
    $keyword = Secure($_POST['keyword']);
    $html    = '';
    
    $files             = scandir('./admin-panel/pages');
    $not_allowed_files = array(
        'edit-custom-page',
        'edit-lang',
        'edit-article',
        'edit-profile-field',
        'edit-video-ad'
    );
    foreach ($files as $key => $file) {
        if (file_exists('./admin-panel/pages/' . $file . '/content.html') && !in_array($file, $not_allowed_files)) {
            
            $string = file_get_contents('./admin-panel/pages/' . $file . '/content.html');
            preg_match_all("@(?s)<h2([^<]*)>([^<]*)<\/h2>@", $string, $matches1);
            
            if (!empty($matches1) && !empty($matches1[2])) {
                foreach ($matches1[2] as $key => $title) {
                    if (strpos(strtolower($title), strtolower($keyword)) !== false) {
                        $page_title = '';
                        preg_match_all("@(?s)<h2([^<]*)>([^<]*)<\/h2>@", $string, $matches3);
                        if (!empty($matches3) && !empty($matches3[2])) {
                            foreach ($matches3[2] as $key => $title2) {
                                $page_title = $title2;
                                break;
                            }
                        }
                        $html .= '<a href="' . LoadAdminLinkSettings($file) . '?highlight=' . $keyword . '"><div  style="padding: 5px 2px;">' . $page_title . '</div><div><small style="color: #333;">' . $title . '</small></div></a>';
                        break;
                    }
                }
            }
            
            preg_match_all("@(?s)<label([^<]*)>([^<]*)<\/label>@", $string, $matches2);
            if (!empty($matches2) && !empty($matches2[2])) {
                foreach ($matches2[2] as $key => $lable) {
                    if (strpos(strtolower($lable), strtolower($keyword)) !== false) {
                        $page_title = '';
                        preg_match_all("@(?s)<h2([^<]*)>([^<]*)<\/h2>@", $string, $matches3);
                        if (!empty($matches3) && !empty($matches3[2])) {
                            foreach ($matches3[2] as $key => $title2) {
                                $page_title = $title2;
                                break;
                            }
                        }
                        
                        $html .= '<a href="' . LoadAdminLinkSettings($file) . '?highlight=' . $keyword . '"><div  style="padding: 5px 2px;">' . $page_title . '</div><div><small style="color: #333;">' . $lable . '</small></div></a>';
                        break;
                    }
                }
            }
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
}


if ($first == 'save-settings') {
    $submit_data = array();
    foreach ($_POST as $key => $settings_to_save) {
        $submit_data[$key] = $settings_to_save;
    }
    $update = false;
    if (!empty($submit_data)) {
        foreach ($submit_data as $key => $value) {
            $update = $db->where('name', $key)->update(T_CONFIG, array(
                'value' => Secure($value, 0)
            ));
            
            if ($key == 'bank_description') {
                
                $update = $db->where('name', $key)->update(T_CONFIG, array(
                    'value' => $value
                ));
                
            }
            if ($key == 'ftp_upload') {
                if ($value == "on") {
                    if ($kd->config->s3_upload == "on") {
                        $update = $db->where('name', 's3_upload')->update(T_CONFIG, array(
                            'value' => "off"
                        ));
                    }
                }
            }
            
            
            if ($key == 's3_upload') {
                if ($value == "on") {
                    if ($kd->config->ftp_upload == "on") {
                        $update = $db->where('name', 'ftp_upload')->update(T_CONFIG, array(
                            'value' => "off"
                        ));
                    }
                }
            }
            if ($key == 'admin_com_sell_videos') {
                if (empty($value) || $value < 0 || !is_numeric($value)) {
                    $update = $db->where('name', $key)->update(T_CONFIG, array(
                        'value' => 0
                    ));
                }
            }
            if ($key == 'queue_count' && (!($value >= 0) || !is_numeric($value))) {
                $update = $db->where('name', $key)->update(T_CONFIG, array(
                    'value' => 0
                ));
            }
            
        }
    }
    if ($update) {
        $data = array(
            'status' => 200
        );
        
    }
}
if ($first == 'insert-invitation') {
    $data           = array(
        'status' => 200,
        'html' => ''
    );
    $kd->invitation = InsertAdminInvitation();
    if ($kd->invitation && is_array($kd->invitation)) {
        $data['html']   = LoadAdminPage('manage-invitation-keys/list');
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'rm-invitation' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $data = array(
        'status' => 304
    );
    if (DeleteAdminInvitation('id', $_GET['id'])) {
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'update-sitemap') {
    $rate = (isset($_POST['rate']) && strlen($_POST['rate']) > 0) ? $_POST['rate'] : false;
    $data = array(
        'status' => 304
    );
    if (Wo_GenirateSiteMap($rate)) {
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'rm-user-invitation' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $data = array(
        'status' => 304
    );
    if (Wo_DeleteUserInvitation('id', $_GET['id'])) {
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'delete-user') {
    if (!empty($_POST['id'])) {
        
        $delete = DeleteUser(Secure($_POST['id']));
        if ($delete) {
            $data = array(
                'status' => 200
            );
        }
    }
}
if ($first == 'update-ads') {
    $updated = false;
    foreach ($_POST as $key => $ads) {
        if ($key != 'hash_id') {
            $ad_data = array(
                'code' => htmlspecialchars(base64_decode($ads)),
                'active' => (empty($ads)) ? 0 : 1
            );
            $update  = $db->where('placement', Secure($key))->update(T_ADS, $ad_data);
            if ($update) {
                $updated = true;
            }
        }
    }
    if ($updated == true) {
        $data = array(
            'status' => 200
        );
    }
}
if ($first == 'submit-sitemap-settings') {
    if (!file_exists('./sitemaps')) {
        @mkdir('./sitemaps', 0777, true);
    }
    $dom      = new DOMDocument();
    $filename = 'sitemaps/sitemap.xml';
    if ($_POST['completed'] == 0) {
        $completed          = 0;
        $videos_file_number = (!empty($_POST['videos_file_number'])) ? (int) $_POST['videos_file_number'] : 0;
        $post_file_number   = (!empty($_POST['post_file_number'])) ? (int) $_POST['post_file_number'] : 0;
        $percentage         = (!empty($_POST['percentage'])) ? (int) $_POST['percentage'] : 0;
        $worked             = (!empty($_POST['worked'])) ? (int) $_POST['worked'] : 0;
        $total_videos       = $db->getValue(T_QUESTIONS, 'count(*)');
        $total_posts        = $db->getValue(T_USERS, 'count(*)');
        $total              = $total_videos + $total_posts;
        if (!empty($_POST['post_offset']) && $_POST['post_offset'] > 0) {
            $post_offset = Secure($_POST['post_offset']);
            $db->where('id', $post_offset, '>');
        }
        $posts = $db->get(T_USERS, 500);
        if (!empty($_POST['videos_offset']) && $_POST['videos_offset'] > 0) {
            $videos_offset = Secure($_POST['videos_offset']);
            $db->where('id', $videos_offset, '>');
        }
        $mysql           = $db->get(T_QUESTIONS, 500);
        $count           = count($mysql) + count($posts) + $worked;
        $sitemap_numbers = ceil($total_videos / 20000);
        $new_file        = false;
        
        if ($videos_file_number > 1 || $post_file_number > 1) {
            $new_file = true;
        }
        if ($percentage == 0) {
            $files = glob('./sitemaps/*');
            foreach ($files as $file) {
                if (is_file($file))
                    unlink($file);
            }
            for ($i = 1; $i <= $sitemap_numbers; $i++) {
                $open_file = fopen("sitemaps/sitemap-" . $i . ".xml", "w");
                $open_file = fopen("sitemaps/sitemap-a-" . $i . ".xml", "w");
            }
            if (filesize('sitemaps/sitemap-' . $videos_file_number . '.xml') < 1) {
                $write_video_data = '<?xml version="1.0" encoding="UTF-8"?>
                                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            }
            if (filesize('sitemaps/sitemap-a-' . $post_file_number . '.xml') < 1) {
                $write_posts_data = '<?xml version="1.0" encoding="UTF-8"?>
                                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            }
        } else if ($videos_file_number > 1) {
            if (filesize('sitemaps/sitemap-' . $videos_file_number . '.xml') < 1) {
                $write_video_data = '<?xml version="1.0" encoding="UTF-8"?>
                                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            }
            $write_posts_data = file_get_contents('sitemaps/sitemap-a-' . $post_file_number . '.xml');
            
            
        } else if ($post_file_number > 1) {
            if (filesize('sitemaps/sitemap-a-' . $post_file_number . '.xml') < 1) {
                $write_posts_data = '<?xml version="1.0" encoding="UTF-8"?>
                                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            }
            $write_video_data = file_get_contents('sitemaps/sitemap-' . $videos_file_number . '.xml');
            
            
        } else {
            $write_video_data = file_get_contents('sitemaps/sitemap-' . $videos_file_number . '.xml');
            $write_posts_data = file_get_contents('sitemaps/sitemap-a-' . $post_file_number . '.xml');
        }
        
        
        if (!empty($mysql)) {
            foreach ($mysql as $key => $question) {
                $write_video_data .= '<url>
                              <loc>' . UrlLink('post/' . $question->id) . '</loc>
                              <lastmod>' . date('c', $question->time) . '</lastmod>
                              <changefreq>monthly</changefreq>
                              <priority>0.8</priority>
                           </url>' . "\n";
            }
        }
        file_put_contents('sitemaps/sitemap-' . $videos_file_number . '.xml', $write_video_data);
        
        
        
        if (!empty($posts)) {
            foreach ($posts as $key => $user) {
                $write_posts_data .= '<url>
                              <loc>' . UrlLink('@' . $user->username) . '</loc>
                              <lastmod>' . date('c', $user->last_active) . '</lastmod>
                              <changefreq>monthly</changefreq>
                              <priority>0.8</priority>
                           </url>' . "\n";
            }
        }
        file_put_contents('sitemaps/sitemap-a-' . $post_file_number . '.xml', $write_posts_data);
        
        if ($total > 0) {
            $percentage = round(($count * 100) / $total, 2);
        }
        if ($count == $total) {
            $percentage = 100;
        }
        
        if ($percentage == 100) {
            $write_posts_data .= "\n</urlset>";
            $write_video_data .= "\n</urlset>";
            file_put_contents('sitemaps/sitemap-' . $videos_file_number . '.xml', $write_video_data);
            file_put_contents('sitemaps/sitemap-a-' . $post_file_number . '.xml', $write_posts_data);
            $files            = glob('./sitemaps/*');
            $write_final_data = '<?xml version="1.0" encoding="UTF-8"?>
                                <sitemapindex  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" >';
            foreach ($files as $file) {
                if (is_file($file)) {
                    $write_final_data .= "\n<sitemap>
                                          <loc>" . $kd->config->site_url . '/' . str_replace('./', '', $file) . "</loc>
                                          <lastmod>" . date('c') . "</lastmod>
                                        </sitemap>";
                }
            }
            $write_final_data .= '</sitemapindex>';
            $file_final           = file_put_contents('sitemap-main.xml', $write_final_data);
            $data['last_created'] = date('d-m-Y');
            $last_created_update  = $update = $db->where('name', 'last_created_sitemap')->update(T_CONFIG, array(
                'value' => Secure($data['last_created'], 0)
            ));
            $completed            = 1;
        }
        
        if (!empty($posts)) {
            $last_post   = $posts[count($posts) - 1];
            $post_offset = $last_post->id;
        } else {
            $post_offset = $_POST['post_offset'];
        }
        if (!empty($mysql)) {
            $last_video    = $mysql[count($mysql) - 1];
            $videos_offset = $last_video->id;
        } else {
            $videos_offset = $_POST['videos_offset'];
        }
        
        $worked = count($mysql) + count($posts) + $worked;
        
        if ($total_videos > 20000 && $worked >= 20000 && !empty($mysql) && $percentage < 100) {
            $write_video_data .= "\n</urlset>";
            file_put_contents('sitemaps/sitemap-' . $videos_file_number . '.xml', $write_video_data);
            $videos_file_number = $videos_file_number + 1;
        }
        if ($total_posts > 20000 && $worked >= 20000 && !empty($posts) && $percentage < 100) {
            $write_posts_data .= "\n</urlset>";
            file_put_contents('sitemaps/sitemap-a-' . $post_file_number . '.xml', $write_posts_data);
            $post_file_number = $post_file_number + 1;
        }
        $data = array(
            'status' => 201,
            'post_offset' => $post_offset,
            'videos_offset' => $videos_offset,
            'percentage_full' => $percentage . '%',
            'percentage' => $percentage,
            'videos_file_number' => $videos_file_number,
            'post_file_number' => $post_file_number,
            'worked' => $worked,
            'completed' => $completed
        );
        
    }
    
}
if ($first == 'save-design') {
    $saveSetting = false;
    if (isset($_FILES['logo']['name'])) {
        $fileInfo = array(
            'file' => $_FILES["logo"]["tmp_name"],
            'name' => $_FILES['logo']['name'],
            'size' => $_FILES["logo"]["size"]
        );
        $media    = UploadLogo($fileInfo);
    }
    if (isset($_FILES['light-logo']['name'])) {
        $fileInfo = array(
            'file' => $_FILES["light-logo"]["tmp_name"],
            'name' => $_FILES['light-logo']['name'],
            'size' => $_FILES["light-logo"]["size"],
            'light-logo' => true
        );
        $media    = UploadLogo($fileInfo);
    }
    if (isset($_FILES['favicon']['name'])) {
        $fileInfo = array(
            'file' => $_FILES["favicon"]["tmp_name"],
            'name' => $_FILES['favicon']['name'],
            'size' => $_FILES["favicon"]["size"],
            'favicon' => true
        );
        $media    = UploadLogo($fileInfo);
    }
    $submit_data = array();
    foreach ($_POST as $key => $settings_to_save) {
        $submit_data[$key] = $settings_to_save;
    }
    $update = false;
    if (!empty($submit_data)) {
        foreach ($submit_data as $key => $value) {
            $update = $db->where('name', $key)->update(T_CONFIG, array(
                'value' => Secure($value, 0)
            ));
        }
    }
    if ($update) {
        $data = array(
            'status' => 200
        );
    }
    $data['status'] = 200;
}
if ($first == 'save-terms') {
    $saveSetting = false;
    foreach ($_POST as $key => $value) {
        if ($key != 'hash_id') {
            $saveSetting = $db->where('type', $key)->update(T_TERMS, array(
                'text' => Secure(base64_decode($value), 0)
            ));
        }
    }
    if ($saveSetting) {
        $data['status'] = 200;
    }
}
if ($first == 'update-question') {
    $error = false;
    if (empty($_POST['question'])) {
        $error = 400;
    } else {
        if (!empty($_FILES["image"])) {
            if (!empty($_FILES["image"]["error"])) {
                $error = 404;
            } else if (!file_exists($_FILES["image"]["tmp_name"])) {
                $error = 405;
            }
        } else if (empty($_POST['id']) || !is_numeric($_POST['id'])) {
            $error = 500;
        }
    }
    if (empty($error)) {
        $insert      = false;
        $active      = (isset($_POST['draft'])) ? '0' : '1';
        $id          = Secure($_POST['id']);
        $update_data = array(
            'question' => Secure($_POST['question']),
            'time' => time(),
            'active' => $active
        );
        if (isset($_POST['is_anonymously'])) {
            $update_data['is_anonymously'] = Secure($_POST['is_anonymously']);
        }
        $insert         = $db->where('id', $id)->update(T_QUESTIONS, $update_data);
        $data['status'] = ($insert && empty($error)) ? 200 : 500;
        
    } else {
        $data['status'] = $error;
    }
}
if ($first == 'delete-user-ad') {
    if (!empty($_POST['id'])) {
        $ad_data = $db->where('id', Secure($_POST['id']))->getOne(T_USER_ADS);
        if (!empty($ad_data)) {
            $s3 = ($kd->config->s3_upload == 'on' || $kd->config->ftp_upload = 'on') ? true : false;
            if (file_exists($ad_data->ad_media)) {
                unlink($ad_data->ad_media);
            }
            
            else if ($s3 === true) {
                DeleteFromToS3($ad_data->ad_media);
            }
            
            $delete = $db->where('id', Secure($_POST['id']))->delete(T_USER_ADS);
            if ($delete) {
                $data = array(
                    'status' => 200
                );
            }
        }
    }
}
if ($first == 'backup') {
    $backup = Backup($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name);
    if ($backup) {
        $data['status'] = 200;
        $data['date']   = date('d-m-Y');
    }
}
use Aws\S3\S3Client;

if ($first == 'testS3') {
    try {
        $s3Client = S3Client::factory(array(
            'version' => 'latest',
            'region' => $kd->config->region,
            'credentials' => array(
                'key' => $kd->config->amazone_s3_key,
                'secret' => $kd->config->amazone_s3_s_key
            )
        ));
        
        $buckets = $s3Client->listBuckets();
        if (!empty($buckets)) {
            if ($s3Client->doesBucketExist($kd->config->s3_bucket_name)) {
                $data['status'] = 200;
                $array          = array(
                    'upload/photos/d-cover.jpg',
                    'upload/photos/d-avatar.jpg',
                    'upload/photos/thumbnail.jpg'
                );
                foreach ($array as $key => $value) {
                    $upload = UploadToS3($value, array(
                        'delete' => 'no'
                    ));
                }
            }
            
            else {
                $data['status'] = 300;
            }
        } else {
            $data['status'] = 500;
        }
    }
    
    catch (Exception $e) {
        $data['status']  = 400;
        $data['message'] = $e->getMessage();
    }
}
if ($first == 'test_ftp') {
    try {
        $ftp = new \FtpClient\FtpClient();
        $ftp->connect($kd->config->ftp_host, false, $kd->config->ftp_port);
        $login = $ftp->login($kd->config->ftp_username, $kd->config->ftp_password);
        if (!empty($kd->config->ftp_path)) {
            if ($kd->config->ftp_path != "./") {
                $ftp->chdir($kd->config->ftp_path);
            }
        }
        $array = array(
            'upload/photos/d-cover.jpg',
            'upload/photos/d-avatar.jpg',
            'upload/photos/thumbnail.jpg'
        );
        foreach ($array as $key => $value) {
            $upload = UploadToS3($value, array(
                'delete' => 'no'
            ));
        }
        $data['status'] = 200;
    }
    catch (Exception $e) {
        $data['status']  = 400;
        $data['message'] = $e->getMessage();
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'add_announcement') {
    $text           = (!empty($_POST['text'])) ? Secure($_POST['text']) : "";
    $data['status'] = 400;
    $re_data        = array(
        'text' => $text,
        'active' => '1',
        'time' => time()
    );
    
    $insert_id = $db->insert(T_ANNOUNCEMENTS, $re_data);
    
    if (!empty($insert_id)) {
        $announcement   = $db->where('id', $insert_id)->getOne(T_ANNOUNCEMENTS);
        $data['status'] = 200;
        $data['html']   = LoadAdminPage("manage-announcements/active", array(
            'ANN_ID' => $announcement->id,
            'ANN_VIEWS' => 0,
            'ANN_TEXT' => Decode($announcement->text),
            'ANN_TIME' => Time_Elapsed_String($announcement->time)
        ));
    }
}
if ($first == 'delete-announcement') {
    $request        = (!empty($_POST['id']) && is_numeric($_POST['id']));
    $data['status'] = 400;
    if ($request === true) {
        $announcement_id = Secure($_POST['id']);
        $db->where('id', $announcement_id)->delete(T_ANNOUNCEMENTS);
        $data['status'] = 200;
    }
}
if ($first == 'toggle-announcement') {
    $request        = (!empty($_POST['id']) && is_numeric($_POST['id']));
    $data['status'] = 400;
    
    if ($request === true) {
        
        $announcement_id = Secure($_POST['id']);
        $announcement    = $db->where('id', $announcement_id)->getOne(T_ANNOUNCEMENTS);
        if (!empty($announcement)) {
            $status = ($announcement->active == 1) ? '0' : '1';
            
            $db->where('id', $announcement_id)->update(T_ANNOUNCEMENTS, array(
                'active' => $status
            ));
            $data['status'] = 200;
            echo $status;
            exit();
        }
        
    }
}
if ($first == 'banip' && !empty($_POST['ip'])) {
    $data    = array(
        'status' => 400
    );
    $request = filter_var($_POST['ip'], FILTER_VALIDATE_IP);
    if (!empty($request)) {
        $table   = T_BANNED_IPS;
        $re_data = array(
            'ip_address' => $_POST['ip'],
            'time' => time()
        );
        
        $ban_id = $db->insert($table, $re_data);
        $ban_ip = $db->where('id', $ban_id)->getOne($table);
        
        if (!empty($ban_ip)) {
            $data['status'] = 200;
            $data['html']   = LoadAdminPage("ban-users/list", array(
                'BANNEDIP_ID' => $ban_ip->id,
                'BANNEDIP_TIME' => Time_Elapsed_String($ban_ip->time),
                'BANNEDIP_ADDR' => $ban_ip->ip_address
            ));
        }
    }
}
if ($first == 'unbanip') {
    $data    = array(
        'status' => 400
    );
    $request = (!empty($_POST['id']) && is_numeric($_POST['id']));
    if (!empty($request)) {
        $table  = T_BANNED_IPS;
        $ban_id = Secure($_POST['id']);
        $db->where('id', $ban_id)->delete($table);
        $data['status'] = 200;
    }
}
if ($first == 'save-custom-design-settings') {
    $data   = array(
        'status' => 200
    );
    $code   = array();
    $code[] = (!empty($_POST['header_js'])) ? $_POST['header_js'] : "";
    $code[] = (!empty($_POST['footer_js'])) ? $_POST['footer_js'] : "";
    $code[] = (!empty($_POST['css_styles'])) ? $_POST['css_styles'] : "";
    $errors = custom_design('save', $code);
    
    if (!empty($errors)) {
        $data = array(
            'status' => 500,
            'errors' => $errors
        );
    }
}
if ($first == 'reset_apps_key') {
    $app_key     = sha1(microtime());
    $data_config = array(
        'apps_api_key' => $app_key
    );
    
    foreach ($data_config as $name => $value) {
        $db->where('name', $name)->update(T_CONFIG, array(
            'value' => Secure($value, 0)
        ));
    }
    
    $data['status']  = 200;
    $data['app_key'] = $app_key;
}

if ($first == 'update_lang_key' && !empty($_POST['id_of_key'])) {
    $up_data   = array();
    $id_of_key = Secure($_POST['id_of_key']);
    
    foreach ($langs as $lang) {
        if (!empty($_POST[$lang])) {
            $up_data[$lang] = Secure($_POST[$lang]);
        }
    }
    
    $update = $db->where('lang_key', $id_of_key)->update(T_LANGS, $up_data);
    
    if ($update) {
        $data['status'] = 200;
    }
}
if ($first == 'add_new_lang' && !empty($_POST['lang'])) {
    
    if (in_array(strtolower($_POST['lang']), $langs)) {
        $data['status'] = 400;
    }
    
    else {
        $lang_name = Secure($_POST['lang']);
        $lang_name = strtolower($lang_name);
        $t_langs   = T_LANGS;
        
        $sql = "
            ALTER TABLE `$t_langs` ADD `$lang_name` 
            TEXT CHARACTER 
            SET utf8 COLLATE utf8_unicode_ci 
            NULL DEFAULT NULL
        ";
        
        $query = mysqli_query($sqlConnect, $sql);
        
        if ($query) {
            
            $english = get_langs('english');
            $content = file_get_contents('assets/langs/english.php');
            $fp      = fopen("assets/langs/$lang_name.php", "wb");
            fwrite($fp, $content);
            fclose($fp);
            
            foreach ($english as $key => $lang) {
                mysqli_query($sqlConnect, "UPDATE `$t_langs` SET `{$lang_name}` = '$lang' WHERE `lang_key` = '{$key}'");
            }
            
            $data['status'] = 200;
        }
    }
}
if ($first == 'add_new_lang_key' && !empty($_POST['lang_key'])) {
    $lang_key = Secure($_POST['lang_key']);
    $mysqli   = $db->where('lang_key', $lang_key)->getValue(T_LANGS, 'count(*)');
    
    if ($mysqli == 0) {
        
        $insert_id = $db->insert(T_LANGS, array(
            'lang_key' => $lang_key
        ));
        
        if ($insert_id) {
            $data['status'] = 200;
            $data['url']    = LoadAdminLinkSettings('manage-languages');
        }
    }
    
    else {
        $data['status'] = 400;
    }
}
if ($first == 'delete_lang' && !empty($_GET['id'])) {
    if (in_array($_GET['id'], $langs)) {
        $lang_name = Secure($_GET['id']);
        $t_langs   = T_LANGS;
        $query     = mysqli_query($sqlConnect, "ALTER TABLE `$t_langs` DROP COLUMN `$lang_name`");
        if ($query) {
            if (file_exists("assets/langs/$lang_name.php")) {
                unlink("assets/langs/$lang_name.php");
            }
            $data['status'] = 200;
        }
    }
}
if ($first == 'get_user_ad' && !empty($_POST['id'])) {
    $data['status'] = 400;
    if (is_numeric($_POST['id']) && $_POST['id'] > 0) {
        $id = Secure($_POST['id']);
        $ad = $db->where('id', $id)->getOne(T_USER_ADS);
        if (!empty($ad)) {
            $user_data      = UserData($ad->user_id);
            $data['html']   = LoadAdminPage('manage-user-ads/view', array(
                'ID' => $ad->id,
                'USERNAME' => $user_data->name,
                'USER_AVATAR' => $user_data->avatar,
                'DATE' => date("Y-F-d", $ad->posted),
                'IMG' => GetMedia($ad->ad_media)
            ));
            $data['status'] = 200;
        }
    }
}
if ($first == 'generate_fake_users') {
    require "assets/import/fake-users/vendor/autoload.php";
    $faker = Faker\Factory::create();
    if (empty($_POST['password'])) {
        $_POST['password'] = '123456789';
    }
    $count_users = $_POST['count_users'];
    $password    = $_POST['password'];
    $avatar      = $_POST['avatar'];
    RunInBackground(array(
        'status' => 200
    ));
    for ($i = 0; $i < $count_users; $i++) {
        $genders     = array(
            "male",
            "female"
        );
        $random_keys = array_rand($genders, 1);
        $gender      = array_rand(array(
            "male",
            "female"
        ), 1);
        $gender      = $genders[$random_keys];
        $re_data     = array(
            'email' => Secure(str_replace(".", "_", $faker->userName) . '_' . rand(111, 999) . "@yahoo.com", 0),
            'username' => Secure($faker->userName . '_' . rand(111, 999), 0),
            'password' => Secure($password, 0),
            'email_code' => Secure(md5($faker->userName . '_' . rand(111, 999)), 0),
            'src' => 'Fake',
            'gender' => Secure($gender),
            'last_active' => time(),
            'active' => 1,
            'registered' => date('Y') . '/' . intval(date('m')),
            'first_name' => $faker->firstName($gender),
            'last_name' => $faker->lastName
        );
        if ($avatar == 1) {
            $re_data['avatar'] = ImportImageFromFile($faker->imageUrl(150, 150));
        }
        $add_user = $db->insert(T_USERS, $re_data);
    }
    
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'auto_friend') {
    if (!empty($_GET['users'])) {
        $save = $db->where('name', 'auto_friend_users')->update(T_CONFIG, array(
            'value' => Secure($_GET['users'], 0)
        ));
        if ($save) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'delete-questions') {
    if (!empty($_POST['id'])) {
        $delete = DeleteQuestion(Secure($_POST['id']));
        if ($delete) {
            $data = array(
                'status' => 200
            );
        }
    }
}
if ($first == 'add_followers') {
    $data           = array();
    $data['status'] = 200;
    $data['error']  = false;
    if (empty($_POST['followers']) || empty($_POST['user_id'])) {
        $data['status'] = 500;
        $data['error']  = __('please_check_details');
    }
    if (!is_numeric($_POST['followers']) || !is_numeric($_POST['user_id'])) {
        $data['status'] = 500;
        $data['error']  = 'Numbers only are allowed';
    }
    if ($_POST['followers'] < 0 || $_POST['user_id'] < 0) {
        $data['status'] = 500;
        $data['error']  = 'Integer numbers only are allowed';
    }
    $userData = UserData($_POST['user_id']);
    if (empty($data['error']) && $data['status'] != 500) {
        $followers  = floor($_POST['followers']);
        $usersCount = $db->getValue(T_USERS, 'COUNT(*)');
        if ($followers > $usersCount) {
            $data['status'] = 500;
            $data['error']  = "Followers can't be more than your users: $usersCount";
        }
        if ($db->getValue(T_USERS, "MAX(id)") <= $userData->last_follow_id) {
            $data['status'] = 500;
            $data['error']  = "No more users left to follow, all the users are following {$userData->name}.";
        }
    }
    if (empty($data['error']) && $data['error'] != 500) {
        $users_id = array();
        
        $users = $db->where('id', $userData->last_follow_id, ">")->get(T_USERS, $followers, 'id');
        foreach ($users as $key => $i) {
            $users_id[] = $i->id;
        }
        if (empty($data['error']) && $data['status'] != 500 && !empty($users_id)) {
            RunInBackground(array(
                'status' => 200
            ));
            $followed    = RegisterFollow($_POST['user_id'], $users_id);
            $update_user = $db->where('id', $_POST['user_id'])->update(T_USERS, array(
                "last_follow_id" => Secure(end($users_id))
            ));
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'delete-reports') {
    $request        = (!empty($_POST['id']) && is_numeric($_POST['id']));
    $data['status'] = 400;
    if ($request === true) {
        $report_id = Secure($_POST['id']);
        $db->where('id', $report_id)->delete(T_REPORTS);
        $data['status'] = 200;
    }
}

if ($first == 'select_currency') {
    
    if (!empty($_POST['currency']) && in_array($_POST['currency'], $kd->config->currency_array)) {
        
        $currency = Secure($_POST['currency']);
        
        $db->where('name', 'payment_currency')->update(T_CONFIG, array(
            'value' => $currency
        ));
        
        if (in_array($_POST['currency'], $kd->paypal_currency)) {
            
            $db->where('name', 'paypal_currency')->update(T_CONFIG, array(
                'value' => $currency
            ));
            
        }
        
        if (in_array($_POST['currency'], $kd->checkout_currency)) {
            
            $db->where('name', 'checkout_currency')->update(T_CONFIG, array(
                'value' => $currency
            ));
            
        }
        
        if (in_array($_POST['currency'], $kd->stripe_currency)) {
            
            $db->where('name', 'stripe_currency')->update(T_CONFIG, array(
                'value' => $currency
            ));
            
        }
        
    }
    
    $data = array(
        
        'status' => 200
        
    );
    
}

if ($first == 'add_new_curreny') {
    
    if (!empty($_POST['currency']) && !empty($_POST['currency_symbol'])) {
        
        $kd->config->currency_array[] = Secure($_POST['currency']);
        
        $kd->config->currency_symbol_array[Secure($_POST['currency'])] = Secure($_POST['currency_symbol']);
        
        $db->where('name', 'currency_array')->update(T_CONFIG, array(
            'value' => serialize($kd->config->currency_array)
        ));
        
        $db->where('name', 'currency_symbol_array')->update(T_CONFIG, array(
            'value' => serialize($kd->config->currency_symbol_array)
        ));
        
    }
    
    $data = array(
        'status' => 200
    );
    
}

if ($first == 'edit_curreny') {
    
    if (!empty($_POST['currency']) && !empty($_POST['currency_symbol']) && in_array($_POST['currency_id'], array_keys($kd->config->currency_array))) {
        
        $kd->config->currency_array[$_POST['currency_id']] = Secure($_POST['currency']);
        
        $kd->config->currency_symbol_array[Secure($_POST['currency'])] = Secure($_POST['currency_symbol']);
        
        $db->where('name', 'currency_array')->update(T_CONFIG, array(
            'value' => serialize($kd->config->currency_array)
        ));
        
        $db->where('name', 'currency_symbol_array')->update(T_CONFIG, array(
            'value' => serialize($kd->config->currency_symbol_array)
        ));
        
    }
    
    $data = array(
        
        'status' => 200
        
    );
    
}

if ($first == 'remove__curreny') {
    
    if (!empty($_POST['currency'])) {
        
        if (in_array($_POST['currency'], $kd->config->currency_array)) {
            
            foreach ($kd->config->currency_array as $key => $currency) {
                
                if ($currency == $_POST['currency']) {
                    
                    if (in_array($currency, array_keys($kd->config->currency_symbol_array))) {
                        
                        unset($kd->config->currency_symbol_array[$currency]);
                        
                    }
                    
                    unset($kd->config->currency_array[$key]);
                    
                }
                
            }
            
            if ($kd->config->payment_currency == $_POST['currency']) {
                
                if (!empty($kd->config->currency_array)) {
                    
                    $db->where('name', 'payment_currency')->update(T_CONFIG, array(
                        'value' => reset($kd->config->currency_array)
                    ));
                    
                }
                
            }
            
            $db->where('name', 'currency_array')->update(T_CONFIG, array(
                'value' => serialize($kd->config->currency_array)
            ));
            
            $db->where('name', 'currency_symbol_array')->update(T_CONFIG, array(
                'value' => serialize($kd->config->currency_symbol_array)
            ));
            
        }
        
    }
    
    $data = array(
        
        'status' => 200
        
    );
    
}

if ($first == 'delete_receipt') {
    
    if (!empty($_GET['receiid'])) {
        
        $user_id = Secure($_GET['user_id']);
        
        $id = Secure($_GET['receiid']);
        
        $photo_file = Secure($_GET['receifile']);
        
        $receipt = $db->where('id', $id)->getOne('bank_receipts', array(
            '*'
        ));
        
        
        
        $notif_data = array(
            
            'notifier_id' => $kd->user->id,
            
            'recipient_id' => $receipt->user_id,
            
            'type' => 'bank_decline',
            
            'url' => "",
            
            'time' => time()
            
        );
        
        Notify($notif_data);
        
        
        
        $db->where('id', $id)->delete('bank_receipts');
        
        if (file_exists($photo_file)) {
            
            @unlink(trim($photo_file));
            
        }
        
        else if ($kd->config->s3_upload == 'on' || $kd->config->ftp_upload == 'on' || $kd->config->spaces == 'on') {
            
            @DeleteFromToS3($photo_file);
            
        }
        
        $data = array(
            
            'status' => 200
            
        );
        
    }
    
}
if ($first == 'verification' && !empty($_POST['id']) && !empty($_POST['a'])) {
    $request = (is_numeric($_POST['id']) && is_numeric($_POST['a']) && in_array($_POST['a'], array(
        1,
        2,
        3
    )));
    
    if ($request === true) {
        
        $request_id   = Secure($_POST['id']);
        $request_data = $db->where('id', $request_id)->getOne(T_VERIF_REQUESTS);
        
        if ($_POST['a'] == 1 && !empty($request_data)) {
            $up_data = array(
                'verified' => 1
            );
            
            $db->where('id', $request_data->user_id)->update(T_USERS, $up_data);
            $db->where('id', $request_id)->delete(T_VERIF_REQUESTS);
            $data['status'] = 200;
            
            $notif_data = array(
                'recipient_id' => $request_data->user_id,
                'type' => 'approved',
                'text' => 'Your post account has been verified',
                'url' => "/#",
                'time' => time()
            );
            
            Notify($notif_data);
        }
        
        else if ($_POST['a'] == 2 && !empty($request_data)) {
            $user_data      = UserData($request_data->user_id);
            $data['status'] = 200;
            $data['html']   = LoadAdminPage('verification-requests/view', array(
                'ID' => $request_data->id,
                'USERNAME' => $request_data->name,
                'USER_AVATAR' => $user_data->avatar,
                'TEXT' => $request_data->message,
                'DATE' => date("Y-F-d", $request_data->time),
                'IMG' => GetMedia($request_data->media_file)
            ));
        }
        
        else if ($_POST['a'] == 3) {
            $db->where('id', $request_id)->delete(T_VERIF_REQUESTS);
            $data['status'] = 200;
        }
    }
}

if ($first == 'approve_receipt') {
    if (!empty($_GET['receipt_id'])) {
        $photo_id = Secure($_GET['receipt_id']);
        $receipt  = $db->where('id', $photo_id)->getOne(T_BANK_TRANSFER, array(
            '*'
        ));
        
        if ($receipt) {
            
            
            $amount       = 0;
            $realprice    = $receipt->price;
            $payer_id     = $receipt->user_id;
            $promotAmount = $kd->config->promote_question_cost;
            
            
            
            $updated = $db->where('id', $photo_id)->update(T_BANK_TRANSFER, array(
                'approved' => 1,
                'approved_at' => time()
            ));
            if ($updated === true) {
                
                
                
                if ($receipt->question_id > 0) {
                    
                    $final_price22       = $realprice - $promotAmount;
                    $updatePromoQuestion = $db->where('id', $receipt->question_id)->update(T_QUESTIONS, array(
                        'promoted' => time()
                    ));
                    $addUserWallet       = $db->where('id', $payer_id)->update(T_USERS, array(
                        'wallet' => $db->inc($final_price22)
                    ));
                    
                    if ($addUserWallet) {
                        $notif_data = array(
                            'notifier_id' => $user->id,
                            'recipient_id' => $payer_id,
                            'type' => 'approved',
                            'text' => 'Your post has been updated',
                            'question_id' => $questionid,
                            'url' => "/#",
                            'time' => time()
                        );
                        
                        Notify($notif_data);
                    }
                }
                
                if ($receipt) {
                    
                    $updateUser = $db->where('id', $receipt->user_id)->update(T_USERS, array(
                        'wallet' => $db->inc($realprice)
                    ));
                    if ($updateUser) {
                        $notif_data = array(
                            'notifier_id' => $user->id,
                            'recipient_id' => $payer_id,
                            'type' => 'approved',
                            'text' => " Your Requestion Has Been Approved",
                            'url' => "/#",
                            'time' => time()
                        );
                        
                        Notify($notif_data);
                    }
                }
            }
            
            $notif_data = array(
                'notifier_id' => $user->id,
                'recipient_id' => $receipt->user_id,
                'type' => 'approve_receipt',
                'text' => 'Your payment request has been approved',
                'url' => "/#",
                'time' => time()
            );
            Notify($notif_data);
            
            $data = array(
                'status' => 200,
                'message' => 'Approved'
            );
        }
    }
    
}
if ($first == 'add_new_page') {
    if (!empty($_POST['page_name']) && !empty($_POST['page_content']) && !empty($_POST['page_title'])) {
        $page_name    = Secure($_POST['page_name']);
        $page_content = Secure(str_replace(array(
            "\r",
            "\n"
        ), "", $_POST['page_content']));
        $page_title   = Secure($_POST['page_title']);
        $page_type    = 0;
        if (!empty($_POST['page_type'])) {
            $page_type = 1;
        }
        
        if (!preg_match('/^[\w]+$/', $page_name)) {
            $data = array(
                'status' => 400,
                'message' => 'Invalid page name characters'
            );
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
        $data_ = array(
            'page_name' => $page_name,
            'page_content' => $page_content,
            'page_title' => $page_title,
            'page_type' => $page_type
        );
        $add   = $db->insert(T_CUSTOM_PAGES, $data_);
        if ($add) {
            $data['status'] = 200;
        }
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Please fill all the required fields'
        );
    }
}

if ($first == 'delete_custom_page') {
    if (!empty($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0) {
        $id = Secure($_POST['id']);
        $db->where('id', $id)->delete(T_CUSTOM_PAGES);
        $data['status'] = 200;
    }
}

if ($first == 'edit_page') {
    
    if (!empty($_POST['page_id']) && !empty($_POST['page_name']) && !empty($_POST['page_content']) && !empty($_POST['page_title'])) {
        $page_name    = $_POST['page_name'];
        $page_content = $_POST['page_content'];
        $page_title   = $_POST['page_title'];
        $page_type    = 0;
        if (!empty($_POST['page_type'])) {
            $page_type = 1;
        }
        
        
        if (!preg_match('/^[\w]+$/', $page_name)) {
            
            
            
            $data = array(
                'status' => 400,
                'message' => 'Invalid page name characters'
            );
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
        $data_ = array(
            'page_name' => $page_name,
            'page_content' => $page_content,
            'page_title' => $page_title,
            'page_type' => $page_type
        );
        $add   = $db->where('id', Secure($_POST['page_id']))->update(T_CUSTOM_PAGES, $data_);
        if ($add) {
            $data['status'] = 200;
        }
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Please fill all the required fields'
        );
    }
}
if ($second == 'test_spaces') {
    include_once("assets/import/spaces/spaces.php");
    try {
        $key        = $kd->config->spaces_key;
        $secret     = $kd->config->spaces_secret;
        $space_name = $kd->config->space_name;
        $region     = $kd->config->space_region;
        $space      = new SpacesConnect($key, $secret, $space_name, $region);
        $buckets    = $space->ListSpaces();
        $result     = $space->PutCORS(array(
            'AllowedHeaders' => array(
                'Authorization'
            ),
            'AllowedMethods' => array(
                'POST',
                'GET',
                'PUT'
            ),
            'AllowedOrigins' => array(
                '*'
            ),
            'ExposeHeaders' => array(),
            'MaxAgeSeconds' => 3000
        ));
        if (!empty($buckets)) {
            if (!empty($space->GetSpaceName())) {
                $data['status'] = 200;
                $array          = array(
                    'upload/photos/d-cover.jpg',
                    'upload/photos/d-avatar.jpg',
                    'upload/photos/f-avatar.png',
                    'upload/photos/thumbnail.jpg'
                );
                foreach ($array as $key => $value) {
                    $upload = UploadToS3($value, array(
                        'delete' => 'no'
                    ));
                }
            } else {
                $data['status'] = 300;
            }
        } else {
            $data['status'] = 500;
        }
    }
    catch (Exception $e) {
        $data['status']  = 400;
        $data['message'] = $e->getMessage();
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}

if ($first == 'test_cloud') {
    if ($kd->config->cloud_upload != 'on' || empty($kd->config->cloud_file_path) || empty($kd->config->cloud_bucket_name)) {
        $data['message'] = 'Please enable Google Cloud Storage and fill all fields.';
    } elseif (!file_exists($kd->config->cloud_file_path)) {
        $data['message'] = 'Google Cloud File not found on your server Please upload it to your server.';
    } else {
        require_once 'assets/cloud/vendor/autoload.php';
        
        
        try {
            $storage = new StorageClient(array(
                'keyFilePath' => $kd->config->cloud_file_path
            ));
            $bucket  = $storage->bucket($kd->config->cloud_bucket_name);
            if ($bucket) {
                
                $array = array(
                    'upload/photos/d-avatar.jpg',
                    'upload/photos/d-cover.jpg',
                    'upload/photos/d-group.jpg',
                    'upload/photos/d-page.jpg',
                    'upload/photos/d-blog.jpg',
                    'upload/photos/game-icon.png',
                    'upload/photos/d-film.jpg',
                    'upload/photos/incognito.png',
                    'upload/photos/app-default-icon.png'
                );
                foreach ($array as $key => $value) {
                    $fileContent = file_get_contents($value);
                    
                    $storageObject = $bucket->upload($fileContent, array(
                        'name' => $value
                    ));
                }
                
                $data['status'] = 200;
            } else {
                $data['message'] = 'Error in connection';
            }
        }
        catch (Exception $e) {
            $data['message'] = $e;
        }
    }
    
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'notifications-get-users') {
    $html  = '';
    $users = GetUsersByName($_POST['name'], false, 10);
    if ($users && count($users) > 0) {
        foreach ($users as $key) {
            $html .= LoadAdminPage('mass-notifications/list', array(
                'NOTIFICATION_DATA' => $key
            ));
        }
        $data['status'] = 200;
        $data['html']   = $html;
    } else {
        $data = array(
            'status' => 404,
            'message' => ' no user found'
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'notifications-send') {
    $error = false;
    $users = array();
    if (!isset($_POST['url']) || !isset($_POST['description'])) {
        $error = true;
    } else {
        if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
            $error = true;
            $data  = array(
                'status' => 304,
                'message' => 'url invalid'
            );
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
        if (strlen($_POST['description']) < 5 || strlen($_POST['description']) > 300) {
            $error = true;
            $data  = array(
                'status' => 304,
                'message' => 'description too short'
            );
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
    }
    if (!$error) {
        if (empty($_POST['notifc-users'])) {
            $users = GetUserIds();
        } elseif ($_POST['notifc-users'] && strlen($_POST['notifc-users']) > 0) {
            $users = explode(',', $_POST['notifc-users']);
        }
        $url               = Secure($_POST['url']);
        $message           = Secure($_POST['description']);
        $registration_data = array(
            'full_link' => $url,
            'text' => $message,
            'recipients' => $users
        );
        if (RegisterAdminNotification($registration_data)) {
            $data = array(
                'status' => 200,
                'message' => 'notification sent'
            );
        }
    } else {
        $data = array(
            'status' => 304,
            'message' => 'please check details'
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'send_mail_to_mock_users') {
    $isset_test = 'off';
    $types      = array(
        'week',
        'month',
        '3month',
        '6month',
        '9month',
        'year'
    );
    if (empty($_POST['message']) || empty($_POST['subject']) || empty($_POST['send_to']) || !in_array($_POST['send_to'], $types)) {
        $send_errors = $error_icon . __('please_check_details');
    } else {
        if (!empty($_POST['test_message'])) {
            if ($_POST['test_message'] == 'on') {
                $isset_test = 'on';
            }
        }
        if ($isset_test == 'on') {
            $send_message_data = array(
                'from_email' => $kd->config->siteEmail,
                'from_name' => $kd->config->siteName,
                'to_email' => $asdk->user->email,
                'to_name' => $kd->user->name,
                'subject' => $_POST['subject'],
                'charSet' => 'utf-8',
                'message_body' => $_POST['message'],
                'is_html' => true
            );
            $send              = SendMessage($send_message_data);
        } else {
            $users = array();
            if (isset($_POST['selected_emails']) && strlen($_POST['selected_emails']) > 0) {
                $user_ids = explode(',', $_POST['selected_emails']);
                if (is_array($user_ids) && count($user_ids) > 0) {
                    foreach ($user_ids as $user_id) {
                        $users[] = UserData($user_id);
                    }
                }
            } else {
                $users = GetUsersByTime($_POST['send_to']);
            }
            RunInBackground(array(
                'status' => 300
            ));
            foreach ($users as $user) {
                $send_message_data = array(
                    'from_email' => $kd->config->siteEmail,
                    'from_name' => $kd->config->siteName,
                    'to_email' => $asdk->user->email,
                    'to_name' => $kd->user->name,
                    'subject' => $_POST['subject'],
                    'charSet' => 'utf-8',
                    'message_body' => $_POST['message'],
                    'is_html' => true
                );
                $send              = SendMessage($send_message_data);
                $mail->ClearAddresses();
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($send_errors)) {
        $send_errors_data = array(
            'status' => 400,
            'message' => $send_errors
        );
        echo json_encode($send_errors_data);
    } else {
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    }
    exit();
}
if ($first == 'get_users_emails' && isset($_POST['name'])) {
    $html  = '';
    $users = GetUsersByName($_POST['name'], false, 20);
    
    
    if (count($users) > 0) {
        foreach ($users as $user) {
            $html .= LoadAdminPage('send_email/list', array(
                'USER' => $user
            ));
        }
        $data['status'] = 200;
        $data['html']   = $html;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($first == 'send_mail_to_all_users') {
    $isset_test = 'off';
    if (empty($_POST['message']) || empty($_POST['subject'])) {
        $send_errors = $error_icon . __('please_check_details');
    } else {
        if (!empty($_POST['test_message'])) {
            if ($_POST['test_message'] == 'on') {
                $isset_test = 'on';
            }
        }
        if ($isset_test == 'on') {
            $send_message_data = array(
                'from_email' => $kd->config->siteEmail,
                'from_name' => $kd->config->siteName,
                'to_email' => $asdk->user->email,
                'to_name' => $kd->user->name,
                'subject' => $_POST['subject'],
                'charSet' => 'utf-8',
                'message_body' => $_POST['message'],
                'is_html' => true
            );
            $send              = SendMessage($send_message_data);
            $mail->ClearAddresses();
        } else {
            $users_type = 'all';
            $users      = array();
            if (isset($_POST['selected_emails']) && strlen($_POST['selected_emails']) > 0) {
                $user_ids = explode(',', $_POST['selected_emails']);
                if (is_array($user_ids) && count($user_ids) > 0) {
                    foreach ($user_ids as $user_id) {
                        $users[] = UserData($user_id);
                    }
                }
            } else if ($_POST['send_to'] == 'active') {
                $users = GetAllUsersByType('active');
            } else if ($_POST['send_to'] == 'inactive') {
                $users = GetAllUsersByType('inactive');
            }
            RunInBackground(array(
                'status' => 300
            ));
            foreach ($users as $user) {
                $send_message_data = array(
                    'from_email' => $kd->config->siteEmail,
                    'from_name' => $kd->config->siteName,
                    'to_email' => $asdk->user->email,
                    'to_name' => $kd->user->name,
                    'subject' => $_POST['subject'],
                    'charSet' => 'utf-8',
                    'message_body' => $_POST['message'],
                    'is_html' => true
                );
                $send              = SendMessage($send_message_data);
                $mail->ClearAddresses();
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($send_errors)) {
        $send_errors_data = array(
            'status' => 400,
            'message' => $send_errors
        );
        echo json_encode($send_errors_data);
    } else {
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    }
    exit();
}
if ('send_multiple_application_status') {
    $send_errors = '';
    
    $get_emails = $db->where('is_notified', 0)->where('isClosed', 0)->get(T_APPLICATIONS);
    
    RunInBackground(array(
        'status' => 300
    ));
    foreach ($get_emails as $apl) {
        $update_data       = array(
            'UNIVERSITY' => GetuniversityByID($apl->university_id),
            'PROGRAM' => GetProgramByID($apl->program_id),
            'URL' => UrlLink('status'),
            'NAME' => $apl->first_name . ' ' . $apl->middle_name . ' ' . $apl->last_name
        );
        $send_message_data = array(
            'from_email' => $kd->config->email,
            'from_name' => $kd->config->name,
            'to_email' => $apl->email,
            'to_name' => $apl->first_name . ' ' . $apl->last_name,
            'subject' => __('application_status_update'),
            'charSet' => 'utf-8',
            'message_body' => LoadPage('email/application_status', $update_data),
            'is_html' => true
        );
        
        $status_updated['is_notified'] = 1;
        $send                          = SendMessage($send_message_data);
        if ($send) {
            $db->where('id', $apl->id)->update(T_APPLICATIONS, $status_updated);
            $mail->ClearAddresses();
        }
    }
    
    
    header("Content-type: application/json");
    if (!empty($send_errors)) {
        $send_errors_data = array(
            'status' => 400,
            'message' => $send_errors
        );
        echo json_encode($send_errors_data);
    } else {
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    }
    exit();
    
}
if ($first == 'university_edit' && !empty($_POST['university_id'])) {
    
    $university_id = $_POST['university_id'];
    $universities  = new stdClass();
    if ($_FILES['main_image'] != null) {
        if (!empty($_FILES['main_image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['main_image']['tmp_name'],
                'size' => $_FILES['main_image']['size'],
                'name' => $_FILES['main_image']['name'],
                'type' => $_FILES['main_image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'main_image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    if ($_FILES['university_logo'] != null) {
        if (!empty($_FILES['university_logo']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['university_logo']['tmp_name'],
                'size' => $_FILES['university_logo']['size'],
                'name' => $_FILES['university_logo']['name'],
                'type' => $_FILES['university_logo']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'university_logo'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->university_logo = $file_upload['filename'];
            }
        }
        
    }
    $universities->title                  = $_POST['university_title'];
    $universities->description            = $_POST['description'];
    $universities->university             = $_POST['university_name'];
    $universities->location               = $_POST['location'];
    $universities->university_type        = $_POST['university_type'];
    $universities->foundation             = $_POST['foundation'];
    $universities->lang_edu_en            = $_POST['lang_edu_en'];
    $universities->lang_edu_tk            = $_POST['lang_edu_tr'];
    $universities->sp_facilitie           = $_POST['sp_facilities'];
    $universities->sp_teams               = $_POST['sports_teams'];
    $universities->st_associations        = $_POST['student_associations'];
    $universities->laboratories           = $_POST['Laboratories'];
    $universities->asso_degrees           = $_POST['associate_degrees'];
    $universities->undergraduate_program  = $_POST['undergraduate_programs'];
    $universities->master_programs        = $_POST['master_programs'];
    $universities->ph_d_programs          = $_POST['PH_P_programs'];
    $universities->international_students = $_POST['international_students'];
    $universities->total_students         = $_POST['total_students'];
    $universities->study_mode             = $_POST['study_mode'];
    
    
    $universities->dormitory           = $_POST['dormitory'] == "on" ? "1" : "0";
    $universities->female              = $_POST['f_domitory'] == "on" ? "1" : "0";
    $universities->male                = $_POST['m_domitory'] == "on" ? "1" : "0";
    $universities->library             = $_POST['library'] == "on" ? "1" : "0";
    $universities->wifi                = $_POST['wifi'] == "on" ? "1" : "0";
    $universities->gym                 = $_POST['gym'] == "on" ? "1" : "0";
    $universities->cafeteria           = $_POST['cafeteria'] == "on" ? "1" : "0";
    $universities->copy_center         = $_POST['copy_center'] == "on" ? "1" : "0";
    $universities->hairdresser         = $_POST['hairdresser'] == "on" ? "1" : "0";
    $universities->atm                 = $_POST['atm'] == "on" ? "1" : "0";
    $universities->car_park            = $_POST['car_park'] == "on" ? "1" : "0";
    $universities->bank                = $_POST['bank'] == "on" ? "1" : "0";
    $universities->security            = $_POST['security'] == "on" ? "1" : "0";
    $universities->vertural_court      = $_POST['virtual_court'] == "on" ? "1" : "0";
    $universities->walking_track       = $_POST['walking_track'] == "on" ? "1" : "0";
    $universities->barrier_free        = $_POST['barrier_free_campus'] == "on" ? "1" : "0";
    $universities->tennis_court        = $_POST['tennis_court'] == "on" ? "1" : "0";
    $universities->dining_hall         = $_POST['dining_hall'] == "on" ? "1" : "0";
    $universities->auditorium          = $_POST['auditorium'] == "on" ? "1" : "0";
    $universities->medial_center       = $_POST['medial_first_aid'] == "on" ? "1" : "0";
    $universities->hospital            = $_POST['hospital'] == "on" ? "1" : "0";
    $universities->bachelor            = $_POST['bachelor'] == "on" ? "1" : "0";
    $universities->master              = $_POST['master'] == "on" ? "1" : "0";
    $universities->certificate         = $_POST['certificate'] == "on" ? "1" : "0";
    $universities->phd                 = $_POST['phd'] == "on" ? "1" : "0";
    $universities->associate_degree    = $_POST['associate_degree'] == "on" ? "1" : "0";
    $universities->medicine_health     = $_POST['medicine_health'] == "on" ? "1" : "0";
    $universities->pharmacy            = $_POST['pharmacy'] == "on" ? "1" : "0";
    $universities->dentisy             = $_POST['dentistry'] == "on" ? "1" : "0";
    $universities->engineering         = $_POST['engineering'] == "on" ? "1" : "0";
    $universities->computer_science    = $_POST['computer_it'] == "on" ? "1" : "0";
    $universities->agriculture         = $_POST['agriculture_forestry'] == "on" ? "1" : "0";
    $universities->art_design          = $_POST['arts_design_architecture'] == "on" ? "1" : "0";
    $universities->business_management = $_POST['business_management'] == "on" ? "1" : "0";
    $universities->education_traning   = $_POST['education_traning'] == "on" ? "1" : "0";
    $universities->engineering1        = $_POST['engineering1'] == "on" ? "1" : "0";
    $universities->sports              = $_POST['sports'] == "on" ? "1" : "0";
    $universities->journalism          = $_POST['journalism_media'] == "on" ? "1" : "0";
    $universities->law                 = $_POST['law '] == "on" ? "1" : "0";
    $universities->medicine_health1    = $_POST['medicine_health1'] == "on" ? "1" : "0";
    $universities->natural_science     = $_POST['Natural_mathematics'] == "on" ? "1" : "0";
    $universities->social_science      = ($_POST['social_science'] == "on") ? "1" : "0";
    $universities->medicine            = ($_POST['medicine'] === "on") ? "1" : "0";
    $universities->applied_science     = ($_POST['applied_science'] = "on") ? "1" : "0";
    
    $update = $db->where('id', $_POST['university_id'])->update(T_UNIVERSITY, ToArray($universities));
    
    
    header("Content-type: application/json");
    if ($update) {
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    } else {
        $send_errors_data = array(
            'status' => 400,
            'message' => $send_errors
        );
        echo json_encode($send_errors_data);
    }
    exit();
}
if ($first == 'university_add') {
    
    
    $universities = new stdClass();
    if (!empty($_FILES['main_image'])) {
        if (!empty($_FILES['main_image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['main_image']['tmp_name'],
                'size' => $_FILES['main_image']['size'],
                'name' => $_FILES['main_image']['name'],
                'type' => $_FILES['main_image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'main_image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    if (!empty($_FILES['university_logo'])) {
        if (!empty($_FILES['university_logo']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['university_logo']['tmp_name'],
                'size' => $_FILES['university_logo']['size'],
                'name' => $_FILES['university_logo']['name'],
                'type' => $_FILES['university_logo']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'university_logo'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->university_logo = $file_upload['filename'];
            }
        }
        
    }
    $universities->university_name_slug   = slugify($_POST['university_name'], '_');
    $universities->title                  = $_POST['university_title'];
    $universities->description            = $_POST['description'];
    $universities->university             = $_POST['university_name'];
    $universities->location               = $_POST['location'];
    $universities->university_type        = $_POST['university_type'];
    $universities->foundation             = $_POST['foundation'];
    $universities->lang_edu_en            = $_POST['lang_edu_en'];
    $universities->lang_edu_tk            = $_POST['lang_edu_tr'];
    $universities->sp_facilitie           = $_POST['sp_facilities'];
    $universities->sp_teams               = $_POST['sports_teams'];
    $universities->st_associations        = $_POST['student_associations'];
    $universities->laboratories           = $_POST['Laboratories'];
    $universities->asso_degrees           = $_POST['associate_degrees'];
    $universities->undergraduate_program  = $_POST['undergraduate_programs'];
    $universities->master_programs        = $_POST['master_programs'];
    $universities->ph_d_programs          = $_POST['PH_P_programs'];
    $universities->international_students = $_POST['international_students'];
    $universities->total_students         = $_POST['total_students'];
    $universities->study_mode             = $_POST['study_mode'];
    
    
    $universities->dormitory           = $_POST['dormitory'] == "on" ? "1" : "0";
    $universities->female              = $_POST['f_domitory'] == "on" ? "1" : "0";
    $universities->male                = $_POST['m_domitory'] == "on" ? "1" : "0";
    $universities->library             = $_POST['library'] == "on" ? "1" : "0";
    $universities->wifi                = $_POST['wifi'] == "on" ? "1" : "0";
    $universities->gym                 = $_POST['gym'] == "on" ? "1" : "0";
    $universities->cafeteria           = $_POST['cafeteria'] == "on" ? "1" : "0";
    $universities->copy_center         = $_POST['copy_center'] == "on" ? "1" : "0";
    $universities->hairdresser         = $_POST['hairdresser'] == "on" ? "1" : "0";
    $universities->atm                 = $_POST['atm'] == "on" ? "1" : "0";
    $universities->car_park            = $_POST['car_park'] == "on" ? "1" : "0";
    $universities->bank                = $_POST['bank'] == "on" ? "1" : "0";
    $universities->security            = $_POST['security'] == "on" ? "1" : "0";
    $universities->vertural_court      = $_POST['virtual_court'] == "on" ? "1" : "0";
    $universities->walking_track       = $_POST['walking_track'] == "on" ? "1" : "0";
    $universities->barrier_free        = $_POST['barrier_free_campus'] == "on" ? "1" : "0";
    $universities->tennis_court        = $_POST['tennis_court'] == "on" ? "1" : "0";
    $universities->dining_hall         = $_POST['dining_hall'] == "on" ? "1" : "0";
    $universities->auditorium          = $_POST['auditorium'] == "on" ? "1" : "0";
    $universities->medial_center       = $_POST['medial_first_aid'] == "on" ? "1" : "0";
    $universities->hospital            = $_POST['hospital'] == "on" ? "1" : "0";
    $universities->bachelor            = $_POST['bachelor'] == "on" ? "1" : "0";
    $universities->master              = $_POST['master'] == "on" ? "1" : "0";
    $universities->certificate         = $_POST['certificate'] == "on" ? "1" : "0";
    $universities->phd                 = $_POST['phd'] == "on" ? "1" : "0";
    $universities->associate_degree    = $_POST['associate_degree'] == "on" ? "1" : "0";
    $universities->medicine_health     = $_POST['medicine_health'] == "on" ? "1" : "0";
    $universities->pharmacy            = $_POST['pharmacy'] == "on" ? "1" : "0";
    $universities->dentisy             = $_POST['dentistry'] == "on" ? "1" : "0";
    $universities->engineering         = $_POST['engineering'] == "on" ? "1" : "0";
    $universities->computer_science    = $_POST['computer_it'] == "on" ? "1" : "0";
    $universities->agriculture         = $_POST['agriculture_forestry'] == "on" ? "1" : "0";
    $universities->art_design          = $_POST['arts_design_architecture'] == "on" ? "1" : "0";
    $universities->business_management = $_POST['business_management'] == "on" ? "1" : "0";
    $universities->education_traning   = $_POST['education_traning'] == "on" ? "1" : "0";
    $universities->engineering1        = $_POST['engineering1'] == "on" ? "1" : "0";
    $universities->sports              = $_POST['sports'] == "on" ? "1" : "0";
    $universities->journalism          = $_POST['journalism_media'] == "on" ? "1" : "0";
    $universities->law                 = $_POST['law '] == "on" ? "1" : "0";
    $universities->medicine_health1    = $_POST['medicine_health1'] == "on" ? "1" : "0";
    $universities->natural_science     = (isset($_POST['medicine']) && $_POST['Natural_mathematics'] == "on") ? "1" : "0";
    $universities->social_science      = (isset($_POST['medicine']) && $_POST['social_science'] == "on") ? "1" : "0";
    $universities->medicine            = (isset($_POST['medicine']) && $_POST['medicine'] === "on") ? "1" : "0";
    $universities->applied_science     = ($_POST['applied_science'] = "on") ? "1" : "0";
    
    $update = $db->insert(T_UNIVERSITY, ToArray($universities));
    var_dump($update);
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
    }
    exit();
}
if ($first == 'university_department') {
    
    
    $universities = new stdClass();
    
    $universities->university_id   = $_POST['university_id'];
    $universities->department      = $_POST['department'];
    $universities->department_slag = slugify($_POST['department'], '_');
    $update                        = $db->insert(T_DEPARTMENTS, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
    }
    exit();
}
if ($first == 'edit_program') {
    
    
    $universities = new stdClass();
    if (!empty($_FILES['image'])) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $file_info   = array(
                'file' => $_FILES['image']['tmp_name'],
                'size' => $_FILES['image']['size'],
                'name' => $_FILES['image']['name'],
                'type' => $_FILES['image']['type'],
                'crop' => array(
                    'width' => 400,
                    'height' => 400
                ),
                'mode' => 'image'
            );
            $file_upload = ShareFile($file_info);
            if (!empty($file_upload['filename'])) {
                $universities->main_image = $file_upload['filename'];
            }
        }
        
    }
    
    $universities->university_id   = Secure($_POST['university_id']);
    $universities->department      = Secure($_POST['department']);
    $universities->language      = Secure($_POST['language']);
    $universities->degree      = Secure($_POST['degree']);
    $universities->duration      = Secure($_POST['duration']);
    $universities->tuition_fees      = Secure($_POST['tuition_fees']);
    $universities->discounted_fees      = Secure($_POST['discounted_fees']);
    $universities->discipline      = Secure($_POST['discipline']);
 
    $update                        = $db->where('id',Secure($_POST['id']) )->update(T_PROGRAMS, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        echo json_encode($data);
        exit();
    } else {
        
        $send_errors_data = array(
            'status' => 400,
            'message' => "ERROR"
        );
        echo json_encode($send_errors_data);
        exit();
    }
    exit();
}
if ($first == "import") {
    
    
    if (!empty($_FILES["import_excel"])) {
        $allowed_extension = array(
            'xls',
            'csv',
            'xlsx'
        );
        $file_array        = explode(".", $_FILES["import_excel"]["name"]);
        $file_extension    = end($file_array);
        $full_data         = $_FILES["import_excel"];
        
        if (in_array($file_extension, $allowed_extension)) {
            $dataa = ExcelToDB($full_data, $file_extension);
            foreach ($dataa as $row) {
                
                $university = array(
                    'university' => $row[0],
                    'location' => $row[1],
                    'university_type' => $row[2],
                    'foundation' => $row[3],
                    'lang_edu_en' => $row[4],
                    'lang_edu_tk' => $row[5],
                    'sp_facilitie' => $row[6],
                    'sp_teams' => $row[7],
                    'st_associations' => $row[8],
                    'laboratories' => $row[9],
                    'asso_degrees' => $row[10],
                    'undergraduate_program' => $row[11],
                    'master_programs' => $row[12],
                    'ph_d_programs' => $row[13],
                    'international_students' => $row[14],
                    'total_students' => $row[15],
                    'study_mode' => $row[16],
                    'dormitory' => $row[17],
                    'female' => $row[18],
                    'male' => $row[19],
                    'library' => $row[20],
                    'wifi' => $row[21],
                    'gym' => $row[22],
                    'cafeteria' => $row[23],
                    'copy_center' => $row[24],
                    'hairdresser' => $row[25],
                    'atm' => $row[26],
                    'car_park' => $row[27],
                    'bank' => $row[28],
                    'security' => $row[29],
                    'vertural_court' => $row[30],
                    'walking_track' => $row[31],
                    'barrier_free' => $row[32],
                    'tennis_court' => $row[34],
                    'dining_hall' => $row[36],
                    'auditorium' => $row[37],
                    'medial_center' => $row[38],
                    'hospital' => $row[39],
                    'bachelor' => $row[40],
                    'master' => $row[41],
                    'certificate' => $row[42],
                    'phd' => $row[43],
                    'associate_degree' => $row[44],
                    'medicine_health' => $row[45],
                    'pharmacy' => $row[46],
                    'dentisy' => $row[47],
                    'engineering' => $row[48],
                    'computer_science' => $row[49],
                    'agriculture' => $row[50],
                    'art_design' => $row[51],
                    'business_management' => $row[52],
                    'education_traning' => $row[53],
                    'sports' => $row[54],
                    'journalism' => $row[55],
                    'law' => $row[56],
                    'natural_science' => $row[57],
                    'social_science' => $row[58],
                    'medicine' => $row[59],
                    'applied_science' => $row[60]
                );
                $db->insert(T_UNIVERSITY, $university);
            }
        }
        $data = array(
            'status' => 200,
            'message' => 'successfully'
            
            
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
            
        );
    }
    
    
}

if ($first == "export_univesity") {
    
    $universities_data = $db->get(T_UNIVERSITY);
    
    if (DBToExcel($universities_data)) {
        
        $data = array(
            'status' => 200,
            'message' => 'successfully'
        );
    } else {
        $data = array(
            'status' => 400,
            'message' => 'Error Importingt the file'
        );
    }
    
    
    
    
}

if ($first == 'get_lang_key') {
    var_dump("asfas");
    if (empty($_GET['lang_name']) && empty($_GET['id'])) {
        exit();
    }
    $html = '';
    
    $lang_key = Secure($_GET['id']);
    $lang_nm  = Secure($_GET['lang_name']);
    $langs    = $db->where('lang_key', $lang_key)->getOne(T_LANGS, array(
        $lang_nm
    ));
    
    if (count($langs) > 0) {
        foreach ($langs as $key => $lang_value) {
            $html .= LoadAdminPage('edit-lang/form-list', array(
                'KEY' => ($key),
                'LANG_KEY' => ucfirst($key),
                'LANG_VALUE' => $lang_value
            ));
        }
    }
    
    else {
        $html = "<h4 class='text-center'>Keyword not found</h4>";
    }
    
    $data['status'] = 200;
    $data['html']   = $html;
}