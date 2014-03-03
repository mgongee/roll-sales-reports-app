$(document).ready(function(){
	
	// 'add entry' page form validation
	$('#add-new-sale').validate({ 
        rules: {
            site_address: {
                required: true,
            },
            builder: {
                required: true,
            },
            distributor: {
                required: true,
            },
            rebate_percentage: {
                required: false,
				digits: true,
            },
            rolls_sold: {
                required: true,
				digits: true,
            }
        }
    });
	
	
	// prepare deletion 
	$('[href=#popupConfirmDelete]').on('click',function (e) {
		// store parent of clicked button
		 idToDelete = $(this).attr('id').replace('delete-','');
		 trToDelete = $(this).parent().parent(); // row with the deleted element
	 });

	// confirm deletion
	$('#buttonDeleteConfirm').on('click',function(){
		$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'route=delete&id=' + idToDelete,
			beforeSend: function() {
				trToDelete.animate({'backgroundColor':'#fb6c6c'},300);
			},
			success: function() {
				trToDelete.slideUp(900,function() {
					trToDelete.remove();
				});
			}
		});
		$('#popupConfirmDelete').popup('close');
	});

	// delete button
	$("#dialog-confirm").click(function(e){
		var id = $(this).attr('id').replace('delete-','');
		e.preventDefault();
		var tr = $(this).parent('tr'); // row with the deleted element
	});
	
	
	// close confirmation dialog
	$("#buttonDeleteClose").click(function(){
		$( "#popupConfirmDelete" ).popup( "close" );
	});
	
	

});