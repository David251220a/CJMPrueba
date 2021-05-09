@extends('layouts.admin')

@section('contenido')

    <div class="rows">

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

            <h3>Generacion de Planillas Importadas  <a href="importar/create"> <button class="btn btn-success"> Nuevo </button></a></h3>
            
            
        </div>

    </div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th style="text-align: center">Fecha Planilla</th>                        
                        <th style="text-align: center ; width:50px; height:30">Cantidad Funcionario</th>
                        <th style="text-align: center">Aporte</th>
                        <th style="text-align: center">Bonficacion</th>
                        <th style="text-align: center ; width:90px; height:50px">T# Aporte</th>
                        <th style="text-align: center">T# Primera Asig</th>
                        <th style="text-align: center">T# Diferencia Asig</th>
                        <th style="text-align: center">T# RSA</th>
                        <th style="text-align: center">T# General</th>
                        <th style="text-align: center">Opciones</th>

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                    
                    @foreach ($planilla as $pla)
                    <tr>

                        <td style="vertical-align: middle ; text-align: center">{{ date('d-m-Y', strtotime($pla->Fecha_Planilla))}}</td>                    
                        <td style="vertical-align: middle ; text-align: center">{{$pla->Cantidad_Funcionario}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_Aporte}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_Bonificacion}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_General_Aporte}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_PrimeraAsig}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_DiferenciaAsig}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_RSA}}</td>
                        <td style="vertical-align: middle ; text-align: right">{{$pla->Total_General}}</td>
                        <td style="vertical-align: middle ; text-align: center">
                        
                         {{--   <a href="{{URL::action('PlanillaMensualPDF@Generar', $pla->IdPlanilla)}}">
                                <button class="btn btn-info">PDF</button>
                           </a>
                        --}}
                            <a href="{{URL::action('PlanillaMensualImportController@show',$pla->IdItem)}}">
                                 <button class="btn btn-info">Detalles</button>
                            </a>

                            <a href="" data-target="#modal-delete-{{$pla->IdItem}}" data-toggle="modal">
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
