<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BookRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class BookController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the Book.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $books = Book::all();
        
        return view('books.index')
            ->with('books', $books);
    }

    public function empty(Request $request)
    {
        $books = Book::where('stock','<', 1)->get();

        return view('books.index')
            ->with('books', $books);
    }

    public function borrow($id)
    {
        $validasi = book::where('id',$id)->where('stock','>',0)->where('status','active')->count();

        if($validasi > 0) {
            //jika buku nya ada lebih dari satu dan status nya aktif
            $borrow = new Borrow;
            $borrow->book_id = $id;
            $borrow->user_id = Auth::user()->id;
            $borrow->date = date('Y-m-d');
            $borrow->date_of_retrun = date('Y-m-d',strtotime(" +1 weeks", time()));
            $borrow->save();

            //kurangi stock buku
            $book = Book::findOrFail($id);
            $old_stock = $book->stock;
            $new_stock = $old_stock - 1;
            Book::findOrfail($id)->update(['stock' => $new_stock]);

            Flash::success('borrow success');

            return redirect(route('books.index'));
        } else {
            Flash::error('borrow failed');

            return redirect(route('books.index'));
        }

    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $category = Category::all();
        return view('books.create', compact('category'));
    }

    /**
     * Store a newly created Book in storage.
     *
     * @param CreateBookRequest $request
     *
     * @return Response
     */
    public function store(CreateBookRequest $request)
    {
        $input = $request->all();
        $input['title'] = $request->title;
        $input['slug'] = Str::slug($request->title);
        $input['cover'] = $request->file('cover')->store(
            'asset/covers','public'
        );

        $book = $this->bookRepository->create($input);

        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.edit', compact('category'))->with('book', $book);
    }

    /**
     * Update the specified Book in storage.
     *
     * @param int $id
     * @param UpdateBookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookRequest $request)
    {
        $book = $this->bookRepository->find($id);
        $book->title = $request->title;
        $book->category_id = $request->category_id;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->stock = $request->stock;
        $book->slug = Str::slug($request->get('title'));
        $book->updated_by  = Auth::user()->id;
        if($request->hasFile('cover')) {
            if($book->cover && file_exists(storage_path('app/public'.$book->cover))) {
                Storage::delete('public/'.$book->cover);
            }
            $file = $request->file('cover')->store('covers','public');
            $book->cover = $file;
        }
        $book->save();

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        Flash::success('Book updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $this->bookRepository->delete($id);

        Flash::success('Book deleted successfully.');

        return redirect(route('books.index'));
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'in:active,inactive'
        ]);

        $item = Book::findOrFail($id);
        $item->status = $request->status;
        $item->save();

        return redirect(route('books.index'));
    }
}
