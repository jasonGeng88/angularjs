<?php
	$serverip="//192.168.1.105";
	// $dir=$serverip.'\\app2code\\downloadApp';
	// $dir='D:\\wamp\\www\\appcode\\downloadApp';
	$dir='/Users/jason-geng/Sites/web/angularPro/downloadApp';
	$fileAndroid=array();
	$fileIos=array();
	if (is_dir($dir)) {
		$dirHandle=opendir($dir);
		$i=0;
		$curVersion="";
		$cur=0;
		while (false !== ($fileName= readdir($dirHandle))) {
			$subFile = $dir . DIRECTORY_SEPARATOR . $fileName; 
			//去除linux隐藏文件
			$rule="/^[.][\s\S]*/";
			$match=preg_match($rule, $fileName);

			if (is_file($subFile) && $match==0) {
				$fileNameAll=substr($subFile, strrpos($subFile, DIRECTORY_SEPARATOR)+1);
				$suffix=substr($fileNameAll,strrpos($fileNameAll, '.'));
				if ($suffix=='.apk') {
					$fileAndroid[$i]['name']=substr($fileNameAll,0,strlen($fileNameAll)-strlen($suffix));
					$fileAndroid[$i]['suffix']=substr($fileNameAll,-strlen($suffix));
					// echo($fileAndroid[$i]['name']);die;
					$len=strlen($suffix)+10;
					$filetime=substr($fileAndroid[$i]['name'], -17,10);

					$fileAndroid[$i]['date']=date('Y-m-d H:i:s',$filetime);
					$fileAndroid[$i]['code']=$fileAndroid[$i]['name'].'.png';
					$fileAndroid[$i]['type']='安卓';
					// if ($filetime>$cur) {
					// 	$cur=$filetime;
					// 	$curVersion=$fileArr['android'][$i]['name'];
					// }
					$i++;
				} else if ($suffix=='.ipa') {
					$fileIos[$i]['name']=substr($fileNameAll,0,strlen($fileNameAll)-strlen($suffix));
					$fileIos[$i]['suffix']=substr($fileNameAll,-strlen($suffix));
					$len=strlen($suffix)+10;
					$filetime=substr($fileIos[$i]['name'], -13,10);
					$fileIos[$i]['date']=date('Y-m-d H:i:s',$filetime);
					$fileIos[$i]['code']=$fileIos[$i]['name'].'.png';
					$fileIos[$i]['type']='IOS';
					// if ($filetime>$cur) {
					// 	$cur=$filetime;
					// 	$curVersion=$fileArr[$i]['name'];
					// }
					$i++;
				}

			}
		}
		closedir($dirHandle);
	}
	if (!empty($fileAndroid)) {
		$dateOrder=array();
		foreach ($fileAndroid as $key => $value) {
			$dateOrder[$key]=$value['date'];
		}
		array_multisort($dateOrder,SORT_DESC,$fileAndroid);
	}
	if (!empty($fileIos)) {
		$dateOrder=array();
		foreach ($fileIos as $key => $value) {
			$dateOrder[$key]=$value['date'];
		}
		array_multisort($dateOrder,SORT_DESC,$fileIos);
	}
	$fileArr=array(
			"android"=>$fileAndroid,
			"ios"=>$fileIos
		);
	$res=json_encode($fileArr);
	echo($res);



	

	
	// return $fileArr;
	// $html="";
	// if (empty($fileArr) || count($fileArr)==0) {
	// 	$html='<p>没有任何安装包！</p>';
	// } else {
	// 	foreach ($fileArr as $key => $value) {
	// 		$html.='<p><a href="'+$dir+'\\'+$value['name']+'.png">';
	// 		$html.=$value['name'].$value['suffix'];
	// 		$html.='</a></p>';
	// 	}
	// }
	// echo htmlspecialchars($html);die;
	// echo "<<<EOT 
	// 	$html
	// EOT;";die;
	// echo( htmlspecialchars($html));