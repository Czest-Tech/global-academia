<?php 


if($first == "import"){


     if(!empty($_FILES["import_excel"]))
        {
         $allowed_extension = array('xls', 'csv', 'xlsx');
         $file_array = explode(".", $_FILES["import_excel"]["name"]);
         $file_extension = end($file_array);

         if(in_array($file_extension, $allowed_extension))
            {
              $dataa = ExcelToDB($file_array,$file_extension);
        

              foreach($dataa as $row){  
                    $university = array(          
                        'university' => $row['university'],
                        'location' => $row['location'],
                        'university_type' => $row['university_type'],
                        'foundation' => $row['year_of_foundation'],
                        'lang_edu_en' => $row['language_of_education_english'],
                        'lang_edu_tk' => $row['language_of_education_turkish'],
                        'sp_facilitie' => $row['sports_facilities'],
                        'sp_teams' => $row['sports_teams'],
                        'st_associations' => $row['student_associations'],
                        'laboratories' => $row['laboratories'],
                        'asso_degrees' => $row['associate_degrees'],
                        'undergraduate_program' => $row['undergraduate_program'],
                        'master_programs' => $row['masters_programs'],
                        'ph_d_programs' => $row['phd_programs'],
                        'international_students' => $row['international_students'],
                        'total_students' => $row['total_students'],
                        'study_mode' => $row['study_mode'],
                        'dormitory' => $row['dormitory'],
                        'female' => $row['femail_dormitory'],
                        'male' => $row['male_dormitory'],
                        'library' => $row['library'],
                        'wifi' => $row['wifi'],
                        'gym' => $row['gym'],
                        'cafeteria' => $row['cafeteria'],
                        'copy_center' => $row['copy_center'],
                        'hairdresser' => $row['hairdresser'],
                        'atm' => $row['atm'],
                        'car_park' => $row['car_park'],
                        'bank' => $row['bank'],
                        'security' => $row['security'],
                        'vertural_court' => $row['virtual_court'],
                        'walking_track' => $row['walking_track'],
                        'barrier_free' => $row['barrier_free_campus'],
                        'tennis_court' => $row['tennis_court'],
                        'dining_hall' => $row['dining_hall'],
                        'auditorium' => $row['auditorium'],
                        'medial_center' => $row['medical_center_first_aid'],
                        'hospital' => $row['hospital'],
                        'bachelor' => $row['bachelor'],
                        'master' => $row['master'],
                        'certificate' => $row['certificate'],
                        'phd' => $row['phd'],
                        'associate_degree' => $row['associate_degree'],
                        'medicine_health' => $row['medicine_health'],
                        'pharmacy' => $row['pharmacy'],
                        'dentisy' => $row['dentistry'],
                        'engineering' => $row['engineering'],
                        'computer_science' => $row['computer_science_it'],
                        'agriculture' => $row['agriculture_forestry'],
                        'art_design' => $row['arts_design_architecture'],
                        'business_management' => $row['business_management'],
                        'education_traning' => $row['education_training'],
                        'sports' => $row['sports'],
                        'journalism' => $row['journalism_media'],
                        'law' => $row['law'],
                        'natural_science' => $row['natural_sciences_mathematics'],
                        'social_science' => $row['social_sciences'],
                        'medicine' => $row['medicine'],
                        'applied_science' => $row['applied_sciences']
                    );
                    $db->insert(T_UNIVERSITY, $university);
                }
            
            }
            $data = array(
               'status' => 200,
              
            );
        } else {
            $data = array(
               'status' => 400,
               'message' => 'panyo'
              
            );
        }
    

}


