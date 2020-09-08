<!-- Modal -->
<script type="text/javascript">
  function lettersOnly(input){
    var regex = /[^a-z0-9 ]/gi;
    input.value = input.value.replace(regex,"");
  }
</script>

<div class="modal fade" id="form_edit_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Expense Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_exp_type_form" onsubmit="return false">
          <div class="form-group">
            <input type="hidden" name="eid" id="eid" value=""/>
            <label for="exp_type_input_up">Expense Type</label>
            <input type="text" class="form-control" onkeyup="lettersOnly(this)" name="exp_type_input_up" id="exp_type_input_up" placeholder="Enter Expense Type ">
            <small id="brand_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              <label for="exp_tu_date">Date</label>
              <input type="text" class="form-control" name="exp_tu_date" id="exp_tu_date"value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>