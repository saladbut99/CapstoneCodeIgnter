<?php

namespace App\Models;

use CodeIgniter\Model;

class PupilModelStatus extends Model
{
    protected $table      = 'pupil';
    protected $primaryKey = 'pupil_id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['pupil_firstname', 'pupil_lastname','pupil_middlename','pupil_username','section_id', 'pupil_password','pupil_address','pupil_father_name','pupil_mother_name','pupil_guardian_name','account_status'];

    //specify dates
    // protected $useTimestamps = true;
    // protected $createdField  = 'post_created_at';
    // protected $updatedField  = 'post_updated_at';
    // protected $deletedField  = 'deleted_at';
    //
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation      = false;

}
