@extends('layouts.admin')

@section('contenido')


@php  $total_Salario = 0 @endphp
@php  $total_Bonificacion = 0 @endphp
@php  $total_Aporte_Salario = 0 @endphp
@php  $total_Aporte_Bonificacion = 0 @endphp
@php  $totalPrimeraAsif = 0 @endphp
@php  $totalDiferenciaAsif = 0 @endphp
@php  $totalRSA = 0 @endphp
@php  $cantidad = 0 @endphp
@php  $Total_General = 0 @endphp


@php $total_Salario = $rendicion->Total_Salario  @endphp
@php $total_Bonificacion = $rendicion->Total_Salario_Bonificacion  @endphp
@php $total_Aporte_Salario = $rendicion->Total_Aporte_Personal  @endphp
@php $total_Aporte_Bonificacion = $rendicion->Total_Aporte_Bonificacion  @endphp
@php $totalDiferenciaAsif = $rendicion->Total_Diferencia_Asignacion  @endphp
@php $totalPrimeraAsif = $rendicion->Total_Primera_Asignacion  @endphp
@php $totalRSA = $rendicion->Total_RSA  @endphp



@php $Total_General = $total_Aporte_Salario + $total_Aporte_Bonificacion + $totalDiferenciaAsif + $totalPrimeraAsif +$totalRSA @endphp


    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <h3>Rendicion de Aporte con Fecha : {{date('d-m-Y', strtotime($rendicion->Fecha_Aporte))}}</h3>        

    </div>

    <div class="row">


        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="cantidad" >Cantidad de Funcionario</label>
                <input type="text" name="cantidad" value="{{number_format($rendicion->Cantidad_Persona, 0, ".", ".")}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_salario" >Total Salario </label>
                <input style="text-align:right;" type="text" name="total_salario" value="{{number_format($total_Salario, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_bonificacion" >Total Bonificacion </label>
                <input style="text-align:right;" type="text" name="total_bonificacion" value="{{number_format($total_Bonificacion, 0, ".", ".")}}" class="form-control" readonly >

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

                <label for="total_aporte_bonificacion" >Total Aporte Bonif. </label>
                <input style="text-align:right;" type="text" name="total_aporte_bonificacion" value="{{number_format($total_Aporte_Bonificacion, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>
    

    
    
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

            <div class="form-group">

                <label for="total_primera_asig" >Total Primera Asig. </label>
                <input style="text-align:right;" type="text" name="total_primera_asig" value="{{number_format($totalPrimeraAsif, 0, ".", ".")}}" class="form-control" readonly >

            </div>
            
        </div>
    
    </div> 
    
    <div class="row">
        
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
                    
                    <thead>
                        
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
                        @foreach ($aporte_afiliado as $ren)
                            <tr class="select" name="fila[]" id="fila{{$cont}}" >                                
                                <td style="text-align:right;">{{number_format($ren->Documento, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{$ren->Nombre}} , {{$ren->Apellido}}</td>                                                        
                                <td style="text-align:right;">{{number_format($ren->Salario, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->Salario_Bonificacion, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->Aporte_Salario, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->Aporte_Bonificacion, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->Primera_Asignacion, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->Diferencia_Asignacion, 0, ".", ".")}}</td>
                                <td style="text-align:right;">{{number_format($ren->RSA, 0, ".", ".")}}</td>
                                
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
            
            {{$aporte_afiliado-> render()}}

        </div>

    </div>

    <div class="row">

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">
            <a href="#">
                <button class="btn btn-info">PDF</button>
           </a>
            <button class="btn btn-danger"  onclick="history.back()">Atras</button>  
        </div>

        </div>    

    </div>

    @push('scripts')

    <script>
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

    </script>
    
        
    @endpush
   
@endsection