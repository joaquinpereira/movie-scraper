<?php

use Illuminate\Support\Facades\App;

function getTotalPages($request, $key){
    if(!$request->session()->get($key))
        return 2;

    return $request->session()->get($key);
}

function setTotalPages($request,$key,$total){
    $request->session()->put($key,$total);
}

function dateFormat()
{
    if(\Illuminate\Support\Facades\App::getLocale() == "es"){
        return 'd MMMM, Y';
    }else{
        return 'MMMM d, Y';
    }
}
