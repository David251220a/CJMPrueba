@extends('layouts.admin')

@section('contenido')

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label form="nombre" > <h4> Nombre  Usuario:</h4></label>
                            <label><h5>{{ Auth::user()->name }}</h5> </label>
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                        <div class="form-group">

                            <label form="nombre" > <h4> Direccion :</h4></label>
                            <br>
                            <label><h5>{{$user_institucion->Direccion}}</h5> </label>

                        </div>
                    
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label form="nombre" > <h4> R.U.C :</h4></label>
                            <br>
                            <label><h5>{{$user_institucion->RUC}}</h5> </label>
                        </div>
                    </div>

                </div>


            </div>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            
            <FIELDSET>

                <LEGEND><b> <i> <u><h3> INSTITUCION MUNICIPAL</h3></u></i></b> </LEGEND>

                <div class="row">

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <label for=""> <h4> {{$user_institucion->NombreInstitucionMunicipal}} </h4></label>

                    </div>    
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <br><br>
                    
                    <div class="video-responsive" style="align-items: center">
                        <div style="text-align: center">
                            {{-- <iframe src="{{$contenido->Video}}" frameborder="0" allowfullscreen  width="560" height="315"></iframe> --}}
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/0SPK_QB0bhg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>    
                
                <div style="font-size: 2rem;">

                    <h4> <a href="https://www.youtube.com/channel/UCA-PBAR_V8GLAM7_TEIEPeA" target="_blank">
                    Visite Nuestra Pagina de YOUTUBE</a>  <i class="fa fa-youtube" aria-hidden="true"></i></h4>
                    <h4> 
                        <a href="https://www.facebook.com/CJPPMPY/" target="_blank">
                        Visite Nuestra Pagina de FACEBOOK</a> <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </h4>
                    
                    <h4> 
                        <a href="http://www.cjppm.gov.py/sobre-nosotros" target="_blank">
                        Visite Nuestra Pagina de WEB</a> <i class="fa fa-chrome" aria-hidden="true"></i> 
                    </h4>
                        

                </div>    

            </FIELDSET>   

        </div>

    </div>

    @push('scripts')

        <script type="text/javascript">

        </script>

    @endpush    


@endsection
