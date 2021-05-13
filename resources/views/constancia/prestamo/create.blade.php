@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Afiliado</h3>
            
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

    {!! Form::open(array('url'=>'afiliado/persona', 'method'=>'POST', 'autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row">

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="cedula" >Numero de Cedula</label>
                <input type="text" name="cedula" required value="{{old('cedula')}}" class="form-control" placeholder="Numero de Cedula..">

            </div>

        </div>

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="nombre" >Nombre Afiliado</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..">

            </div>
        </div>
    
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="apellido" >Apellido Afiliado</label>
                <input type="text" name="apellido" required value="{{old('apellido')}}" class="form-control" placeholder="Apellido..">

            </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label form="departamento" >Departamento</label>
                <select name="departamento" id="departamento" class="form-control selectpicker"  data-live-search="true">

                    @foreach ($departamento as $dep)
                        
                        <option value="{{$dep->Id_Departamento}}">{{$dep->Desc_Departamento}}</option>

                    @endforeach

                </select>

            </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="ciudad" >Ciudad</label>
                <input type="text" name="ciudad"  value="{{old('ciudad')}}" class="form-control" placeholder="Ciudad..">

            </div>
            
        </div> 
        
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="barrio" >Barrio</label>
                <input type="text" name="barrio"  value="{{old('barrio')}}" class="form-control" placeholder="Barrio..">

            </div>
            
        </div> 

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label for="celular" >Telefono Movil</label>
                <input type="text" name="celular"  value="{{old('celular')}}" class="form-control" placeholder="Celular..">

            </div>
            
        </div> 
        
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

            <div class="form-group">

                <label form="sexo" >Sexo</label>
                <select name="sexo" id="sexo" class="form-control selectpicker"  data-live-search="true">                    
                        
                    <option value="1">MASCULINO</option>
                    <option value="2">FEMENINO</option>                                

                </select>

            </div>
        </div> 
  
        
    </div>
    
    <div class="row">

        <label > <h4 class="alert alert-info">Ingresar Ingresos</h4></label>

    </div>

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">
            
                <div class="row">

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="psalario" >Salario</label>
                            <input type="number" name="psalario" id="psalario" class="form-control"
                            placeholder="Salario..">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="psalario_bonficacion" > Salario Bonificacion</label>
                            <input type="number" name="psalario_bonficacion" id="psalario_bonficacion" class="form-control"
                            placeholder="Salario Bonficacion.." value="0">
            
                        </div>
            
                    </div>
                    

                </div>
                
                
                <div class="row">
                    
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="pprimeraasig" >Primera Asignacion</label>
                            <input type="number" name="pprimeraasig" id="pprimeraasig" class="form-control" 
                            placeholder="Primera Asignacion.." value="0">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="pdiferenciaasig" >Diferencia Asignacion</label>
                            <input type="number" name="pdiferenciaasig" id="pdiferenciaasig" class="form-control" 
                            placeholder="Diferencia Asignacion.." value="0">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="prsa" >R.S.A.</label>
                            <input type="number" name="prsa" id="prsa" class="form-control" 
                            placeholder="RSA.." value="0">
            
                        </div>
            
                    </div>

                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

                        <div class="form-group">
                            
                            <button type="button"  id="bt_add" class="btn btn-primary">Agregar</button>
                    
                        </div>
            
                    </div>

                </div>
                

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <table id="detalles" class="table table-striped table-condensed table-bordered table-hover">

                        <thead style="background-color:#A9D0F5">

                            <th>Opciones</th>
                            <th>Salario</th>
                            <th>Salario Bonif.</th>
                            <th>Aporte s/ Salario</th>
                            <th>Aporte s/ Bonif.</th>
                            <th>Primera Asignacion</th>
                            <th>Diferencia Aignacion</th>
                            <th>RSA</th>

                        </thead>

                        <tfoot>

                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tfoot>

                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

        <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden" > 
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>  

        </div>

    </div>    

    {!! Form::close() !!}
    
    @push('scripts')

    <script type="text/javascript">

        $(document).ready(function(){
            $("#bt_add").click(function(){
                agregar();
            });
            
        });
 
        $("#guardar").hide();
        //$("#ptipo_aporte").change(cambiarvalores);


        function agregar() {

            var opcion = document.getElementById("ptipo_aporte");                        
            var salario = document.getElementById("psalario").value;
            var salario_bonificacion = document.getElementById("psalario_bonficacion").value;
            var aporte_salario = Math.round(((salario * 10) /100));
            var aporte_bonficacion = Math.round(((salario_bonificacion * 10) /100));
            var primera_asignacion = document.getElementById("pprimeraasig").value;
            var diferencia_asignacion = document.getElementById("pdiferenciaasig").value;
            var rsa = document.getElementById("prsa").value;
            
            var cont = 0;
            var X = 'X';

            if (salario !="" && aporte_salario!="" && primera_asignacion!="" && diferencia_asignacion!="" && rsa!="" ) {
               
                var fila= '<tr class="select" id="fila'+ cont +'">' +
                    '<td> <button type="button" class="btn btn-warning" onclick="eliminar('+cont +')">' + X +'</button> </td>' +                    
                    '<td> <input type="number" name="salario[]" value="' + salario + '"> </td>'+
                    '<td> <input type="number" name="salario_bonificacion[]" value="' + salario_bonificacion + '"> </td>'+
                    '<td> <input type="number" name="aporte_salario[]" value="' + aporte_salario + '"> </td>'+
                    '<td> <input type="number" name="aporte_bonficacion[]" value="' + aporte_bonficacion + '"> </td>'+
                    '<td> <input type="number" name="primera_asignacion[]" value="' + primera_asignacion + '" ></td>'+
                    '<td> <input type="number" name="diferencia_asignacion[]" value="' + diferencia_asignacion + '" ></td>' +
                    '<td> <input type="number" name="rsa[]" value="' + rsa + '" ></td>' +
                    '</tr>';
                cont++;
                $('#detalles').append(fila);
                Evaluar();
                Limpiar();

            }else{

                alert("Error al ingresar el detalle del ingreso, revise los datos del articulo.");

            }
        }

        function Limpiar() {
            
            $("#psalario").val("");
            $("#psalario_bonficacion").val(0);            
            $("#pprimeraasig").val(0);
            $("#pdiferenciaasig").val(0);
            $("#prsa").val(0);
        }

        function eliminar(index) {
            
            $('#fila' +index).remove();
            $("#bt_add").show();
            
        }

        function Evaluar() {
        
            var salario = document.getElementById("psalario").value;            

            sal = parseInt(salario);            

            if ( sal> 0 ) {                            
                
                //$("#bt_add").show();
                //$("#guardar").hide();
                $("#bt_add").hide();
                $("#guardar").show();

            } else {
                
                //$("#bt_add").hide();
                //$("#guardar").show();
                $("#bt_add").show();
                $("#guardar").hide();
                
            }

        }


    </script>

    @endpush

@endsection