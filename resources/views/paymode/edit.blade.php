<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Editar Paymode</title>
</head>

<body>

    <div class="container">
        <div class="col-12 text-center">
            <div class="alert alert-success" role="alert">
                <h1 class="mb-0" style="color: green;">Editar Paymode</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('paymodes.update', ['paymode' => $paymode->id]) }}">
            @csrf
            @method('PUT') <!-- Agregar esta línea para usar el método PUT -->

            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{$paymode->name}}">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <label for="observation" class="form-label">Observacion</label>
                    <input type="text" class="form-control" id="observation" name="observation" placeholder="observation" value="{{$paymode->observation}}">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-danger">Guardar</button>
                            <a href="{{ route('paymodes.index') }}" class="btn btn-warning ms-2">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>