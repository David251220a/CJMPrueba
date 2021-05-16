@extends('layouts.admin')

@section('contenido')
@php  $total_Aporte = 0 @endphp
@php  $Aporte = 0 @endphp
@php  $DiferenciaAsif = 0 @endphp
@php  $PrimeraAsif = 0 @endphp
@php  $RSA = 0 @endphp


@foreach ($afiliado_constancia as $afi)

    @php $Aporte += $afi->Aporte_Personal  @endphp
    @php $DiferenciaAsif += $afi->Diferencia_Asignacion  @endphp
    @php $PrimeraAsif += $afi->Primera_Asignacion  @endphp
    @php $RSA += $afi->RSA  @endphp    
    @php $total_Aporte += ($afi->Aporte_Personal + $afi->Diferencia_Asignacion + $afi->Primera_Asignacion +$afi->RSA) @endphp    

@endforeach

<div class="panel-body">

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label form="nombre" > <h4> Afiliado :</h4></label>
                <br>
                <label> <h5> <b>{{$afiliado->Nombre}}, {{$afiliado->Apellido}} </b> </h5> </label>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label form="nombre" > <h4> Institucion Municipal :</h4></label>
                <br>
                <label> <h5> <b>{{$afiliado_cabezera->Grupo}} </b> </h5> </label>

            </div>
        
        </div>

    </div>


</div>

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
                    <th style="text-align: center">Antiguedad</th>                    

                </thead>
                {{-- Fin de la cabezera de la table es una fila --}}

                {{-- Realiza el bucle para mostrar todos los registro que
                    traer el controla categoria y crea y almacena las filas --}}
                                
                <tr style="vertical-align: middle ; text-align: center">
                    
                    <td>{{date('d-m-Y', strtotime($afiliado_cabezera->Fecha_Aporte_Ultimo))}}</td>                                            
                    <td>{{number_format($afiliado_cabezera->Total_Aporte_Personal,0, ".", ".")}}</td>                    
                    <td>{{number_format($afiliado_cabezera->Total_Primera_Asignacion,0, ".", ".")}}</td>
                    <td>{{number_format($afiliado_cabezera->Total_Diferencia_Asignacion,0, ".", ".")}}</td>
                    <td>{{number_format($afiliado_cabezera->Total_RSA_Deuda,0, ".", ".")}}</td>                    
                    <td>{{$afiliado_cabezera->Antiguedad_Año}} años y {{$afiliado_cabezera->Antiguedad_Mes}} meses.</td>
                   
                </tr>                            
                
            </table>

        </div>        

    </div>

</div>

<div class="panel-body">

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label form="nombre" > <h4> CONSTANCIA DE APORTE :</h4></label>
                <br>                
            </div>
        </div>


    </div>


</div>

<div class="rows">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                {{-- Cabecera de la tabla --}}
                
                <thead>
                    
                    <th style="text-align: center">Fecha Aporte</th>                                                
                    <th style="text-align: center">Aporte Personal</th>                    
                    <th style="text-align: center">Primera Asig.</th>
                    <th style="text-align: center">Diferencia Asig.</th>
                    <th style="text-align: center">RSA</th>
                    <th style="text-align: center">Tipo Operacion</th>                    

                </thead>
                {{-- Fin de la cabezera de la table es una fila --}}

                {{-- Realiza el bucle para mostrar todos los registro que
                    traer el controla categoria y crea y almacena las filas --}}
                                
                @foreach ($afiliado_constancia as $cons)
                    <tr style="vertical-align: middle ; text-align: center">
                                
                        <td>{{date('d-m-Y', strtotime($cons->Fecha_Aporte))}}</td>                                          
                        <td>{{number_format($cons->Aporte_Personal,0, ".", ".")}}</td>                    
                        <td>{{number_format($cons->Primera_Asignacion,0, ".", ".")}}</td>
                        <td>{{number_format($cons->Diferencia_Asignacion,0, ".", ".")}}</td>
                        <td>{{number_format($cons->RSA,0, ".", ".")}}</td>
                        <td>{{$cons->Desc_Tipo_Operacion}} </td>
                                   
                    </tr>
                @endforeach

                <tr style="vertical-align: middle ; text-align: center">
                    <td> <b> TOTALES </b> </td>                                            
                    <td> <b> {{number_format($Aporte,0, ".", ".")}} </b> </td>                    
                    <td> <b> {{number_format($PrimeraAsif,0, ".", ".")}} </b> </td>
                    <td> <b> {{number_format($DiferenciaAsif,0, ".", ".")}} </b> </td>
                    <td> <b> {{number_format($RSA,0, ".", ".")}} </b> </td>
                    <td> <b> {{number_format($total_Aporte,0, ".", ".")}} TOTAL GENERAL </b> </td>

                </tr>
            </table>

        </div>         

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