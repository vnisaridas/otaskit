<!-- Modal -->
<div class="modal fade" id="TaskUpdateModal" tabindex="-1" aria-labelledby="TaskUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TaskUpdateModalLabel">Update Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="task_edit">
      @csrf
      <input type="hidden" id="taskid" name="id">
      <div class="modal-body">        
        	<div class="form-group mb-4">
					    <label for="Title">Title</label>
					    <input type="text" class="form-control" id="title" name="title" required="required">			    
					</div>
					<div class="form-group mb-4">
					    <label for="Email">Description</label>
					    <textarea class="form-control" name="description" id="description" required="required"></textarea>   
					</div>
					<div class="form-group mb-4">
					    <label for="Mobile No">Assignee</label>
					    <select class="form-select" name="employee_id" id="employee_id" required="required">
					    		<option value="">Select Employee</option>
					    		@if(!empty($employees))
					    			@foreach($employees as $key => $value)
					    				<option value="{{ $value->id }}">{{ $value->name }}</option>
					    			@endforeach
					    		@endif
					    </select>					    	    
					</div>   
					<div class="form-group mb-4">
					    <label for="Mobile No">Status</label>
					    <select class="form-select" name="status" id="status" required="required">
					    		<option value="Assigned">Assigned</option>
					    		<option value="In Progress">In Progress</option>
					    		<option value="Done">Done</option>
					    </select>					    	    
					</div>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary task_button">Update changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
