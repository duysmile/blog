<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="{{route('admin')}}">Torf's Blog</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::to('admin/articles')}}">Articles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">Images</a>
        </li>
        @if(Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{URL::to('admin/categories')}}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">User</a>
            </li>
        @endif
    </ul>
    <ul class="navbar-nav ml-auto">
        <span class="text-light">
            <?= Auth::user()->name ?>
        </span>
        <a href="{{URL::to('admin/logout')}}">&nbsp;Logout</a>
    </ul>
</nav>


