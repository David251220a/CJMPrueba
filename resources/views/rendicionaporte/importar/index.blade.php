@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">

        <h3>Rendición de Aportes Realizadas <a href="importar/create"> <button class="btn btn-success"> Nueva Rendicion </button></a></h3>
                
    </div>

</div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>
                        
                        <th>Fecha Planilla</th>                                                
                        <th>Total Aporte</th>
                        <th>Total Aporte Bonif.</th>
                        <th>Total Primera Asig.</th>
                        <th>Total Diferencia Asig.</th>
                        <th>Total RSA</th>
                        <th>Situacion</th>
                        <th>Opciones</th>

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                    
                    @foreach ($rendicion_aporte as $ren)
                    <tr style="vertical-align: middle ; text-align: center">
                        
                        <td>{{date('d-m-Y', strtotime($ren->Fecha_Aporte))}}</td>                                            
                        <td>{{number_format($ren->Total_Aporte_Personal,0, ".", ".")}}</td>
                        <td>{{number_format($ren->Total_Aporte_Bonificacion,0, ".", ".")}}</td>
                        <td>{{number_format($ren->Total_Primera_Asignacion,0, ".", ".")}}</td>
                        <td>{{number_format($ren->Total_Diferencia_Asignacion,0, ".", ".")}}</td>
                        <td>{{number_format($ren->Total_RSA,0, ".", ".")}}</td>
                        <td>{{$ren->Desc_Situacion}}</td>
                        <td>
                         
                         {{--   <a href="{{URL::action('PlanillaMensualPDF@Generar', $pla->IdPlanilla)}}">
                                <button class="btn btn-info">PDF</button>
                           </a>
                        --}}
                            <a href="{{URL::action('apo_Rendicion_AporteController@show', $ren->Id_Rendicion)}}">
                                 <button class="btn btn-info">Detalles</button>
                            </a>
                            {{--   
                            <a href="" data-target="#modal-delete-{{$ren->IdPlanilla}}" data-toggle="modal">
                                <button class="btn btn-danger">Borrar</button>
                           </a>
                            --}}
                        </td>
                    </tr>

                    {{--   @include('planillamensual.generar.modal')--}}

                    @endforeach
                    
                </table>

            </div>

            {{$rendicion_aporte-> render()}}

        </div>

    </div>


@endsection
