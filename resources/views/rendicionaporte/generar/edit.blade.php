@extends('layouts.admin')

@section('contenido')

    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <h3>Editar Ingreso del  Afiliado: {{$persona->nombre}} {{$persona->apellido}}</h3>
            
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
    
    {!! Form::model($persona, ['method'=>'PUT','route'=>['generar.update', $persona->idpersona]] ) !!}
    
    {{Form::token()}}
    
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="nombre" >Nombre </label>
                <input type="text" name="nombre" disabled value="{{$persona->nombre}}" class="form-control" >

            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

            <div class="form-group">

                <label for="apellido" >Apellido</label>
                <input type="text" name="apellido" disabled value="{{$persona->apellido}}" class="form-control" >

            </div>
        </div>  

        
    </div>


    {!! Form::close() !!}
        


@endsection 