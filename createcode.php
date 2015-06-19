<?php
	$serverip="192.168.40.252";
	if ($_FILES["file"]["error"] > 0)
	{
		$error='Error: ' . $_FILES["file"]["error"];
		header('location: http://'.$serverip.'\\app2code\\index.php');
	}
	else
	{
		//文件类型
		$type=substr(strrchr($_FILES["file"]["name"], '.'), 1);
		$type=strtolower($type);
		if ($type!='apk'||$type!='ipa') {
			$error='上传类型错误！';
			header('location: http://'.$serverip.'\\app2code\\index.php');

		}
		//文件大小
		$size=$_FILES["file"]["size"] / 1024;
		if ($size>2*1024) {
			$error='上传文件最大2M！';
			header('location: http://'.$serverip.'\\app2code\\index.php');
		}
		//服务器文件名
		$len=strlen($_FILES["file"]["name"])-strlen($type)-1;
		//http
		$dir='downloadApp';
		if ($type=='apk') {
			$name=substr($_FILES["file"]["name"], 0,$len).time().'android';
		} else if ($type=='ipa') {
			$name=substr($_FILES["file"]["name"], 0,$len).time().'ios';
		}
		$fileName=$dir.'/'.$name.'.'.$type;
		if (!file_exists($dir)) {
			mkdir($dir);
		}
		copy($_FILES["file"]["tmp_name"],$fileName);

		include('extensions\\phpqrcode.php');
		$data='http://'.$serverip.'\\app2code\\'.$fileName;
		// echo($data);die;
		$pngname=$dir.'\\'.$name.'.png';
		QRcode::png($data,$pngname);
		header('location: http://'.$serverip.'\\app2code\\index.php');
		
	}
?>