<?php

namespace App\Controllers;

use App\Models\TeacherRegistration;
use App\Models\AdminModel;
use App\Models\CustomModel;
use App\Models\LessonMaster;
use App\Models\TeacherLesson;
use App\Models\MediaLesson;
use App\Models\LessonContent;
use App\Models\LessonExample;
use App\Models\MediaLessonExample;

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
            'errors'=>[
                  'alpha' => 'This field must not contain spaces.',
                ]
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
            $_POST['account_status']='Active';
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

    public function viewrosal(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 1 Rosal'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
      return view('admin_rosal', $data);
    }

    public function viewrose(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 1 Rose'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
      return view('admin_rose', $data);
    }

    public function viewadelfa(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 1 Adelfa'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
      return view('admin_adelfa', $data);
    }

    public function viewlily(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 1 Lily'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('lesson_master.unit', 'ASC')->findAll();
      return view('admin_lily', $data);
    }

    public function viewgumamela(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 2 Gumamela'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('lesson_master.unit', 'ASC')->findAll();
      return view('admin_gumamela', $data);
    }

    public function vieworchid(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 2 Gumamela'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('lesson_master.unit', 'ASC')->findAll();
      return view('admin_orchid', $data);
    }

    public function viewdaisy(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | Grade 2 Gumamela'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('lesson_master.unit', 'ASC')->findAll();
      return view('admin_daisy', $data);
    }








    public function viewmodule($id){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | View Module'
      ];
      //$teacher_id=session()->get('t_id');


      $userModel = new LessonMaster();
      $data['users'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

      $userModel2 = new LessonContent();
      $data['discussion'] = $userModel2->where(['lesson_id'=>$id])->get()->getRow();

      $db = db_connect();
      $getlessoncontentid = new CustomModel($db);
      $id2=$getlessoncontentid->getlessoncontenti2($id);



      $userModel3 = new MediaLesson();
        $data['image'] = $userModel3->where(['lesson_content_id'=>$id2->lesson_content_id])->get()->getRow();

      $example = new LessonExample();
      $data['example'] = $example->where(['lesson_content_id'=>$id2->lesson_content_id])->findAll();




      return view('admin_module', $data);
    }


    public function viewlesson(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Admin | View Lesson'
      ];

      $userModel = new TeacherRegistration();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
      return view('admin_view', $data);




    }
    //
    // public function viewmodule(){
    //   $type = session()->get('usertype');
    //    if ($type!='Admin' && $type=='Teacher'){
    //       return redirect()->to('teacher/home');
    //     //  echo "hello";
    //   }else if ($type!='Admin' && $type=='Pupil') {
    //      return redirect()->to('pupil/home');
    //    }
    //   $title=[
    //     'meta_title'=>'Admin | Module'
    //   ];
    //   return view('admin_viewmodule', $title);
    // }

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

    public function viewsection(){
      $type = session()->get('usertype');
       if ($type!='Admin' && $type=='Teacher'){
          return redirect()->to('teacher/home');
        //  echo "hello";
      }else if ($type!='Admin' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $title=[
        'meta_title'=>'Admin | View Section'
      ];
      return view('admin_viewsection', $title);
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

  public function accountstatus(){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | Account Status'
    ];
    $userModel = new TeacherRegistration();
    $data['users'] = $userModel->join('section', 'teacher.section_id = section.section_id')->orderBy('teacher_id', 'DESC')->findAll();
    return view('admin_changeteacheraccstat', $data);
  }

  public function viewuser($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | Account Status'
    ];
    $userModel = new TeacherRegistration();

    $db = db_connect();
    $model = new CustomModel($db);

    $result=$model->getStatus($id);

    $inactive='Inactive';
    $active='Active';

    if (strcmp($result,'Inactive')==0) {
        $userModel->set('account_status',$active)->where(['teacher_id'=>$id])->update();
    }elseif (strcmp($result,'Active')==0) {
      $userModel->set('account_status',$inactive)->where(['teacher_id'=>$id])->update();
    }
    $session = session();
    $session->setFlashdata('updatesuccess','Account Change Successful ');
     return redirect()->to('admin/accountstatus');

  }

  public function manage(){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | Manage '
    ];

     return view('admin_manage', $data);

  }


}
