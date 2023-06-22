@extends('layouts.admin')


@section('content')
    <div class="container p-5">
        <h2 class="fs-4 text-secondary my-4 ">
            {{ $post->title }}
            <td><a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success">Modfica</a></td>
            @include('admin.partials.form-delete', [
                'title' => 'Eliminazione Post',
                'id' => $post->id,
                'message' => "Confermi l'eliminazione del post {$post->title}?",
                'route' => route('admin.posts.destroy', $post),
            ])

        </h2>

        <p>{{ $date_formatted }}</p>
        <div>
            <strong>Categoria:</strong><span class="badge text-bg-warning">{{ $post->category?->name }}</span>
        </div>

        <div>
            <strong>Tag:</strong>
            @forelse ($post->tags as $tag)
                <span class="badge text-bg-dark">{{ $tag->name }}</span>

            @empty
                <span class="badge text-bg-light">Null</span>
            @endforelse



        </div>

        <p>{!! $post->text !!}</p>
        <div>
            <img width="50%" src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
        </div>




    </div>
@endsection
