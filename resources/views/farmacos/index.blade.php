@extends('app')


@section('content')

<h1>Bienvenido a los farmacos</h1>
<a class="btn btn-warning" href="/farmacos/create">
    <i class="fa fa-edit">Crear</i>
</a>
<table class="table">
    <thead>
        <tr>
            <th>Farmaco</th>
            <th>mecanismo</th>
            <th>Imagen</th>
            <th>Efecto</th>
            <th>Recomendaciones</th>
            <th>grupo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($farmacos as $farma)
        <tr>
            <td>{{ $farma->farmaco }}</td>
            <td>{{ $farma->mecanismo }}</td>
            <td>{{ $farma->url }}</td>
            <td>{{ $farma->efecto }}</td>
            <td>{{ $farma->recomendaciones }}</td>
            <td>{{ $farma->grupofarmaco->grupo }}</td>
            <td>
                <form action="/farmacosact/{{$farma->id}}" method="post">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id_farmaco" value="{{$farma->id_farmaco}}">

                    @if ($farma->estatus==1)
                        @php
                        $checked="checked"
                        @endphp    
                    @else
                        @php
                        $checked=""
                        @endphp
                    @endif
                  <div class="form-check form-switch">
                        <input class="form-check-input estatus" type="checkbox" role="switch" id="estatus" name="estatus" {{$checked}}>
                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                  </div>
                </form>
                  
            </td>
            <td>
                <a class="btn btn-warning" href="/farmacoss/{{ $farma->id }}">
                    <i class="fa fa-edit">Editar</i>
                </a>
            </td>
            <td>
                <form action="/farmacos/{{ $farma->id }}" method="post">
                    @method("delete")
                    @csrf

                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                       
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
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
  
</script>
<script type="text/javascript">
 
    $('.estatus').click(function(event) {
         var form =  $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: `Esta acción activa/ desactiva el farmaco`,
             text: "Esto permite que el famaco se visualice en las aplicaciones.",
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
 
</script>

 @endsection
