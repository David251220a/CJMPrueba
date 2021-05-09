
<div class="rows">
    <h3 style="text-align: center">INSTITUCION DE : {{$planilla->name}}</h3>
    <h4 style="text-align: center"> PLANILLA MENSUAL DE APORTE CON FECHA DE: {{$planilla->FechaPlanilla}}</h4>

    <br>
</div>

<div class="rows">

    <div class="panel panel-primary">

        <div class="panel-body">
            
            <div class="rows">

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                    <div class="form-group">

                    <label for="text" >Total de Aporte : <b> {{$planilla->TotalAporte}} </b></label> 
                    

                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                    <div class="form-group">

                    <label for="text" >Cantidad de Persona : <b> {{$planilla->Cantidad}} </b></label> 
                    

                </div>
            </div>

        </div>
    
    </div>

    <div class="rows">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <table class="table table-striped">

                <thead style="background-color:#A9D0F5">

                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
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
                    <th></th>
                    <th></th>
                   
                </tfoot>

                <tbody>

                @foreach ($planilla_detalle as $pla)
                    <tr>
                        <td> {{$pla->cant}}</td>
                        <td> {{$pla->nombre}}</td>
                        <td> {{$pla->apellido}}"</td>
                        <td> {{$pla->TipoAporte_Descripcion}}"</td>
                        <td> {{$pla->Salario}}</td>
                        <td> {{$pla->Aporte}}"</td>
                        <td> {{$pla->Primera_Asignacion}}</td>
                        <td> {{$pla->Diferencia_Asignacion}}</td>
                        <td> {{$pla->RSA}}</td>
                    </tr>
                        

                    
                @endforeach                 

                </tbody>
            </table>
        </div>
        </div>
