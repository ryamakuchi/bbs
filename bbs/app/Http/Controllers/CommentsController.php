<?php

namespace App\Http\Controllers;

// Intervention Image
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;

class CommentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // バリデーションのルール
    public $validateRules = [
        'post_id' => 'required',
        'contributor' => 'max:100',
        'body' => 'required',
        'delete_key' => 'required'
    ];

    public function store(Request $request)
    {
        $this->validate($request, $this->validateRules);
        Comment::create($request->all());
        \Session::flash('flash_message', 'コメントを作成しました。');
        $id = $request->post_id;

        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'asc')->paginate(20);
        return view('posts.show', compact('post', 'comments'));
    }
}