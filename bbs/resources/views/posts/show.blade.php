@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">記事詳細</div>
                <div class="panel-body">
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                @endif
                    <div>
                        <h1>{{$post->title}}</h1>
                        <p class="text-right">
                            <span class="glyphicon glyphicon-comment">コメント数：</span>
                            <span class="glyphicon glyphicon-time">{{ $post->created_at->format('Y/m/d H:i:s') }}</span>
                        </p>
                        {!! Html::image("media/$post->pic_id.$post->fig_mime", "$post->fig_name.$post->fig_mime", ['class' => 'img-responsive center-block']) !!}
                        <br /><hr><br />
                        <div class="row">
                            <div class="col-sm-4 col-md-offset-2">
                                <b>{{$post->contributor}}</b>
                            </div>
                            <div class="col-sm-4 text-right">{{ $post->created_at->format('Y/m/d H:i:s') }}</div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2"><p>{{$post->body}}</p></div>
                        </div>
                        <br /><hr><br />
                        @foreach($comments as $comment)
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-2">
                                    <b>{{$comment->contributor}}</b>
                                </div>
                                <div class="col-sm-4 text-right">{{ $comment->created_at->format('Y/m/d H:i:s') }}</div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-8 col-md-offset-2"><p>{{$comment->body}}</p></div>
                            </div>
                            <br /><br />
                        @endforeach
                        <br /><hr><br />
                        {{-- エラーの表示 --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                        @endif
                        
                        {!! Form::open(['url' => 'posts/show',
                            'files' => true,
                            'class' => 'form-horizontal',
                            'id' => 'comment-input']) !!}
                        
                        @include('posts.commentFields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection