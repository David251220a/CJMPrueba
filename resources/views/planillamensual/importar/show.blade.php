@extends('layouts.admin')

@section('contenido')

<div class="row">
        
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

    <h3>Planilla Mensual de la Fecha de : {{date('d/m/Y', strtotime($planilla->Fecha_Planilla))}}</h3>
    

</div>

<div class="row">


    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="cantidad" >Cantidad de Afiliados</label>
            <input type="text" name="cantidad" value="{{$planilla->Cantidad_Funcionario}}" class="form-control" readonly>

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_aporte" >Total Aporte </label>
            <input type="text" name="total_aporte" value="{{$planilla->Total_Aporte}}" class="form-control" readonly >

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_primera_asig" >Total Primera Asignacion </label>
            <input type="text" name="total_primera_asig" value="{{$planilla->Total_PrimeraAsig}}" class="form-control" readonly >

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_diferencia_asig" >Total Diferencia Asignacion </label>
            <input type="text" name="total_diferencia_asig"  value="{{$planilla->Total_DiferenciaAsig}}" class="form-control" readonly >

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_rsa" >Total R.S.A. </label>
            <input type="text" name="total_rsa"  value="{{$planilla->Total_RSA}}" class="form-control" readonly>

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_aporte_sinboni" >Total Aporte sin Bonificacion </label>
            <input type="text" name="total_aporte_sinboni" value="{{$planilla->Total_Aporte}}" class="form-control" readonly>

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_bonificacion" >Total Bonificacion </label>
            <input type="text" name="total_bonificacion" value="{{$planilla->Total_Bonificacion}}" class="form-control" readonly >

        </div>
        
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

        <div class="form-group">

            <label for="total_bonificacion" >Total General </label>
            <input type="text" name="total_bonificacion" value="{{$planilla->Total_General}}" class="form-control" readonly >

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
                        <td><input type="text" id="cedula" name="cedula[]" value="{{$pla->Cedula}}" readonly></td>
                        <td><input type="text" id="nombre" name="nombre[]" value="{{$pla->Nombre}}" readonly></td>                    
                        <td><input type="text"  id="apellido" name="apellido[]" value="{{$pla->Apellido}}" readonly></td>
                        <td><input type="hidden" name="idtipo_aporte[]" value="{{$pla->IdTipo_Aporte}}" >{{$pla->Tipo_Aporte_Descripcion}}</td>
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
        <a href="{{URL::action('PlanillaMensualPDF@GenerarImport', $planilla->IdItem)}}">
            <button class="btn btn-info">PDF</button>
       </a>
        <button class="btn btn-danger">Atras</button>  
    </div>

    </div>    

</div>
   
@endsection