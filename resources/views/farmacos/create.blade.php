@extends('app')


@section('content')
<br><br>

    @if (isset($idfarmaco))

     @foreach ($inter as $int)            
       @php

            $id_farmaco=$idfarmaco;
            $ffarmaco=$int->farmaco;
            $fmecanismo=$int->mecanismo;
            $furl=$int->url;
            $fefecto=$int->efecto;
            $frecomendaciones=$int->recomendaciones;
            $fid_bibliografia=intval($int->id_bibliografia);
            $fid_grupo=intval($int->id_grupo);

       @endphp 
     @endforeach
       @php
            $finter="fshow_confirm"
       @endphp    
    @else   
        @php
            $id_farmaco="";
            $ffarmaco="";
            $fmecanismo="";
            $furl="";
            $fefecto="";
            $frecomendaciones="";
            $fid_bibliografia="";
            $fid_grupo="";
            $finter="show_confirm"

       @endphp   
    @endif
    <form id="myForm" action="/farmacos/{{$id_farmaco}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($idfarmaco))
        @method("PUT")
        @endif
            <div class="card">
                <div class="card-header">
                  Formulario de Fármacos
                </div>
                <div class="card-body">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Fármaco</span>
                        </div>
                        <input type="hidden" name="id_farmaco" value="{{$id_farmaco}}">
                        <input type="text"  value="{{$ffarmaco }}" class="form-control" placeholder="Farmaco" aria-label="Farmaco" name="farmaco" aria-describedby="basic-addon1" required>
                      </div>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Mecanismo</span>
                        </div>
                        <textarea class="form-control" aria-label="Mecanismo" name="mecanismo" required>{{$fmecanismo }}</textarea>
                      </div>
                      <br>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label for="basic-url">Imagen  </label>
                            <br>
                        </div>
                        <br>
                        @if ($furl!='')
                        <img src="{{ '../storage/'.$furl }}" alt="{{$ffarmaco }}" height="150" width="150">
                        <input type="file" class="form-control-file" name="urlimagen">
                        @else
                        <input type="file" class="form-control-file" name="urlimagen" required>
                         @endif
                      </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Efecto</span>
                        </div>
                        <input type="text" class="form-control"value="{{$fefecto }}" placeholder="Efecto" aria-label="Efecto" name="efecto" aria-describedby="basic-addon1" required>
                      </div>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Recomendaciones</span>
                        </div>
                        <textarea class="form-control" aria-label="Recomendaciones" name="recomendaciones" required>{{$frecomendaciones }}</textarea>
                      </div>
                   <br>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Bibliografia</span>
                        </div>
                        <select name="id_bibliografia[]" id="id_bibliografia"  title="Seleciona Bibliografia" data-style="btn"  class="form-control selectpicker" multiple multiselect-search="true" required>
                            @foreach ($bibliografias as $biblio)
                            @php
                                $selected = in_array($biblio->id, $biblioselect->pluck('id')->toArray());
                            @endphp
                            <option value="{{ $biblio->id }}" {{ $selected ? 'selected' : '' }}>{{ $biblio->titulo }}</option>
                           @endforeach
                      
                        </select>
                        <div class="input-group-append">
                            
                                <a class="btn btn-warning" href="/bibliografias">
                                  <i class="fa fa-edit">Agregar Bibliografias</i>
                              </a>
                          </div>
                     </div>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Grupo Farmaco</span>
                        </div>
                        <select name="id_grupofarmaco" class="form-control" required>
                            @foreach ($gfar as $gf)
                                    @php
                                        $idx=intval($gf->id);
                                    @endphp
                                
                                @if($idx==$fid_grupo)
                                <option value="{{ $gf->id }}" selected>{{ $gf->grupo }}</option>
                                @else
                                <option value="{{ $gf->id }}">{{ $gf->grupo }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="input-group-append">  
                          <a class="btn btn-warning" href="/grupofarmacos">
                            <i class="fa fa-edit">Agregar Grupos</i>
                          </a>
                          </div>
                     </div>
                     <br>
                     @if (isset($idfarmaco))
                     <button class="btn btn-success" type="submit">Guardar</button>
                     @else
                     <button class="btn btn-success show_confirm" type="button">Guardar Farmaco</button>
                     @endif
<br><br>
</form>
@if (isset($idfarmaco))

<form action="/farmacos/create2" method="POST">
  @csrf

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Interacción</span>
  </div>
  <input type="hidden" name="id_farmaco" value="{{$id_farmaco}}">

  <input type="text" class="form-control" placeholder="Interacción" aria-label="Interaccion" name="interaccion" aria-describedby="basic-addon1" required>
  <div class="input-group-append">  
  <button type="submit" class="btn btn-primary" >Guardar Interacción</button>
  </div>
</div>
</form>
@endif

@if (isset($inter))
    @if (isset($count) && $count==0)
      
    @else
    
<table class="table">
    <thead>
        <tr>
            <th>Interaccion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inter as $int)
        @php
             $idinteraccion=$int->id;
             $inaboton="show_confirm2";
        @endphp

        <tr>
            <td>{{ $int->interaccion }}</td>
            <td>   <input type="hidden" name="inter" value="{{$int->interaccion}}">

                <button type="button" class="btn btn-primary editar" data-toggle="modal" data-target="#exampleModal" data-inter='{{ $int->interaccion}}' data-idinter='{{ $int->id}}' data-idfarma='{{ $id_farmaco}}' title='Editar'>Editar</button>
                 {{-- modal --}}      
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/interacciones/{{ $idinteraccion }}" method="POST" >
          @csrf
          @method("PUT")

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="hidden" id="id_interaccion" name="id_interaccion" value="">
            <input type="hidden" id="id_farmaco" name="id_farmaco" value="">
            <input type="text" class="form-control" id="interaccion" name="interaccion" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
    </form>
    </div>
  </div>
</div>    
    {{-- modal --}}   
            </td>
            <td>
                <form action="/interacciones/{{ $idinteraccion }}" method="post">
                    @method("delete")
                    @csrf
                    <input type="hidden" name="id_farmaco" value="{{$id_farmaco}}">
                    <button type="submit" class="btn btn-xs btn-danger btn-flat {{$inaboton}}" data-toggle="tooltip" title='Delete'>Delete</button>
                       
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endif


@endif
                   </div> 
                   <div class="card-footer text-muted">
                        
                  </div>
                </div>
       

<br><br><br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          //var form =  $(this).closest("myForm");
          const formulario = document.getElementById('myForm');

          event.preventDefault();
          swal({
              title: `Para agregar Interacciones debes guardar el farmaco`,
              text: "Estas seguro que lo quieres guardar?.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                if (formulario.checkValidity()) {
                    swal({
                            title: `Interacciones`,
                            text: "Ingresa la interaccion",
                            buttons: true,
                            dangerMode: true,
                            content: "input",
                        })
                    .then((value) => {
                                // Crear un nuevo elemento input y agregarlo al formulario
                                var nuevoCampo = document.createElement('input');
                                nuevoCampo.type = "text";
                                nuevoCampo.name = "interaccion";
                                nuevoCampo.value=value;
                                document.getElementById('myForm').appendChild(nuevoCampo);
                                document.getElementById('myForm').action = "/farmacos/create2";
                                document.getElementById('myForm').submit();
                    }); 
                }
                else {
                    swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, completa todos los campos del formulario.'
                     });
                }
            }
          });
      });

</script>
<script type="text/javascript">
 
    $('.show_confirm2').click(function(event) {
         var form =  $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: `Estas seguro que quieres borrar este registro?`,
             text: "Si lo eliminas desaparecera para siempre.",
             icon: "warning",
             buttons: true,
             dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
             form.submit();
           }
         });
     });

     $('.editar').click('show.bs.modal', function(event) {
         console.log('pos aqui que ');
         //var button = $(event.relatedTarget) // Button that triggered the modal
         var inter = $(this).data("inter")
         var idinter = $(this).data("idinter")
         var idfarma = $(this).data("idfarma")

         
         //console.log(valor);
          // Asigna el valor al campo de entrada
          $("#interaccion").val(inter);
          $("#id_farmaco").val(idfarma);
          $("#id_interaccion").val(idinter);


     });
</script>
 
 @endsection
