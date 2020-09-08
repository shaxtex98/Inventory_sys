<!-- Modal -->
<script type="text/javascript">
  function AlphOnly(input)
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
<div class="modal fade" id="update_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="update_Expense_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="eid" id="eid" value=""/>
              <label for="exp_date">Date</label>
              <input type="text" class="form-control" name="exp_date" id="exp_date"value="<?php echo date("Y-m-d"); ?>" readonly><br/>
              <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION["id"]; ?>">
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
            <label for="update_exp_des">Expense Description</label>
            <input type="text" class="form-control" onkeyup="AlphOnly(this)" name="update_exp_des" id="update_exp_des" placeholder="Enter Expense Description" >
          </div>
          <div class="form-group col-md-10">
            <label for="update_exp_qty">Expense Quantity</label>
            <input type="number" class="form-control" name="update_exp_qty" id="update_exp_qty" placeholder="Enter Expense Quantity" >
          </div>
          <div class="form-group col-md-10">
            <label for="update_exp_receipt">Expense Receipt</label>
            <input type="text" class="form-control" name="update_exp_receipt" id="update_exp_receipt" placeholder="Enter the Receipt No">
          </div>
          <!-- <div class="form-group col-md-10">
            <label for="exp_image">Expense Image</label><br/>
            <div><img src="" id="output" title="Expense Image" class="img-thumbnail"></div>
            <input type="file" name="exp_image" id="exp_image" accept="image/*" onchange="loadFile(event)">
          </div> -->
          <div class="form-group col-md-10">
            <label for="update_exp_amt">Expense Amount</label>
            <input type="text" class="form-control" name="update_exp_amt" id="update_exp_amt" placeholder="Enter the Amount">
          </div>
        </div>

        
        <button type="submit" class="btn btn-primary" name="btn_add_expense">Add Expense</button>
      </form>
    </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>





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
              
            

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>