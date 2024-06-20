<?php

namespace App\Http\Controllers\Front\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function show(Page $page,$slug)
    {

      

       return view('front.page.single',compact('page'));

    }
}
