<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => false]);
Auth::routes();

Route::group(['middleware' => ['auth','CheckRole:admin,member']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->middleware('verified'); 
    Route::resource('books', 'BookController');
    Route::get('book/{id}/borrow','BookController@borrow')->name('book.borrow'); // route peminjaman buku
    Route::get('user/{id}/profile','UserController@getProfile')->name('users.profile'); // route peminjaman buku
    Route::resource('users', 'UserController');
});


Route::group(['middleware' => ['auth','CheckRole:admin']], function () {
    Route::resource('categories', 'CategoryController');
    Route::get('book/empty','BookController@empty')->name('books.empty'); //route tampilkan buku kosongb
    Route::get('book/{id}/actived','BookController@status')->name('book.actived'); //status buku
    Route::resource('borrows', 'BorrowController');
    Route::get('borrow/{id}/status','BorrowController@status')->name('borrow.status'); //status peminjaman
    Route::get('refund/book','RefundBookController@index')->name('refund.index'); // tampilan semua buku dipinjam
    Route::get('book/{id}/refund','RefundBookController@refund')->name('book.refund'); //mengembalikan buku di pinjam
});