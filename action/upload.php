<?php
	/**
	* 二维码上传
	*/
	class uploadFile extends base
	{
		public function index(){
			$base=new base();
			// $postdata = file_get_contents("php://input");
			// $formData = json_decode($postdata);
			$serverip="192.168.40.252";
			// var_dump($_FILES['file']);die;
			if ($_FILES["file"]["error"] > 0)
			{
				// echo('Error: ' . $_FILES["file"]["error"]);die;
				$base->error('Error: ' . $_FILES["file"]["error"]);
			}
			else
			{
				//文件类型
				$type=substr(strrchr($_FILES["file"]["name"], '.'), 1);
				$type=strtolower($type);
				if ($type!='apk'&& $type!='ipa') {
					echo('上传类型错误！');
				}
				// echo($type);die;

				//文件大小
				$size=$_FILES["file"]["size"] / 1024;
				if ($size>2*1024) {
					$base->error('上传文件最大2M！');
				}
				//服务器文件名
				$len=strlen($_FILES["file"]["name"])-strlen($type)-1;
				//http
				$dir='../downloadApp';
				if ($type=='apk') {
					$name=substr($_FILES["file"]["name"], 0,$len).time().'android';
				} else if ($type=='ipa') {
					$name=substr($_FILES["file"]["name"], 0,$len).time().'ios';
				}
				$fileName=$dir.'/'.$name.'.'.$type;
				if (!file_exists($dir)) {
					mkdir($dir);
				}
				// echo($fileName);die;
				copy($_FILES["file"]["tmp_name"],$fileName);

				include('../extensions/phpqrcode.php');
				$data='http://'.$serverip.'\\angularPro\\downloadApp\\'.$name.'.'.$type;
				// echo($data);die;
				$pngname='http://'.$serverip.'\\angularPro\\downloadApp\\'.$name.'.png';
				// echo($pngname);die;	
				QRcode::png($data,$pngname,4,4,true);
				header('location: http://'.$serverip.'\\angularPro\\index.html');
			}
		}
	}

	/**
	 * 基础类
	 */
	class base
	{
		public function error($msg="操作失败！"){
			$serverip="192.168.40.252";
			$error=$msg;
	    	header('location: http://'.$serverip.'\\angularPro\\index.html');
		}
	}
	
	
?>