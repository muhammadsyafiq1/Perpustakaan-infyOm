@php
    use App\Http\Controllers\Controller;
    use App\Models\Borrow;
    $borrow = Borrow::announ();
    // dd($borrow); die;
@endphp

@if (Auth::user()->roles == 'admin')
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i> <span>Master Categories</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>    
            </span>    
        </a>
        <ul class="treeview-menu">  
            <li class="{{ Request::is('categories*') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}"><i class="fa fa-edit"></i> <span>Categories</span></a>
            </li>
        </ul>k
    </li> 
@endif

<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i> <span>Master Books</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>    
        </span>    
    </a>
    <ul class="treeview-menu">              
        <li class="{{ Request::is('books*') ? 'active' : '' }}">
            <a href="{{ route('books.index') }}"><i class="fa fa-edit"></i> <span>Books</span></a>
        </li>
    </ul>
</li> 

@if (Auth::user()->roles == 'admin')
    <li class="{{ Request::is('borrows*') ? 'active' : '' }}">
        <a href="{{ route('borrows.index') }}"><i class="fa fa-plus-circle"></i> <span>Borrows book <i class="text-primary"> {{ ( $borrow ) }} </i></span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{{ route('refund.index') }}"><i class="fa fa-handshake-o"></i> <span>Refund book</span></a>
    </li>
    <hr>
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Member</span></a>
    </li>
@endif

