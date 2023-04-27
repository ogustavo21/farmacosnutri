@extends('app')


@section('content')
    @if (isset($idb))
    @foreach ($bibliografias as $bib)            
      @php
          
      
           $fidbibliografia=$bib->id;
           $ftitulo=$bib->titulo;
           $fdescripcion=$bib->descripcion;
           $fautor=$bib->autor;
           $fanio=$bib->anio;
           $feditorial=$bib->editorial;
      @endphp 
    @endforeach
      @php
           $finter="fshow_confirm"
      @endphp    
   @else   
       @php
           $fidbibliografia="";
           $ftitulo="";
           $fdescripcion="";
           $fautor="";
           $fanio="";
           $feditorial="";

      @endphp   
   @endif
<form action="/bibliografias/create" method="POST">
    @csrf

<div>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bibliografias</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="titulo" class="col-form-label">Titulo:</label>
              <input type="hidden" name="id_bibliografia" value="{{$fidbibliografia}}">
              <input type="text" class="form-control" name="titulo" id="titulo"  value="{{$ftitulo}}" required>
            </div>
            <div class="form-group">
              <label for="Descripcion" class="col-form-label">Descripcion:</label>
              <textarea class="form-control" id="Descripcion" name="descripcion" required>{{$fdescripcion}}</textarea>
            </div>
            <div class="form-group">
              <label for="autor" class="col-form-label">Autor:</label>
              <input type="text" class="form-control" name="autor" id="autor"  value="{{$fautor}}" required>
            </div>
            <div class="form-group">
              <label for="anio" class="col-form-label">Año:</label>
              <input type="text" class="form-control" name="anio" id="anio"  value="{{$fanio}}" required>
            </div>
            <div class="form-group">
              <label for="editorial" class="col-form-label">Editorial:</label>
              <input type="text" class="form-control" name="editorial" id="editorial"  value="{{$feditorial}}" required>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
  </form>

 @endsection
