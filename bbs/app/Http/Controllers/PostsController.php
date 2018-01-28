<?php

namespace App\Http\Controllers;

// Intervention Image
use Illuminate\Support\Facades\Input;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;

class PostsController extends Controller
{

    // バリデーションのルール
    public $validateRules = [
        'file' => 'required', 'file',
        'title' => 'required',
        'body' => 'max:500'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        return view('posts.index', compact('posts'));        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'asc')->paginate(20);
        // $post = Post::findOrFail($id);
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validateRules);

        $input = $request->all();

        // 新しいpic_idを生成
        $pic_id = Post::orderBy('id', 'desc')->take(1)->value('pic_id');
        ++$pic_id;

        // 名前と拡張子を取得
        $fig_name = $input['file']->getClientOriginalName();
        $fig_mime = $input['file']->extension($input['file']);

        $image = Image::make($input['file']->getRealPath());

        $image->save(public_path() . '/media/' . $pic_id . '.' . $fig_mime);

        Post::create([
            'pic_id' => $pic_id,
            'title' => $input['title'],
            'contributor' => $input['contributor'],
            'body' => $input['body'],
            'category' => $input['category'],
            'tag' => $input['tag'],
            'fig_name' => $fig_name,
            'fig_mime' => $fig_mime
        ]);

        \Session::flash('flash_message', '記事を作成しました。');
        return redirect('posts');
    }
}