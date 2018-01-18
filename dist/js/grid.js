$(document).ready(function()
{
	var categoryId = $('#categoryId').val();
	var category = $('#category').val();
	
	$(".banner-uploader").uploadFile({
		url:"/ajax/categories-media.php?option=1",
		fileName:	"myfile",
		multiple: 	false,
		doneStr:		"Banner uploaded!",
		formData: {
			"categoryId":	categoryId,
			"categoryName": category
			},
		onSuccess:function(files, data, xhr)
		{
			obj 		= JSON.parse(data);
			widthLogo 	= obj.wp;
			heightLogo 	= obj.hp;
			imageLogo 	= obj.fileName;
			lastIdLogo 	= obj.lastId;
			
			var source = '/media/categories/banners-md/'+obj.fileName;
			$('#categoryBanner').attr('src', source);
		}
	});
});