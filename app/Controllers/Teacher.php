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


      $teacher_id=session()->get('t_id');
      $userModel = new TeacherLesson();
      $data['users'] = $userModel->join('lesson_master', 'teacher_lesson.lesson_id = lesson_master.lesson_id')->where(['teacher_lesson.teacher_id'=>$teacher_id])->orderBy('lesson_master.lesson_id', 'ASC')->findAll();


        return view('teacher_view', $data);
    }
    public function removemodule()
    {
      $type = session()->get('usertype');
       if ($type!='Teacher' && $type=='Admin'){
          return redirect()->to('admin/home');
        //  echo "hello";
       }else if ($type!='Teacher' && $type=='Pupil') {
         return redirect()->to('pupil/home');
       }
      $data=[
        'meta_title'=>'Teacher | Remove Module'
      ];


      $teacher_id=session()->get('t_id');
      $userModel = new TeacherLesson();
      $data['users'] = $userModel->join('lesson_master', 'teacher_lesson.lesson_id = lesson_master.lesson_id')->where(['teacher_lesson.teacher_id'=>$teacher_id])->orderBy('lesson_master.lesson_id', 'ASC')->findAll();


        return view('remove_module', $data);
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

       // $section=[
       //   'Grade 1 - Rose','Grade 1 - Rosal', 'Grade 1 - Adelfa' ,'Grade 2 - Lily',  'Grade 2 - Gumamela',  'Grade 3 - Orchid',  'Grade 3 - Daisy'
       // ];
       //
       //
       // $data['section']=$section;


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
                   'is_unique' => 'Username already taken please check for existing pupil account.',
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
  $userModel = new TeacherModel();
  $section = $userModel->join('section', 'teacher.section_id = section.section_id')->where(['teacher_id'=>$user['teacher_id']])->get()->getRow();
    $result2=$section->section_name;
    $section_id = $userModel->where(['teacher_id'=>$user['teacher_id']])->get()->getRow();
      $result3=$section_id->section_id;
     $data = [
       't_id'=> $user['teacher_id'],
       'firstname'=> $user['teacher_firstname'],
       'lastname'=> $user['teacher_lastname'],
       'username'=> $user['teacher_username'],
       'isLoggedIn'=> true,
       'usertype'=> $type,
       'section'=>$result2,
      'section_id'=>$result3,
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
    $model1 = new LessonContent();
    $model2 = new MediaLesson();

    $rules=[
      'lesson_name'=> [
        'rules'=>'required|is_unique[lesson_master.lesson_name]',
        'label'=>'Module Title',
        'errors'=>[
          'is_unique'=>'Module Title already taken please check for existing module',
        ]
      ],
      'lesson_description'=>[
        'rules'=>'required',
        'label'=>'Module Description',
      ],

      'unit'=>[
        'rules'=>'required',
        'label'=>'Lesson Unit',
      ],
      'image'=>[
        'rules'=> 'uploaded[image]|ext_in[image,png,jpg,gif,mp4]',
        'label'=>'Image',
      ],
      'discussion'=>[
        'rules'=>'required|is_unique[lesson_content.discussion]',
        'label'=>'Discussion Field',
      ],
    ];
    if ($this->validate($rules)) {
        //Then do database insertion or loginuser
        $_POST['lesson_name']=ucfirst($_POST['lesson_name']);
        $_POST['lesson_description']=ucfirst($_POST['lesson_description']);
        $_POST['discussion']=ucfirst($_POST['discussion']);
        $model->save($_POST);

        $db = db_connect();
        $custommodel = new CustomModel($db);
        $teacher_lesson=$custommodel->showFK($_POST['lesson_name']);
        $teachermodel = new TeacherModel();
        $getter = $teachermodel->select('teacher_id')->where(['teacher_id'=>session()->get('t_id')])->get()->getRow();
        $teacher_id = $getter->teacher_id;
        date_default_timezone_set('Asia/Manila');
         $myTime=date('Y-m-d h:i:s');
        $newData=[
          'lesson_id' => $teacher_lesson,
          'teacher_id'=>$teacher_id,
          'lesson_upload_date' => $myTime,

        ];
    //     echo "<pre>";
    //   print_r($newData);
    // echo "<pre>";

          $TeacherLesson = new TeacherLesson();
          $TeacherLesson->save($newData);

          $db = db_connect();
          $customnew= new CustomModel($db);
          $id=$customnew->getmoduleid($_POST['lesson_name']);

                  $file = $this->request->getFile('image');
                  if ($file->isValid()&& !$file->hasMoved()) {
                    $file->move('./uploads/images');
                  }
                  $filename = $file->getName();
                  $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

                  $db = db_connect();
                  $getlessonid = new CustomModel($db);
                  $id=$getlessonid->getlessonid($id);



                  $_POST['file_name']=$filename;
                  $_POST['lesson_id']=$id;
                  $_POST['file_targetDirectory']='./uploads/image';
                  $_POST['file_extension']=$fileExt;

                  $model1->save($_POST);

                  $discussion=$_POST['discussion'];
                  $db = db_connect();
                  $getlessoncontentid = new CustomModel($db);
                  $id2=$getlessoncontentid->getlessoncontentid($discussion);
                  $_POST['lesson_content_id']=$id2;
                  $model2->save($_POST);


        $session = session();
        $session->setFlashdata('success','Module Upload Completed');
          return redirect()->to('teacher/viewmodule/'.$id);

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

public function delete($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
   $lessonmaster = new LessonMaster;
    $model = new TeacherLesson();
    if ($lessonmaster) {
      $lessonmaster->delete($id);
    }


   $session = session();
   $session->setFlashdata('updatesuccess','Module Successfully Deleted ');
   return redirect()->to('teacher/view');

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

  $userModel = new TeacherModel();
  $section_id = $userModel->where(['teacher_id'=>session()->get('t_id')])->get()->getRow();
  $result3=$section_id->section_id;
  $pupilModel = new PupilModel();
  $data['users'] = $pupilModel->join('section', 'pupil.section_id = section.section_id')->where(['pupil.section_id'=>$result3])->orderBy('pupil_id', 'DESC')->findAll();
  return view('teacher_changeteacheraccstat', $data);
}

public function module($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Admin | View Module'
  ];
  //$teacher_id=session()->get('t_id');
  $userModel = new LessonMaster();
  $data['users'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();
  //     echo "<pre>";
  //   print_r($data);
  // echo "<pre>";
  helper(['form']);

  if ($this->request->getMethod()=='post') {
    $model = new LessonContent();
    $model2 = new MediaLesson();
    $rules=[
      // 'password'=>[
      //     'rules'=>'required|min_length[8]|max_length[255]',
      //     'label'=>'Password',
      // ],
      // 'password_confirm'=>[
      //     'rules'=>'matches[password]',
      //     'label'=>'Confirm Password',
      // ],
      'image'=>[
        'rules'=> 'uploaded[image]|ext_in[image,png,jpg,gif,mp4]',
        'label'=>'Image',
      ],
      'discussion'=>[
        'rules'=>'required|is_unique[lesson_content.discussion]',
        'label'=>'Discussion Field',
      ],
    ];
    if ($this->validate($rules)) {
        //Then do database insertion or loginuser

        $file = $this->request->getFile('image');
        if ($file->isValid()&& !$file->hasMoved()) {
          $file->move('./uploads/images');
        }
        $filename = $file->getName();

        $db = db_connect();
        $getlessonid = new CustomModel($db);
        $id=$getlessonid->getlessonid($id);



        $_POST['file_name']=$filename;
        $_POST['lesson_id']=$id;
        $_POST['file_targetDirectory']='./uploads/image';

        $model->save($_POST);

        $discussion=$_POST['discussion'];
        $db = db_connect();
        $getlessoncontentid = new CustomModel($db);
        $id2=$getlessoncontentid->getlessoncontentid($discussion);
        $_POST['lesson_content_id']=$id2;
        $model2->save($_POST);
         $session = session();
         $session->setFlashdata('updatesuccess','Image and Discussion Added Successfully ');
           return redirect()->to('teacher/viewmodule/'.$id);

        // echo '<script type="text/javascript">
        //       alert("Account Creation Successful!");
        //       </script>';
    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }

    return view('teacher_moduleview', $data);


}

// public function addexample(){
//   $type = session()->get('usertype');
//    if ($type!='Teacher' && $type=='Admin'){
//       return redirect()->to('admin/home');
//     //  echo "hello";
//    }else if ($type!='Teacher' && $type=='Pupil') {
//      return redirect()->to('pupil/home');
//    }
//
//    $userModel = new LessonMaster();
//    $lesson_id = $userModel->where(['lesson_id'=>$id])->get()->getRow()->lesson_id;
//
//    $userModel2 = new LessonContent();
//    $lesson_content_id = $userModel2->where(['lesson_id'=>$id])->get()->getRow()->lesson_content_id;
//
//   // $data=[
//   //   'meta_title'=>'Admin | View Module'
//   // ];
//   $rules=[
//     // 'password'=>[
//     //     'rules'=>'required|min_length[8]|max_length[255]',
//     //     'label'=>'Password',
//     // ],
//     // 'password_confirm'=>[
//     //     'rules'=>'matches[password]',
//     //     'label'=>'Confirm Password',
//     // ],
//     // 'image'=>[
//     //   'rules'=> 'uploaded[image]|ext_in[image,png,jpg,gif,mp4]',
//     //   'label'=>'Image',
//     // ],
//     'example'=>[
//       'rules'=>'required|is_unique[lesson_content.discussion]',
//       'label'=>'Discussion Field',
//     ],
//   ];
//
//   helper(['form']);
//
//   if ($this->request->getMethod()=='post') {
//     $model= new LessonExample();
//     if ($this->validate($rules)) {
//       //Then do database insertion or loginuser
//
//       // $file = $this->request->getFile('image');
//       // if ($file->isValid()&& !$file->hasMoved()) {
//       //   $file->move('./uploads/images');
//       // }
//       // $filename = $file->getName();
//       //
//       // $db = db_connect();
//       // $getlessonid = new CustomModel($db);
//       // $id=$getlessonid->getlessonid($id);
//       //
//       //
//       //
//       // $_POST['file_name']=$filename;
//       // $_POST['lesson_id']=$id;
//       // $_POST['file_targetDirectory']='./uploads/image';
//       //
//       // $model->save($_POST);
//
//       //$discussion=$_POST['discussion'];
//       // $db = db_connect();
//       // $getlessoncontentid = new CustomModel($db);
//       // $id2=$getlessoncontentid->getlessoncontenti2($id);
//       $_POST['lesson_content_id']=$lesson_content_id;
//       $model->save($_POST);
//        $session = session();
//        $session->setFlashdata('updatesuccess','Image and Discussion Added Successfully ');
//       //  return redirect()->to('teacher/viewmodule/'.$id);
//       return redirect()->to('teacher/view');
//
//       // echo '<script type="text/javascript">
//       //       alert("Account Creation Successful!");
//       //       </script>';
//   }else{
//     //if validation is not successfull
//     //validator provies a list of errors
//     $data['validation']=$this->validator;
//   }
// }
// }

public function viewmodule($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
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

    $rules=[
      // 'password'=>[
      //     'rules'=>'required|min_length[8]|max_length[255]',
      //     'label'=>'Password',
      // ],
      // 'password_confirm'=>[
      //     'rules'=>'matches[password]',
      //     'label'=>'Confirm Password',
      // ],
      'image'=>[
        'rules'=> 'ext_in[image,png,jpg,gif,mp4]',
        'label'=>'Image',
      ],
      'example'=>[
        'rules'=>'required|is_unique[lesson_example.example]',
        'label'=>'Examople Field',
      ],
    ];

    helper(['form']);
    if ($this->request->getMethod()=='post') {
      $model_lesson= new LessonExample();
    //  $model_media = new MediaLessonExample();
      if ($this->validate($rules)) {
        //Then do database insertion or loginuser



        //$discussion=$_POST['discussion'];
        $db = db_connect();
        $getlessoncontentid = new CustomModel($db);
        $id2=$getlessoncontentid->getlessoncontenti3($id);
        $_POST['lesson_content_id']=$id2;



        // $example_val=$_POST['example'];
        // $db = db_connect();
        // $getexampleid = new CustomModel($db);
        // $exampleid=$getexampleid->example($example_val);


        if (!is_uploaded_file($_FILES['image']['tmp_name'])) {


          $file = $this->request->getFile('image');
          if ($file->isValid()&& !$file->hasMoved()) {
            $file->move('./uploads/images');
          }
        //  $filename = $file->getName();
          $filename = $file->getName();
          $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

          $db = db_connect();
          $getlessonid = new CustomModel($db);
          $id=$getlessonid->getlessonid($id);

          $_POST['file_name']='NoFile';
        //  $_POST['lesson_id']=$id;
          $_POST['file_targetDirectory']='NoFile';
          $_POST['file_extension']='NoFile';

          // $getlessoncontentid = new CustomModel($db);
          // $id2=$getlessoncontentid->getlessoncontenti3($id);
        //  $_POST['example_id']=$exampleid;

      }else {
        $file = $this->request->getFile('image');
        if ($file->isValid()&& !$file->hasMoved()) {
          $file->move('./uploads/images');
        }
      //  $filename = $file->getName();
        $filename = $file->getName();
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

        $db = db_connect();
        $getlessonid = new CustomModel($db);
        $id=$getlessonid->getlessonid($id);

        $_POST['file_name']=$filename;
      //  $_POST['lesson_id']=$id;
        $_POST['file_targetDirectory']='./uploads/image';
        $_POST['file_extension']=$fileExt;
      }
          $model_lesson->save($_POST);
         $session = session();
         $session->setFlashdata('updatesuccess','Example added successfully ');
        //  return redirect()->to('teacher/viewmodule/'.$id);
        return redirect()->to('teacher/viewmodule/'.$id);

        // echo '<script type="text/javascript">
        //       alert("Account Creation Successful!");
        //       </script>';
    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
    }

  return view('teacher_module', $data);
}


public function updatemodule($id){

  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

 $db      = \Config\Database::connect();


  $data=[
    'meta_title'=>'Admin | Update Module'
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

    //
    $rules=[

        'lesson_name'=>[
          'rules'=>'required|is_unique[lesson_master.lesson_name]',
          'label'=>'Lesson Name Field',
        ],
        'lesson_description'=>[
          'rules'=>'required',
          'label'=>'Module Description',
        ],

        'unit'=>[
          'rules'=>'required',
          'label'=>'Lesson Unit',
        ],
      'image'=>[
        'rules'=> 'ext_in[image,png,jpg,gif,mp4]',
        'label'=>'Image',
      ],
      // 'example'=>[
      //   'rules'=>'required|is_unique[lesson_example.example]',
      //   'label'=>'Examople Field',
      // ],
    ];
    //
    helper(['form']);

    if ($this->request->getMethod()=='post') {

      $model_lesson = new LessonMaster();

       if ($this->validate($rules)) {


        $lesson_master = [
            'lesson_name' => ucfirst($_POST['lesson_name']),
            'lesson_description' => ucfirst($_POST['lesson_description']),
            'unit'=> $_POST['unit'],
        ];

        $builder = $db->table('lesson_master');

        $builder->where('lesson_id', $id);

        $builder->update($lesson_master);

        $lesson_content = [
            'discussion' => ucfirst($_POST['discussion']),
        ];

        $builder_content = $db->table('lesson_content');

        $builder_content->where('lesson_id', $id);

        $builder_content->update($lesson_content);

      //   // $example_val=$_POST['example'];
      //   // $db = db_connect();
      //   // $getexampleid = new CustomModel($db);
      //   // $exampleid=$getexampleid->example($example_val);
      //
      //
      //   if (!is_uploaded_file($_FILES['image']['tmp_name'])) {
      //
      //
      if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        $file = $this->request->getFile('image');
        if ($file->isValid()&& !$file->hasMoved()) {
          $file->move('./uploads/images');
        }
      //  $filename = $file->getName();
        $filename = $file->getName();
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

        $db = db_connect();
        $getlessonid = new CustomModel($db);
        $id=$getlessonid->getlessonid($id);

        $_POST['file_name']=$filename;
      //  $_POST['lesson_id']=$id;
        $_POST['file_targetDirectory']='./uploads/image';
        $_POST['file_extension']=$fileExt;

          $lesson_media = [
             'file_name' => $filename,
             'file_extension' =>$fileExt,
           ];

           $builder_media = $db->table('media_lesson');

           $builder_media->where('lesson_content_id', $id2->lesson_content_id);

           $builder_media->update($lesson_media);

    }

      $session = session();
      $session->setFlashdata('success','Module Upload Completed');
        return redirect()->to('teacher/updatemodule/'.$id);
    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updatemodule', $data);
}

public function addactivity($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Add Activity '
  ];

   $db      = \Config\Database::connect();

  $userModel = new LessonMaster();
  $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

  $rules=[

      'activity_name'=>[
        'rules'=>'required|is_unique[activity_master.activity_name]',
        'label'=>'Activity Title',
      ],
      'activity_instruction'=>[
        'rules'=>'required',
        'label'=>'Activity Description',
      ],
    'activity_type'=>[
      'rules'=> 'required',
      'label'=>'Activity Type',
    ],

  ];

  helper(['form']);

  if ($this->request->getMethod()=='post') {

    $model_activity = new ActivityMaster();

     if ($this->validate($rules)) {

       $_POST['activity_name']=ucfirst($_POST['activity_name']);
       $_POST['activity_instruction']=ucfirst($_POST['activity_instruction']);
       $_POST['lesson_id']=$id;
       date_default_timezone_set('Asia/Manila');
       $myTime=date('Y-m-d h:i:s');
       $_POST['activity_upload_date'] = $myTime;
       $model_activity->save($_POST);
       $session = session();
       $session->setFlashdata('success','Module Upload Completed');

       $builder = $db->table('activity_master');

       $builder->where('activity_name',  $_POST['activity_name']);

       $result = $builder->get()->getRow();

       $id2=$result->activity_id;

       if (strcmp($_POST['activity_type'],'multiple_choice')==0) {
         return redirect()->to('teacher/multiplechoice/'.$id2);
       }elseif (strcmp($_POST['activity_type'],'enumeration')==0) {
          return redirect()->to('teacher/enumeration/'.$id2);
       }else {
        return redirect()->to('teacher/identification/'.$id2);
       }

  }else{
    //if validation is not successfull
    //validator provies a list of errors
    $data['validation']=$this->validator;
  }
}


   return view('teacher_addactivity', $data);

}

public function viewactivity($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Add Activity '
  ];

  $db      = \Config\Database::connect();

  // $userModel = new LessonMaster();
  // $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

  // $builder = $db->table('activity_master');
  //
  // $builder->where('lesson_id',  $id);
  //
  // $data['users'] = $builder->get()->getRow();

  $activity_id = new ActivityMaster();
  $data['users'] = $activity_id->where(['lesson_id'=>$id])->findAll();

  $userModel = new LessonMaster();
  $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();


   return view('teacher_viewactivity', $data);

}
public function multiplechoice($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
    $question_no=1;
  $data=[
    'meta_title'=>'Teacher | Manage ',
    'question_no'=>$question_no,
  ];



  $activity_id = new ActivityMaster();
  $data['users'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();

   return view('teacher_multiplechoice', $data);

}

public function enumeration($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Manage '
  ];

   return view('teacher_enumeration', $data);

}

public function identification($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Manage '
  ];

   return view('teacher_identification', $data);

}

public function activitytype_checker($actid){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Activity '
  ];

  // $activity_id = new ActivityMaster();
  // $data['users'] = $activity_id->where(['activity_id'=>$actid])->findAll();

   $db      = \Config\Database::connect();

   $builder = $db->table('activity_master');

   $builder->where('activity_id',  $actid);

   $data['users'] = $builder->get()->getRow();

   $act_type=$data['users']->activity_type;


  if (strcmp($act_type,'multiple_choice')==0) {
    return redirect()->to('teacher/multiplechoice/'. $actid);
  }elseif (strcmp($act_type,'enumeration')==0) {
     return redirect()->to('teacher/enumeration/'. $actid);
  }else {
   return redirect()->to('teacher/identification/'. $actid);
  }
}

public function manage(){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | Manage '
  ];

   return view('teacher_manage', $data);

}




}
