<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Do something here
        if (! session()->get('isLoggedIn')) {
        return  redirect()->to('homepage');
      }//else if (session()->get('usertype')=='Pupil') {
      //         return redirect()->to('admindashboard');
      // }else if (session()->get('usertype')=='Teacher') {
      //         return redirect()->to('dashboard');
      // }
        // if (! session()->get('isLoggedIn')) {
        //   if (session()->get('usertype')=='Pupil') {
        //     return redirect()->to('admindashboard');
        //   }else if (session()->get('usertype')=='Teacher') {
        //     return redirect()->to('dashboard');
        //   }
        // }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
