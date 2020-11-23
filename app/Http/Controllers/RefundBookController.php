<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class RefundBookController extends Controller
{
    public function index()
    {
        $items = Borrow::where('status','approve')->get();
        return view('refunds.index', compact('items'));
    }

    public function refund(Request $request,$id)
    {
        $borrow = Borrow::findOrFail($id);
        $book_id = $borrow->book_id;;
        $borrow->status = $request->status;
        $borrow->save();

        //tambah stock buku
        $book = Book::find(['id' => $book_id])->first();
        $old_stock = $book->stock;
        $new_stock = $old_stock + 1;
        Book::where('id',$book_id)->update(['stock' => $new_stock]);

        Flash::success('refund successfully.');

        return redirect(route('borrows.index'));
        
    }
}
