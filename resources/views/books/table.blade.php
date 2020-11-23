<div class="table-responsive">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Stock</th>
                @if (Auth::user()->roles == 'admin')
                <th>Set status</th>
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>
                    <a  data-toggle="modal" 
                        data-target="#view" 
                        data-title="{{ $book->title }}"
                        data-description="{{ $book->description }}"
                        data-id="{{ $book->id }}"
                        data-created_at="{{ $book->created_at }}"
                        data-updated_at="{{ $book->updated_at }}"
                        class="label label-warning">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('book.borrow', $book->id) }}" class="btn btn-info btn-xs">Borrow</a>
                    {{ $book->category->name }}
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->status }}</td>
                <td>{{ $book->stock }}</td>
                @if (Auth::user()->roles == 'admin')
                <td>
                    @if ($book->status == 'active')
                        <a href="{{ route('book.actived',$book->id) }}?status=inactive"
                            class="label label-warning">
                            <i class="fa fa-list"> Nonaktifkan !</i>
                        </a>
                    @elseif($book->status == 'inactive')
                        <a href="{{ route('book.actived',$book->id) }}?status=active" 
                            class="label label-primary">
                            <i class="fa fa-list"> Aktifkan !</i>
                        </a> 
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['books.destroy', $book->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('books.show', [$book->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('books.edit', [$book->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- modal --}}
<div class="modal fade left" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-ms modal-right modal-default" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-id-badge" aria-hidden="true"> View Book</i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                <input type="text" name="title" id="title" class="form-control" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                {!! Form::label('created_at', 'Created At') !!}
                <input type="text" name="created_at" id="created_at" class="form-control" readonly>
            </div>
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At') !!}
                <input type="text" name="updated_at" id="updated_at" class="form-control" readonly>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
{{-- endmodal --}}

@push('scripts')
    <script>
        $('#view').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var title = button.data('title')
            var description = button.data('description')
            var created_at = button.data('created_at')
            var updated_at = button.data('updated_at')
            var id = button.data('id')

            var modal = $(this)

            modal.find('.modal-title').text('VIEW BOOK INFORMATION');
            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #created_at').val(created_at);
            modal.find('.modal-body #updated_at').val(updated_at);
            modal.find('.modal-body #id').val(id);
        });

        $(document).ready(function(){
            $('#table').DataTable();
        });
    </script>
@endpush

