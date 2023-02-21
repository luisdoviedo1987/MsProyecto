<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion Medismart</title>
    </head>
    <body>
        <h1>Datos de afiliado</h1>
        <h4>Número de cliente: {{$afiliado->cli}}</h4>
        <h4>Número de cedula: {{$afiliado->persona_cedula}}</h4>
        <h4>Nombre: {{$afiliado->nombre}}</h4>
        <h4>Teléfono: {{$afiliado->telefono}}</h4>
        <h4>Estado: {{$afiliado->estadoTitular}}</h4>
        <br>
        <br>
        
        @foreach ($data as $d)
            <h1>{{ $d['name'] }}</h1>
            <h2>Datos</h2>
            @foreach ($d['options'] as $key => $value)
                @if($key != '_token')
                    <h4>{{ ucwords($key) }}: {{ $value }}</h4>
                @endif
            @endforeach
            <br>
            <br>
        @endforeach
    </body>
</html>
