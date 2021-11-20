<?php

namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\PupilModel;

class Teacher extends BaseController
{
    public function index()
    {

    $type = session()->get('usertype');
     if ($type!='Teacher' && $type=='Admin'){
        return redirect()->to('admin/home');
      //  echo "hello";
     }else if ($type!='Teacher' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }

      $title=[
        'meta_title'=>'Teacher | Home'
      ];

        return view('teacher_home', $title);
    }
    public function view()
    {
      $type = session()->get('usertype');
       if ($type!='Teacher' && $type=='Admin'){
          return redirect()->to('admin/home');
        //  echo "hello";
       }else if ($type!='Teacher' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Teacher | View'
      ];

        return view('teacher_view', $title);
    }
    public function register()
    {
      $type = session()->get('usertype');
       if ($type!='Teacher' && $type=='Admin'){
          return redirect()->to('admin/home');
        //  echo "hello";
       }else if ($type!='Teacher' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
       helper(['form']);
       $data=[
         'meta_title'=>'Teacher | Register',
       ];

       $section=[
         'Grade 1 - Rose','Grade 1 - Rosal', 'Grade 1 - Adelfa' ,'Grade 2 - Lily',  'Grade 2 - Gumamela',  'Grade 3 - Orchid',  'Grade 3 - Daisy'
       ];
       $data['section']=$section;


       // if ($this->request->getMethod()=='post') {
       //   $model = new TeacherRegistration();
       //    $model->save($_POST);
       // }
       if ($this->request->getMethod()=='post') {
         $model = new PupilModel();
         $rules=[
           'pupil_firstname'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Firstname',
           ],
           'pupil_middlename'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Middlename',
           ],
           'pupil_lastname'=>[
             'rules'=>'required|alpha',
             'label'=>'pupil Lastname',
             'errors'=>[
                   'alpha' => 'This field must not contain spaces.',
                 ]
           ],

           'pupil_username'=>[
             'rules'=>'is_unique[teacher.teacher_username]',
             'label'=>'Teacher Username',
             'errors'=>[
                   'is_unique' => 'Username already taken please check for existing teacher account.',
                 ]
           ],
           'pupil_address'=> [
             'rules'=>'required',
             'label'=>'Pupil Address',
           ],
           'pupil_firstname'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Address',
           ],
           'pupil_father_name'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Fathers Name',
           ],
           'pupil_mother_name'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Mothers Name',
           ],
           'pupil_guardian_name'=> [
             'rules'=>'required|alpha_space',
             'label'=>'Pupil Guardians Name',
           ],

           'section_id'=>[
             'rules'=>'required',
             'label'=>'Section',
           ],
         ];
         if ($this->validate($rules)) {
             //Then do database insertion or loginuser
             $model->save($_POST);
             $session = session();
             $session->setFlashdata('success','Pupil Registration Successful ');
              return redirect()->to('teacher/register');

             // echo '<script type="text/javascript">
             //       alert("Account Creation Successful!");
             //       </script>';
         }else{
           //if validation is not successfull
           //validator provies a list of errors
           $data['validation']=$this->validator;
         }
       }

        return view('teacher_registeraccount', $data);
    }
    public function login(){
      $data=[];
        helper(['form']);
        if ($this->request->getMethod()=='post') {
          //lets do the validation
          $rules=[

            'username'=>[
              'rules'=>'required|min_length[6]|max_length[50]',
            ],
            'password'=>[
              'rules'=>'required|min_length[8]|max_length[255]|validateTeacherUser[username,password]',
            ],
          ];

          $errors=[
            'password'=>[
              'validateTeacherUser'=> 'Username or Password does not match',
            ]
          ];

          if (! $this->validate($rules, $errors)) {
            $data['validation']=$this->validator;

          }else {
            //store user data into the database
            $model = new TeacherModel();
            $user = $model->where('teacher_username',$this->request->getVar('username'))
                            ->first();
          //get the value of the user type from the form after pass it to the array
          $type=$this->request->getVar('usertype');
          //this array bellow ang gamiton if naay user type
          $this->setUserSession($user,$type);
      //   $this->setUserSession($user);

            // ];
            // $model->save($newData);
            // $session = session();
            // $session->setFlashdata('success','Successful Registration');
              //return redirect()->to('dashboard');
              return redirect()->to('teacher/home');
           }


    }
    return view('teacher_login',$data);
  }
private function setUserSession($user,$type){
     $data = [
       't_id'=> $user['teacher_id'],
       'firstname'=> $user['teacher_firstname'],
       'lastname'=> $user['teacher_lastname'],
       'username'=> $user['teacher_username'],
       'isLoggedIn'=> true,
       'usertype'=> $type,
     ];
     session()->set($data);
     return true;
}

public function logout(){
        session()->destroy();
        return redirect()->to('homepage');
  }

public function update(){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
      helper(['form']);
      $data=[
        'meta_title'=>'Teacher | Update Password',
      ];

      if ($this->request->getMethod()=='post') {
        $model = new TeacherModel();
        $rules=[
          'password'=>[
              'rules'=>'required|min_length[8]|max_length[255]',
              'label'=>'Password',
          ],
          'password_confirm'=>[
              'rules'=>'matches[password]',
              'label'=>'Confirm Password',
          ],
        ];
        if ($this->validate($rules)) {
            //Then do database insertion or loginuser
            $newData=[
              'teacher_id' => session()->get('t_id'),
              'teacher_password'=>$this->request->getPost('password'),

            ];
            $model->save($newData);
            $session = session();
            $session->setFlashdata('updatesuccess','Password Update Successful ');
             return redirect()->to('teacher/update');

            // echo '<script type="text/javascript">
            //       alert("Account Creation Successful!");
            //       </script>';
        }else{
          //if validation is not successfull
          //validator provies a list of errors
          $data['validation']=$this->validator;
        }
      }
       return view('teacher_update', $data);
}


}
