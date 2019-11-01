<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Enveropment;

class HomeController extends Controller
{

    public $theme;
    public $subdomain;

    public function __construct()
    {
        $this->theme = 'eletronic';
        $this->subdomain = Enveropment::sessionDomain();
    }

    public function index()
    {

        $data['title'] = 'Loja Multihplic';
        return View::make($this->theme.'.home', $data);
    }

}
