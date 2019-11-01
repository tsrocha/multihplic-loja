<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Enveropment extends Model
{

    public $dir, $folder;

    public static function sessionDomain() {
        $subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
        if(!Session::has('subdomain')) {

            $envFolder = 'shop/' . $subdomain;
            $s3 = Storage::disk('s3');
            if ($s3->exists($envFolder)) {
                Session::put('subdomain', $subdomain);
                return $subdomain;
            } else {
                Session::remove('subdomain');
                echo 'Loja inexistente';
                exit;
            }
        } else {
            if(Session::get('subdomain') != $subdomain) {
                $envFolder = 'shop/' . $subdomain;
                $s3 = Storage::disk('s3');
                if ($s3->exists($envFolder)) {
                    Session::put('subdomain', $subdomain);
                    return $subdomain;
                } else {
                    Session::remove('subdomain');
                    echo 'Loja inexistente';
                    exit;
                }
            } else {
                return Session::get('subdomain');
            }
        }

    }

}
