@extends('master.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <a class="text-success" href="{{route('users.index')}}">&leftarrow; Voltar para a listagem</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <h4 class="mt-3">Cadastrar novo usuário</h4><hr>
                        <form action="{{route('users.store')}}" method="post" class="mt-4" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" class="form-control" id="name" placeholder="Digite o nome"
                                       name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="name">Email:</label>
                                <input type="email" class="form-control" id="name" placeholder="Digite o email"
                                    name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="name">Senha:</label>
                                <input type="password" class="form-control" id="name" placeholder="Digite a senha"
                                    name="password" >
                            </div>
                            <button type="submit" class="btn btn-block btn-success mt-3">Cadastrar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
