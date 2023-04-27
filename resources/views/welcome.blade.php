@extends('app')


@section('content')
        <main class="container">
            <div class="d-flex align-items-center p-3 my-3 text-black bg-purple rounded shadow-sm">
              <img src="{{URL::asset('/img/farmacoimg.png')}}" alt="farmaco" height="100" width="100">
              <div class="lh-1">
                <h1 class="h5 mb-2 text-black lh-1">Bienvenidos</h1>
                <small>Sistema de captura de información para Fármacos 2023</small>
              </div>
            </div>

          
            <div class="my-3 p-3 bg-body rounded shadow-sm">
              <h6 class="border-bottom pb-2 mb-0">Instrucciones de uso</h6>
              <div class="d-flex text-body-secondary pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Paso 1. Grupos de fármacos</strong>
                    <a href="/grupofarmacos">Entrar</a>
                  </div>
                  <span class="d-block">Entra a la lista de grupos y  Crear, actualiza y borra Grupo de fármaco</span>
                </div>
              </div>
              <div class="d-flex text-body-secondary pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Paso 2. Bibliografías</strong>
                    <a href="bibliografias">Entrar</a>
                  </div>
                  <span class="d-block">Entra a las Bibliografías y  Crear, actualiza y borra bibliografías</span>
                </div>
              </div>
              <div class="d-flex text-body-secondary pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"></rect><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text></svg>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Paso 3. Fármacos</strong>
                    <a href="/farmacos">Entrar</a>
                  </div>
                  <span class="d-block">Entra a los fármacos y  Crear, actualiza y borra fármacos, ademas de agregar las interacciones</span>
                </div>
              </div>
              <small class="d-block text-end mt-3">
              </small>
            </div>
          </main>
@endsection
