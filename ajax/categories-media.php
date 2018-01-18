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
		
		$savePath 		= $root.'/media/categories/banners/';
		$medium 		= $root.'/media/categories/banners-md/';
		$pre	  		= 'banner-'.Tools::slugify($_POST['categoryName']);
		$mediumWidth 	= 300;
		
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
				$model->updateCategoryBanner($_POST['categoryId'], $result['fileName']);
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
			$dstWidth = 300;
			$dstImageHeight = 150;
			 
			$source		 = $root.'/media/companies/original/'.$_POST['imgId'];
			$destination = $root.'/media/companies/logo/'.$_POST['imgId'];
			 
			if ($model -> cropImage($_POST, $dstWidth, $dstImageHeight, $source, $destination))
			{
					echo '1';
			}
			else
			{
				echo '0';
			}
		}
	break;
	
}
?>