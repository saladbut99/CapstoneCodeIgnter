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
use App\Models\PerformanceRecords;
use App\Models\Answers;
use App\Models\Section;
use App\Models\TeacherRegistration;


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

    public function viewmoduletable()
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
      //     echo "<pre>";
      //   print_r($data['users']);
      // echo "<pre>";

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
          if (strcmp($user['account_status'],'Inactive')==0) {
            $data['status']='Account Inactive';
          }else {
            //get the value of the user type from the form after pass it to the array
            $type=$this->request->getVar('usertype');
            //this array bellow ang gamiton if naay user type
            $this->setUserSession($user,$type);
        //   $this->setUserSession($user);
            return redirect()->to('teacher/home');
          }

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
   return redirect()->to('teacher/viewmoduletable');

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
        'rules'=> 'ext_in[image,png,jpg,gif,mp4,mp3]',
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
          'rules'=>'required',
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
        return redirect()->to('teacher/viewmodule/'.$id);
    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updatemodule', $data);
}

public function delete_example($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }


   $example = new LessonExample();
   $data['example']=$example->where(['example_id'=>$id])->get()->getRow();

   $lesson_content = new LessonContent();
   $data['content']=$lesson_content->where(['lesson_content_id'=>$data['example']->lesson_content_id])->get()->getRow();

   $lesson_master = new LessonMaster();
   $data['master']=$lesson_master->where(['lesson_id'=>$data['content']->lesson_id])->get()->getRow();

    $model = new TeacherLesson();


    if ($example) {
      $example->delete($id);
    }

    $id2=$data['master']->lesson_id;



    // echo "<pre>";
    //   print_r($data['example']);
    // echo "<pre>";


   $session = session();
   $session->setFlashdata('success','Example Successfully Deleted ');

  return redirect()->to('teacher/viewmodule/'.$id2);

}

public function update_example($id){

  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

 $db      = \Config\Database::connect();



  $data=[
    'meta_title'=>'Teacher | Update Example'
  ];
  //$teacher_id=session()->get('t_id');


     $example = new LessonExample();
     $data['example']=$example->where(['example_id'=>$id])->get()->getRow();

     $lesson_content = new LessonContent();
     $data['content']=$lesson_content->where(['lesson_content_id'=>$data['example']->lesson_content_id])->get()->getRow();

     $lesson_master = new LessonMaster();
     $data['master']=$lesson_master->where(['lesson_id'=>$data['content']->lesson_id])->get()->getRow();



    $rules=[
      'image'=>[
        'rules'=> 'ext_in[image,png,jpg,gif,mp4]',
        'label'=>'Image',
      ],
      'example'=>[
        'rules'=>'required',
        'label'=>'Examople Field',
      ],

    ];

    helper(['form']);

    if ($this->request->getMethod()=='post') {



       if ($this->validate($rules)) {




        if (is_uploaded_file($_FILES['image']['tmp_name'])) {

          $file = $this->request->getFile('image');
          if ($file->isValid()&& !$file->hasMoved()) {
            $file->move('./uploads/images');
          }
        //  $filename = $file->getName();
          $filename = $file->getName();
          $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

          // $db = db_connect();
          // $getlessonid = new CustomModel($db);
          // $id=$getlessonid->getlessonid($id);

          $_POST['file_name']=$filename;
        //  $_POST['lesson_id']=$id;
          $_POST['file_targetDirectory']='./uploads/image';
          $_POST['file_extension']=$fileExt;

            $activity_media = [
               'file_name' => $filename,
               'file_extension' =>$fileExt,
               'file_targetDirectory'=>'./uploads/image',
             ];

             $builder_media = $db->table('lesson_example');

             $builder_media->where('example_id', $id);

             $builder_media->update($activity_media);

      }

      $example=[
         'example'=>ucfirst($_POST['example']),
      ];
      $builder_media2 = $db->table('lesson_example');

      $builder_media2->where('example_id', $id);

      $builder_media2->update($example);
   //
   // echo "<pre>";
   //   print_r($id_array);
   // echo "<pre>";


      $session = session();
      $session->setFlashdata('updatesuccess','Module Upload Completed');

       return redirect()->to('teacher/viewmodule/'.$data['master']->lesson_id);



    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updateexample', $data);
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
  //  $question_no=1;
  $data=[
    'meta_title'=>'Teacher | Manage ',
  //  'question_no'=>$question_no,
  ];



  $activity_id = new ActivityMaster();
  $data['users'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();

  $activity_id = new ActivityContent();
  $data['question'] = $activity_id->where(['activity_id'=>$id])->findAll();


  $choices = new Choices();
  $data['choice'] = $choices->findAll();

  $medias = new MediaActivity();
  $data['media'] = $medias->findAll();

  // echo "<pre>";
  //   print_r($data['choice']);
  // echo "<pre>";

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

  $activity_id = new ActivityMaster();
  $data['users'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();

  $activity_id = new ActivityContent();
  $data['question'] = $activity_id->where(['activity_id'=>$id])->findAll();


  $choices = new Choices();
  $data['choice'] = $choices->findAll();

  $medias = new MediaActivity();
  $data['media'] = $medias->findAll();

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

// Add Question
public function addquestion($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

    $model_master = new ActivityMaster();

      $activity_id = new ActivityContent();
      $data['users'] = $activity_id->where(['activity_id'=>$id])->findAll();

      $score=count($data['users']);
      $score+=1;

   $rules=[

       'activity_question'=>[
         'rules'=>'required|is_unique[activity_content.activity_question]',
         'label'=>'Activity Title',
       ],
       'image'=>[
         'rules'=> 'ext_in[image,png,jpg,gif,mp4,mp3]',
         'label'=>'Image',
       ],
     //   'activity_instruction'=>[
     //     'rules'=>'required',
     //     'label'=>'Activity Description',
     //   ],
     'choice'=>[
       'rules'=> 'required',
       'label'=>'Choice',
     ],

   ];

   helper(['form']);

   if ($this->request->getMethod()=='post') {

     $model_activity = new ActivityContent();
     $model_actmedia = new MediaActivity();
     $model_choice = new Choices();

      if ($this->validate($rules)) {

        $_POST['activity_question']=ucfirst($_POST['activity_question']);
        $_POST['activity_answer']=ucfirst($_POST['activity_answer']);
        $_POST['activity_id']=$id;



           $db      = \Config\Database::connect();

           $builder = $db->table('activity_master');

           $builder->where('activity_id',  $id);

          $activity = $builder->get()->getRow();

          $type = $activity->activity_type;
          if (strcmp($type,'multiple_choice')==0) {
            $_POST['activity_answer_type']=  'M';
          }else if (strcmp($type,'enumeration')==0) {
            $_POST['activity_answer_type']=  'E';
          }else {
            $_POST['activity_answer_type']=  'I';
          }

          // echo "<pre>";
          //   print_r($_POST);
          // echo "<pre>";
          $_POST['activity_perfect_score']=$score*2;

          $model_activity->save($_POST);
          $model_master->save($_POST);

          if (!is_uploaded_file($_FILES['image']['tmp_name'])) {


            $file = $this->request->getFile('image');
            if ($file->isValid()&& !$file->hasMoved()) {
              $file->move('./uploads/images');
            }
          //  $filename = $file->getName();
            $filename = $file->getName();
            $fileExt = pathinfo($filename, PATHINFO_EXTENSION);
            //
            // $db = db_connect();
            // $getlessonid = new CustomModel($db);
            // $id=$getlessonid->getlessonid($id);
            $builder1 = $db->table('activity_content');

            $builder1->where('activity_question',  $_POST['activity_question']);

            $content = $builder1->get()->getRow();
            $_POST['file_name']='NoFile';
            $_POST['activity_content_id']=$content->activity_content_id;
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

          // $db = db_connect();
          // $getlessonid = new CustomModel($db);
          // $id=$getlessonid->getlessonid($id);
          $builder1 = $db->table('activity_content');

          $builder1->where('activity_question',  $_POST['activity_question']);

          $content = $builder1->get()->getRow();

          $_POST['file_name']=$filename;
          $_POST['activity_content_id']=$content->activity_content_id;
          $_POST['file_targetDirectory']='./uploads/image';
          $_POST['file_extension']=$fileExt;
        }

        $model_actmedia->save($_POST);
        $builder2 = $db->table('activity_content');

        $builder2->where('activity_question',  $_POST['activity_question']);

        $content2 = $builder2->get()->getRow();

        //$_POST['activity_content_id']=$content2->activity_content_id;

        $choices = array($_POST['choice']);
        foreach ($choices as $choice) {
            $choice_ent=$choice;

            $f=count($choice_ent);

            for($i=0;$i<$f;$i++)
            {
              $arre=[
                'choice'=>$choice_ent[$i],
                'activity_content_id'=>$content2->activity_content_id,
                ];
              $model_choice->save($arre);
            }

        }



        // echo "<pre>";
        //   print_r($choices);
        // echo "<pre>";

          $session = session();
          $session->setFlashdata('success','Question Added');




        return redirect()->to('teacher/multiplechoice/'.$id);





   }else{
     //if validation is not successfull
     //validator provies a list of errors
     $data['validation']=$this->validator;
   }
 }

}

public function addquestion_identification($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }



   $model_master = new ActivityMaster();

     $activity_id = new ActivityContent();
     $data['users'] = $activity_id->where(['activity_id'=>$id])->findAll();

     $score=count($data['users']);
     $score+=1;

   $rules=[

       'activity_question'=>[
         'rules'=>'required|is_unique[activity_content.activity_question]|alpha_space',
         'label'=>'Activity Title',
       ],
       'image'=>[
         'rules'=> 'ext_in[image,png,jpg,gif,mp4,mp3]',
         'label'=>'Image',
       ],
     //   'activity_instruction'=>[
     //     'rules'=>'required',
     //     'label'=>'Activity Description',
     //   ],
     'activity_answer'=>[
       'rules'=> 'required',
       'label'=>'Choice',
     ],

   ];

   helper(['form']);

   if ($this->request->getMethod()=='post') {

     $model_activity = new ActivityContent();
     $model_actmedia = new MediaActivity();

      if ($this->validate($rules)) {

        $_POST['activity_question']=ucfirst($_POST['activity_question']);
        $_POST['activity_answer']=ucfirst($_POST['activity_answer']);
        $_POST['activity_id']=$id;



           $db      = \Config\Database::connect();

           $builder = $db->table('activity_master');

           $builder->where('activity_id',  $id);

          $activity = $builder->get()->getRow();

          $type = $activity->activity_type;

          if (strcmp($type,'multiple_choice')==0) {
            $_POST['activity_answer_type']=  'M';
          }else if (strcmp($type,'enumeration')==0) {
            $_POST['activity_answer_type']=  'E';
          }else {
            $_POST['activity_answer_type']=  'I';
          }


          $_POST['activity_perfect_score']=$score*2;

          $model_activity->save($_POST);
          $model_master->save($_POST);

          if (!is_uploaded_file($_FILES['image']['tmp_name'])) {


            $file = $this->request->getFile('image');
            if ($file->isValid()&& !$file->hasMoved()) {
              $file->move('./uploads/images');
            }

            $filename = $file->getName();
            $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

            $builder1 = $db->table('activity_content');

            $builder1->where('activity_question',  $_POST['activity_question']);

            $content = $builder1->get()->getRow();
            $_POST['file_name']='NoFile';
            $_POST['activity_content_id']=$content->activity_content_id;
            $_POST['file_targetDirectory']='NoFile';
            $_POST['file_extension']='NoFile';


        }else {
          $file = $this->request->getFile('image');
          if ($file->isValid()&& !$file->hasMoved()) {
            $file->move('./uploads/images');
          }

          $filename = $file->getName();
          $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

          $builder1 = $db->table('activity_content');

          $builder1->where('activity_question',  $_POST['activity_question']);

          $content = $builder1->get()->getRow();

          $_POST['file_name']=$filename;
          $_POST['activity_content_id']=$content->activity_content_id;
          $_POST['file_targetDirectory']='./uploads/image';
          $_POST['file_extension']=$fileExt;
        }

        $model_actmedia->save($_POST);
        $builder2 = $db->table('activity_content');

        $builder2->where('activity_question',  $_POST['activity_question']);

        $content2 = $builder2->get()->getRow();

          $session = session();
          $session->setFlashdata('success','Question Added');



        return redirect()->to('teacher/identification/'.$id);



   }else{
     //if validation is not successfull
     //validator provies a list of errors
     $data['validation']=$this->validator;
   }
 }

}

//Delete Activity
public function delete_activity($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

   // $activity = new ActivityContent();
   // $activity->get()->getRow();

   $activity_content = new ActivityContent();
   $data['act']=$activity_content->where(['activity_content_id'=>$id])->get()->getRow();

    $activity_master = new ActivityMaster();
   $data['master']=$activity_master->where(['activity_id'=>$data['act']->activity_id])->get()->getRow();

    $model = new TeacherLesson();

    $score= $data['master']->activity_perfect_score;
    $score=$score-2;


    if ($activity_content) {
      $activity_content->delete($id);
    }

    $id2=$data['act']->activity_id;

    $save=[
      'activity_perfect_score' => $score,
    ];


     $db      = \Config\Database::connect();

     $builder = $db->table('activity_master');

     $builder->where('activity_id',  $id2);

    $activity = $builder->update($save);
    //$type=$data['master']->activity_type;

   $session = session();
   $session->setFlashdata('success','Activity Question Successfully Deleted ');


     if (strcmp($data['master']->activity_type,'multiple_choice')==0) {
         return redirect()->to('teacher/multiplechoice/'.$id2);
         }
}

public function delete_identificationactivity($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

   // $activity = new ActivityContent();
   // $activity->get()->getRow();

   $activity_content = new ActivityContent();
   $data['act']=$activity_content->where(['activity_content_id'=>$id])->get()->getRow();

    $activity_master = new ActivityMaster();
   $data['master']=$activity_master->where(['activity_id'=>$data['act']->activity_id])->get()->getRow();

   $score= $data['master']->activity_perfect_score;
   $score=$score-2;


    $model = new TeacherLesson();


    if ($activity_content) {
      $activity_content->delete($id);
    }

    $id2=$data['act']->activity_id;
    //$type=$data['master']->activity_type;

    $save=[
      'activity_perfect_score' => $score,
    ];


     $db      = \Config\Database::connect();

     $builder = $db->table('activity_master');

     $builder->where('activity_id',  $id2);

    $activity = $builder->update($save);

   $session = session();
   $session->setFlashdata('success','Activity Question Successfully Deleted ');


     if (strcmp($data['master']->activity_type,'identification')==0) {
         return redirect()->to('teacher/identification/'.$id2);
         }
}

public function delete_mainactivity($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }


   $activitymaster = new ActivityMaster;
   $model = new TeacherLesson();

   $data['activity']=$activitymaster->get()->getRow();
   $lesson_id=$data['activity']->lesson_id;

    $lesson_content = new LessonMaster();
    $data['lesson']=$lesson_content->where(['lesson_id'=>$lesson_id])->get()->getRow();

    if ($activitymaster) {
      $activitymaster->delete($id);
    }

   $session = session();
   $session->setFlashdata('updatesuccess','Activity Successfully Deleted ');
   return redirect()->to('teacher/viewactivity/'.$lesson_id);

}

//Update Activity
public function update_activity($id){

  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

 $db      = \Config\Database::connect();

   $activitymaster = new ActivityMaster;
   $data['activity']=$activitymaster->get()->getRow();
   $lesson_id=$data['activity']->lesson_id;

  $data=[
    'meta_title'=>'Admin | Update Module'
  ];
  //$teacher_id=session()->get('t_id');


  $userModel2 = new ActivityMaster();
  $data['activity'] = $userModel2->where(['activity_id'=>$id])->get()->getRow();

  $userModel2 = new LessonMaster();
  $data['lesson'] = $userModel2->where(['lesson_id'=>$data['activity']->lesson_id])->get()->getRow();

    $rules=[

      'activity_name'=>[
        'rules'=>'required',
        'label'=>'Activity Title',
      ],
      'activity_instruction'=>[
        'rules'=>'required',
        'label'=>'Activity Description',
      ],


    ];
    //
    helper(['form']);

    if ($this->request->getMethod()=='post') {

      $model_lesson = new ActivityMaster();

       if ($this->validate($rules)) {


        $activity_master = [
            'activity_name' => ucfirst($_POST['activity_name']),
            'activity_instruction' => ucfirst($_POST['activity_instruction']),
            //'activity_type'=> $_POST['activity_type'],
        ];

        $builder = $db->table('activity_master');

        $builder->where('activity_id', $id);

        $builder->update($activity_master);




      $session = session();
      $session->setFlashdata('updatesuccess','Module Upload Completed');
        return redirect()->to('teacher/viewactivity/'.$data['lesson']->lesson_id);
    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updateactivity', $data);
}

public function update_question($id){

  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

 $db      = \Config\Database::connect();

   $activitymaster = new ActivityMaster;
   $data['activity']=$activitymaster->get()->getRow();
   $lesson_id=$data['activity']->lesson_id;

  $data=[
    'meta_title'=>'Admin | Update Module'
  ];
  //$teacher_id=session()->get('t_id');


  $userModel2 = new ActivityContent();
  $data['activity'] = $userModel2->where(['activity_content_id'=>$id])->get()->getRow();

  $activitymaster = new ActivityMaster();
  $data['master'] = $activitymaster->where(['activity_id'=>$data['activity']->activity_id])->get()->getRow();

  $media = new MediaActivity();
  $data['medias'] = $media->where(['activity_content_id'=>$id])->get()->getRow();


  $choices = new Choices();
  $data['choices'] = $choices->where(['activity_content_id'=>$id])->findAll();

  $userModel1 = new LessonMaster();
  $data['lesson'] = $userModel1->where(['lesson_id'=>$lesson_id])->get()->getRow();

  // echo "<pre>";
  //   print_r($data['choices']);
  // echo "<pre>";

    $rules=[

      'activity_question'=>[
        'rules'=>'required',
        'label'=>'Activity Title',
      ],
      'image'=>[
        'rules'=> 'ext_in[image,png,jpg,gif,mp4,mp3]',
        'label'=>'Image',
      ],
    //   'activity_instruction'=>[
    //     'rules'=>'required',
    //     'label'=>'Activity Description',
    //   ],
    'choice'=>[
      'rules'=> 'required',
      'label'=>'Choice',
    ],

    ];

    helper(['form']);

    if ($this->request->getMethod()=='post') {



       if ($this->validate($rules)) {


        $activity_content = [
            'activity_question' => ucfirst($_POST['activity_question']),
            'activity_answer' => ucfirst($_POST['activity_answer']),
        ];

        $builder = $db->table('activity_content');

        $builder->where('activity_content_id', $id);

        $builder->update($activity_content);


        if (is_uploaded_file($_FILES['image']['tmp_name'])) {

          $file = $this->request->getFile('image');
          if ($file->isValid()&& !$file->hasMoved()) {
            $file->move('./uploads/images');
          }
        //  $filename = $file->getName();
          $filename = $file->getName();
          $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

          // $db = db_connect();
          // $getlessonid = new CustomModel($db);
          // $id=$getlessonid->getlessonid($id);

          $_POST['file_name']=$filename;
        //  $_POST['lesson_id']=$id;
          $_POST['file_targetDirectory']='./uploads/image';
          $_POST['file_extension']=$fileExt;

            $activity_media = [
               'file_name' => $filename,
               'file_extension' =>$fileExt,
             ];

             $builder_media = $db->table('media_activity');

             $builder_media->where('activity_content_id', $id);

             $builder_media->update($activity_media);
      }

      $id_array = array();

      $choices = array($_POST['choice']);

     $choicestable = $data['choices'];

     foreach ($data['choices'] as $id) {
        array_push($id_array,$id['choices_id']);
     }


   //
   // echo "<pre>";
   //   print_r($id_array);
   // echo "<pre>";

      foreach ($choices as $choice) {
          $choice_e=$choice;

          $f=count($choice_e);
          for($i=0;$i<$f;$i++)
          {
            $arre=[
              'choice'=>ucfirst($choice_e[$i]),

              ];


          $builder_media = $db->table('choices');

          $builder_media->where('choices_id', $id_array[$i]);

          $builder_media->update($arre);

       }
     }
      $session = session();
      $session->setFlashdata('updatesuccess','Module Upload Completed');


      if (strcmp($data['master']->activity_type,'multiple_choice')==0) {
       return redirect()->to('teacher/multiplechoice/'.$data['activity']->activity_id);

      }

    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updatequestion', $data);
}

public function update_identification($id){

  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }

 $db      = \Config\Database::connect();

   $activitymaster = new ActivityMaster;
   $data['activity']=$activitymaster->get()->getRow();
   $lesson_id=$data['activity']->lesson_id;

  $data=[
    'meta_title'=>'Admin | Update Module'
  ];
  //$teacher_id=session()->get('t_id');


  $userModel2 = new ActivityContent();
  $data['activity'] = $userModel2->where(['activity_content_id'=>$id])->get()->getRow();

  $activitymaster = new ActivityMaster();
  $data['master'] = $activitymaster->where(['activity_id'=>$data['activity']->activity_id])->get()->getRow();

  $media = new MediaActivity();
  $data['medias'] = $media->where(['activity_content_id'=>$id])->get()->getRow();


  $choices = new Choices();
  $data['choices'] = $choices->where(['activity_content_id'=>$id])->findAll();

  $userModel1 = new LessonMaster();
  $data['lesson'] = $userModel1->where(['lesson_id'=>$lesson_id])->get()->getRow();

  // echo "<pre>";
  //   print_r($data['choices']);
  // echo "<pre>";

    $rules=[
      //
      'activity_question'=>[
        'rules'=>'required',
        'label'=>'Activity Title',
      ],
      'image'=>[
        'rules'=> 'ext_in[image,png,jpg,gif,mp4,mp3]',
        'label'=>'Image',
      ],

    'activity_answer'=>[
      'rules'=> 'required',
      'label'=>'Choice',
    ],

    ];

    helper(['form']);

    if ($this->request->getMethod()=='post') {



       if ($this->validate($rules)) {


        $activity_update = [
            'activity_question' => ucfirst($_POST['activity_question']),
            'activity_answer' => ucfirst($_POST['activity_answer']),
        ];

        $builder = $db->table('activity_content');

        $builder->where('activity_content_id', $id);

        $builder->update($activity_update);


        if (is_uploaded_file($_FILES['image']['tmp_name'])) {

          $file = $this->request->getFile('image');
          if ($file->isValid()&& !$file->hasMoved()) {
            $file->move('./uploads/images');
          }
        //  $filename = $file->getName();
          $filename = $file->getName();
          $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

          // $db = db_connect();
          // $getlessonid = new CustomModel($db);
          // $id=$getlessonid->getlessonid($id);

          $_POST['file_name']=$filename;
        //  $_POST['lesson_id']=$id;
          $_POST['file_targetDirectory']='./uploads/image';
          $_POST['file_extension']=$fileExt;

            $activity_media = [
               'file_name' => $filename,
               'file_extension' =>$fileExt,
             ];

             $builder_media = $db->table('media_activity');

             $builder_media->where('activity_content_id', $id);

             $builder_media->update($activity_media);
      }


   //
   // echo "<pre>";
   //   print_r($id_array);
   // echo "<pre>";

      $session = session();
      $session->setFlashdata('updatesuccess','Module Upload Completed');

      return redirect()->to('teacher/identification/'.$data['activity']->activity_id);

    }else{
      //if validation is not successfull
      //validator provies a list of errors
      $data['validation']=$this->validator;
    }
  }


  return view('teacher_updateidentification', $data);
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
public function viewpupil_section(){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | View Pupil',

  ];

  $section_name = new Section();
  $data['section'] = $section_name->where(['section_id'=>session()->get('section_id')])->get()->getRow();

  $userModel = new PupilModel();
  $data['users'] = $userModel->join('section', 'pupil.section_id = section.section_id')->orderBy('pupil_id', 'DESC')->findAll();


  // $url1 = base_url(); // Site URL
  // $url2 = $this->uri->segment(1); // Controller - instrument
  // $url3 = $this->uri->segment(2); // Method - instrument
  // $url4 = $this->uri->segment(3); // detail
  // $url5 = $this->uri->segment(4);
//  echo $string;

  return view('teacher_pupilactivity', $data);
}

public function view_overallperformance($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Admin | View Module',
    'section_id'=>$id,
  ];

    $total=0;
    $range=0;
    $new_pupil = new PerformanceRecords();
    $data['pupil']=$new_pupil->where(['pupil_id'=>$id])->findAll();

    $pupilmodel = new PupilModel();
    $data['pupilmodel']=$pupilmodel->where(['pupil_id'=>$id])->get()->getRow();

    // $records = new ActivityMaster();
    // $data['users']=$records->join('lesson_master','activity_master.lesson_id = lesson_master.lesson_id')
    //                        ->join('teacher_lesson', 'lesson_master.lesson_id = teacher_lesson.lesson_id')
    //                        ->join('teacher', 'teacher_lesson.teacher_id = teacher.teacher_id')
    //                        ->join('section', 'teacher.section_id = section.section_id')
    //                        ->where(['section.section_id'=>session()->get('section')])
    //                        ->findAll();

  return view('teacher_viewoverallperformance', $data);
}

public function viewperformance_module($id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | View Module',
    'section_id'=>$id,
  ];

  $userModel = new TeacherModel();
  $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
  $data['teacher']=$userModel->where(['teacher_id'=>session()->get('t_id')])->get()->getRow();


  $pupilmodel = new PupilModel();
  $data['pupil']=$pupilmodel->where(['pupil_id'=>$id])->get()->getRow();
  // //
  //     echo "<pre>";
  //   print_r($pupil_id);
  // echo "<pre>";


  return view('teacher_moduleperformance', $data);

}

public function teacher_activityperformance($id,$pupil_id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | View Module',
    'section_id'=>$id,
  ];

  $userModel = new TeacherRegistration();
  $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')
                            ->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')
                            ->join('activity_master','lesson_master.lesson_id = activity_master.lesson_id')
                            ->join('section','teacher.section_id = section.section_id')
                            ->orderBy('teacher.teacher_id', 'ASC')
                            ->where(['activity_master.lesson_id'=>$id])
                            ->findAll();

  $activity_id = new ActivityMaster();
  $data['join'] = $activity_id->join('performance_records','performance_records.activity_id = activity_master.activity_id')
                              ->join('pupil','pupil.pupil_id = performance_records.pupil_id')
                              ->where(['activity_master.lesson_id'=>$id]) ->where(['pupil.pupil_id'=>$pupil_id])->orderBy('activity_master.activity_id', 'ASC')->findAll();
  // $data['teacher']=$userModel->where(['section_id'=>$id])->get()->getRow();
  //
  // //
  //     echo "<pre>";
  //   print_r($data['join']);
  // echo "<pre>";
  // //
  //
  // $activity_id = new ActivityMaster();
  // $data['users'] = $activity_id->where(['lesson_id'=>$id])->findAll();
  $pupilmodel = new PupilModel();
  $data['pupil']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();

  $userModel = new LessonMaster();
  $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

return view('teacher_viewactivity2', $data);

}

public function viewperformance($id,$pupil_id){
  $type = session()->get('usertype');
   if ($type!='Teacher' && $type=='Admin'){
      return redirect()->to('admin/home');
    //  echo "hello";
   }else if ($type!='Teacher' && $type=='Pupil') {
     return redirect()->to('pupil/home');
   }
  $data=[
    'meta_title'=>'Teacher | View Performance ',
    'act_id'=>$id,
    'pupil_id'=>$pupil_id,
  ];

  $activity_id = new ActivityMaster();
  $data['id'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();
  $records = new PerformanceRecords();
  // $userModel = new TeacherRegistration();
  $data['users']=$records->join('activity_master','activity_master.activity_id = performance_records.activity_id')->join('pupil', 'pupil.pupil_id = performance_records.pupil_id')->where(['performance_records.activity_id'=>$id])->findAll();
  // echo "<pre>";
  //   print_r($data['id']);
  // echo "<pre";


  $pupilmodel = new PupilModel();
  $data['pupilmodel']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();

return view('teacher_viewperformance', $data);
}




}
