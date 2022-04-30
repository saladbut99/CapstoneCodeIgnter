<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaLessonExample extends Model
{
    protected $table      = 'media_lesson_example';
    protected $primaryKey = 'media_lesson_example_id ';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    //list of fields that can be manipulated from an outside class
    protected $allowedFields = ['file_name','example_id','file_targetDirectory','file_extension'];

}
