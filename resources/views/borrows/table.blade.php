<div class="table-responsive">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Book</th>
                <th>status</th>
                <th>Borrowing Date</th>
                <th>Return Book</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($borrows as $borrow)
            <tr>
                <td>{{ $borrow->user->name }}</td>
                <td>{{ $borrow->book->title }}</td>
                <td>
                    @if ($borrow->status == 'inapprove')
                        <a href="{{ route('borrow.status',$borrow->id) }}?status=approve" class="btn btn-primary btn-xs">Approve now</a>
                    @elseif($borrow->status == 'approve')
                        <span class="label label-success"><i class="fa fa-check"></i></span>
                    @endif
                </td>
                <td>{{ date('M/d/y',strtotime($borrow->date)) }}</td>
                <td>{{ date('M/d/y',strtotime($borrow->date_of_retrun))}}</td>
                <td>
                    {!! Form::open(['route' => ['borrows.destroy', $borrow->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('borrows.show', [$borrow->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('borrows.edit', [$borrow->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
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
