<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Generated from CLI using this command:
//php artisan make:controller PagesController
class PagesController extends Controller
{
    public function index(){
        //return 'From INDEX';
        //Definition is defined in resources/pages/index.blade.php
        $title = "Welcome to Laravel!!!";
        
        //One way to pass in a value to view.
        //In order to use compact(), just submit the variable name without $
        //return view('pages.index', compact('title'));
        
        return view('pages.index')->with('title', $title);
    }
    public function about(){
        //Definition is defined in resources/pages/about.blade.php
        $title = "About";
        return view('pages.about')->with('title', $title);
    }
    public function services(){
        //Definition is defined in resources/pages/index.blade.php
        $data = array(
            'title'    => "Services",
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        
        return view('pages.services')->with($data);
    }
}