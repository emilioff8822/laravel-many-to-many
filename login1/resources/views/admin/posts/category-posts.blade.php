@extends('layouts.admin')

@section('content')
    <div class="container p-5">

        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif



        <h2 class="fs-4 text-secondary my-4">
            Elenco Categorie e Posts
        </h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <ul>
                                @forelse ($category->posts as $post)
                                    <li><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></li>
                                @empty
                                    <li>Non sono presenti post</li>
                                @endforelse


                            </ul>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>



    </div>
@endsection
