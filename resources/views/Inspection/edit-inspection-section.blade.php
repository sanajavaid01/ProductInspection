<!-- //editinspection -->
<div class="modal fade" id="editInspectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Edit Inspection Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="form-inline">
            <label for="heading1">Heading:</label>
            <input type="text" id="heading1" name="heading1" value="" required>
            <input type="hidden" id="inspection_id" name="inspection_id" >
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="editInspectionDetails()">Edit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>