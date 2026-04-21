<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Composición de Mesa</title>
</head>
<body>
    <div class="container">
        <h1>Formulario de Composición de Mesa</h1>

        <form action="/formulario/enviar" method="POST">
@csrf
            <input type="text" name="documento">
            <button type="submit" class="btn btn-primary" onclick="enviarDocumento(event)">Enviar</button>

            <div class="form-group">

                @if(isset($buscado))
            @if($persona)
                <div>
                    <div name="descripcion" id="descripcion" class="form-control">{{$persona->Descripción}}</div>
                <img>
                    <label for="colegio">Colegio</label>
                    <div name="colegio" id="colegio" class="form-control">{{$persona->Colegio}}</div>
                    <label for="mesa">Mesa</label>
                    <div name="mesa" id="mesa" class="form-control">{{$persona->Mesa}}</div>
                    <label for="direccion">Dirección</label>
                    <div name="direccion" id="direccion" class="form-control">{{$persona->Dirección}}</div>
                </div>
                @else
                <div>No se encontró información para el DNI ingresado.</div>
            @endif
        </form>
    </div>
</body>
</html>
