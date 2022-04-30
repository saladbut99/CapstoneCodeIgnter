<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonExample extends Model
{
    protected $table      = 'lesson_example';
    protected $primaryKey = 'example_id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['lesson_content_id','example', 'file_name', 'file_targetDirectory', 'file_extension'];

}
