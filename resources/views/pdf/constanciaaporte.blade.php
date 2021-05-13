
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

<div class="rows">

    <div class="panel panel-primary">

        <div class="panel-body">
            
            <div class="rows">

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <h3 style="text-align: center">CAJA DE JUBILACIONES Y PENSIONES DEL PERSONAL MUNICIPAL</h3>
                    <br>
                    <h4 style="text-align: center"> CONSTANCIA DE APORTE</h4>                       

                </div>

            </div>

        </div>
    
    </div>

<div class="row">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <p style="border: ridge #0f0fef 1px;"> 
            <label form="nombre" > <h4> Afiliado :</h4></label></p>
            <br>
            <label> <h5> <b>{{$afiliado->Nombre}}, {{$afiliado->Apellido}} </b> </h5> </label>
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

        <div class="form-group">

            <label form="nombre" > <h4> Institucion Municipal :</h4></label>
            <br>
            
            {{number_format($afiliado_cabezera->Total_Diferencia_Asignacion,0, ".", ".")}}
        </div>
    
    </div>

</div>

    
