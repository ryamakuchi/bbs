<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

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
        $posts = Post::orderBy('id', 'desc')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
        return redirect('admin/posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->validateRules);
 
        $post = Post::findOrFail($id);
        $post->update($request->all());
 
        \Session::flash('flash_message', '記事を更新しました。');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete($id);
        \Session::flash('flash_message', '記事を削除しました。');
        return redirect('admin/posts');
    }
}
