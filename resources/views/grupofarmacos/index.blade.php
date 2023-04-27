@extends('app')


@section('content')

<h1>Bienvenido a los Grupos de Farmacos</h1>
<a class="btn btn-warning" href="/grupofarmacos/create">
    <i class="fa fa-edit">Crear</i>
</a>
<table class="table">
    <thead>
        <tr>
            <th>Grupo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grupofarmacos as $grupos)
        <tr>
            <td>{{ $grupos->grupo }}</td>
            <td>{{ $grupos->subgrupo }}</td>
            <td>
                <a class="btn btn-warning" href="/grupofarmacos/create2/{{ $grupos->id }}">
                    <i class="fa fa-edit">Editar</i>
                </a>
            </td>
            <td>
                <form action="/grupofarmacos/{{ $grupos->id }}" method="post">
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

 @endsection
