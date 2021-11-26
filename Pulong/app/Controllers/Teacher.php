<?php

namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\PupilModel;
use App\Models\PupilModelStatus;
use App\Models\LessonMaster;
use App\Models\CustomModel;


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
      $data=[
        'meta_title'=>'Teacher | View'
      ];
      $userModel = new LessonMaster();
      $data['users'] = $userModel->orderBy('lesson_id', 'ASC')->findAll();


        return view('teacher_view', $data);
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
             'label'=>'Pupil Lastname',
             'errors'=>[
                   'alpha' => 'This field must not contain spaces.',
                 ]
           ],

           'pupil_username'=>[
             'rules'=>'is_unique[pupil.pupil_username]|required',
             'label'=>'Pupil Username',
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
             $_POST['account_status']='Active';
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

public function managelesson()
{
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $title=[
    'meta_title'=>'Teacher | Manage Lessons'
  ];

    return view('teacher_managelesson', $title);
}

public function addmodule()
{
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Add Module'
  ];
  helper(['form']);
  if ($this->request->getMethod()=='post') {
    $model = new LessonMaster();
    $rules=[
      'lesson_name'=> [
        'rules'=>'required',
        'label'=>'Module Title',
      ],
      'lesson_description'=>[
        'rules'=>'required',
        'label'=>'Module Description',
      ],

      'year_level'=>[
        'rules'=>'required',
        'label'=>'Grade Level',
      ],

    ];
    if ($this->validate($rules)) {
        //Then do database insertion or loginuser

       $model->save($_POST);
        $session = session();
        $session->setFlashdata('success','Module Upload Completed');
         return redirect()->to('teacher/addmodule');

    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }

    return view('teacher_addmodule', $data);
}

public function viewuser($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Admin | Account Status'
  ];
  $userModel = new PupilModelStatus();

  $db = db_connect();
  $model = new CustomModel($db);

  $result=$model->getStatusPupil($id);

  $inactive='Inactive';
  $active='Active';

  if (strcmp($result,'Inactive')==0) {
      $userModel->set('account_status',$active)->where(['pupil_id'=>$id])->update();
  }elseif (strcmp($result,'Active')==0) {
    $userModel->set('account_status',$inactive)->where(['pupil_id'=>$id])->update();
  }
  $session = session();
  $session->setFlashdata('updatesuccess','Account Change Successful ');
   return redirect()->to('teacher/pupilaccountstatus');

}

public function accountstatus(){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Account Status'
  ];
  $userModel = new PupilModel();
  $data['users'] = $userModel->join('section', 'pupil.section_id = section.section_id')->orderBy('pupil_id', 'DESC')->findAll();
  return view('teacher_changeteacheraccstat', $data);
}


}
