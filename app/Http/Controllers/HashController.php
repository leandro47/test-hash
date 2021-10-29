<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HashController extends Controller
{
    public function store(Request $request)
    {
        for ($i = 0; $i < 500000; $i++) {
            $key = uniqid();
            $hash =  md5($request->input('text') . $key);

            if (\substr($hash, 0, 4) === '0000') {
                return $hash;
            }
        }
    }
}
