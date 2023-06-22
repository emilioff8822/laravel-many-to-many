<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direction = 'asc';
        $posts= Post::orderBy('id', $direction)->paginate(10);
        return view('admin.posts.index', compact('posts','direction'));
    }

    public function orderby ($direction){
        $direction = $direction == 'asc' ? 'desc' : 'asc';
        $posts= Post::orderBy('id', $direction)->paginate(10);
        return view('admin.posts.index', compact('posts', 'direction'));
    }


    public function categoryPosts(){
        $categories = Category::all();
        return view('admin.posts.category-posts' , compact ('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $title = 'Creazione di un nuovo post';
        $method = 'POST';
        $route = route('admin.posts.store');
        //post glielo passo come null quindi nell'old non puo esistere title
        $post = null;

        return view('admin.posts.create-edit', compact('title', 'method', 'route', 'post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $form_data= $request->all();
        $form_data['slug'] = Post::generateSlug($form_data['title']);
        $form_data['date'] = date('Y-m-d');

        //verifico se e' stata caricata un immagine
        if(array_key_exists('image', $form_data)){

            //prima di salvare l'immagine salvo il nome
         $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
         //salvo l'immagine nella cartella uploads ed in $form_data['image_path'] salvo il percorso
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);



        }

        $new_post = new Post();
        $new_post->fill($form_data);

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    $date = date_create($post->date);
    $date_formatted = date_format($date, 'd/m/Y');
    return view('admin.posts.show', compact('post', 'date_formatted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
                $categories = Category::all();

        $title = "Modifica di: " . $post->title;
        $method = 'PUT';
        $route = route('admin.posts.update', $post);
        return view('admin.posts.create-edit', compact('title', 'method', 'route', 'post' ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $form_data = $request->all();
        if($form_data['title'] != $post->title ){
        $form_data['slug'] = Post::generateSlug($form_data['title']);
        }else{
            $form_data['slug'] = $post->slug;
        }
        $form_data['date'] = date('Y-m-d');

        //per quanto riguarda l;u'update dell'immagine uso il controllo che avevo usato in precedenza
         //verifico se e' stata caricata un immagine
        if(array_key_exists('image', $form_data)){

        //rispetto a prima ce' questa aggiunta,se l'immagine esiste vuol dire che ne ' stata caricata una nuova ed elimino la vecchia
            if($post->image_path){
                Storage::disk('public')->delete($post->image_path);
            }

            //prima di salvare l'immagine salvo il nome
         $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
         //salvo l'immagine nella cartella uploads ed in $form_data['image_path'] salvo il percorso
        $form_data['image_path'] = Storage::put('uploads', $form_data['image']);



        }

        $post->update($form_data);
        return redirect()->route('admin.posts.show', $post);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //se il post da eliminare contiene un immagine la devo cancellare dalla cartella
        if($post->image_path){
                Storage::disk('public')->delete($post->image_path);
            }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato correttamente');
    }
}