<div class="row" id="add-product-section" style="display:none;">
  <div class="col-md-12">
    <h3>Product Details</h3><hr>
  </div>
  
  <div class="col-md-12">
      <form method="POST" enctype="multipart/form-data" id="add-product-form">
      @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="" required>
            <br>
            <label for="sku_code">SKU Code:</label>
            <input type="text" id="sku_code" name="sku_code" value="" required>
            <br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" required>
            <button type="submit" class="btn btn-primary pull-right" >Save</button>
    
      </form>

  </div>
  <div class="col-md-12">
  <button type="button" class="btn btn-secondary pull-right" onclick="showProductSection1()">Cancel</button>
  </div> 
 
</div>
