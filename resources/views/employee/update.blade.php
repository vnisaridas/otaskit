<!-- Modal -->
<div class="modal fade" id="EmployeeUpdateModal" tabindex="-1" aria-labelledby="EmployeeUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EmployeeUpdateModalLabel">Update Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="employee_edit">
      @csrf
      <input type="hidden" id="empid" name="id">
      <div class="modal-body">        
        	<div class="form-group mb-4">
					    <label for="Name">Name</label>
					    <input type="text" class="form-control" id="name" name="name" required="required">			    
					</div>
					<div class="form-group mb-4">
					    <label for="Email">Email</label>
					    <input type="email" class="form-control" id="email" name="email" required="required">			    
					</div>
					<div class="form-group mb-4">
					    <label for="Mobile No">Mobile No</label>
					    <input type="text" class="form-control" id="mobile" name="mobile" required="required">			    
					</div>
					<div class="form-group mb-4">
					    <label for="Department">Department</label>
					    <select class="form-select" id="department" name="department" required="required">		
					    		<option>Sales</option>
					    		<option>Marketing</option>
					    		<option>IT</option>
					    </select>	    
					</div>
					<div class="form-group mb-4">
					    <label for="Status">Status</label>
					    <select class="form-select" id="status" name="status" required="required">		
						    	<option>Active</option>
						    	<option>Inactive</option>
					    </select>			    
					</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
