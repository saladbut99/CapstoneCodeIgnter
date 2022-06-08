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
use App\Models\ActivityMaster;
use App\Models\ActivityContent;
use App\Models\MediaActivity;
use App\Models\Choices;
use App\Models\PerformanceRecords;
use App\Models\Answers;
use App\Models\PupilModel;
use App\Models\PupilModelStatus;
use App\Models\Section;

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
            $section_id=$_POST['section_id'];

            $data['teacher']=$model->where(['section_id'=>$section_id])->get()->getRow();

            if (empty($data['teacher'])) {
              $_POST['account_status']='Active';
              $model->save($_POST);
              $session = session();
              $session->setFlashdata('success','Teacher Registration Successful ');
               return redirect()->to('admin/register');
            }else {
                $data['status']='Account Inactive';
            }

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
      $data['teacher']=$userModel->findAll();
      // echo "<pre>";
      // print_r($data['users']);
      // echo "<pre>";

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


  public function viewactivity($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
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


     return view('admin_viewactivity', $data);
  }

  public function activitytype_checker($actid){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
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
      return redirect()->to('admin/multiplechoice/'. $actid);
    }elseif (strcmp($act_type,'enumeration')==0) {
       return redirect()->to('teacher/enumeration/'. $actid);
    }else {
     return redirect()->to('admin/identification/'. $actid);
    }
  }

  public function multiplechoice($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
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

     return view('admin_multiplechoice', $data);

  }

  public function enumeration($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Teacher | Manage '
    ];

     return view('teacher_enumeration', $data);

  }

  public function identification($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
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

     return view('admin_identification', $data);

  }
  public function viewpupil_section($string){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | Account Status',
      'section_name'=>$string,
    ];
    $userModel = new PupilModel();
    $data['users'] = $userModel->join('section', 'pupil.section_id = section.section_id')->orderBy('pupil_id', 'DESC')->findAll();


    // $url1 = base_url(); // Site URL
    // $url2 = $this->uri->segment(1); // Controller - instrument
    // $url3 = $this->uri->segment(2); // Method - instrument
    // $url4 = $this->uri->segment(3); // detail
    // $url5 = $this->uri->segment(4);
  //  echo $string;
  if (strcmp(strtoupper($string),strtoupper('Rose'))==0) {
     return view('admin_viewperformancerose', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Rosal'))==0) {
    return view('admin_viewperformancerosal', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Adelfa'))==0) {
    return view('admin_viewperformanceadelfa', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Lily'))==0) {
    return view('admin_viewperformancelily', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Gumamela'))==0) {
    return view('admin_viewperformancegumamela', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Orchid'))==0) {
    return view('admin_viewperformanceorchid', $data);
  }elseif (strcmp(strtoupper($string),strtoupper('Daisy'))==0) {
    return view('admin_viewperformancedaisy', $data);
  }

  }

  public function viewperformance_section(){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | Section'
    ];
    return view('admin_viewsectionperformance', $data);

  }

  public function viewperformance_module($id,$pupil_id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | View Module',
      'section_id'=>$id,
    ];

    $userModel = new TeacherRegistration();
    $data['users']=$userModel->join('teacher_lesson', 'teacher.teacher_id = teacher_lesson.teacher_id')->join('lesson_master','teacher_lesson.lesson_id = lesson_master.lesson_id')->join('section','teacher.section_id = section.section_id')->orderBy('teacher.teacher_id', 'ASC')->findAll();
    $data['teacher']=$userModel->where(['section_id'=>$id])->get()->getRow();


    $pupilmodel = new PupilModel();
    $data['pupil']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();
    // //
    //     echo "<pre>";
    //   print_r($pupil_id);
    // echo "<pre>";


    return view('admin_moduleperformance', $data);

  }

  public function admin_activityperformance($id,$pupil_id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | View Module',
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
    //   print_r($pupil_id);
    // echo "<pre>";
    // //
    //
    // $activity_id = new ActivityMaster();
    // $data['users'] = $activity_id->where(['lesson_id'=>$id])->findAll();
    $pupilmodel = new PupilModel();
    $data['pupil']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();

    $userModel = new LessonMaster();
    $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

    return view('admin_viewactivity2', $data);

  }

  public function view_overallperformance($id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
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

    return view('admin_viewoverallperformance', $data);
  }

  public function view_overallmoduleperformance($activity_id,$pupil_id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Admin | View Module',
      'activity_id'=>$activity_id,
    ];

      // $total=0;
      // $range=0;
      $new_pupil = new PerformanceRecords();
      $data['pupil']=$new_pupil->join('activity_master','activity_master.activity_id = performance_records.activity_id')
                                ->join('lesson_master','lesson_master.lesson_id = activity_master.lesson_id')
                                ->where(['pupil_id'=>$pupil_id])->findAll();


      $pupilmodel = new PupilModel();
      $data['pupilmodel']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();

      // echo "<pre>";
      // print_r($data['pupil']);
      // echo "<pre>";

      // $records = new ActivityMaster();
      // $data['users']=$records->join('lesson_master','activity_master.lesson_id = lesson_master.lesson_id')
      //                        ->join('teacher_lesson', 'lesson_master.lesson_id = teacher_lesson.lesson_id')
      //                        ->join('teacher', 'teacher_lesson.teacher_id = teacher.teacher_id')
      //                        ->join('section', 'teacher.section_id = section.section_id')
      //                        ->where(['section.section_id'=>session()->get('section')])
      //                        ->findAll();


      //                        ->join('teacher_lesson', 'lesson_master.lesson_id = teacher_lesson.lesson_id')
      //                        ->join('teacher', 'teacher_lesson.teacher_id = teacher.teacher_id')
      //                        ->join('section', 'teacher.section_id = section.section_id')

    return view('admin_viewmoduleoverallperformance', $data);
  }
  public function viewperformance($id,$pupil_id){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Pupil | View Performance ',
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

  return view('admin_viewperformance', $data);
  }

  public function viewsectionperformance($string){
    $type = session()->get('usertype');
     if ($type!='Admin' && $type=='Teacher'){
        return redirect()->to('teacher/home');
      //  echo "hello";
    }else if ($type!='Admin' && $type=='Pupil') {
       return redirect()->to('pupil/home');
     }
    $data=[
      'meta_title'=>'Pupil | View Performance ',
    ];

    $sec_name=ucfirst($string);
  //  echo $sec_name;
    $activity_id = new Section();
    $data['id'] = $activity_id->where(['section_name'=>$sec_name])->get()->getRow();
  //   $records = new PerformanceRecords();
  //   // $userModel = new TeacherRegistration();
  //   $data['users']=$records->join('activity_master','activity_master.activity_id = performance_records.activity_id')->join('pupil', 'pupil.pupil_id = performance_records.pupil_id')->where(['performance_records.activity_id'=>$id])->findAll();

  //
  //
  //   $pupilmodel = new PupilModel();
  //   $data['pupilmodel']=$pupilmodel->where(['pupil_id'=>$pupil_id])->get()->getRow();
    // $new_pupil = new PerformanceRecords();
    // $data['pupil']=$new_pupil->join('activity_master','activity_master.activity_id = performance_records.activity_id')
    //                           ->join('lesson_master','lesson_master.lesson_id = activity_master.lesson_id')
    //                           ->join('teacher_lesson','teacher_lesson.lesson_id = lesson_master.lesson_id')
    //                           ->join('teacher','teacher.teacher_id = teacher_lesson.teacher_id')
    //                           ->join('section','section.section_id = teacher.section_id')
    //                           ->join('pupil','pupil.section_id = teacher.section_id')
    //                           ->where(['section.section_name'=>$sec_name])->findAll();
    $new_pupil = new PupilModel();
    $data['pupil']=$new_pupil->join('performance_records','performance_records.pupil_id = pupil.pupil_id')
                              ->join('section','section.section_id = pupil.section_id')
                              ->where(['section.section_name'=>$sec_name])->findAll();
   return view('admin_viewoverallsectionperformance', $data);
  // echo "<pre>";
  //   print_r($data['pupil']);
  // echo "<pre";
  }




}
