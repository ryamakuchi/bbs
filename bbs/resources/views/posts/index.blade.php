@extends('layouts.app')

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

                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <h2>{!! link_to_action('PostsController@show', $post->title, [$post->id]) !!}</h2>
                            <small>
                            投稿日：{{ $post->created_at->format('Y/m/d H:i:s') }}
                            </small>
                            <a href="{{URL::to("posts/$post->id")}}">
                            {!! Html::image("media/$post->pic_id.$post->fig_mime", "$post->fig_name.$post->fig_mime", ['class' => 'img-responsive center-block']) !!}
                            </a>
                            <p>{{ $post->body }}</p>
                            <br />
                        </div>
                    @endforeach
                    {!! $posts->render() !!}
                </div>
                <div class="panel-footer">
                    {!! link_to('posts/create', '新規投稿はコチラ', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
