<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public $theme;

    public function __construct()
    {
        $this->theme = 'eletronic';
    }

    public function index()
    {

        $data['title'] = 'Loja Multihplic';
        return View::make($this->theme.'.home', $data);
    }

}
