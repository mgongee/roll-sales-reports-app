$(document).ready(function(){
	
	// add entry page
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

});