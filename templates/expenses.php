<!-- Modal -->
<script type="text/javascript">
  function AlpsOnly(input)
  {
    var regex = /[^a-z0-9 ]/gi;
    input.value = input.value.replace(regex,"");
  }
  function loadFile(event)
  {
    var output=document.getElementById('output');
    output.src=URL.createObjectURL(event.target.files[0]);
    console.log(output);
  }
</script>
<div class="modal fade" id="form_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="expense_form" onsubmit="return false" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="exp_date">Date</label>
              <input type="text" class="form-control" name="exp_date" id="exp_date"value="<?php echo date("Y-m-d"); ?>" readonly><br/>
              <!-- <label class="form-check-label">Do you want Edit Date?</label><br/>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div> -->
            </div>
            <div class="form-group col-md-10">
              <label for="exp_type">Expense Type</label>
              <select class="form-control" name="exp_type" id="exp_type" />


            </select>
          </div>
          <div class="form-group col-md-10">
            <label for="exp_des">Expense Description</label>
            <input type="text" class="form-control" onkeyup="AlpsOnly(this)" name="exp_des" id="exp_des" placeholder="Enter Expense Description" >
          </div>
          <div class="form-group col-md-10">
            <label for="exp_qty">Expense Quantity</label>
            <input type="number" class="form-control" name="exp_quantity" id="exp_quantity" placeholder="Enter Expense Quantity" >
          </div>
          <div class="form-group col-md-10">
            <label for="exp_receipt">Expense Receipt</label>
            <input type="text" class="form-control" name="exp_receipt" id="exp_receipt" placeholder="Enter the Receipt No">
          </div>
          <!-- <div class="form-group col-md-10">
            <label for="exp_image">Expense Image</label><br/>
            <div><img src="" id="output" title="Expense Image" class="img-thumbnail"></div>
            <input type="file" name="exp_image" id="exp_image" accept="image/*" onchange="loadFile(event)">
          </div> -->
          <div class="form-group col-md-10">
            <label for="exp_amt">Expense Amount</label>
            <input type="text" class="form-control" name="exp_amt" id="exp_amt" placeholder="Enter the Amount">
          </div>
        </div>

        
        <button type="submit" class="btn btn-success" name="btn_add_expense">Add Expense</button>
      </form>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>