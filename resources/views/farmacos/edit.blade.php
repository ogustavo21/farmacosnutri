@extends('app')


@section('content')
<h1>Aqui puedes editar un Farmaco</h1>
<form action="/farmacos/{{$farmaco->id}}" method="POST">
    @method("PUT")
    @csrf
    <label>Farmaco
        <br>
        <input type="text" name="farmaco" value="{{$farmaco->farmaco}}" >
    </label>
    <br>
    <label>Mecanismo
        <br>
        <textarea name="mecanismo" cols="10" rows="5" >{{$farmaco->mecanismo}}</textarea>
    </label>
    <br>
    <label >Imagen
        <br>
        <input type="text" name="urlimagen" value="{{$farmaco->url}}">
    </label>
    <br>
    <label >Efecto
        <br>
        <input type="text" name="efecto" value="{{$farmaco->efecto}}">
    </label>
    <br>
    <label>Recomendaciones
        <br>
        <textarea name="recomendaciones" cols="10" rows="5" value="">{{$farmaco->recomendaciones}}</textarea>
    </label>
    <br>
    <label>Bibliografia
    <select name="id_bibliografia">
        @foreach ($bibliografias as $biblio)
            <option value="{{ $biblio->id }}">{{ $biblio->titulo }}</option>
        @endforeach
    </select>
    <br>
    <label>Grupo Farmaco
        <select name="id_grupofarmaco">
            @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
            @endforeach
        </select>
        <br>
    <button class="btn btn-success" type="submit">Guardar</button>
</form>

 @endsection
