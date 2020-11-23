@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Borrow
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($borrow, ['route' => ['borrows.update', $borrow->id], 'method' => 'patch']) !!}

                        @include('borrows.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection