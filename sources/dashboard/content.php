<?php

if (IS_LOGGED == false) {
    header("Location: " . UrlLink('login'));
    exit();
}
$user_id                = $kd->user->id;
$kd->is_admin          = IsAdmin();
$final_page = '';
$lesson_list_html = '';
// var_dump($_GET['_id']);
if (isset($_GET['user']) && !empty($_GET['user']) && ($kd->is_admin === true)) {
    if (empty($db->where('username', Secure($_GET['user']))->getValue(T_USERS, 'count(*)'))) {
        header("Location: " . UrlLink(''));
        exit();
    }
    $user_id               = $db->where('username', Secure($_GET['user']))->getValue(T_USERS, 'id');
    $kd->is_settings_admin = true;
}
$kd->settings     = UserData($user_id);

$kd->isowner = false;

if (IS_LOGGED == true) {
    if ($kd->settings->id == $user->id) {
        $kd->isowner = true;
    }
}
$countries = '';
foreach ($countries_name as $key => $value) {
    $selected = ($key == $kd->settings->country_id) ? 'selected' : '';
    $countries .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
}



$pages_array = [
	'dashboard',
    'profile',
    'messages',
    'settings',
    'students',
    'applications',
    'view_application',
    'notifications'
   
  
];
$chat_id = 0;
$sidebar = '';
$html = '';
$chat_user = array();
// if(!empty($_GET['page']) && $_GET['page'] == 'messages'){
//     // if (!empty($_GET['_id'])) {
//     //     $get_user_id = $db->where('username', Secure($_GET['_id']))->getValue(T_USERS, 'id');
//     //     if (!empty($get_user_id)) {
//     //         $chat_user = UserData($get_user_id);
//     //         if ($chat_user->id != $kd->user->id) {
//     //             $chat_id = $chat_user->id;
//     //         } else {
//     //             $chat_user = array();
//     //         }
//     //     } else {
//     //         $chat_user = array();
//     //     }
//     // }
    
//     // if (empty($chat_id)) {
//     //     $html = LoadPage("dashboard/pages/lists/no_message");
//     // } else {
//     //     $messages_html = GetMessages($chat_id, array('chat_user' => $chat_user, 'return_method' => 'html'));
//     //     if (!empty($messages_html)) {
//     //         $html = LoadPage("dashboard/pages/lists/messages", array('MESSAGES' => $messages_html));
//     //     } else {
//     //         $html = LoadPage("dashboard/pages/lists/no_message");
//     //     }
//     // }
    
//     // $users_html = GetMessagesUserList(array('return_method' => 'html'));
    
//     // if (empty($users_html)) {
//     //     $users_html = '<p class="empty_state"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>No users found</p>';
//     // }
//     // //$kd->page_url_ = $kd->config->site_url.'/messages';
//     // $kd->chat_id = $chat_id;
//     // $kd->chat_user = $chat_user;
    
//     // $sidebar =  $users_html;
// }

$kd->page_url_   = $kd->config->site_url.'/dashboard';

$kd->dashboard_page = 'dashboard';


if (!empty($_GET['page'])) {
    if (in_array($_GET['page'], $pages_array)) {
        $kd->dashboard_page = $_GET['page'];
        $kd->page_url_ = $kd->config->site_url.'/dashboard/'.$kd->dashboard_page.'/'.$kd->settings->username;
    }
} 


$final_page =  LoadPage("dashboard/pages/$kd->dashboard_page", [
         'USER_DATA' => $user,              
]);



$kd->page        = 'dashboard';
$kd->title       = __('dashboard') . ' | ' . $kd->config->title;
$kd->description = $kd->config->description;
$kd->keyword     = $kd->config->keyword;


$kd->content     = LoadPage('dashboard/content', [
        'USER_DATA' => $user,
        'PROFILE_PAGE' => $final_page,

       
    
]);