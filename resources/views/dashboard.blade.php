<x-app-layout>
    <!doctype html>
    <html lang="pt-br">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
      </head>
      <body>
    
        <x-slot name="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @can('Ver Usuário')
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <a href="{{ route('users.index')}}" style="text-decoration: none">Usuários <i class="fas fa-arrow-alt-circle-right"></i></a>
                        </h2>
                        @endcan
                    </div>
                    <div class="col-md-4">
                        @can('Ver Perfis')
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <a href="{{ route('roles.index')}}" style="text-decoration: none">Perfis <i class="fas fa-arrow-alt-circle-right"></i></a>
                        </h2>
                        @endcan
                    </div>
                    <div class="col-md-4">
                        @can('Ver Post')
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <a href="{{ route('posts.index')}}" style="text-decoration: none">Blog <i class="fas fa-arrow-alt-circle-right"></i></a>
                        </h2>
                        @endcan
                    </div>
                </div>
            </div>
        </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
    </html>
</x-app-layout>
