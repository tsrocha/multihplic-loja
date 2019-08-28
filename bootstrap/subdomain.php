<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 28/08/19
 * Time: 18:06
 */

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

##
# GET COMPANIE
##
$subdomain = explode('.', $_SERVER['HTTP_HOST'])[0];

##
# GET ENVIRONMENT
##
$cloudFolder = 'cloud_system/' . $subdomain;
$envFolder = 'app/environment/' . $subdomain;

#Check Companie Exists
if(is_dir(storage_path($envFolder))){
    #set env
    Dotenv::load(storage_path($envFolder));
}else{
    $local = Storage::disk('local');
    $s3 = Storage::disk('s3');

    if($s3->exists($cloudFolder . '/.env')){
        #read .env cloud
        $envFile = $s3->get($cloudFolder . '/.env');

        #download .env from cloud
        $local->put(str_replace('app/', '', $envFolder) . '/.env', $envFile);

        #set env
        Dotenv::load(storage_path($envFolder));
    }else{
        echo 'Companhia Inexistente!';exit;
    }
}
