<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'image:') !!} <br>
    @if ($user->image)
        <img src="{{ asset('storage/'.$user->image) }}" alt="" width="100"> <br>
    @else
        Image not found
    @endif
    <br>
    <input type="file" name="image" id="image"><br>
</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nationality', 'nationality:') !!}
    {!! Form::text('nationality', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4 mb-4">
    {!! Form::label('gender', 'Gender:') !!}
    <select name="gender" id="gender" class="form-control">
        <option value="0" disabled="true" selected="true">--Choose--</option>
        <option value="pria" {{ $user->gender == 'pria' ? 'selected' : '' }}>Pria</option>
        <option value="wanita" {{ $user->gender == 'wanita' ? 'selected' : '' }}>wanita</option>
    </select>
</div>


<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('no_hp', 'no_hp:') !!}
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('age', 'age:') !!}
    {!! Form::number('age', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('bod', 'bod:') !!}
    <input type="text" class="form-control" id="bod" value="{{ date('Y-m-d',strtotime($user->bod)) }}">
    <small>y/m/d</small>
</div>

<div class="form-group col-sm-4">
    {!! Form::label('address', 'address:') !!}
    <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Update', ['class' => 'btn-block btn-xs btn btn-primary']) !!}
    <a href="{{ route('books.index') }}" class="btn-block btn-xs btn btn-default">Cancel</a>
</div>
