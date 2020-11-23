@extends('layouts.app')

@section('content')
    @if (Auth::user()->roles == 'admin')
    <section class="content-header">
        <h1 class="pull-left">
            <a class="btn btn-success" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('books.index') }}">All Books</a>
            <a class="btn btn-danger" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('books.empty') }}">Stock expired</a>
        </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('books.create') }}"><i class="fa fa-plus-circle"></i></a>
        </h1>
    </section>
    @endif
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('books.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

