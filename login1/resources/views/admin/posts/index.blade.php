@extends('layouts.admin')

@section('content')
    <div class="container p-5">

        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif



        <h2 class="fs-4 text-secondary my-4">
            Elenco Post
        </h2>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><a href="{{ route('admin.orderby', ['direction' => $direction]) }}">#ID</a></th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><span class="badge text-bg-warning">{{ $post->category?->name }}</span>
                        </td>
                        @php
                            $date = date_create($post->date);
                        @endphp


                        <td>{{ date_format($date, 'd/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-primary">VAI</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success">Modfica</a>

                            <!-- bottone elimina con metodo DELETE -->

                            @include('admin.partials.form-delete', [
                                'title' => 'Eliminazione Post',
                                'id' => $post->id,
                                'message' => "Confermi l'eliminazione del post {$post->title}?",
                                'route' => route('admin.posts.destroy', $post),
                            ])


                        </td>




                    </tr>
                @endforeach




            </tbody>
        </table>
        <div>
            {{ $posts->links() }}
        </div>

    </div>
@endsection
