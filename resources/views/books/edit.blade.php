@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Book
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <form action="{{ route('books.update',$book->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group col-sm-6">
                            {!! Form::label('cover', 'Cover:') !!} <br>
                            @if ($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}" class="img-rounded" width="80"> <br>
                                <small>Kosongkan bila tak ingin dirubah</small><br>
                            @else
                                <small class="text-muted">Cover not found</small>
                            @endif
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        
                        <!-- Category Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('category_id', 'Category Id:') !!}
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="0" selected="true" disabled="true">--Choose Category--</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Title Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('title', 'Title:') !!}
                            <input type="text" name="title" id="title" value="{{ $book->title }}" class="form-control">
                        </div>
                        
                        <!-- Author Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('author', 'Author:') !!}
                            <input type="text" name="author" id="author" value="{{ $book->author }}" class="form-control">
                        </div>
                        
                        <!-- Description Field -->
                        <div class="form-group col-sm-12 col-lg-12">
                            {!! Form::label('description', 'Description:') !!}
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $book->description }}</textarea>
                        </div>
                        
                        <!-- Stock Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('stock', 'Stock:') !!}
                            <input type="number" name="stock" id="stock" value="{{ $book->stock }}" class="form-control">
                        </div>
                        
                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('books.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
@endsection