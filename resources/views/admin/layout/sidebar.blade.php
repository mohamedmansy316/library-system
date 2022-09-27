<!--**********************************
Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Books</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('admin.books.all')}}">View all</a></li>
                    <li><a href="{{route('admin.books.getCreate')}}">Add new</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                <span class="nav-text">Borrows requests</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{route('admin.borrows.all')}}">View all</a></li>
            </ul>
        </li>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-networking"></i>
            <span class="nav-text">Reverse requests</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{route('admin.reverse.all')}}">View all</a></li>
        </ul>
    </li>
    </div>
</div>
