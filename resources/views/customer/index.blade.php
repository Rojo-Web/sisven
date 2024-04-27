<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<x-app-layout>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-success" role="alert">
                    <h1 class="mb-0" style="color: green;">CITAS</h1>
                </div>
                <a href="{{ route('customers.create')}}" class="btn btn-success float-start">Agregar </a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Cedula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Direcciòn</th>
                            <th scope="col">F/Nacimiento</th>
                            <th scope="col">N/Telefono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{$customer->id}}</th>
                            <td>{{$customer->nombre}}</td>
                            <td>{{$customer->apellido}}</td>
                            <td>{{$customer->fecha_nacimiento}}</td>
                            <td>{{$customer->direccion}}</td>
                            <td>{{$customer->direccion}}</td>
                            <td>{{$customer->telefono}}</td>
                            <td>{{$customer->email}}</td>

                       
                    @endforeach                      


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

</html>
