<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PostController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Ver Post')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Adicionar Post')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        if(!empty($request->published)) {
            $post->published = $request->published;
        }

        $post->save();

        return redirect()->route('posts.index', [
            'post' => $post->id,
        ])->with('message', 'Artigo criado com sucesso!.');
    }
    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        if(!Auth::user()->hasPermissionTo('Editar Post')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->content = $request->content;

        if(isset($request->published)) {
            $post->published = $request->published;
        }

        $post->save();
        return redirect()->route('post.edit', [
            'post' => $post->id,
        ])->with('message', 'Artigo atualizado com sucesso!.');
    }

    public function destroy(Post $post)
    {
        if(!Auth::user()->hasPermissionTo('Excluir Post')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('message_danger', 'Artigo excluído com sucesso!.');
    }
}
