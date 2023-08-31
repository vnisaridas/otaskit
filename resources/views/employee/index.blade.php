@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>
                <div class="card-body">                	
                	<div class="d-flex justify-content-end bg-light mb-4">
                		<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EmployeeModal">Create</button>
                	</div>
                	<div class="table-responsive">
	                    <table class="table table-bordered">
	                    	<thead>
	                    		<tr>
	                    			<th>Name</th>
	                    			<th>Email</th>
	                    			<th>Mobile No</th>
	                    			<th>Department</th>
	                    			<th>Status</th>
	                    			<th>Action</th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
	                    		  @if(!empty($employees) && $employees->count())
                							@foreach($employees as $key => $value)
                								<tr>
                									<td>{{ $value->name }}</td>
                									<td>{{ $value->email }}</td>
                									<td>{{ $value->mobile }}</td>
                									<td>{{ $value->department }}</td>
                									<td>{{ $value->status }}</td>
                									<td>
                										<a class="btn btn-warning btn-sm update_employee" emp_id="{{ $value->id }}">Edit</a>
                										<a class="btn btn-danger btn-sm delete_employee" emp_id="{{ $value->id }}">Delete</a>
                									</td>
                								</tr>
                							@endforeach
                						@else
											<tr>
												<td colspan="6">There are no data.</td>
											</tr>
										@endif
	                    	</tbody>
	                    </table>
	                    <div class="d-flex justify-content-end bg-light">
	                    	{!! $employees->links() !!}
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('employee.form')
@include('employee.update')
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/employee.js') }}"></script>
@endpush
