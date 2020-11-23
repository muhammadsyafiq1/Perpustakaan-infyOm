@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Refund</h1>
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->book->title }}</td>
                                <td>
                                    <a href="{{ route('book.refund',$item->id) }}?status=refund" class="btn btn-xs btn-primary"><i class="fa fa-book"> Refund</i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                
                @push('scripts')
                    <script>
                        $(document).ready(function(){
                            $('#table').DataTable();
                        });
                    </script>
                @endpush
                
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

