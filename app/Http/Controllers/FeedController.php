<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class FeedController extends Controller
{
    public function feed()
    {
        $posts = DB::table('posts')
        ->orderBy('created_at', 'asc')
        ->get();

        return view('feed')
            ->with('posts', $posts);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'content' => 'required|max:500'
        ]);

        $post = new Post;
        $post->content = $request->input('content');
        $post->user()->associate(Auth::user()->id);
        $post->save();
        
        return redirect()->route('home');
    }
}
