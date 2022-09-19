<?php

namespace App\Controllers;

class Site extends BaseController
{
    public function home()
    {
        $session = session();
        $this->cachePage(1);



        return view('templates/header')
            . view('neoness/index')
            . view('templates/footer');
    }
}