<div class="form-group">
    {!! Form::label('contributor', '投稿者:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('contributor', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('body', '内容:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('delete_key', '削除KEY:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('delete_key', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
        {!! Form::submit('書き込む', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::hidden('post_id', $post->id) !!}
{!! Form::hidden('delete_flg', '0') !!}