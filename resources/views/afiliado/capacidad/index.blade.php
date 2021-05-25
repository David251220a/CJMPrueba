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


@php  $Aporte_Total_General = 0 @endphp
@php  $Prestamos_Total_General = 0 @endphp
@php  $Total_General_Deuda = 0 @endphp
@php  $Total_Disponible = 0 @endphp
@php  $Texto_Obserbacion = "" @endphp
@php  $existe_pedido = 0 @endphp

@if(empty($pedido_refinanciacion->Descripcion))
    
    @php  $Texto_Obserbacion = "Yo autorizo el refinanción de mis deudas(Activo o Moroso) con un total de #.###.### a un plazo de ## meses" @endphp
    @php  $existe_pedido = 0 @endphp

@else
    
    @php  $Texto_Obserbacion = $pedido_refinanciacion->Descripcion @endphp
    @php  $existe_pedido = 1 @endphp

@endif


@if(empty($aux_prestamo_morosidad->cant))

@else

    @foreach ($prestamo_morosidad as $pre_mor)

        @php $Monto_Cuota_Saldo += $pre_mor->Monto_Cuota_Saldo  @endphp
        @php $Monto_Cuota_Interes_Saldo += $pre_mor->Monto_Cuota_Interes_Saldo  @endphp
        @php $Monto_Cuota_Amortizacion_Saldo += $pre_mor->Monto_Cuota_Amortizacion_Saldo  @endphp
        @php $MontoCuota_Interes_Punitorio_Saldo += $pre_mor->MontoCuota_Interes_Punitorio_Saldo  @endphp
        @php $MontoCuota_Interes_Punitorio_Congelado += $pre_mor->MontoCuota_Interes_Punitorio_Congelado  @endphp
        @php $Monto_Cuota_Seguro_Saldo += $pre_mor->Monto_Cuota_Seguro_Saldo  @endphp
        @php $Monto_IVA += $pre_mor->IVA  @endphp
        
    @endforeach

@endif


@php $total_general = $Monto_Cuota_Interes_Saldo 
                    + $Monto_Cuota_Amortizacion_Saldo 
                    + $MontoCuota_Interes_Punitorio_Saldo 
                    + $MontoCuota_Interes_Punitorio_Congelado 
                    + $Monto_Cuota_Seguro_Saldo 
                    + $Monto_IVA                 
@endphp

@if(empty($aux_aporte->cant))

    @php
        
        $Aporte_Total_General =52628136

    @endphp 

@else

    @php  $Aporte_Total_General = $aporte->Total_Aporte_Personal 
                                + $aporte->Total_Primera_Asignacion 
                                + $aporte->Total_Diferencia_Asignacion 
                                + $aporte->Total_RSA_Deuda

    @endphp

@endif

@if(empty($aux_prestamo->cant))

@else

    @foreach ($prestamo as $pre)

        @php $Prestamos_Total_General += $pre->Monto_Amortizacion_Total_SaldoActual  @endphp

    @endforeach    

@endif

@php
    
    $Total_General_Deuda = $Prestamos_Total_General + $total_general    

@endphp

@php

    $Total_Disponible = $Aporte_Total_General -  $Total_General_Deuda

@endphp

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
                    <label> <h5> <b>{{$institucion_municipal->NombreInstitucionMunicipal}}</b> </h5> </label>

                </div>
            
            </div>

        </div>

    </div>

    @if(empty($aux_aporte->cant))

    @else

        <LEGEND><b> <i> <u><h3> TOTAL DE  APORTE</h3></u></i></b> </LEGEND>

        <div class="rows">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                <div class="table-responsive">
        
                    <table class="table table-striped table-bordered table-condensed table-hover">
        
                        {{-- Cabecera de la tabla --}}
                        
                        <thead>
                            
                            <th style="text-align: center">Fecha Ultimo Aporte</th>                                                
                            <th style="text-align: center">Total Aporte Personal</th>                    
                            <th style="text-align: center">Total Primera Asig.</th>
                            <th style="text-align: center">Total Diferencia Asig.</th>
                            <th style="text-align: center">Total RSA</th>
                            <th style="text-align: center">Total General</th>
                            <th style="text-align: center">Antiguedad</th>                    
        
                        </thead>                        
                                        
                        <tr style="vertical-align: middle ; text-align: center">
                            
                            <td>{{date('d-m-Y', strtotime($aporte->Fecha_Aporte_Ultimo))}}</td>                                            
                            <td>{{number_format($aporte->Total_Aporte_Personal,0, ".", ".")}}</td>                    
                            <td>{{number_format($aporte->Total_Primera_Asignacion,0, ".", ".")}}</td>
                            <td>{{number_format($aporte->Total_Diferencia_Asignacion,0, ".", ".")}}</td>
                            <td>{{number_format($aporte->Total_RSA_Deuda,0, ".", ".")}}</td>
                            <td>{{number_format($Aporte_Total_General,0, ".", ".")}}</td>
                            <td>{{$aporte->Antiguedad_Año}} años y {{$aporte->Antiguedad_Mes}} meses.</td>
                        
                        </tr>                            
                        
                    </table>
        
                </div>        
        
            </div>
    
        </div>
    
    @endif
    
    @if(empty($aux_prestamo->cant))

    @else
        <div class="rows">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                <FIELDSET>
        
                    <LEGEND><b> <i> <u><h3> PRESTAMOS ACTIVOS</h3></u></i></b> </LEGEND>
        
                    <div class="table-responsive">
        
                        <table id="detalles"  class="table table-striped table-bordered table-condensed table-hover">                            
                            
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
                                
                            @foreach ($prestamo as $cons)
        
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
        
                            <div class="col-md-12 text-center">
                                <ul class="pagination pagination-lg pager" id="developer_page"></ul>
                            </div>
                        </table>
        
                    </div>
        
                </FIELDSET>
        
            </div>
    
        </div>

    @endif

    @if(empty($aux_prestamo_morosidad->cant))

    @else
        
        <div class="rows">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
                <LEGEND><b> <i> <u><h3> MOROSIDAD</h3></u></i></b> </LEGEND>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-condensed table-hover">
                        
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

        
            </div>
    
        </div>

    @endif

    <div class="rows">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <LEGEND><b> <i> <u><h3> CAPACIDAD</h3></u></i></b> </LEGEND>            

        </div>

    </div>
    
    <div class="rows">
    
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
            <label> <h4> <b>Total Aporte: {{number_format($Aporte_Total_General,0, ".", ".")}}</b> </h4> </label>

        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
            <label> <h4> <b>Total Deuda + Prestamos: {{number_format($Total_General_Deuda,0, ".", ".")}}</b> </h4> </label>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
            <label> <h4> <b>Disponibilidad de Prestamos: {{number_format($Total_Disponible,0, ".", ".")}}</b> </h4> </label>

        </div>
    
    </div>

    <div class="rows">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                  
        
            <div class="checkbox">
                
                <label>
                    <input type="checkbox" id="prefinanciar" value="option1" onchange="showContent()">  Desea Autorizar una Refinanciación para su proxima Solicitud?
                </label>
            </div>
        
        </div>        

    </div>
    {!! Form::open(array('url'=>'afiliado/capacidad', 'method'=>'POST', 'autocomplete'=>'off'))!!}
    {{Form::token()}}    
    <div class="rows">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                  
    
            <div class="form-group green-border-focus">
                <label style="display:none;" id="pobserbacion1" for="exampleFormControlTextarea5">OBSERBACION</label>
                <textarea style="display:none;" class="form-control" name="pobserbacion" id="pobserbacion" rows="3" >{{$Texto_Obserbacion}}</textarea>
            </div>

            <input type="hidden" name="id_legajo" id="id_legajo"  value="{{$afiliado->Id_Legajo}}" class="form-control" >
            <input type="hidden" name="existe_pedido" id="existe_pedido"  value="{{$existe_pedido}}" class="form-control" >
    
        </div>
    </div>
    
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

        <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden" > 
            <button class="btn btn-primary" style="display: none;" id="pguardar" type="submit">Guardar</button>            

        </div>

    </div>    

    {!! Form::close() !!}

    @push('scripts')

    <script type="text/javascript">
            
        $(document).ready(function() {
            var dataTable = $('#detalles').dataTable({
                //$("#detalles_.dataTables_filter").hide();                
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",                    
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
                        
            });

            
            
        });

        function showContent() {
            var observacion = document.getElementById("pobserbacion");
            var observacion1 = document.getElementById("pobserbacion1");
            var check = document.getElementById("prefinanciar");
            var guardar = document.getElementById("pguardar");
            var existe_pedido = document.getElementById("existe_pedido").value;;
            

            if (check.checked) {
                
                if (existe_pedido == 1){
                    
                    observacion.style.display='block';
                    observacion1.style.display='block';
                    alert("Ya cuenta con solicitud de Refinancion.");

                }else{                                
                    observacion.style.display='block';
                    observacion1.style.display='block';
                    guardar.style.display='block';
                
                }  
                
            }else {

                observacion.style.display='none';
                observacion1.style.display='none';
                guardar.style.display='none';
            
            }
            
        }

    </script>


    @endpush

@endsection


