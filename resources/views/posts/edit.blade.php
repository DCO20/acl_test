@extends('master.master')

@section('content')
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <a class="text-success" href="{{ route('posts.index') }}">&leftarrow; Voltar para a listagem</a>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('post.update', ['post' => $post->id]) }}" method="post" class="mt-4"
                                autocomplete="off">
                              @csrf
                              @method('PUT')
  
                              <div class="form-group">
                                  <label for="title">Título</label>
                                  <input type="text" class="form-control" id="title"
                                         placeholder="Insira o título do artigo"
                                         name="title" value="{{ old('title') ?? $post->title }}">
                              </div>
  
                              <div class="form-group">
                                  <label for="content">Conteúdo</label>
                                  <textarea class="form-control" id="content" rows="3" name="content"
                                            placeholder="Insira o conteúdo...">{{ old('content') ?? $post->content }}</textarea>
                              </div>
  
                              <div class="form-group">
                                  <label for="content">Publicado</label>
                                  <div class="form-check">
                                      <input class="form-check-input" type="radio" name="published" id="publishedtrue"
                                             value="1" {{ $post->published == true ? 'checked' : '' }}>
                                      <label class="form-check-label" for="publishedtrue">
                                          Sim
                                      </label>
                                  </div>
                                  <div class="form-check">
                                      <input class="form-check-input" type="radio" name="published"
                                             id="publishedfalse"
                                             value="0" {{ $post->published == false ? 'checked' : '' }}>
                                      <label class="form-check-label" for="publishedfalse">
                                          Não
                                      </label>
                                  </div>
                              </div>
  
                              <button type="submit" class="btn btn-block btn-success">Editar Artigo</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @endsection