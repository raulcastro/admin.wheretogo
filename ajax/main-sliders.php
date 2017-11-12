<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root.'/models/back/Media_Model.php');
require_once($root.'/models/back/Layout_Model.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';

switch ($_GET['option'])
{
// 	Upload 
	case 1:
		$model	= new Layout_Model();
		$data 	= $backend->loadBackend();
		
		$allowedExtensions = array("jpg", "JPG", "jpeg", "png");
		$sizeLimit 	= 20 * 1024 * 1024;
		
		$uploader 	= new Media_Model($allowedExtensions, $sizeLimit);
		
		$savePath 		= $root.'/media/sliders/original/';
		$medium 		= $root.'/media/sliders/resized/';
		$pre	  		= Tools::slugify($data['appInfo']['siteName']);
		$mediumWidth 	= 1200;
		
		if ($result = $uploader->handleUpload($savePath, $pre))
		{
			$uploader->getThumb($result['fileName']	, $savePath, $medium, $mediumWidth,
					'width', '');
		
			$newData = getimagesize($medium.$result['fileName']);
		
			$wp     = $newData[0];
			$hp     = $newData[1];
			
			$lastId = 0;
			
			if ($newData)
			{
				$lastId = $model->addSlider($result['fileName']);
			}
		
			$data  = array('success'=>true, 'fileName'=>$result['fileName'],
					'wp'=>$wp, 'hp'=>$hp, 'lastId'=>$lastId);
		
			echo htmlspecialchars(json_encode($data), ENT_NOQUOTES);
		}
	break;

// 	Crop
	case 2:
		$model	= new Media_Model();
		$data 	= $backend->loadBackend();
		
		if (!empty($_POST))
		{
			$dstWidth 		= 1200;
			$dstImageHeight = 674;
			
			$imgId = '';
			
			if (isset($_POST['imgId']))
			{
				$imgId = $_POST['imgId'];
			}
			
			
			$source 		= $root.'media/sliders/original/'.$imgId;
			$destination 	= $root.'media/sliders/front/'.$imgId;
			
			if ($model -> cropImage($_POST, $dstWidth, $dstImageHeight, $source, $destination))
			{
				if ($model->getThumb($imgId, $root.'media/sliders/front/', $root.'media/sliders/thumbnail/', 200, 'width', ''))
				{
					echo '1';
				}
				else
				{
					echo '0';
				}
			}
		}
	break;
	
	// 	Update
	case 3:
		$model	= new Layout_Model();
	
		if (!empty($_POST))
		{
			if ($model->editSliderInfo($_POST))
				echo 1;
			else 
				echo 0;
		}
	break;
	
	// 	Delete
	case 4:
		$model	= new Layout_Model();
	
		if (!empty($_POST))
		{
			if ($model->deleteSlider($_POST['sliderId']))
				echo 1;
		}
	break;
}
?>