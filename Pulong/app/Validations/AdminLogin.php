<?php

namespace App\Validations;

//connection to the model
use App\Models\AdminModel;
use App\Models\TeacherModel;
use App\Models\PupilModel;
class AdminLogin{

  public function validateUser(string $str, string $fields, array $data){

    $model = new AdminModel();

    //getting the row of from the database this gets everything apil nag password
    $user = $model->where('admin_username',$data['username'])
                    ->first();
    //if no user found return false
    if(!$user){
      return false;
    }

    //$data['password'] is the user input $user['password '] is from the database
    //this return can return true or false, password_verify returns either true or false, if password matches it will return true
    //if password does not match it will return false thus to be checked by the codeigniter
    return password_verify($data['password'],$user['admin_password']);
  }

  public function validateTeacherUser(string $str, string $fields, array $data){

    $model = new TeacherModel();

    //getting the row of from the database this gets everything apil nag password
    $user = $model->where('teacher_username',$data['username'])
                    ->first();
    //if no user found return false
    if(!$user){
      return false;
    }

    //$data['password'] is the user input $user['password '] is from the database
    //this return can return true or false, password_verify returns either true or false, if password matches it will return true
    //if password does not match it will return false thus to be checked by the codeigniter
    return password_verify($data['password'],$user['teacher_password']);


  }
  public function validatePupilUser(string $str, string $fields, array $data){

    $model = new PupilModel();

    //getting the row of from the database this gets everything apil nag password
    $user = $model->where('pupil_username',$data['username'])
                    ->first();
    //if no user found return false
    if(!$user){
      return false;
    }

    //$data['password'] is the user input $user['password '] is from the database
    //this return can return true or false, password_verify returns either true or false, if password matches it will return true
    //if password does not match it will return false thus to be checked by the codeigniter
    return password_verify($data['password'],$user['pupil_password']);


  }
}
