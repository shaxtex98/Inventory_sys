<!-- Modal -->
<script type="text/javascript">
  function AlpOnly(input){
    var regex = /[^a-z0-9 ]/gi;
    input.value = input.value.replace(regex,"");
  }
</script>
<div class="modal fade" id="form_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Updating Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="update_product_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="pid" id="pid" value=""/>
              <label for="added_date">Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date"value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group col-md-6">
              <label for="update_product">Product Name</label>
              <input type="text" onkeyup="AlpOnly(this)" class="form-control" name="update_product" id="update_product" placeholder="Enter New Product Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="select_cat">Category</label>
            <select class="form-control" name="select_cat" id="select_cat" required/>


          </select>
        </div>
        <div class="form-group">
          <label for="select_brand">Brand</label>
          <select class="form-control" name="select_brand" id="select_brand" required/>



        </select>
      </div>
      <div class="form-group">
        <label for="product_price">Product Price <small>PKR</small></label>
        <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter the Price">
      </div>
      <div class="form-group">
        <label for="product_qty">Quantity</label>
        <input type="text" class="form-control" name="product_qty" id="product_qty" placeholder="Enter the Quantity">
      </div>
      <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>