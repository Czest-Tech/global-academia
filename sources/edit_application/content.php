<?php

$kd->apply_university = '';
$kd->apply_program = '';
$kd->apply_page = '';
$html = '';

if (isset($_GET['page'])){    
  $app_data =  $db->where('id', Secure($_GET['page']))->getOne(T_APPLICATIONS);

  if(empty(GetMedia($app_data->passport_file))){
    $html .=
   ' <div class="slide-row5">
        <p> '. __('passport') .'</p>
        <div class="inputs5-1">
            <span id="click_passaport_file">
                <img src="https://img.icons8.com/office/50/000000/passport.png"/>
                <span id="edit_passport_name">Click to Upload</span>
            </span>
            <input type="file" name="passport_file"   class="passport_file" id="passport_file" style="display:none;">
        </div>
    </div>';
  
  }
  if(empty(GetMedia($app_data->transcript_file))){
     
 $html .=   '<div class="slide-row5">
                    <p>'. __('transcript') .'</p>
                    <div class="inputs5-1">
                        <span class="click_transcript_file"><img src="https://img.icons8.com/bubbles/50/000000/report-card.png"/><span id="edit_transcript_name">Click to Upload</span></span>
                        <input type="file" name="transcript_file" class="transcript_file"  style="display:none;" id="transcript_file">
                    </div>
                </div>';
  }

  if(empty(GetMedia($app_data->diploma_file))){
    $html .= ' <div class="slide-row5">
        <p>'. __('diploma') .'</p>
            <div class="inputs5-1">
                <span class="click_diploma_file"><img src="https://img.icons8.com/plasticine/100/000000/certificate.png"/><span id="edit_diploma_name">Click to Upload</span></span>
                <input type="file"  name="diploma_file" class="diploma_file" style="display:none;" id="diploma_file">
            </div>
        </div>';
  }
  if(empty(GetMedia($app_data->id_photo))){ 
      $html .=  '<div class="slide-row5">
      <p>'. __('photo') .'</p>
      <div class="inputs5-1">
          <span id="click_id_photo"> <img src="https://img.icons8.com/color/48/000000/person-male.png"/><span id="edit_photo_name">Click to Upload</span></span>
          <input type="file" name="id_photo" class="id_photo" id="id_photo" style="display:none;">
      </div>
  </div>';
  }

} 



// $kd->page_url_   = $kd->config->site_url.'/'.$kd->apply_page .'/'.$kd->apply_university .'/'. $kd->apply_program;
$kd->title       = __('apply') . ' | ' . $kd->config->title;
$kd->page        = "edit_application";
$kd->description = $kd->config->description;
$kd->keyword     = @$kd->config->keyword;

$countries = '';
foreach ($kd->countries_name as $key => $value) {

    $countries .= '<option value="' . $value . '">' . $value . '</option>';
}



$kd->content     = LoadPage('apply/edit_application',  array('COUNTRIES_LAYOUT' => $countries,'MISSING_DOC' => $html, 'ID' => $_GET['page']));