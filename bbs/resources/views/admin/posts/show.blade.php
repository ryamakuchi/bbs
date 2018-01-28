@extends('layouts.admin')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">記事詳細</div>
                <div class="panel-body">
                    <div>
                        <h1>{{$post->title}}</h1>
                        <p class="text-right">
                            <span class="glyphicon glyphicon-comment">コメント数：</span>  
                            <span class="glyphicon glyphicon-time">{{ $post->created_at->format('Y/m/d H:i:s') }}</span>
                        </p>
                        {!! Html::image("media/$post->pic_id.$post->fig_mime", "$post->fig_name.$post->fig_mime", ['class' => 'img-responsive center-block']) !!}
                        <br /><hr><br />
                        <p>
                            <div style="float:left;">
                                <b>{{$post->contributor}}</b>
                            </div>
                            <div style="text-align:right;">{{ $post->created_at->format('Y/m/d H:i:s') }}</div>
                        </p>
                        <br />
                        <p>{{$post->body}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
