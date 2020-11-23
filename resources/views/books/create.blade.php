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
                    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        @include('books.fields')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
