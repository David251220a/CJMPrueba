@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

        <h3>Planilla Mensual de la Fecha de : {{date('d-m-Y', strtotime($planilla->Fecha))}}</h3>
        @php
            $IdPlanilla = $planilla->IdPlanilla;
        @endphp
        <input type="hidden" name="total_rsa"  value="{{$IdPlanilla}}" id="Id" >
        </div>

    </div>

    <div class="row">


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="cantidad" >Cantidad de Afiliados</label>
                <input type="text" name="cantidad" value="{{$planilla->Cantidad}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_aporte" >Total Aporte </label>
                <input type="text" name="total_aporte" value="{{$planilla->TotalAporte}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_primera_asig" >Total Primera Asignacion </label>
                <input type="text" name="total_primera_asig" value="{{$planilla->TotalPrimera_Asignacion}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_diferencia_asig" >Total Diferencia Asignacion </label>
                <input type="text" name="total_diferencia_asig"  value="{{$planilla->TotalDiferencia_Asignacion}}" class="form-control" readonly >

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_rsa" >Total R.S.A. </label>
                <input type="text" name="total_rsa"  value="{{$planilla->TotalRSA}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_aporte_sinboni" >Total Aporte sin Bonificacion </label>
                <input type="text" name="total_aporte_sinboni" value="{{$planilla->TotalAporte_sinBonificacion}}" class="form-control" readonly>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="total_bonificacion" >Total Bonificacion </label>
                <input type="text" name="total_bonificacion" value="{{$planilla->TotalBonificacion}}" class="form-control" readonly >

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
               
                    @foreach ($planilla_detalle as $pla)
                        <tr class="select">
                            <td hidden><input type="hidden" id="idpersona" name="idpersona[]" value="{{$pla->idpersona}}" > </td>
                            <td><input type="text" id="cedula" name="cedula[]" value="{{$pla->cedula}}" readonly></td>
                            <td><input type="text" id="nombre" name="nombre[]" value="{{$pla->nombre}}" readonly></td>                    
                            <td><input type="text"  id="apellido" name="apellido[]" value="{{$pla->apellido}}" readonly></td>
                            <td><input type="hidden" name="idtipo_aporte[]" value="{{$pla->IdTipo_Aporte}}" >{{$pla->TipoAporte_Descripcion}}</td>
                            <td><input type="number" id="salario" name="salario[]" value="{{$pla->Salario}}" readonly></td>
                            <td><input type="number" id="aporte" name="aporte[]" value="{{$pla->Aporte}}" readonly></td>
                            <td><input type="number" id="primera_asig" name="primera_asig[]"  value="{{$pla->Primera_Asignacion}}" readonly></td>
                            <td><input type="number" id="diferencia_asig" name="diferencia_asig[]"  value="{{$pla->Diferencia_Asignacion}}" readonly></td>
                            <td><input type="number" id="rsa" name="rsa[]" value="{{$pla->RSA}}" readonly></td>
                            
                        </tr>
            
                    @endforeach
                    
                    
                </table>

            </div>
            {{$planilla_detalle-> render()}}

        </div>

    </div>
   
    

    <div class="row">

       
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">
            <a href="{{URL::action('PlanillaMensualPDF@Generar', $IdPlanilla)}}">
                <button class="btn btn-info">PDF</button>
           </a>
            <button class="btn btn-danger">Atras</button>  
        </div>

        </div>    

    </div>

    @push('scripts')

    <script>
        var opcion = document.getElementById("Id").value;
        console.log(opcion)
    </script>
    
        
    @endpush
   
@endsection