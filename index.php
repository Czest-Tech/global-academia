<?php
include('./assets/init.php');
$page = 'program';
if (isset($_GET['link1'])) {
    $page = $_GET['link1'];
}






if (file_exists("./sources/$page/content.php")) {
    include("./sources/$page/content.php");
}

if (empty($kd->content)) {
    include("./sources/404/content.php");
}

$side_header = 'not-logged';

if (IS_LOGGED == true) {
    $side_header = 'loggedin';
}

$footerall            = '';
$footerlogin            = '';
$og_meta           = '';

$langs__footer = $langs;
$langs_right    = '';
$langs_left    = '';
$number = 0;
foreach ($langs__footer as $key => $language) {
    $lang_explode = explode('.', $language);
    $language     = $lang_explode[0];
    $language_    = ucfirst($language);
    $langs_left .= LoadPage('header/languages', array('LANGID' => $language, 'LANGNAME' => $language_));
}


// if($kd->page == 'university') {

//     $kd->title = 'sd';
//     $kd->description = 'sds';
//     $kd->keyword = 'ssd';
     
//     $og_meta = LoadPage('header/og-meta', array(
//         'TITLE' =>   $kd->title,
//         'DESC' => $kd->description,
//        'URL' => '',
//         'THUMB' => '{{CONFIG theme_url}}/img/icon.png'
//     ));

// }

// else if ( $kd->page  == 'program-details') {
//     var_dump($_GET['page']);
//     $kd->title = 'sd';
//     $kd->description = 'sds';
//     $kd->keyword = 'ssd';
     
//     $og_meta = LoadPage('header/og-meta', array(
//         'TITLE' =>   $kd->title,
//         'DESC' => $kd->description,
//        'URL' => $kd->config->site_url,
//         'THUMB' => '{{CONFIG theme_url}}/img/icon.png'
//     ));

// } else {
//      $og_meta = LoadPage('header/og-meta', array(
//         'TITLE' => $kd->config->title,
//         'DESC' => $kd->config->description,
//         'URL' => $kd->config->site_url,
//         'THUMB' => '{{CONFIG theme_url}}/img/icon.png',
        
//     ));
// }



$footerall = LoadPage('footer/content');



$site_header = LoadPage('header/content', array(
  
    'USER_DATA' => (IS_LOGGED)? $user : '',
    'LANGUAGES_LANG' => $langs_left,
    'ACTIVE_LANG' => $kd->language,
    'ACTIVE_LANGNAME' => ucfirst($kd->language)
    
));
$final_content = LoadPage('container', array(
    'CONTAINER_TITLE' => $kd->title,
    'CONTAINER_DESC' => $kd->description,
   // 'CONTAINER_KEYWORDS' => $kd->keyword,
    'CONTAINER_CONTENT' => $kd->content,
    'IS_LOGGED' => (IS_LOGGED == true) ? 'data-logged="true"' : '',
    'MAIN_URL' => $kd->actual_link,
    'HEADER_LAYOUT' => $site_header,
    'FOOTER_LAYOUT_ALL' => $footerall,
    'FOOTER_LAYOUT_LOGIN' => $footerlogin,
  //  'OG_METATAGS' => $og_meta,
    'EXTRA_JS' => LoadPage('extra-js/content'),
   
   
));



echo $final_content;



$db->disconnect();
unset($kd);