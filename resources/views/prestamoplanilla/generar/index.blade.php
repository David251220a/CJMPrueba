@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

            <h3>Generacion de Planillas de Prestamo  <a href="generar/create"> <button class="btn btn-success"> Nuevo </button></a></h3>
            
            
        </div>

    </div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th style="text-align: center">Fecha Planilla</th>                        
                        <th style="text-align: center ; width:50px; height:30">Total a Cobrar</th>
                        <th style="text-align: center">Total Cobrado</th>
                        <th style="text-align: center">Estado</th>
                        <th style="text-align: center">Opciones</th>

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                    
                    @foreach ($planilla as $pla)
                    <tr>

                        <td style="vertical-align: middle ; text-align: center">{{ date('d-m-Y', strtotime($pla->Fecha_Planilla))}}</td>                    
                        <td style="vertical-align: middle ; text-align: center">{{$pla->Total_A_Cobrar}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_Cobrado}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Estado}}</td>
                        <td style="vertical-align: middle ; text-align: center">
                        
                            <a href="{{URL::action('PrestamoPlanillaController@show',$pla->IdPrestamo_Planilla)}}">
                                 <button class="btn btn-info">Detalles</button>
                            </a>

                            <a href="" data-target="#modal-delete-{{$pla->IdPrestamo_Planilla}}" data-toggle="modal">
                                <button class="btn btn-danger">Borrar</button>
                           </a>

                        </td>
                    </tr>

                    @include('planillamensual.importar.modal')

                    @endforeach
                    
                </table>

            </div>

            {{$planilla-> render()}}

        </div>

    </div>
   
    

@endsection
