<!-- Modal -->
<div class="modal fade" id="TaskModal" tabindex="-1" aria-labelledby="TaskModalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TaskModalModalLabel">Create Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="task_register">
      @csrf
      <div class="modal-body">        
        	<div class="form-group mb-4">
					    <label for="Title">Title</label>
					    <input type="text" class="form-control" id="title" name="title" required="required">			    
					</div>
					<div class="form-group mb-4">
					    <label for="Email">Description</label>
					    <textarea class="form-control" name="description" id="description" required="required"></textarea>   
					</div>										       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
