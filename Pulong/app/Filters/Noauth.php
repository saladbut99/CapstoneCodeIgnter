<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Do something here
        // if (session()->get('isLoggedIn')) {
        // return  redirect()->to('dashboard');
        // }
        if (session()->get('isLoggedIn')) {
          if (session()->get('usertype')=='Pupil') {
            return redirect()->to('pupil/home');
          }else if (session()->get('usertype')=='Teacher') {
            return redirect()->to('teacher/home');
          }else if (session()->get('usertype')=='Admin') {
            return redirect()->to('admin/home');
          }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
