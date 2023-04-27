@extends('app')


@section('content')

<h1>Bienvenido a los Bibliografias</h1>
<a class="btn btn-warning" href="/bibliografias/create">
    <i class="fa fa-edit">Crear</i>
</a>
<table class="table">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Autor</th>
            <th>Año</th>
            <th>Editorial</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bibliografias as $biblio)
        <tr>
            <td>{{ $biblio->titulo }}</td>
            <td>{{ $biblio->descripcion }}</td>
            <td>{{ $biblio->autor }}</td>
            <td>{{ $biblio->anio }}</td>
            <td>{{ $biblio->editorial }}</td>
            <td>
                <a class="btn btn-warning" href="/bibliografias/create2/{{ $biblio->id }}">
                    <i class="fa fa-edit">Editar</i>
                </a>
            </td>
            <td>
                <form action="/bibliografias/{{ $biblio->id }}" method="post">
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
