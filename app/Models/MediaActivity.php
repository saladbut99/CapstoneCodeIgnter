<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaActivity extends Model
{
    protected $table      = 'media_activity';
    protected $primaryKey = 'media_activity_id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['file_name', 'activity_content_id','file_targetDirectory','file_extension'];

    //specify dates
    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'deleted_at';
    //
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation      = false;

    // //beforeinsert everytime you are going to insert checkName function is executed
    // protected $beforeInsert = ['insertname'];

    //$data variable below is the data that is being submitted

    // protected function checkName(array $data){
    //
    //   $data['data']['teacher_firstname'] = trim($data['data']['teacher_firstname']);
    //   $capital=$data['data']['teacher_firstname'];
    //   $converted=ucwords($capital);
    //   $data['data']['teacher_firstname']=$converted;
    //
    //   $data['data']['teacher_lastname'] = trim($data['data']['teacher_lastname']);
    //   $capital_last=$data['data']['teacher_lastname'];
    //   $converted_last=ucwords($capital_last);
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
    //   $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    // }
}
