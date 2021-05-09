@extends('layouts.admin')

@section('contenido')

    @if (session()->has('msj'))
    <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
    @else
        
    @endif


    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h3>Nueva Planilla de Prestamo</h3>
            
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

    {!! Form::open(array('url'=>'prestamoplanilla/generar', 'method'=>'POST', 'autocomplete'=>'off','file'=>'true', 'enctype'=>"multipart/form-data"))!!}
    {{Form::token()}}


    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="form-group">

                <label for="IdInstitucion" >Institucion Municipal</label>
                <select name="IdInstitucion" id="IdInstitucion" class="form-control selectpicker" data-live-search="true" required>

                    @foreach ($persona as $per)
                        
                        <option value="{{$per->id}}">{{$per->name}}</option>

                    @endforeach

                </select>

            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="excel" >Seleccionar Archivo Excel</label>
                <input type="file" name="excel" class="form-control" required>

            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">
    
                <label for="fecha" >Seleccionar Fecha Planilla</label>
                <input type="date" name="fecha" class="form-control" value="31/01/2020" required>
    
            </div>
            
        </div>

    </div>


    

    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">

            <div class="form-group">

                <button class="btn btn-primary" type="submit">Enviar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>  
            </div>

        </div>    

    </div>
    
    {!! Form::close() !!}
   
@endsection