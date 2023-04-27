@extends('app')


@section('content')
    @if (isset($idgf))
    @foreach ($grupofarmacos as $grup)            
      @php
          
      
           $fidgrupo=$grup->id;
           $fgrupo=$grup->grupo;
           $fsubgrupo=$grup->subgrupo;

      @endphp 
    @endforeach
      @php
           $finter="fshow_confirm"
      @endphp    
   @else   
       @php
           $fidgrupo="";
           $fgrupo="";
           $fsubgrupo="";

      @endphp   
   @endif
<form action="/grupofarmacos/create" method="POST">
    @csrf

<div>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Grupo farmacos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="Grupo" class="col-form-label">Grupo:</label>
              <input type="hidden" name="id_grupofarmaco" value="{{$fidgrupo}}">
              <input type="text" class="form-control" name="grupo" id="grupo"  value="{{$fgrupo}}" required>
            </div>
            <div class="form-group">
              <label for="Subgrupo" class="col-form-label">Subgrupo:</label>
              <textarea class="form-control" id="subgrupo" name="subgrupo" required>{{$fsubgrupo}}</textarea>
            </div>
    
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  </form>

 @endsection
