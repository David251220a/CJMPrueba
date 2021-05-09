@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Listado de Funcionarios  <a href="persona/create"> <button class="btn btn-success"> Nuevo </button></a></h3>
        @include('afiliado.persona.search')
        
    </div>

</div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th>Numero Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>                        
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Opciones</th>

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                    
                    @foreach ($persona as $per)
                    <tr>

                        <td>{{$per->cedula}}</td>
                        <td>{{$per->nombre}}</td>
                        <td>{{$per->apellido}}</td>                    
                        <td>{{$per->telefono}}</td>
                        <td>{{$per->email}}</td>
                        <td>
                            <a href="{{URL::action('PersonaController@edit', $per->idpersona)}}">
                                 <button class="btn btn-info">Editar</button>
                            </a>

                            <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal">
                                <button class="btn btn-danger">Borrar</button>
                           </a>

                        </td>
                    </tr>

                    @include('afiliado.persona.modal')

                    @endforeach
                    
                </table>

            </div>

            {{$persona -> render()}}

        </div>

    </div>


@endsection
