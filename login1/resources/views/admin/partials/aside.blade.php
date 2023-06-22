<aside class="bg-dark text-white">
    <nav>
        <ul>
            <li><a href="{{ route('admin.home') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.posts.index') }}"><i class="fa-solid fa-list"></i> Elenco Posts</a></li>
            <li><a href="{{ route('admin.category_posts') }}"><i class="fa-solid fa-tag"></i> Elenco Categorie/Post</a>
            </li>
            <li><a href="{{ route('admin.tags_posts') }}"><i class="fa-solid fa-tag"></i> Elenco Tag/Post</a></li>


            <li><a href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-list"></i> Gestione Categorie</a>
            </li>
            <li><a href="{{ route('admin.tags.index') }}"><i class="fa-solid fa-list"></i> Gestione Tags</a></li>


            <li><a href="{{ route('admin.posts.create') }}"><i class="fa-solid fa-folder-plus"></i> New Post</a></li>
        </ul>
    </nav>
</aside>
