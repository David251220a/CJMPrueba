@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <h3>Editar Afiliado: {{$persona->nombre}} {{$persona->apellido}}</h3>
            
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


    {{-- comment--}}
    
    {!! Form::model($persona, ['method'=>'PUT','route'=>['persona.update', $persona->idpersona]] ) !!}
    
    {{Form::token()}}
    
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="nombre" >Nombre Afiliado</label>
                <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre..">

            </div>
        </div>
    
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="apellido" >Apellido Afiliado</label>
                <input type="text" name="apellido" required value="{{$persona->apellido}}" class="form-control" placeholder="Apellido..">

            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="direccion" > Direccion</label>
                <input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="direccion..">

            </div>

        </div>
        

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="cedula" >Numero de Cedula</label>
                <input type="text" name="cedula" required value="{{$persona->cedula}}" class="form-control" placeholder="Numero de Cedula..">

            </div>

        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="telefono" >Telefono</label>
                <input type="text" name="telefono"  value="{{$persona->telefono}}" class="form-control" placeholder="Telefono..">

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="email" >Email</label>
                <input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="email..">

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

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                        <div class="form-group">

                            <label form="ptipo_aporte" >Tipo de Aporte</label>
                            <select name="ptipo_aporte" id="ptipo_aporte" class="form-control selectpicker"  data-live-search="true">

                                @foreach ($tipo_aporte as $apor)
                                    
                                    <option value="{{$apor->IdTipo_Aporte}}">{{$apor->Descripcion}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="psalario" >Salario</label>
                            <input type="number" name="psalario" id="psalario" class="form-control"
                            placeholder="Salario..">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="paporte" >Aporte</label>
                            <input type="number" name="paporte" id="paporte" class="form-control"
                            placeholder="Aporte...">
            
                        </div>
            
                    </div>

                </div>
                
                
                <div class="row">
                    
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="pprimeraasig" >Primera Asignacion</label>
                            <input type="number" name="pprimeraasig" id="pprimeraasig" class="form-control" 
                            placeholder="Primera Asignacion..">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="pdiferenciaasig" >Diferencia Asignacion</label>
                            <input type="number" name="pdiferenciaasig" id="pdiferenciaasig" class="form-control" 
                            placeholder="Diferencia Asignacion..">
            
                        </div>
            
                    </div>

                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

                        <div class="form-group">
            
                            <label form="prsa" >R.S.A.</label>
                            <input type="number" name="prsa" id="prsa" class="form-control" 
                            placeholder="RSA..">
            
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
                            <th>Tipo de Aporte</th>
                            <th>Salario</th>
                            <th>Aporte</th>
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

                        </tfoot>
                        
                        <tbody>
                            @php
                                $cont = 0;
                            @endphp                           
                           @foreach ($afiliado as $afi)
                            
                           <tr class="select" id="fila{{$cont}}"> 
                                <td> <button type="button" class="btn btn-warning" onclick="eliminar({{$cont}})">  X </button> </td>
                                <td> <input type="hidden" name="idtipo_aporte[{{$cont}}]" value="{{$afi->IdTipo_Aporte}}">{{$afi->Descripcion}}</td>
                                <td> <input type="number" name="salario[{{$cont}}]" value="{{$afi->Salario}}"></td>
                                <td> <input type="number" name="aporte[{{$cont}}]" value="{{$afi->Aporte}}"></td>
                                <td> <input type="number" name="primera_asignacion[{{$cont}}]" value="{{$afi->Primera_Asignacion}}" ></td>
                                <td> <input type="number" name="diferencia_asignacion[{{$cont}}]" value="{{$afi->Diferencia_Asignacion}}" ></td>
                                <td> <input type="number" name="rsa[{{$cont}}]" value="{{$afi->RSA}}" ></td>
                                <td hidden onClick=" iniciar()"> </td>
                                @php
                                $cont++;
                                @endphp
                           </tr>

                           @endforeach 

                        </tbody>
                    </table>

                </div>


            </div>
            <input name="cont" id="pcont" value="{{$cont}}"  type="hidden" >

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
 
        $("#ptipo_aporte").change(cambiarvalores);
       
        
        
        
        

        function cambiarvalores(){

            var opcion = document.getElementById("ptipo_aporte");
            var tipoaporte = opcion.options[opcion.selectedIndex].value;

            console.log(tipoaporte);

            if(tipoaporte == 2){

                document.getElementById("pprimeraasig").disabled = true;
                document.getElementById("pdiferenciaasig").disabled = true;
                document.getElementById("prsa").disabled = true;

                $("#pprimeraasig").val(0);
                $("#pdiferenciaasig").val(0);
                $("#prsa").val(0);

            }else{

                document.getElementById("pprimeraasig").disabled = false;
                document.getElementById("pdiferenciaasig").disabled = false;
                document.getElementById("prsa").disabled = false;
                $("#pprimeraasig").val(0);
                $("#pdiferenciaasig").val(0);
                $("#prsa").val(0);

            }

            
        }

        function agregar() {

            var opcion = document.getElementById("ptipo_aporte");
            var tipo_aporte = opcion.options[opcion.selectedIndex].text;
            var idtipo_aporte = opcion.options[opcion.selectedIndex].value;
            var salario = document.getElementById("psalario").value;
            var aporte = document.getElementById("paporte").value;
            var primera_asignacion = document.getElementById("pprimeraasig").value;
            var diferencia_asignacion = document.getElementById("pdiferenciaasig").value;
            var rsa = document.getElementById("prsa").value;
            var contador = document.getElementById("pcont").value;
            var cont=0;
            var X ='X';

            if (salario !="" && aporte!="" && primera_asignacion!="" && diferencia_asignacion!="" && rsa!="" ) {
                
                if (contador > 0) {
                    cont = (parseInt(contador) + 1);
                    console.log(cont);
                }else{
                    cont++;
                }


                var fila= '<tr class="select" id="fila'+ cont +'">' +
                    '<td> <button type="button" class="btn btn-warning" onclick="eliminar('+cont +')">' + X +'</button> </td>' +
                    '<td> <input type="hidden" name="idtipo_aporte[]" value="'+ idtipo_aporte +'">' + tipo_aporte + '</td>' +
                    '<td> <input type="number" name="salario[]" value="' + salario + '"> </td>'+
                    '<td> <input type="number" name="aporte[]" value="' + aporte + '"> </td>'+
                    '<td> <input type="number" name="primera_asignacion[]" value="' + primera_asignacion + '" ></td>'+
                    '<td> <input type="number" name="diferencia_asignacion[]" value="' + diferencia_asignacion + '" ></td>' +
                    '<td> <input type="number" name="rsa[]" value="' + rsa + '" ></td>' +
                    '</tr>';
                $('#detalles').append(fila);
                console.log(cont);
                Evaluar();
                Limpiar();

            }else{

                alert("Error al ingresar el detalle del ingreso, revise los datos del articulo.");

            }
        }

        function iniciar() {

            var opcion = document.getElementById("ptipo_aporte");
            var tipo_aporte = opcion.options[opcion.selectedIndex].text;
            var idtipo_aporte = opcion.options[opcion.selectedIndex].value;
            var salario = document.getElementById("psalario").value;
            var aporte = document.getElementById("paporte").value;
            var primera_asignacion = document.getElementById("pprimeraasig").value;
            var diferencia_asignacion = document.getElementById("pdiferenciaasig").value;
            var rsa = document.getElementById("prsa").value;

            if (salario !="" && aporte!="" && primera_asignacion!="" && diferencia_asignacion!="" && rsa!="" ) {
            
                var fila= '<tr class="select" id="fila'+ cont +'">' +
                    '<td> <button type="button" class="btn btn-warning" onclick="eliminar('+cont +')">' + X +'</button> </td>' +
                    '<td> <input type="hidden" name="idtipo_aporte[]" value="'+ idtipo_aporte +'">' + tipo_aporte + '</td>' +
                    '<td> <input type="number" name="salario[]" value="' + salario + '"> </td>'+
                    '<td> <input type="number" name="aporte[]" value="' + aporte + '"> </td>'+
                    '<td> <input type="number" name="primera_asignacion[]" value="' + primera_asignacion + '" ></td>'+
                    '<td> <input type="number" name="diferencia_asignacion[]" value="' + diferencia_asignacion + '" ></td>' +
                    '<td> <input type="number" name="rsa[]" value="' + rsa + '" ></td>' +
                    '</tr>';
                cont++;
                $('#detalles').append(fila);
                console.log(cont);
                Evaluar();
                Limpiar();

            }else{

                alert("Error al ingresar el detalle del ingreso, revise los datos del articulo.");

            }
        }

        function Limpiar() {
            
            $("#psalario").val("");
            $("#pprimeraasig").val("");
            $("#pdiferenciaasig").val("");
            $("#paporte").val("");
            $("#prsa").val("");
        }

        function eliminar(index) {
            
            document.getElementsByTagName("detalles")[index];
            $('#fila' +index).remove();
            index = index -1;
            $("#pcont").html(index);
            console.log(index);


            
        }

        function borrar(index) {
            
            $('#fila' +index).remove();
            
        }
        
        function Evaluar() {
        
            var salario = document.getElementById("psalario").value;
            var aporte = document.getElementById("paporte").value;

            sal = parseInt(salario);
            apor =  parseInt(aporte);

            if ( sal> 0 ) {
                
                if (apor > 0 ) {
                    $("#guardar").show();
                }else{
                    $("#guardar").hide();    
                }
                
                

            } else {

                $("#guardar").hide();
            
            }

        }


    </script>


    @endpush

@endsection