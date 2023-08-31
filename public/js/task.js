$(document).ready(function(){

	$('#TaskModal').on('show.bs.modal', function (e) {
		$('#task_register')[0].reset();
	});

	$('#task_register').validate({
		submitHandler: function (form) {
			$.ajax({
				type:'POST',
				url:'task',
				data:$('#task_register').serialize(),
				dataType:'json',
				success:function(res){
					//console.log(res);
					if(res.status == 'success'){
						$('#TaskModal').modal('hide');
						//window.location.reload();
					}
				},
				error:function(){
					$('#TaskModal').modal('hide');
				}
			});
		}
	});

	$('.delete_task').click(function(){
		var taskid = $(this).attr('task_id');
		$.ajax({
			type:'DELETE',
			url:'task/'+taskid,
			data:{
				'_token': $('meta[name="csrf-token"]').attr('content')
			},
			success:function(){
				window.location.reload();
			}
		});

	});

	$('.update_task').click(function(){
		var taskid = $(this).attr('task_id');
		$.ajax({
			type:'GET',
			url:'task/'+taskid,
			dataType:'json',
			success:function(res){
				$('#TaskUpdateModal').modal('show');
				$('#TaskUpdateModal #title').val(res.title);
				$('#TaskUpdateModal #description').val(res.description);
				$('#TaskUpdateModal #taskid').val(res.id);
				$('#TaskUpdateModal #employee_id').val(res.employee_id);				
				if(res.status == 'In Progress'){
					$('#TaskUpdateModal #employee_id').parent().remove();
					$('#TaskUpdateModal form').append('<input type="hidden" name="employee_id" value="'+res.employee_id+'" />');
				}
				if(res.status == 'Done'){
					$('#TaskUpdateModal .task_button').addClass('disabled');	
				}
				if(res.status != 'Unassigned'){
					$('#TaskUpdateModal #status').val(res.status);
				}
			},
			error:function(){
				$('#TaskUpdateModal').modal('hide');
			}
		});
	});

	$('#task_edit').validate({
		submitHandler: function (form) {
			var employeeid = $('#task_edit #taskid').val();
			$.ajax({
				type:'PATCH',
				url:'task/'+employeeid,
				data:$('#task_edit').serialize(),
				dataType:'json',
				success:function(res){
					//console.log(res);
					if(res.status == 'success'){
						$('#TaskUpdateModal').modal('hide');
						//window.location.reload();
					}
				},
				error:function(){
					$('#TaskUpdateModal').modal('hide');
				}
			});
		}
	});

});