<?php
function getTotalPages($request, $key){
    if(!$request->session()->get($key))
        return 2;

    return $request->session()->get($key);
}

function setTotalPages($request,$key,$total){
    $request->session()->put($key,$total);
}
