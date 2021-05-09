@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Generacion de Planillas Realizadas  <a href="generar/create"> <button class="btn btn-success"> Nuevo </button></a></h3>
        
        
    </div>

</div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th>Id</th>
                        <th>Fecha Planilla</th>                        
                        <th>Cantidad</th>
                        <th>Total Aporte</th>
                        <th>Total Primera Asig</th>
                        <th>Total Diferencia Asig</th>
                        <th>Total RSA</th>
                        <th>Opciones</th>

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                    
                    @foreach ($planilla as $pla)
                    <tr style="vertical-align: middle ; text-align: center">

                        <td>{{$pla->IdPlanilla}}</td>
                        <td>{{date('d-m-Y', strtotime($pla->Fecha))}}</td>                    
                        <td>{{$pla->Cantidad}}</td>
                        <td>{{$pla->TotalAporte}}</td>
                        <td>{{$pla->TotalPrimera_Asignacion}}</td>
                        <td>{{$pla->TotalDiferencia_Asignacion}}</td>
                        <td>{{$pla->TotalRSA}}</td>
                        <td>
                         
                         {{--   <a href="{{URL::action('PlanillaMensualPDF@Generar', $pla->IdPlanilla)}}">
                                <button class="btn btn-info">PDF</button>
                           </a>
                        --}}
                            <a href="{{URL::action('PlanillaMensualController@show', $pla->IdPlanilla)}}">
                                 <button class="btn btn-info">Detalles</button>
                            </a>

                            <a href="" data-target="#modal-delete-{{$pla->IdPlanilla}}" data-toggle="modal">
                                <button class="btn btn-danger">Borrar</button>
                           </a>

                        </td>
                    </tr>

                    @include('planillamensual.generar.modal')

                    @endforeach
                    
                </table>

            </div>

            {{$planilla-> render()}}

        </div>

    </div>


@endsection
