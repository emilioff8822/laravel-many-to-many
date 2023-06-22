@extends('layouts.admin')

@section('content')
    <div class="container p-5">

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <h2 class="fs-4 text-secondary my-4 ">
            {{ $title }}

        </h2>

        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)


            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input name="title" value="{{ old('title', $post?->title) }}"
                    class="form-control @error('title') is-invalid
                @enderror" id="title"
                    placeholder="Titolo">

                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <p for="title" class="form-label">Tag</p>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($tags as $tag)
                        <input type="checkbox" class="btn-check" id="tag{{ $loop->iteration }}" autocomplete="off"
                            value="{{ $tag->id }}" name="tags[]" checked>
                        <label class="btn btn-outline-dark" for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    @endforeach




                </div>



            </div>


            <div class="mb-3">
                <p for="title" class="form-label">Tag</p>

                <select class="form-select" name="category_id">
                    <option value="">Selezionare una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id', $post?->category?->id)) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach


                </select>




            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Testo</label>
                <textarea class="form-control post-text" name="text" id="text" cols="30" rows="10">{{ old('title', $post?->title) }}</textarea>
                @error('text')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="reading_time" class="form-label">Immagine</label>
                <input name="image" class="form-control mb-3 mt-3" id="image" type="file"
                    onchange="showImage(event)">

                <img width="150" id="prev-image" src="{{ asset('storage/' . $post?->image_path) }}"
                    onerror="this.src='/img/111.jpeg'">
            </div>

            <div class="mb-3">
                <label for="reading_time" class="form-label">Tempo di lettura</label>
                <input name="reading_time" value="{{ old('reading_time', $post?->reading_time) }}" class="form-control"
                    id="number" placeholder="">
            </div>

            <button type="submit" class="btn btn-dark">Invia</button>





        </form>






    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#text'))
            .catch(error => {
                console.error(error);
            });

        function showImage(event) {
            const tagImage = document.getElementById('prev-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
