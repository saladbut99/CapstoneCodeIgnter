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
    $data=[
      'meta_title'=>'Pupil | Home'
    ];

    $pupil_id=session()->get('t_id');
    $new = new PupilModel();
    $data['users'] = $new->where('pupil_id',$pupil_id)->get()->getRow();
    // echo "<pre>";
    //   print_r($data['users']);
    // echo "<pre";
      return view('pupil_home', $data);


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

          if (strcmp($user['account_status'],'Inactive')==0) {
            $data['status']='Account Inactive';
          }else {
            //get the value of the user type from the form after pass it to the array
            $type=$this->request->getVar('usertype');
            //this array bellow ang gamiton if naay user type
            $this->setUserSession($user,$type);
        //   $this->setUserSession($user);
            return redirect()->to('pupil/home');
          }

          // ];
          // $model->save($newData);
          // $session = session();
          // $session->setFlashdata('success','Successful Registration');
            //return redirect()->to('dashboard');

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
     'section'=> $user['section_id'],
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
      // echo "<pre";


    return view('pupil_view', $data);
    }

    public function viewmoduleactivity()
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
      $data['join'] = $section_id->join('performance_records','performance_records.pupil_id = pupil.pupil_id')
                                  ->join('activity_master','performance_records.activity_id = activity_master.activity_id')
                                  ->join('lesson_master','activity_master.lesson_id = lesson_master.lesson_id')
                                  // ->join('teacher_lesson', 'lesson_master.lesson_id = teacher_lesson.lesson_id')
                                  ->join('section','pupil.section_id = section.section_id')
                                  ->where(['pupil.pupil_id'=>$pupil_id])
                                //  ->join('pupil','pupil.pupil_id = performance_records.pupil_id')
                                  ->findAll();

      return view('pupil_actview', $data);
    }

    public function viewactivitytable($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
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
      $data['users'] = $activity_id->where(['lesson_id'=>$id])->where(['status'=>'Published'])->orderBy('activity_id', 'ASC')->findAll();
      $data['join'] = $activity_id->join('performance_records','performance_records.activity_id = activity_master.activity_id')
                                  ->join('pupil','pupil.pupil_id = performance_records.pupil_id')
                                  ->where(['activity_master.lesson_id'=>$id])->where(['pupil.pupil_id'=>session()->get('t_id')])->findAll();

      $userModel = new LessonMaster();
      $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

      // echo "<pre>";
      //   print_r($data['join']);
      // echo "<pre";



       return view('pupil_viewactivitytable', $data);
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

    public function viewactivity($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Teacher | Add Activity '
      ];

      $db      = \Config\Database::connect();



      $activity_id = new ActivityMaster();
      $data['users'] = $activity_id->where(['lesson_id'=>$id])->where(['status'=>'Published'])->orderBy('activity_id', 'ASC')->findAll();
      $data['join'] = $activity_id->join('performance_records','performance_records.activity_id = activity_master.activity_id')->join('pupil','pupil.pupil_id = performance_records.pupil_id')->where(['activity_master.lesson_id'=>$id])->orderBy('activity_master.activity_id', 'ASC')->findAll();

      $userModel = new LessonMaster();
      $data['lesson'] = $userModel->where(['lesson_id'=>$id])->get()->getRow();

      // echo "<pre>";
      //   print_r($data['join']);
      // echo "<pre";


     return view('pupil_viewactivity', $data);

    }

    public function multiplechoice($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }

      $data=[
        'meta_title'=>'Teacher | Manage ',

      ];

      $activity_id = new ActivityMaster();
      $data['users'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();

      $activity_id = new ActivityContent();
      $data['question'] = $activity_id->where(['activity_id'=>$id])->orderBy('activity_content_id', 'RANDOM')->findAll();


      $choices = new Choices();
      $data['choice'] = $choices->orderBy('choices_id', 'RANDOM')->findAll();

      $medias = new MediaActivity();
      $data['media'] = $medias->findAll();

       return view('pupil_multiplechoice', $data);

    }

    public function activitytype_checker($actid){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
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
        return redirect()->to('pupil/multiplechoice/'. $actid);
      }elseif (strcmp($act_type,'enumeration')==0) {
         return redirect()->to('pupil/enumeration/'. $actid);
      }else {
       return redirect()->to('pupil/identification/'. $actid);
      }
    }

    public function identification($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Pupil | Activity '
      ];

      $activity_id = new ActivityMaster();
      $data['users'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();

      $activity_id = new ActivityContent();
      $data['question'] = $activity_id->where(['activity_id'=>$id])->orderBy('activity_content_id', 'RANDOM')->findAll();


      $choices = new Choices();
      $data['choice'] = $choices->findAll();

      $medias = new MediaActivity();
      $data['media'] = $medias->findAll();

       return view('pupil_identification', $data);

    }

    public function check($actid){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Teacher | Activity '
      ];
      //

      $score=0;


      $choices = new Choices();
      $data['choice'] = $choices->findAll();

      $ind=0;

      $retakes=1;
       foreach ($_POST as $key) {
         // print_r($key['activity_content_id']);
         $activity_id = new ActivityContent();
         $data['question'] = $activity_id->where(['activity_content_id'=>$key['activity_content_id']])->get()->getRow();

         if (strcmp(strtoupper($key['answer']),strtoupper($data['question']->activity_answer))==0) {
            $score+=2;
         }
       }

       $activity_id = new ActivityMaster();
       $data['master'] = $activity_id->where(['activity_id'=>$actid])->get()->getRow();
       $percent_score=$score/$data['master']->activity_perfect_score*100;

       date_default_timezone_set('Asia/Manila');
        $myTime=date('Y-m-d h:i:s');

      $id = new PerformanceRecords();
      $data['list'] = $id->where(['activity_id'=>$actid])->findAll();

      foreach ($data['list'] as $key) {
          $retakes+=1;
      }

      $newData=[
        'pupil_id' => session()->get('t_id'),
        'activity_score'=>$score,
        'performed_activity_date'=>$myTime,
        'activity_id'=>$actid,
        'activity_retakes'=>$retakes,
        'percentage_score'=>$percent_score,
        'perfect_score'=>$data['master']->activity_perfect_score,
      ];


      $answers = new Answers();

      $PerformanceRecords = new PerformanceRecords();
      $PerformanceRecords->save($newData);
      $performance_id = $PerformanceRecords->getInsertID();
      //

      $data['record'] = $id->where(['performance_id'=>$performance_id])->get()->getRow();

      foreach ($_POST as $answer) {
            $arre=[
              'activity_answer'=>$answer['answer'],
              'performance_id'=>$performance_id,
              'activity_content_id'=>$answer['activity_content_id'],
            ];
            $answers->save($arre);
      }

      // $act_retake = $data['record']->activity_retakes;
      // $act_retake2=$act_retake+1;
      // // $retake_data=[
      // //   'activity_retakes'=>$actid+=1,
      // // ];
      //
      // echo "<pre>";
      //   print_r($retakes);
      // echo "<pre";
      // //
      //
      //  $db      = \Config\Database::connect();
      //
      //  $builder = $db->table('performance_records');
      //  $builder->set('activity_retakes', 'activity_retakes + 1');
      //  $builder->where('performance_id',  $performance_id);
      //  $builder->update();

    //  $data['results']=$_POST;





      $data['results']=$_POST;

      $activity_id = new ActivityMaster();
      $data['users'] = $activity_id->where(['activity_id'=>$actid])->get()->getRow();

      $performance = new PerformanceRecords();
      $data['performance'] = $performance->where(['performance_id'=>$performance_id])->get()->getRow();

      $activity_id = new ActivityContent();
      $data['question'] = $activity_id->where(['activity_id'=>$actid])->findAll();


      $choices = new Choices();
      $data['choice'] = $choices->findAll();

      $medias = new MediaActivity();
      $data['media'] = $medias->findAll();

      return view('pupil_multiplechoiceresults', $data);

    }

    public function check_identification($actid){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Teacher | Activity '
      ];
      //
      $retakes=1;
      $score=0;




      $choices = new Choices();
      $data['choice'] = $choices->findAll();

      $ind=0;


       foreach ($_POST as $key) {
         // print_r($key['activity_content_id']);
         $activity_id = new ActivityContent();
         $data['question'] = $activity_id->where(['activity_content_id'=>$key['activity_content_id']])->get()->getRow();

         if (strcmp(strtoupper(trim($key['answer'])),strtoupper(trim($data['question']->activity_answer)))==0) {
            $score+=2;
         }
       }

       $activity_id = new ActivityMaster();
       $data['master'] = $activity_id->where(['activity_id'=>$actid])->get()->getRow();
       $percent_score=$score/$data['master']->activity_perfect_score*100;

       date_default_timezone_set('Asia/Manila');
        $myTime=date('Y-m-d h:i:s');

        $id = new PerformanceRecords();
        $data['list'] = $id->where(['activity_id'=>$actid])->findAll();

        foreach ($data['list'] as $key) {
            if (!$key['pupil_id']==session()->get('t_id')) {
                $retakes=1;
            }else {
              $retakes+=1;
            }
        }


      $newData=[
        'pupil_id' => session()->get('t_id'),
        'activity_score'=>$score,
        'performed_activity_date'=>$myTime,
        'activity_id'=>$actid,
        'activity_retakes'=>$retakes,
        'percentage_score'=>$percent_score,
        'perfect_score'=>$data['master']->activity_perfect_score,
      ];

      $answers = new Answers();

      $PerformanceRecords = new PerformanceRecords();
      $PerformanceRecords->save($newData);
      $performance_id = $PerformanceRecords->getInsertID();

      foreach ($_POST as $answer) {
            $arre=[
              'activity_answer'=>$answer['answer'],
              'performance_id'=>$performance_id,
              'activity_content_id'=>$answer['activity_content_id'],
            ];
            $answers->save($arre);
      }


      $data['results']=$_POST;

      $activity_id = new ActivityMaster();
      $data['users'] = $activity_id->where(['activity_id'=>$actid])->get()->getRow();

      $performance = new PerformanceRecords();
      $data['performance'] = $performance->where(['performance_id'=>$performance_id])->get()->getRow();

      $activity_id = new ActivityContent();
      $data['question'] = $activity_id->where(['activity_id'=>$actid])->findAll();


      $choices = new Choices();
      $data['choice'] = $choices->findAll();

      $medias = new MediaActivity();
      $data['media'] = $medias->findAll();

      // echo "<pre>";
      //   print_r($data['results']);
      // echo "<pre";

      // $id = new PerformanceRecords();
      // $data['record'] = $id->where(['performance_id'=>$performance_id])->get()->getRow();
      //
      //
      //
      // $act_retake = $data['record']->activity_retakes;
      // $act_retake+=1;
      // // $retake_data=[
      // //   'activity_retakes'=>$actid+=1,
      // // ];
      //
      //
      //  $db      = \Config\Database::connect();
      //
      //  $builder = $db->table('performance_records');
      //  $builder->set('activity_retakes', $act_retake);
      //  $builder->where('performance_id',  $performance_id);
      //  $builder->update();
     return view('pupil_identificationresults', $data);
    }
    public function viewperformance($id){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Pupil | View Performance ',
        'act_id'=>$id,
      ];

      $activity_id = new ActivityMaster();
      $data['id'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();
      $records = new PerformanceRecords();
      // $userModel = new TeacherRegistration();
      $data['users']=$records->join('activity_master','activity_master.activity_id = performance_records.activity_id')->join('pupil', 'pupil.pupil_id = performance_records.pupil_id')->where(['performance_records.activity_id'=>$id])->findAll();
      // echo "<pre>";
      //   print_r($data['id']);
      // echo "<pre";



    return view('pupil_viewperformance', $data);
    }

    public function viewoverallperformance(){
      $type = session()->get('usertype');
       if ($type!='Pupil' && $type=='Admin'){
          return redirect()->to('admin/home');
          //echo "hello";
       }else if ($type!='Pupil' && $type=='Teacher') {
         return redirect()->to('teacher/home');
       }
      $data=[
        'meta_title'=>'Pupil | View Performance ',
        //'act_id'=>$id,
      ];

      $total=0;
      $range=0;
      $new_pupil = new PerformanceRecords();
      $data['pupil']=$new_pupil->where(['pupil_id'=>session()->get('t_id')])->findAll();

      // $activity_id = new ActivityMaster();
      // $data['id'] = $activity_id->where(['activity_id'=>$id])->get()->getRow();
      // $records = new PerformanceRecords();
      // // $userModel = new TeacherRegistration();
      // $data['users']=$records->join('activity_master','activity_master.activity_id = performance_records.activity_id')->join('pupil', 'pupil.pupil_id = performance_records.pupil_id')->where(['performance_records.activity_id'=>$id])->findAll();
      //$total=$total+$data['pupil']->activity_score;
      // foreach ($data['pupil'] as $key ) {
      //   $total=$total+$key['activity_score'];
      //   $range=$range+$key['perfect_score'];
      // }
      $records = new ActivityMaster();
      // $userModel = new TeacherRegistration();
      $data['users']=$records->join('lesson_master','activity_master.lesson_id = lesson_master.lesson_id')
                             ->join('teacher_lesson', 'lesson_master.lesson_id = teacher_lesson.lesson_id')
                             ->join('teacher', 'teacher_lesson.teacher_id = teacher.teacher_id')
                             ->join('section', 'teacher.section_id = section.section_id')
                             ->where(['section.section_id'=>session()->get('section')])
                             ->findAll();
      // echo "<pre>";

    //  $total_percent=$total/$range;




    return view('pupil_viewoverallperformance', $data);
    }
}
