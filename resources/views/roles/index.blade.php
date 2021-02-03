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
    
                            <a class="text-success" href="{{route('roles.create')}}">&plus; Cadastrar Perfil</a><hr>
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
                                    <th>Perfil</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
    
                               @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td class="d-flex">
                                            <a class="mr-3 btn btn-sm btn-outline-success" href="{{route('roles.edit', ['role' => $role->id])}}">Editar</a>
                                            <a class="mr-3 btn btn-sm btn-outline-primary" href="{{route('role.permissions', ['role' => $role->id ])}}">Permissões</a>
                                            <form action="{{route('roles.destroy',['role' => $role->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Remover">
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