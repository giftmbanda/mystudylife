<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <p>Delete this user?</p>
      </div>
      <div class="modal-footer">
        {!! Form::button('Cancel', array('class' => 'btn btn-white waves-effect', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
        {!! Form::button('Confirm Delete', array('class' => 'btn btn-danger waves-effect', 'type' => 'button', 'id' => 'confirm' )) !!}
      </div>
    </div>
  </div>
</div>