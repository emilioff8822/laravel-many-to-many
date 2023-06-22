@extends('layouts.admin')

@section('content')
    <div class="container p-5">

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif



        <h2 class="fs-4 text-secondary my-4">
            Gestione Tags
        </h2>
        <div class="w-50">
            <div class="input-group mb-3">
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Nuovo Tag"
                            aria-label="nuovo tag" aria-describedby="basic-addon2">
                        <button class="input-group-text" id="basic-addon2" type="submit"><i class="fa-solid fa-plus"></i>
                            Add</button>
                    </div>


                </form>




            </div>


        </div>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Azioni</th>
                    <th scope="col">Numero Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>
                            <form action="{{ route('admin.tags.update', $tag) }}" method="POST" id="edit_form">
                                @csrf
                                @method('PUT')
                                <input class="border-0" name="name" type="text" value="{{ $tag->name }}">

                            </form>
                        </td>
                        <td>
                            <button class="btn btn-success" onclick="submitEditForm()">Salva</button>
                            @include('admin.partials.form-delete', [
                                'title' => 'Eliminazione Tag',
                                'id' => $tag->id,
                                'message' => "Confermi l'eliminazione del Tag {$tag->name}?",
                                'route' => route('admin.tags.destroy', $tag),
                            ])
                        </td>

                        <td>{{ count($tag->posts) }}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>

    <script>
        function submitEditForm() {
            const form = document.getElementById('edit_form');
            form.submit();
        }
    </script>
@endsection
