<div class="modal fade modal-slide-in-right" aria-hidden="true"
    role="dialog" tabindex="-1" id="modal-delete-{{$afi->Id_Afiliado_Institucion}}">

    {!! Form::open(array('action'=> array('apo_Afiliado_Inst_MunicController@destroy', $afi->Id_Afiliado_Institucion), 'method'=>'delete' ) ) !!}

    <div class="modal-dialog">
        
        <div class="modal-content">

            <div class="modal-header">

                <button  type="button" class="close" data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">x</span>

                </button>

                <h4 class="modal-title">Eliminar Funcionario</h4>

            </div>

            <div class="modale-body">

                <p>Confirme si desea Eliminar Funcionario</p>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>

            </div>

        </div>

    </div>

    {!! Form::close() !!}

</div>