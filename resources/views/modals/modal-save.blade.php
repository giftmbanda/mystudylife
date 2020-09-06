<div class="modal fade modal-success modal-save" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ Lang::get('modals.confirm_modal_title_text') }} </h4>
      </div>
      <div class="modal-body">
        <p>{{ Lang::get('modals.confirm_modal_title_text') }} </p>
      </div>
      <div class="modal-footer">
        {!! Form::button('<i class="fa fa-fw '.Lang::get('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . Lang::get('modals.confirm_modal_button_cancel_text'), array('class' => 'btn btn-white waves-effect', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
        {!! Form::button('<i class="fa fa-fw '.Lang::get('modals.confirm_modal_button_save_icon').'" aria-hidden="true"></i> ' . Lang::get('modals.confirm_modal_button_save_text'), array('class' => 'btn waves-effect btn-success pull-right btn-flat', 'type' => 'button', 'id' => 'confirm' )) !!}
      </div>
    </div>
  </div>
</div>