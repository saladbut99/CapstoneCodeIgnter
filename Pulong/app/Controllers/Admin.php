<?php

namespace App\Controllers;



class Admin extends BaseController
{
    public function index()
    {
      $title=[
        'meta_title'=>'Admin| Home'
      ];

        return view('admin_home', $title);
    }

    public function register(){
      $title=[
        'meta_title'=>'Admin| Register'
      ];
      return view('admin_registeraccount', $title);
    }

    public function viewlesson(){
      $title=[
        'meta_title'=>'Admin| View Lesson'
      ];
      return view('admin_view', $title);
    }


}
