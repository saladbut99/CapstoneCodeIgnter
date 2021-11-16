<?php

namespace App\Controllers;

use App\Models\TeacherRegistration;
use App\Models\AdminModel;
class Admin extends BaseController
{
    public function index()
    {
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Admin | Home'
      ];

        return view('admin_home', $title);
    }

    public function register(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      helper(['form']);
      $data=[
        'meta_title'=>'Admin | Register',
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
        $model = new TeacherRegistration();
        $rules=[
          'teacher_firstname'=> [
            'rules'=>'required|alpha_space',
            'label'=>'Teacher Firstname',
          ],
          'teacher_lastname'=>[
            'rules'=>'required|alpha',
            'label'=>'Teacher Lastname',
          ],

          'teacher_username'=>[
            'rules'=>'is_unique[teacher.teacher_username]',
            'label'=>'Teacher Username',
            'errors'=>[
                  'is_unique' => 'Username already taken please check for existing teacher account.',
                ]
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
            $session->setFlashdata('success','Teacher Registration Successful ');
             return redirect()->to('admin/register');

            // echo '<script type="text/javascript">
            //       alert("Account Creation Successful!");
            //       </script>';
        }else{
          //if validation is not successfull
          //validator provies a list of errors
          $data['validation']=$this->validator;
        }
      }



       return view('admin_registeraccount', $data);
    }

    public function viewlesson(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Admin | View Lesson'
      ];
      return view('admin_view', $title);
    }

    public function viewmodule(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Admin | Module'
      ];
      return view('admin_viewmodule', $title);
    }

    public function viewcontent(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Admin | Content'
      ];
      return view('admin_viewcontent', $title);
    }

    public function success(){
      $title=[
        'meta_title'=>'Success'
      ];
        return view('admin_success',$title);
    }
    public function login()
    {
      $data=[];
        helper(['form']);
        if ($this->request->getMethod()=='post') {
          //lets to the validation
          $rules=[

            'username'=>[
              'rules'=>'required|min_length[6]|max_length[50]',
            ],
            'password'=>[
              'rules'=>'required|min_length[8]|max_length[255]|validateUser[username,password]',
            ],
          ];

          $errors=[
            'password'=>[
              'validateUser'=> 'Username or Password does not match',
            ]
          ];

          if (! $this->validate($rules, $errors)) {
            $data['validation']=$this->validator;

          }else {
            //store user data into the database
            $model = new AdminModel();
            $user = $model->where('admin_username',$this->request->getVar('username'))
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
              return redirect()->to('admin/home');
           }

        }
      return view('admin_login',$data);
    }

private function setUserSession($user,$type){
 $data = [
   't_id'=> $user['admin_id'],
   'username'=> $user['admin_username'],
   'firstname'=> $user['admin_firstname'],
   'lastname'=> $user['admin_lastname'],
   //'email'=> $user['email'],
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
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    helper(['form']);
    $data=[
      'meta_title'=>'Admin | Update Password',
    ];

    if ($this->request->getMethod()=='post') {
      $model = new AdminModel();
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
            'admin_id' => session()->get('t_id'),
            'admin_password'=>$this->request->getPost('password'),

          ];
          $model->save($newData);
          $session = session();
          $session->setFlashdata('updatesuccess','Password Update Successful ');
           return redirect()->to('admin/update');

          // echo '<script type="text/javascript">
          //       alert("Account Creation Successful!");
          //       </script>';
      }else{
        //if validation is not successfull
        //validator provies a list of errors
        $data['validation']=$this->validator;
      }
    }
     return view('admin_update', $data);
  }


}
