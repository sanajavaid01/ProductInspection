<!-- //editinspection -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Edit Product Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data" id="edit-product-form">
          @csrf
          <input type="hidden" class="form-control" id="update_p_id" name="update_p_id" value="" required>
          <div class="row">
          <div class="col-md-6">
          <label for="p_name">Name:</label>
            <input type="text" class="form-control" id="p_name" name="p_name" value="" required>
          </div>

          <div class="col-md-6">
          <label for="p_sku_code">SKU Code:</label>
            <input type="text"  class="form-control" id="p_sku_code" name="p_sku_code" value="" required readonly>
          </div>
          <br>

          <div class="col-md-6">
          <label for="p_image">Image:</label>
          <div class="file-upload-wrapper" data-text="Select your file!">
            <input type="file" id="p_image" class="file-upload-field" name="p_image" accept="image/x-png,image/gif,image/jpeg" required>

           
    </div>

          </div>

         
          </div>
<br>
          <div class="modal-footer">

        
          <button type="button" class="btn btn-danger " data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary " >Save</button>
      </div>

         
    
      </form>

  </div>

  

      </div>
     
    </div>
  </div>
</div>