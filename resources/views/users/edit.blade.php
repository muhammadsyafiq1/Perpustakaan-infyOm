@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    
                    @include('users.fields')
                    
                </form>
               </div>
           </div>
       </div>
   </div>
@endsection