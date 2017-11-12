function saveSliderData(sliderId)
{
	title 	= $('#sid-'+sliderId+' .slider-title').val();
	link 	= $('#sid-'+sliderId+' .slider-link').val();
	promos 	= $('#sid-'+sliderId+' .slider-promos').val();
	
    $.ajax({
        type:   'POST',
        url:    '/ajax/main-sliders.php?option=3',
        data:{  title: title,
                link: link,
                promos: promos,
                sliderId: sliderId
             },
        success:
        function(xml)
        {
        	if (0 != xml)
            {
            	bootbox.alert({
            	    message: "The info has been succesfully updated! =)",
            	    size: 'small',
            	    backdrop: true
            	});
            }
        }
    });
}

function deleteSlider(sliderId)
{
    $.ajax({
        type:   'POST',
        url:    '/ajax/main-sliders.php?option=4',
        data:{  
                sliderId: sliderId
             },
        success:
        function(xml)
        {
            if ('1' == xml)
            {
            	$('#sid-'+sliderId).fadeOut();
            }
        }
    });
}