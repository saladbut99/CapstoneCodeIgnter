<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonMaster extends Model
{
    protected $table      = 'lesson_master';
    protected $primaryKey = 'lesson_id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['lesson_name','lesson_description', 'unit','status'];

    //specify dates
    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'deleted_at';
    //
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation      = false;
  //  protected $beforeUpdate = ['hashPassword'];
    // //beforeinsert everytime you are going to insert checkName function is executed
    //   protected $beforeInsert = ['capitalName'];
    // //
    // protected function capitalName(array $data){
    //       $data['data']['lesson_name']=ucfirst($data['data']['lesson_name']);
    //       return $data;
    // }
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

    // public function hashPassword(array $data){
    //   $data['data']['teacher_password'] = password_hash($data['data']['teacher_password'], PASSWORD_DEFAULT);
    // //  echo "hellloo";
    //   return $data;
    // }
}
