<input type="hidden" name="created_by" value="{{ Auth::user()->id }}">

<div class="form-group col-sm-6">
    {!! Form::label('cover', 'Cover:') !!} <br>
    <input type="file" name="cover" id="cover" class="form-control">
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    <select name="category_id" id="category_id" class="form-control">
        <option value="0" selected="true" disabled="true">--Choose Category--</option>
        @foreach ($category as $category)
            <option value="{{ $category->id }}" {{ old('category_id') }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Author Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author', 'Author:') !!}
    {!! Form::text('author', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('books.index') }}" class="btn btn-default">Cancel</a>
</div>
