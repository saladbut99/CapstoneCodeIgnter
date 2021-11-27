<?php
namespace App\Models;

//must include for connection
use CodeIgniter\Database\ConnectionInterface;

class CustomModel{

  protected $db;

  //consctruct class
  public function __construct(ConnectionInterface &$db){
    $this->db =& $db;
  }

  function all(){
    //SELECT * FROM posts
    //First db connection, then which table
    return $this->db->table('posts')->get()->getResult();

  }


  //getting the foriegn key
  function showFK($name){
    $builder=$this->db->table('lesson_master');
    $builder->where('lesson_name ',$name);
    $result = $builder->get()->getRow();
    $result2=$result->lesson_id;

      return $result2;
  }
  function path($name){
    //$builder->insert('path',$name[path]);
    $builder=$this->db->table('users');
    $path=$name['path'];

    $builder->insert($name);

  }
  function getPK(){
    //$builder->insert('path',$name[path]);
    $builder=$this->db->table('users');
    $builder->insert($name);
  }


  function getStatus($id){
      $builder = $this->db->table('teacher');
      $builder->select('account_status');
      $builder->where('teacher_id ',$id);
      $result = $builder->get()->getRow();
      $result2=$result->account_status;
    //  $result2=$result['account_status'];
      return $result2;
  }

  function getStatusPupil($id){
      $builder = $this->db->table('pupil');
      $builder->select('account_status');
      $builder->where('pupil_id ',$id);
      $result = $builder->get()->getRow();
      $result2=$result->account_status;
    //  $result2=$result['account_status'];
      return $result2;
  }


}
