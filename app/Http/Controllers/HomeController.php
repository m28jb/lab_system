<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('post_likes')
<<<<<<< HEAD
        ->orderBy('created_at','date')
        ->get();
=======
            ->orderBy('created_at', 'desc')
            ->get();
>>>>>>> 463ba6d0815e51a05ff79c70c1c5c954ebbec556

        return view('home', compact('posts'));
    }
}
