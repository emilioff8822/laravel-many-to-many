@extends('layouts.admin')

@section('content')
    <div class="container p-5">

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif



        <h2 class="fs-4 text-secondary my-4">
            Gestione Categorie
        </h2>
        <div class="w-50">
            <div class="input-group mb-3">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Nuova Categoria"
                            aria-label="nuova categoria" aria-describedby="basic-addon2">
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
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="edit_form">
                                @csrf
                                @method('PUT')
                                <input class="border-0" name="name" type="text" value="{{ $category->name }}">

                            </form>
                        </td>
                        <td>
                            <button class="btn btn-success" onclick="submitEditForm()">Salva</button>
                            @include('admin.partials.form-delete', [
                                'title' => 'Eliminazione Categoria',
                                'id' => $category->id,
                                'message' => "Confermi l'eliminazione della categoria {$category->name}?",
                                'route' => route('admin.categories.destroy', $category),
                            ])
                        </td>

                        <td>{{ count($category->posts) }}</td>
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
