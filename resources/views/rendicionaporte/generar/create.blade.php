@extends('layouts.admin')

@section('contenido')


@php  $total_Aporte_Salario = 0 @endphp
@php  $total_Aporte_Bonificacion = 0 @endphp
@php  $totalPrimeraAsif = 0 @endphp
@php  $totalDiferenciaAsif = 0 @endphp
@php  $totalRSA = 0 @endphp
@php  $cantidad = 0 @endphp
@php  $Total_General = 0 @endphp


@foreach ($rendicion as $ren)

    @php $total_Aporte_Salario += $ren->Aporte_Salario  @endphp
    @php $total_Aporte_Bonificacion += $ren->Aporte_Salario_Bonificacion  @endphp
    @php $totalDiferenciaAsif += $ren->Diferencia_Asignacion  @endphp
    @php $totalPrimeraAsif += $ren->Primera_Asignacion  @endphp
    @php $totalRSA += $ren->RSA  @endphp
    @php $cantidad +=  1  @endphp    

@endforeach

@php $Total_General = $total_Aporte_Salario + $total_Aporte_Bonificacion + $totalDiferenciaAsif + $totalPrimeraAsif +$totalRSA @endphp

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
            <a href="{{URL::action('apo_Afiliado_Inst_MunicController@index')}}"><button style='width:145px; height:50'  class="btn btn-info">Editar Afiliados</button></a>
        </div>

        </div>    

    </div>

    {!! Form::open(array('url'=>'rendicionaporte/generar', 'method'=>'POST', 'autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">

            <button class="btn btn-primary" type="submit">Enviar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>  
        </div>

        </div>    

    </div>    

    <div class="row">

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="fecha" >Fecha de Planilla </label>
                <input style="text-align:right;" type="date" name="fecha" class="form-control" value="2020-01-31">


            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="cantidad" >Cantidad de Afiliados</label>
                <input style="text-align:right;" type="text" name="cantidad" value="{{number_format($cantidad, 0, ".", ".")}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_aporte" >Total Aporte Salario </label>
                <input style="text-align:right;" type="text" name="total_aporte" value="{{number_format($total_Aporte_Salario, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_aporte" >Total Aporte Bonif. </label>
                <input style="text-align:right;" type="text" name="total_aporte" value="{{number_format($total_Aporte_Bonificacion, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_primera_asig" >Total Primera Asig. </label>
                <input style="text-align:right;" type="text" name="total_primera_asig" value="{{number_format($totalPrimeraAsif, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_diferencia_asig" >Total Diferencia Asig. </label>
                <input style="text-align:right;" type="text" name="total_diferencia_asig"  value="{{number_format($totalDiferenciaAsif, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_rsa" >Total R.S.A. </label>
                <input style="text-align:right;" type="text" name="total_rsa"  value="{{number_format($totalRSA, 0, ".", ".")}}" class="form-control" readonly>

            </div>
            
        </div>        

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_general" >Total General </label>
                <input style="text-align:right;" type="text" name="total_general" class="form-control" value="{{number_format($Total_General, 0, ".", ".")}}" readonly>


            </div>
            
        </div>

    </div>
    
    <div class="rows">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    {{-- Cabecera de la tabla --}}
                    
                    <thead style="background-color:#A9D0F5">

                        <th  hidden></th>
                        <th>Cedula de Identidad</th>
                        <th>Nombre y Apellido</th>                                                                 
                        <th>Salario</th>
                        <th>Salario Bonificacion</th>                        
                        <th>Aporte Salario</th>
                        <th>Aporte Bonficacion</th>
                        <th>Primera Asig</th>
                        <th>Diferencia Asig</th>
                        <th>RSA</th>                      

                    </thead>                    
                    
                    <tbody id="developers">
                        @php
                        $cont = 0;
                        @endphp
                        @foreach ($rendicion as $ren)
                            <tr class="select" id="fila{{$cont}}" >
                                <td hidden><input type="hidden" id="idpersona" name="idpersona[]" value="{{$ren->Id_Afiliado_Institucion}}" > </td>
                                <td style="text-align:right;"><input style="text-align:right;" type="text" id="cedula" name="cedula[]" value="{{$ren->Documento}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="text" id="nombre" name="nombre_apellido[]" value="{{$ren->Nombre}} , {{$ren->Apellido}}" readonly></td>                                                        
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="salario" name="salario[]" value="{{$ren->Salario}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="salario_bonificacion" name="salario_bonificacion[]" value="{{$ren->Salario_Bonificacion}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="aporte_salario" name="aporte_salario[]" value="{{$ren->Aporte_Salario}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="aporte_bonificacion" name="aporte_bonificacion[]" value="{{$ren->Aporte_Salario_Bonificacion}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="primera_asig" name="primera_asig[]"  value="{{$ren->Primera_Asignacion}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="diferencia_asig" name="diferencia_asig[]"  value="{{$ren->Diferencia_Asignacion}}" readonly></td>
                                <td style="text-align:right;"><input style="text-align:right;" type="number" id="rsa" name="rsa[]" value="{{$ren->RSA}}" readonly></td>
                                
                            </tr>
                            @php
                            $cont++;
                            @endphp
                            <input id="cont" name="cont" value="{{$cont}}" type="hidden"></td>
                        @endforeach
                    </tbody>
                    <div class="col-md-12 text-center">
                        <ul class="pagination pagination-lg pager" id="developer_page"></ul>
                        </div>
                    
                </table>

            </div>
            

        </div>

    </div>
   
    
    {!! Form::close() !!}
    @push('scripts')

    <script type="text/javascript">
    
        $(document).ready(function() {
            $('#developers').pageMe({
                pagerSelector: '#developer_page',
                showPrevNext: true,
                hidePageNumbers: false,
                perPage: 1
            });
        });
 

    </script>

    @endpush

@endsection