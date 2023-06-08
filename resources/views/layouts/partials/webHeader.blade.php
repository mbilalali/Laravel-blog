<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/blogs">Blogs</a></li>
            @if (auth()->check())
                <li><a href="/write">Write A Blog</a></li>
                <li><a href="/logout">Logout</a></li>
            @else
                <li><a href="/login">Write a Blog</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @endif


        </ul>
    </div>
</nav>
