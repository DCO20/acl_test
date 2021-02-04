@extends('master.master')

@section('content')
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <a class="text-success" href="{{ route('post.create') }}">&plus; Cadastrar Artigo</a>
                            @include('includes.alerts')
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table table-striped mt-4">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ ($post->published == true ? 'Publicado' : 'Rascunho') }}</td>
                                            <td class="d-flex">
                                                <a class="mr-3 btn btn-sm btn-outline-success" href="{{ route('post.edit', ['post' => $post->id]) }}">Editar</a>
                                                <form action="{{ route('post.destroy', ['post' => $post->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input class="btn btn-sm btn-outline-danger" type="submit"
                                                        value="Remover">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @endsection