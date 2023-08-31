@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>
                <div class="card-body">            
                	<form>
            			<div class="row">
            				<div class="col-md-3">
            					<select class="form-select" name="employee_id">
            						<option value="">Select Employee</option>
            						@if(!empty($employees))
						    			@foreach($employees as $key => $value)
						    				<option value="{{ $value->id }}" {{ (isset($getdata['employee_id']) && $getdata['employee_id'] == $value->id) ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
						    			@endforeach
						    		@endif
            					</select>
            				</div>
            				<div class="col-md-3">
            					<select class="form-select" name="status">
            						<option value="">Select Status</option>
            						<option value="Unassigned" {{ (isset($getdata['status']) && $getdata['status'] == 'Unassigned') ? 'selected="selected"' : '' }}>Unassigned</option>
            						<option value="Assigned" {{ (isset($getdata['status']) && $getdata['status'] == 'Assigned') ? 'selected="selected"' : '' }}>Assigned</option>
						    		<option value="In Progress" {{ (isset($getdata['status']) && $getdata['status'] == 'In Progress') ? 'selected="selected"' : '' }}>In Progress</option>
						    		<option value="Done" {{ (isset($getdata['status']) && $getdata['status'] == 'Done') ? 'selected="selected"' : '' }}>Done</option>
            					</select>
            				</div>
            				<div class="col-md-3">
            					<button type="submit" class="btn btn-info btn-sm">Search</button>
            					<a href="{{ url('admin/task') }}" class="btn btn-warning btn-sm">Reset</a>
            				</div>
            			</div>
            		</form>    	
                	<div class="d-flex justify-content-end bg-light mb-4">                		
                		<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#TaskModal">Create</button>
                	</div>
                	<div class="table-responsive">
	                    <table class="table table-bordered">
	                    	<thead>
	                    		<tr>
	                    			<th>Title</th>
	                    			<th>Description</th>
	                    			<th>Status</th>
	                    			<th>Assignee</th>
	                    			<th>Action</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
                    		  @if(!empty($tasks) && $tasks->count())
	    							@foreach($tasks as $key => $value)
	    								<tr>
	    									<td>{{ $value->title }}</td>
	    									<td>{{ substr($value->description,0,50) }}[...]</td>
	    									<td>{{ $value->status }}</td>
	    									<td>{{ (isset($value->employee)) ? $value->employee->name : 'Not Assigned' }}</td>
	    									<td>
	    										<a class="btn btn-warning btn-sm update_task" task_id="{{ $value->id }}">Edit</a>
                								<a class="btn btn-danger btn-sm delete_task" task_id="{{ $value->id }}">Delete</a>
	    									</td>
	    								</tr>
	    							@endforeach
	    						@else
									<tr>
										<td colspan="5">There are no data.</td>
									</tr>
								@endif
	                    	</tbody>
	                    </table>
	                    <div class="d-flex justify-content-end bg-light">
	                    	{!! $tasks->links() !!}
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('task.form')
@include('task.update')
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/task.js') }}"></script>
@endpush
