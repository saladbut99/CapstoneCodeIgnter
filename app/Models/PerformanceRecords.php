<?php

namespace App\Models;

use CodeIgniter\Model;

class PerformanceRecords extends Model
{
    protected $table      = 'performance_records';
    protected $primaryKey = 'performance_id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['pupil_id', 'activity_score','performed_activity_date','activity_id','activity_retakes','activity_answer', 'activity_content_id', 'percentage_score'];

    //specify dates
    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'deleted_at';
    //
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation      = false;
    // protected $beforeInsert = ['checkName'];
    // protected $beforeUpdate = ['hashPassword'];
    //
    // protected function checkName(array $data){
    //
    //   $data['data']['pupil_firstname'] = trim($data['data']['pupil_firstname']);
    //   $capital=$data['data']['pupil_firstname'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_firstname']=$converted;
    //
    //   $data['data']['pupil_middlename'] = trim($data['data']['pupil_middlename']);
    //   $capital=$data['data']['pupil_middlename'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_middlename']=$converted;
    //
    //   $data['data']['pupil_address'] = trim($data['data']['pupil_address']);
    //   $capital=$data['data']['pupil_address'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_address']=$converted;
    //
    //   $data['data']['pupil_father_name'] = trim($data['data']['pupil_father_name']);
    //   $capital=$data['data']['pupil_father_name'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_father_name']=$converted;
    //
    //   $data['data']['pupil_mother_name'] = trim($data['data']['pupil_mother_name']);
    //   $capital=$data['data']['pupil_mother_name'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_mother_name']=$converted;
    //
    //   $data['data']['pupil_guardian_name'] = trim($data['data']['pupil_guardian_name']);
    //   $capital=$data['data']['pupil_guardian_name'];
    //   $converted=ucwords($capital);
    //   $data['data']['pupil_guardian_name']=$converted;
    //
    //   $data['data']['pupil_lastname'] = trim($data['data']['pupil_lastname']);
    //   $capital_last=$data['data']['pupil_lastname'];
    //   $converted_last=ucwords($capital_last);
    //   $data['data']['pupil_lastname']=$converted_last;
    //
    //   $explode=$data['data']['pupil_firstname'];
    //   $pieces = explode(" ",$explode);
    //
    //   $username = implode("",$pieces);
    //   $merge=$username;
    //   $finalmerge='.'.$merge;
    //   $mergeusername=$data['data']['pupil_lastname'].$finalmerge;
    //   $getuser= $data['data']['pupil_username'];
    //   $data['data']['pupil_username']=$getuser;
    //   $data['data']['pupil_password']=password_hash($mergeusername, PASSWORD_DEFAULT);
    //
    //   $secid=$data['data']['section_id'];
    //   $data['data']['section_id']=$secid;
    //
    //
    //   return $data;
    // }
    //
    // // //beforeinsert everytime you are going to insert checkName function is executed
    //  protected $beforeInsert = ['checkName'];
    //
    // //$data variable below is the data that is being submitted
    // protected function checkName(array $data){
    //
    //   $data['data']['teacher_firstname'] = trim($data['data']['teacher_firstname']);
    //   $capital=$data['data']['teacher_firstname'];
    //   $converted=ucfirst($capital);
    //   $data['data']['teacher_firstname']=$converted;
    //
    //   $data['data']['teacher_lastname'] = trim($data['data']['teacher_lastname']);
    //   $capital_last=$data['data']['teacher_lastname'];
    //   $converted_last=ucfirst($capital_last);
    //   $data['data']['teacher_lastname']=$converted_last;
    //
    //   $explode=$data['data']['teacher_firstname'];
    //   $pieces = explode(" ",$explode);
    //
    //   $username = implode("",$pieces);
    //   $merge=$username;
    //   $finalmerge='.'.$merge;
    //   $mergeusername=$data['data']['teacher_lastname'].$finalmerge;
    //   $getuser= $data['data']['teacher_username'];
    //   $data['data']['teacher_username']=$getuser;
    //   $data['data']['teacher_password']=password_hash($mergeusername, PASSWORD_DEFAULT);
    //
    //   $secid=$data['data']['section_id'];
    //   $data['data']['section_id']=$secid;
    //
    //
    //   return $data;
    // }
    public function hashPassword(array $data){
      $data['data']['pupil_password'] = password_hash($data['data']['pupil_password'], PASSWORD_DEFAULT);
    //  echo "hellloo";
      return $data;
    }
}
