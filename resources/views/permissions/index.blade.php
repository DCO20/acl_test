@extends('master.master')

@section('content')
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" permission="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
    
                            <a class="text-success" href="{{route('permissions.create')}}">&plus; Cadastrar Permissão</a><hr>
                            @include('includes.alerts')
                            
                            @if($errors)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger mt-4" permission="alert">
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
    
                               @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td class="d-flex">
                                            <a class="mr-3 btn btn-sm btn-outline-success" href="{{route('permissions.edit', ['permission' => $permission->id])}}">Editar</a>
                                            <a class="mr-3 btn btn-sm btn-outline-primary" href="">Perfis</a>
                                            <form action="{{route('permissions.destroy',['permission' => $permission->id])}}" method="post">
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