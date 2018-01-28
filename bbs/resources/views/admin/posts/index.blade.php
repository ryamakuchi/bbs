@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">記事一覧</div>
                <div class="panel-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif

                    <div class="mb10">
                        {!! link_to('admin/posts/create', '新規作成', ['class' => 'btn btn-primary']) !!}
                    </div>

                    <br />
                    <table class="table table-striped table-bordered table-hover"  style="table-layout:fixed;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>タイトル</th>
                            <th>画像</th>
                            <th>作成日</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td style="width:200px;">
                                {!! Html::image("media/$post->pic_id.$post->fig_mime", "$post->fig_name.$post->fig_mime", ['class' => 'img-responsive center-block']) !!}
                                </td>
                                <td>{{ $post->created_at->format('Y/m/d H:i:s') }}</td>
                                <td>
                                    {!! link_to_action('Admin\PostsController@show', '表示', [$post->id]) !!}
                                    {!! link_to_action('Admin\PostsController@edit', '編集', [$post->id]) !!}
                                    {!! Form::model($post,
                                    ['url' => [
                                        'admin/posts', $post->id],
                                        'method' => 'delete',
                                        'class' => 'delete-from'
                                    ]) !!}
                                        {!! Form::submit('削除', [
                                            'onclick' => "return confirm('本当に削除しますか?')",
                                            'class' => 'text-link btn btn-default'
                                            ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! $posts->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
