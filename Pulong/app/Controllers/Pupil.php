<?php

namespace App\Controllers;

use App\Models\PupilModel;

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
}
