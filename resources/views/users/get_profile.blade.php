@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">My Profile</h1> <br>
        <small class="label label-primary">{{ $items->roles }}</small>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('users.edit',$items->id) }}"><i class="fa fa-edit"> Edit</i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered" id="datatables">
                    <tr>
                        <th>Image</th>
                        <td><img src="{{ asset('storage/'.$items->image) }}" alt="" width="300"></td>
                    </tr>
                    <tr>
                        <th>ID user</th>
                        <td>
                            @if ($items->id % 2 == 0)
                                <span class="label label-success">{{ $items->id }}</span>
                            @else 
                                <span class="label label-default">{{ $items->id }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $items->name }}</td>
                    </tr>
                    <tr>
                        <th>Birth of day</th>
                        <td>{{ date('D M, Y',strtotime($items->bod)) }}</td>
                    </tr>
                    <tr>
                        <th>Hp</th>
                        <td>{{ $items->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>age</th>
                        <td>{{ $items->age }}</td>
                    </tr>
                    <tr>
                        <th>Current School</th>
                        <td>{{ $items->current_school }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $items->address }}</td>
                    </tr>
                    <tr>
                        <th>Nationality</th>
                        <td>{{ $items->nationality }}</td>
                    </tr>
                    <th>History Borrows</th>
                    <td>
                        <table class="table table-bordered" id="tables">
                            <thead>
                                <tr>
                                    <th>ID borrow</th>
                                    <th>Title</th>
                                    <th>Date of borrow</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items->borrows as $borrow)
                                <tr>
                                    <td>{{ $borrow->id }}</td>
                                    <td>{{ $borrow->book->title }}</td>
                                    <td>{{ date('M/d/y',strtotime($borrow->date)) }}</td>
                                    <td>{{ $borrow->status }}</td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>        
                    </td>
                  </table>    
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#tables').DataTable();
        });
    </script>
@endpush

