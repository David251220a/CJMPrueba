<div class="modal fade modal-slide-in-right" aria-hidden="true"
    role="dialog" tabindex="-1" id="modal-delete-{{$pla->IdPlanilla}}">

    {!! Form::open(array('action'=> array('PlanillaMensualController@destroy', $pla->IdPlanilla), 'method'=>'delete' ) ) !!}

    <div class="modal-dialog">
        
        <div class="modal-content">

            <div class="modal-header">

                <button  type="button" class="close" data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">x</span>

                </button>

                <h4 class="modal-title">Eliminar PLanilla</h4>

            </div>

            <div class="modale-body">

                <p>Confirme si desea Eliminar Planilla</p>


            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>

            </div>

        </div>

    </div>

    {!! Form::close() !!}

</div>