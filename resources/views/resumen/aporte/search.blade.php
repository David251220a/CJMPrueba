{!! Form::open(array('url'=>'resumen/aporte', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
    
    <div class="form-group">

        <div class="input-group">

        <input type="search" class="form-control" name="searchtext" placeholder="Buscar.." value="{{$searchtext}}">
        {{-- AGREGAR UN BOTON A LADO PARA QUE SE QUEDE MAS LINDO --}}
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar Insitución Municipal</button>
        </span>

        </div>

    </div>

{{Form::close() }}