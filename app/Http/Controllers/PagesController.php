<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',  ['only' => ['show', 'index']]);
    }
    public function index(){

        $title = 'Welkom Dominique!';
        return view ('pages.index')->with('title',$title);
    }
    public function about(){
        $title = 'Welkom op de about pagina';
        return view ('pages.about')->with('title',$title);
    }
    public function services(){

        $data = array(
             'title' =>'Services!',
             'services' =>['Web Design',' Programming', 'SEO']
        );
        return view ('pages.services')->with($data);
    }
    public function portfolio(){
        $title = 'Welkom op de Portfolio pagina';
        return view ('pages.portfolio')->with('title',$title);
    }
    
}
