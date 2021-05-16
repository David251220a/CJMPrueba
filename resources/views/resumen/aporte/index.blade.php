@extends('layouts.admin')

@section('contenido')

<div class="rows">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

        <h3>Resumen Cobros de Aportes</h3>
        <br>
        @include('resumen.aporte.search')           
        
    </div>

</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                {{-- Cabecera de la tabla --}}
                
                <thead>

                    <th>Departamento</th>
                    <th>Institución</th>
                    <th>Periodo Pago Personal</th>
                    <th>Periodo Pago Patronal</th>
                    <th>Total Salario</th>
                    <th>Total Personal</th>
                    <th>Total Patronal</th>
                    <th>Total Primera Asig.</th>
                    <th>Total Diferencia Asig.</th>
                    <th>Total RSA</th>
                    <th>Total Aporte</th>                    

                </thead>

                @foreach ($aporte as $apo)
                <tr>

                    <td>{{$apo->Id_Departamento}} - {{$apo->Desc_Departamento}}</td>
                    <td>{{$apo->Id_InstitucionMunicipal}} - {{$apo->NombreInstitucionMunicipal}}</td>
                    <td>{{$apo->Periodo_Aporte_Personal}}</td>                    
                    <td>{{$apo->Periodo_Aporte_Patronal}}</td>
                    <td>{{number_format($apo->Total_Salario,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_Aporte_Personal,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_Aporte_Patronal,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_Primera_Asignacion,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_Diferencia_Asignacion,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_RSA,0, ".", ".")}}</td>
                    <td>{{number_format($apo->Total_Aporte,0, ".", ".")}}</td>

                </tr>               

                @endforeach
                
            </table>

        </div>

        {{$aporte->render()}}

    </div>

</div>

@endsection
