<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ComponentTestController extends Controller
{
    //
    public function showComponent1()
    {
      $massage = 'メッセージ';
      return view('tests.component-test1',compact('massage'));
    }

    public function showComponent2()
    {
      return view('tests.component-test2');
    }
}
