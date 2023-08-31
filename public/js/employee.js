$(document).ready(function(){

	$('#EmployeeModal').on('show.bs.modal', function (e) {
		$('#employee_register')[0].reset();
	});

	$('#employee_register').validate({
		submitHandler: function (form) {
			$.ajax({
				type:'POST',
				url:'employee',
				data:$('#employee_register').serialize(),
				dataType:'json',
				success:function(res){
					//console.log(res);
					if(res.status == 'success'){
						$('#EmployeeModal').modal('hide');
						window.location.reload();
					}
				},
				error:function(){
					$('#EmployeeModal').modal('hide');
				}
			});
		}
	});

	$('.delete_employee').click(function(){
		var employeeid = $(this).attr('emp_id');
		$.ajax({
			type:'DELETE',
			url:'employee/'+employeeid,
			data:{
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(){
				window.location.reload();
			}
		});

	});

	$('.update_employee').click(function(){
		var employeeid = $(this).attr('emp_id');
		$.ajax({
			type:'GET',
			url:'employee/'+employeeid,
			dataType:'json',
			success:function(res){
				$('#EmployeeUpdateModal').modal('show');
				$('#EmployeeUpdateModal #name').val(res.name);
				$('#EmployeeUpdateModal #email').val(res.email);
				$('#EmployeeUpdateModal #mobile').val(res.mobile);
				$('#EmployeeUpdateModal #department').val(res.department);
				$('#EmployeeUpdateModal #status').val(res.status);
				$('#EmployeeUpdateModal #empid').val(res.id);
			},
			error:function(){
				$('#EmployeeUpdateModal').modal('hide');
			}
		});
	});

	$('#employee_edit').validate({
		submitHandler: function (form) {
			var employeeid = $('#employee_edit #empid').val();
			$.ajax({
				type:'PATCH',
				url:'employee/'+employeeid,
				data:$('#employee_edit').serialize(),
				dataType:'json',
				success:function(res){
					//console.log(res);
					if(res.status == 'success'){
						$('#EmployeeUpdateModal').modal('hide');
						window.location.reload();
					}
				},
				error:function(){
					$('#EmployeeUpdateModal').modal('hide');
				}
			});
		}
	});
});