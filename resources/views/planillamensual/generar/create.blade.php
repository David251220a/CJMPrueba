@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nueva Planilla</h3>
            
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    
                <ul>
                  @foreach ($errors->all() as $error)

                    <li>{{$error}}</li>
                      
                  @endforeach  
                </ul>

                </div>
                
            @endif
        
        </div>

    </div>

    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session()->has('msj'))
            
            <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
            
            @else
                
            @endif
        </div>
    </div>

    <div class="row">

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">
            <a href="{{URL::action('PersonaController@index')}}"><button style='width:145px; height:50'  class="btn btn-info">Editar Afiliados</button></a>
        </div>

        </div>    

    </div>

    {!! Form::open(array('url'=>'planillamensual/generar', 'method'=>'POST', 'autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">

            <button class="btn btn-primary" type="submit">Enviar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>  
        </div>

        </div>    

    </div>

    @php  $totalAporte = 0 @endphp
    @php  $totalBonificacion = 0 @endphp
    @php  $TotalAportesinBonificacion = 0 @endphp
    @php  $totalDiferenciaAsif = 0 @endphp
    @php  $totalPrimeraAsif = 0 @endphp
    @php  $totalRSA = 0 @endphp
    @php  $cantidad = 0 @endphp
    @php  $Total_General = 0 @endphp
    
    
    @foreach ($afiliado as $afi)

        @php $totalAporte += $afi->Aporte  @endphp
        @php $totalDiferenciaAsif += $afi->Diferencia_Asignacion  @endphp
        @php $totalPrimeraAsif += $afi->Primera_Asignacion  @endphp
        @php $totalRSA += $afi->RSA  @endphp
        @php $cantidad +=  1  @endphp
        @php $Total_General += ($afi->Aporte + $afi->Diferencia_Asignacion + $afi->Primera_Asignacion +$afi->RSA) @endphp
        @if ($afi->IdTipo_Aporte == 1)
            

            @php $TotalAportesinBonificacion += $afi->Aporte  @endphp

        @else
            
            @php $totalBonificacion += $afi->Aporte  @endphp

        @endif
    
    @endforeach

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="fecha" >Fecha de Planilla </label>
                <input type="date" name="fecha" class="form-control" value="2020-01-31">


            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="cantidad" >Cantidad de Afiliados</label>
                <input type="text" name="cantidad" value="{{$persona->cantidad}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_aporte" >Total Aporte </label>
                <input type="text" name="total_aporte" value="{{$totalAporte}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_primera_asig" >Total Primera Asignacion </label>
                <input type="text" name="total_primera_asig" value="{{$totalPrimeraAsif}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_diferencia_asig" >Total Diferencia Asignacion </label>
                <input type="text" name="total_diferencia_asig"  value="{{$totalDiferenciaAsif}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_rsa" >Total R.S.A. </label>
                <input type="text" name="total_rsa"  value="{{$totalRSA}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_aporte_sinboni" >Total Aporte sin Bonificacion </label>
                <input type="text" name="total_aporte_sinboni" value="{{$TotalAportesinBonificacion}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_bonificacion" >Total Bonificacion </label>
                <input type="text" name="total_bonificacion" value="{{$totalBonificacion}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_general" >Total General </label>
                <input type="number" name="total_general" class="form-control" value="{{$Total_General}}" readonly>


            </div>
            
        </div>

    </div>
    
    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead>

                        <th  hidden> Idpersona</th>
                        <th>Cedula de Identidad</th>
                        <th>Nombre</th>                        
                        <th>Apellido</th>
                        <th>Tipo de Aporte</th>
                        <th>Salario</th>
                        <th>Aporte</th>
                        <th>Primera Asig</th>
                        <th>Diferencia Asig</th>
                        <th>RSA</th>
                      

                    </thead>
                    {{-- Fin de la cabezera de la table es una fila --}}

                    {{-- Realiza el bucle para mostrar todos los registro que
                        traer el controla categoria y crea y almacena las filas --}}
                        @php
                        $cont = 0;
                        @endphp
                    @foreach ($afiliado as $afi)
                        <tr class="select" id="fila{{$cont}}" >
                            <td hidden><input type="hidden" id="idpersona" name="idpersona[]" value="{{$afi->idpersona}}" > </td>
                            <td><input type="text" id="cedula" name="cedula[]" value="{{$afi->cedula}}" readonly></td>
                            <td><input type="text" id="nombre" name="nombre[]" value="{{$afi->nombre}}" readonly></td>                    
                            <td><input type="text"  id="apellido" name="apellido[]" value="{{$afi->apellido}}" readonly></td>
                            <td><input type="hidden" name="idtipo_aporte[]" value="{{$afi->IdTipo_Aporte}}" >{{$afi->Descripcion}}</td>
                            <td><input type="number" id="salario" name="salario[]" value="{{$afi->Salario}}" readonly></td>
                            <td><input type="number" id="aporte" name="aporte[]" value="{{$afi->Aporte}}" readonly></td>
                            <td><input type="number" id="primera_asig" name="primera_asig[]"  value="{{$afi->Primera_Asignacion}}" readonly></td>
                            <td><input type="number" id="diferencia_asig" name="diferencia_asig[]"  value="{{$afi->Diferencia_Asignacion}}" readonly></td>
                            <td><input type="number" id="rsa" name="rsa[]" value="{{$afi->RSA}}" readonly></td>
                            
                        </tr>
                        @php
                        $cont++;
                        @endphp
                        <input id="cont" name="cont" value="{{$cont}}" type="hidden"></td>
                    @endforeach
                    
                    
                </table>

            </div>


        </div>

    </div>
   
    
    {!! Form::close() !!}

   
@endsection