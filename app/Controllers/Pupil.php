<?php

namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\PupilModel;
use App\Models\PupilModelStatus;
use App\Models\LessonMaster;
use App\Models\CustomModel;
use App\Models\TeacherLesson;
use App\Models\MediaLesson;
use App\Models\LessonContent;
use App\Models\LessonExample;
use App\Models\MediaLessonExample;
use App\Models\ActivityMaster;
use App\Models\ActivityContent;
use App\Models\MediaActivity;
use App\Models\Choices;


class Pupil extends BaseController
{
  public function index()
  {
    $type = session()->get('usertype');
     if ($type!='Pupil' && $type=='Admin'){
        return redirect()->to('admin/home');
        //echo "hello";
     }else if ($type!='Pupil' && $type=='Teacher') {
       return redirect()->to('teacher/home');
     }
    $title=[
      'meta_title'=>'Pupil | Home'
    ];

      return view('pupil_home', $title);
  }
  public function view()
  {
    $type = session()->get('usertype');
     if ($type!='Pupil' && $type=='Admin'){
        return redirect()->to('admin/home');
      //  echo "hello";
    }else if ($type!='Pupil' && $type=='Teacher') {
       return redirect()->to('teacher/home');
     }
    $title=[
      'meta_title'=>'Pupil | View'
    ];

      return view('pupil_view', $title);
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
            'rules'=>'required|min_length[8]|max_length[255]|validatePupilUser[username,password]',
          ],
        ];

        $errors=[
          'password'=>[
            'validatePupilUser'=> 'Username or Password does not match',
          ]
        ];

        if (! $this->validate($rules, $errors)) {
          $data['validation']=$this->validator;

        }else {
          //store user data into the database
          $model = new PupilModel();
          $user = $model->where('pupil_username',$this->request->getVar('username'))
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
            return redirect()->to('pupil/home');
         }


  }
  return view('pupil_login',$data);
}
private function setUserSession($user,$type){
   $data = [
     't_id'=> $user['pupil_id'],
     'firstname'=> $user['pupil_firstname'],
     'lastname'=> $user['pupil_lastname'],
     'username'=> $user['pupil_username'],
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
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
          helper(['form']);
          $data=[
            'meta_title'=>'Teacher | Update Password',
          ];

          if ($this->request->getMethod()=='post') {
            $model = new PupilModel();
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
                  'pupil_id' => session()->get('t_id'),
                  'pupil_password'=>$this->request->getPost('password'),

                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('updatesuccess','Password Update Successful ');
                 return redirect()->to('pupil/update');

                // echo '<script type="text/javascript">
                //       alert("Account Creation Successful!");
                //       </script>';
            }else{
              //if validation is not successfull
              //validator provies a list of errors
              $data['validation']=$this->validator;
            }
          }
           return view('pupil_update', $data);
    }

    public function viewmoduletable()
    {
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Pupil | View'
      ];


      $pupil_id=session()->get('t_id');
      $userModel = new TeacherModel();
      $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();

      $section_id = new PupilModel();
      $data['pupil'] = $section_id->where(['pupil_id'=>$pupil_id])->get()->getRow();



      // echo "<pre>";
      //   print_r($data['users']);
      // echo "<pre>";

      return view('pupil_view', $data);
    }

    public function viewmodule($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Pupil | View Module'
      ];
      //$teacher_id=session()->get('t_id');


      $userModel = new LessonMaster();
      $data['users'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

      $userModel2 = new LessonContent();
      $data['discussion'] = $userModel2->where(['lesson_id'=>$id])->get()->getRow();

      $db = db_connect();
      $getlessoncontentid = new CustomModel($db);
      $id2=$getlessoncontentid->getlessoncontenti2($id);



      // $db = db_connect();
      // $getexampleid1 = new CustomModel($db);
      // $exampleid=$getexampleid1->example($example_val);

      // $id3 = $id2->lesson_content_id;
      //
      // $db = db_connect();
      // $getexampleid1 = new CustomModel($db);
      // $exampleid_=$getexampleid1->example_media($id3);


    // echo "<pre>";
    //   print_r($exampleid_);
    // echo "<pre";


      $userModel3 = new MediaLesson();
        $data['image'] = $userModel3->where(['lesson_content_id'=>$id2->lesson_content_id])->get()->getRow();

      $example = new LessonExample();
      $data['example'] = $example->where(['lesson_content_id'=>$id2->lesson_content_id])->findAll();

        //
        // $example_media = new MediaLessonExample();
        // $data['example_media'] = $example_media->where(['example_id'=>$exampleid_->example_id])->findAll();

      // echo "<pre>";
      //   print_r($exampleid_);
      // echo "<pre";

        //$data['users'] = $userModel->join('lesson_master', 'teacher_lesson.lesson_id = lesson_master.lesson_id')->where(['teacher_lesson.teacher_id'=>$teacher_id])->orderBy('lesson_master.lesson_id', 'ASC')->findAll();


      return view('pupil_viewmodule', $data);
    }
}
