@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Listado de Funcionarios Inactivos</h3>
        @include('afiliado.personainactiva.search')
        
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
                        <th>N. Celular</th>                        
                        <th>Opciones</th>

                    </thead>
                                        
                    @foreach ($afiliado as $afi)
                    <tr>

                        <td>{{$afi->Documento}}</td>
                        <td>{{$afi->Nombre}}</td>
                        <td>{{$afi->Apellido}}</td>                    
                        <td>{{$afi->Celular}}</td>                        
                        <td>                                                       
                        <a href="" data-target="#modal-delete-{{$afi->Id_Afiliado_Insitucion}}" data-toggle="modal">
                            <button class="btn btn-success">Activar</button>
                        </a>
                           
                        </td>
                    </tr>

                    @include('afiliado.personainactiva.modal')

                    @endforeach
                    
                </table>

            </div>

            {{$afiliado -> render()}}

        </div>

    </div>


@endsection
