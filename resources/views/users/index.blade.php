@extends('master.master')

@section('content')
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @can('Adicionar Usuário')
                            <a class="text-success" href="{{route('users.create')}}">&plus; Cadastrar Usuário</a><hr>
                            @endcan
                            @include('includes.alerts')
                            @if($errors)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger mt-4" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
    
                            <table class="table table-striped mt-4">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuário</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
    
                               @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td class="d-flex">
                                            @can('Excluir Usuário')
                                            <a class="mr-3 btn btn-sm btn-outline-success" href="{{route('users.edit', ['user' => $user->id])}}">Editar</a>
                                            @endcan

                                            @can('Adicionar Perfil')
                                            <a class="mr-3 btn btn-sm btn-outline-primary" href="{{route('user.roles', ['user' => $user->id])}}">Perfis</a>
                                            @endcan


                                            <form action="{{route('users.destroy',['user' => $user->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                @can('Excluir Usuário')
                                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
                                                @endcan
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