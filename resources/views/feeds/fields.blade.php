<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <label class="radio-inline">
        {!! Form::radio('type', "Rss", null) !!} Rss
    </label>
    <label class="radio-inline">
        {!! Form::radio('type', "Atom", null) !!} Atom
    </label>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('users_id', Auth::user()->id) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('feeds.index') !!}" class="btn btn-default">Cancel</a>
</div>
