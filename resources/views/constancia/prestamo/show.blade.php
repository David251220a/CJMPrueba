@extends('layouts.admin')

@section('contenido')

@php  $total_general = 0 @endphp
@php  $Monto_Cuota_Saldo = 0 @endphp
@php  $Monto_Cuota_Interes_Saldo = 0 @endphp
@php  $Monto_Cuota_Amortizacion_Saldo = 0 @endphp
@php  $MontoCuota_Interes_Punitorio_Saldo = 0 @endphp
@php  $MontoCuota_Interes_Punitorio_Congelado = 0 @endphp
@php  $Monto_Cuota_Seguro_Saldo = 0 @endphp
@php  $Monto_IVA = 0 @endphp


@if(empty($cont_prestamo_morosidad->cant) || $cont_prestamo_morosidad->cant == 0)

@else

    @foreach ($afiliado_prestamo_morosidad as $pre_mor)

        @php $Monto_Cuota_Saldo += $pre_mor->Monto_Cuota_Saldo  @endphp
        @php $Monto_Cuota_Interes_Saldo += $pre_mor->Monto_Cuota_Interes_Saldo  @endphp
        @php $Monto_Cuota_Amortizacion_Saldo += $pre_mor->Monto_Cuota_Amortizacion_Saldo  @endphp
        @php $MontoCuota_Interes_Punitorio_Saldo += $pre_mor->MontoCuota_Interes_Punitorio_Saldo  @endphp
        @php $MontoCuota_Interes_Punitorio_Congelado += $pre_mor->MontoCuota_Interes_Punitorio_Congelado  @endphp
        @php $Monto_Cuota_Seguro_Saldo += $pre_mor->Monto_Cuota_Seguro_Saldo  @endphp
        @php $Monto_IVA += $pre_mor->IVA  @endphp
        
    @endforeach

@endif


@php $total_general = $Monto_Cuota_Interes_Saldo + $Monto_Cuota_Amortizacion_Saldo + $MontoCuota_Interes_Punitorio_Saldo + $MontoCuota_Interes_Punitorio_Congelado + $Monto_Cuota_Seguro_Saldo + $Monto_IVA  @endphp

<div class="panel-body">

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label form="nombre" > <h4> Afiliado :</h4></label>
                <br>
                <label> <h4> <b>{{$afiliado->Nombre}}, {{$afiliado->Apellido}} </b> </h4> </label>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label form="nombre" > <h4> Institucion Municipal :</h4></label>
                <br>
                <label> <h5> <b> </b> </h5> </label>

            </div>
        
        </div>

    </div>

</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <FIELDSET>

            <LEGEND><b> <i> <u><h3> PRESTAMOS ACTIVOS</h3></u></i></b> </LEGEND>

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>
                        
                        <th style="text-align: center">Secuencia</th>
                        <th style="text-align: center">Cuota / Plazo</th>
                        <th style="text-align: center">Monto Prestamo</th>                    
                        <th style="text-align: center">Monto Cuota</th>
                        <th style="text-align: center">Fecha Ult/Generacion</th>
                        <th style="text-align: center">Saldo Actual</th>                    
                        <th style="text-align: center">Linea</th>
                        <th style="text-align: center">Dependencia</th>

                    </thead>                    
                        
                    @foreach ($afiliado_prestamo as $cons)

                        <tr style="vertical-align: middle ; text-align: center">
                    
                            <td>{{$cons->Secuencia}}</td>                         
                            <td>{{$cons->Cuota_Cobro_Ultimo}} / {{$cons->Plazo}}</td>                    
                            <td>{{number_format($cons->Monto_Prestamo,0, ".", ".")}}</td>
                            <td>{{number_format($cons->Monto_Cuota,0, ".", ".")}}</td>
                            <td>{{date('d-m-Y', strtotime($cons->Cuota_Fecha_Generacion_Ultima))}}</td>
                            <td>{{number_format($cons->Monto_Amortizacion_Total_SaldoActual, 0, ".", ".")}}</td>
                            <td>{{$cons->Desc_Producto}} </td>
                            <td>{{$cons->Id_Dependencia}} </td> 
                                    
                        </tr>
                        
                    @endforeach

                    
                </table>

            </div>

            @if(empty($cont_prestamo_morosidad->cant) || $cont_prestamo_morosidad->cant == 0)


            @else

                <LEGEND><b> <i> <u><h3> MOROSIDAD</h3></u></i></b> </LEGEND>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-condensed table-hover">

                        {{-- Cabecera de la tabla --}}
                        <thead>
                            
                            <th colspan="8" style="text-align: center" >TOTALES</th>

                        </thead>                    

                        <thead>
                            
                            <th style="text-align: center">Monto Cuota Saldo</th>
                            <th style="text-align: center">Monto Interes Saldo</th>
                            <th style="text-align: center">Monto Capital Saldo</th>                    
                            <th style="text-align: center">Monto Int. Punitorio Saldo</th>
                            <th style="text-align: center">Monto Int. Punitorio Congelado Saldo</th>
                            <th style="text-align: center">Monto Seguro Saldo</th>                    
                            <th style="text-align: center">Monto IVA</th>
                            <th style="text-align: center">Total General</th>

                        </thead>                    

                        <tr style="vertical-align: middle ; text-align: center">
                    
                            <td>{{number_format($Monto_Cuota_Saldo,0, ".", ".")}}</td>
                            <td>{{number_format($Monto_Cuota_Interes_Saldo,0, ".", ".")}}</td>
                            <td>{{number_format($Monto_Cuota_Amortizacion_Saldo,0, ".", ".")}}</td>
                            <td>{{number_format($MontoCuota_Interes_Punitorio_Saldo,0, ".", ".")}}</td>
                            <td>{{number_format($MontoCuota_Interes_Punitorio_Congelado,0, ".", ".")}}</td>
                            <td>{{number_format($Monto_Cuota_Seguro_Saldo,0, ".", ".")}}</td>
                            <td>{{number_format($Monto_IVA,0, ".", ".")}}</td>
                            <td>{{number_format($total_general,0, ".", ".")}}</td> 
                                    
                        </tr>                                               
                        
                    </table>

                </div>
            
            @endif

        </FIELDSET>

    </div>

</div>

<div class="row">
       
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">
        <a href="{{URL::action('PDFController@ConstanciaAporte', $afiliado->Id_Legajo)}}" target="_blank">
            <button class="btn btn-info">PDF</button>
        </a>
                
        <button class="btn btn-danger" onclick="history.back()">Atras</button>  

        {{--<input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">--}}

        </div>

    </div>    

</div>


@endsection
