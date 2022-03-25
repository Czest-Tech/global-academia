<?php 

if ($first == 'university_add') {
    if(empty($_POST['university_name'])){
        $data = array(
            'status' => 400,
            'error' => 'university name cant not be empty'
        );
        echo json_encode($data);
        exit();
    }
    $university_exists = false;
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
    
    
    $universities->dormitory           = (isset($_POST['dormitory'])) ? 1 : 0;
    $universities->female              = (isset($_POST['f_domitory'])) ? 1 : 0;
    $universities->male                = (isset($_POST['m_domitory'])) ? 1 : 0;
    $universities->library             = (isset($_POST['library'])) ? 1 : 0;
    $universities->wifi                = (isset($_POST['wifi'])) ? 1 : 0;
    $universities->gym                 = (isset($_POST['gym'])) ? 1 : 0;
    $universities->cafeteria           = (isset($_POST['cafeteria'])) ? 1 : 0;
    $universities->copy_center         = (isset($_POST['copy_center'])) ? 1 : 0;
    $universities->hairdresser         = (isset($_POST['hairdresser'])) ? 1 : 0;
    $universities->atm                 = (isset($_POST['atm'])) ? 1 : 0;
    $universities->car_park            = (isset($_POST['car_park'])) ? 1 : 0;
    $universities->bank                = (isset($_POST['bank'])) ? 1 : 0;
    $universities->security            = (isset($_POST['security'])) ? 1 : 0;
    $universities->vertural_court      = (isset($_POST['virtual_court'])) ? 1 : 0;
    $universities->walking_track       = (isset($_POST['walking_track'])) ? 1 : 0;
    $universities->barrier_free        = (isset($_POST['barrier_free_campus'])) ? 1 : 0;
    $universities->tennis_court        = (isset($_POST['tennis_court'])) ? 1 : 0;
    $universities->dining_hall         = (isset($_POST['dining_hall'])) ? 1 : 0;
    $universities->auditorium          = (isset($_POST['auditorium'])) ? 1 : 0;
    $universities->medial_center       = (isset($_POST['medial_first_aid'])) ? 1 : 0;
    $universities->hospital            = (isset($_POST['hospital'])) ? 1 : 0;
    $universities->bachelor            = (isset($_POST['bachelor'])) ? 1 : 0;
    $universities->master              = (isset($_POST['master'])) ? 1 : 0;
    $universities->certificate         = (isset($_POST['certificate'])) ? 1 : 0;
    $universities->phd                 = (isset($_POST['phd'])) ? 1 : 0;
    $universities->associate_degree    = (isset($_POST['associate_degree'])) ? 1 : 0;
    $universities->medicine_health     = (isset($_POST['medicine_health'])) ? 1 : 0;
    $universities->pharmacy            = (isset($_POST['pharmacy'])) ? 1 : 0;
    $universities->dentisy             = (isset($_POST['dentistry'])) ? 1 : 0;
    $universities->engineering         = (isset($_POST['engineering'])) ? 1 : 0;
    $universities->computer_science    = (isset($_POST['computer_it'])) ? 1 : 0;
    $universities->agriculture         = (isset($_POST['agriculture_forestry'])) ? 1 : 0;
    $universities->art_design          = (isset($_POST['arts_design_architecture'])) ? 1 : 0;
    $universities->business_management = (isset($_POST['business_management'])) ? 1 : 0;
    $universities->education_traning   = (isset($_POST['education_traning'])) ? 1 : 0;
    $universities->engineering1        = (isset($_POST['engineering1'])) ? 1 : 0;
    $universities->sports              = (isset($_POST['sports'])) ? 1 : 0;
    $universities->journalism          = (isset($_POST['journalism_media'])) ? 1 : 0;
    $universities->law                 = (isset($_POST['law '])) ? 1 : 0;
    $universities->medicine_health1    = (isset($_POST['medicine_health1'])) ? 1 : 0;
    $universities->natural_science     = (isset($_POST['Natural_mathematics'])) ? 1 : 0;
    $universities->social_science      = (isset($_POST['social_science'])) ? 1 : 0;
    $universities->medicine            = (isset($_POST['medicine'])) ? 1 : 0;
    $universities->applied_science     = (isset($_POST['applied_science'])) ? 1 : 0;
    
    $university_exists = $db->where('university_name_slug',   $universities->university_name_slug)->getOne(T_UNIVERSITY);
   
    if(!$university_exists){
        $update = $db->insert(T_UNIVERSITY, ToArray($universities));
        if ($update) {
        
            $data = array(
                'status' => 200
            );
        
        } else {
            
            $data = array(
                'status' => 400,
                'message' => "error posting university"
            );
          
        }
    } else {
        $data = array(
            'status' => 400,
            'message' => "university already exists"
        );
    }
    
  
    
    
    
  
}
if ($first == 'university_edit' && !empty($_POST['university_id'])) {
    
    if(empty($_POST['university_name'])){
        $data = array(
            'status' => 400,
            'error' => 'university name cant not be empty'
        );
        echo json_encode($data);
        exit();
    }
    $university_exists = false;
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
    
    
    $universities->dormitory           = (isset($_POST['dormitory'])) ? 1 : 0;
    $universities->female              = (isset($_POST['f_domitory'])) ? 1 : 0;
    $universities->male                = (isset($_POST['m_domitory'])) ? 1 : 0;
    $universities->library             = (isset($_POST['library'])) ? 1 : 0;
    $universities->wifi                = (isset($_POST['wifi'])) ? 1 : 0;
    $universities->gym                 = (isset($_POST['gym'])) ? 1 : 0;
    $universities->cafeteria           = (isset($_POST['cafeteria'])) ? 1 : 0;
    $universities->copy_center         = (isset($_POST['copy_center'])) ? 1 : 0;
    $universities->hairdresser         = (isset($_POST['hairdresser'])) ? 1 : 0;
    $universities->atm                 = (isset($_POST['atm'])) ? 1 : 0;
    $universities->car_park            = (isset($_POST['car_park'])) ? 1 : 0;
    $universities->bank                = (isset($_POST['bank'])) ? 1 : 0;
    $universities->security            = (isset($_POST['security'])) ? 1 : 0;
    $universities->vertural_court      = (isset($_POST['virtual_court'])) ? 1 : 0;
    $universities->walking_track       = (isset($_POST['walking_track'])) ? 1 : 0;
    $universities->barrier_free        = (isset($_POST['barrier_free_campus'])) ? 1 : 0;
    $universities->tennis_court        = (isset($_POST['tennis_court'])) ? 1 : 0;
    $universities->dining_hall         = (isset($_POST['dining_hall'])) ? 1 : 0;
    $universities->auditorium          = (isset($_POST['auditorium'])) ? 1 : 0;
    $universities->medial_center       = (isset($_POST['medial_first_aid'])) ? 1 : 0;
    $universities->hospital            = (isset($_POST['hospital'])) ? 1 : 0;
    $universities->bachelor            = (isset($_POST['bachelor'])) ? 1 : 0;
    $universities->master              = (isset($_POST['master'])) ? 1 : 0;
    $universities->certificate         = (isset($_POST['certificate'])) ? 1 : 0;
    $universities->phd                 = (isset($_POST['phd'])) ? 1 : 0;
    $universities->associate_degree    = (isset($_POST['associate_degree'])) ? 1 : 0;
    $universities->medicine_health     = (isset($_POST['medicine_health'])) ? 1 : 0;
    $universities->pharmacy            = (isset($_POST['pharmacy'])) ? 1 : 0;
    $universities->dentisy             = (isset($_POST['dentistry'])) ? 1 : 0;
    $universities->engineering         = (isset($_POST['engineering'])) ? 1 : 0;
    $universities->computer_science    = (isset($_POST['computer_it'])) ? 1 : 0;
    $universities->agriculture         = (isset($_POST['agriculture_forestry'])) ? 1 : 0;
    $universities->art_design          = (isset($_POST['arts_design_architecture'])) ? 1 : 0;
    $universities->business_management = (isset($_POST['business_management'])) ? 1 : 0;
    $universities->education_traning   = (isset($_POST['education_traning'])) ? 1 : 0;
    $universities->engineering1        = (isset($_POST['engineering1'])) ? 1 : 0;
    $universities->sports              = (isset($_POST['sports'])) ? 1 : 0;
    $universities->journalism          = (isset($_POST['journalism_media'])) ? 1 : 0;
    $universities->law                 = (isset($_POST['law '])) ? 1 : 0;
    $universities->medicine_health1    = (isset($_POST['medicine_health1'])) ? 1 : 0;
    $universities->natural_science     = (isset($_POST['Natural_mathematics'])) ? 1 : 0;
    $universities->social_science      = (isset($_POST['social_science'])) ? 1 : 0;
    $universities->medicine            = (isset($_POST['medicine'])) ? 1 : 0;
    $universities->applied_science     = (isset($_POST['applied_science'])) ? 1 : 0;
    
    $update = $db->where('id', $_POST['university_id'])->update(T_UNIVERSITY, ToArray($universities));
    

    if ($update) {
        $data = array(
            'status' => 200
        );
       
    } else {
        $data = array(
            'status' => 400,
            'message' => $send_errors
        );
        
    }
   
}
if ($first == 'edit_program') {
    
    if(empty($_POST['id'])){
        $data = array(
            'status' => 400,
            'error' => 'id not be empty'
        );
        echo json_encode($data);
        exit();
    }
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
    $universities->university = GetuniversityByID(Secure($_POST['university_id']));

    $universities->discipline      = Secure($_POST['discipline']);
 
    $update                        = $db->where('id',Secure($_POST['id']) )->update(T_PROGRAM, ToArray($universities));
    
    
    
    if ($update) {
        
        $data = array(
            'status' => 200
        );
        
    } else {
        
        $data = array(
            'status' => 400,
            'message' => "ERROR"
        );
       
    }
    
}