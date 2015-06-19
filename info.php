<?php
	$serverip="192.168.40.252";
	// $dir=$serverip.'\\app2code\\downloadApp';
	$dir='D:\\wamp\\www\\app2code\\downloadApp';
	$fileArr=array();
	if (is_dir($dir)) {
		$dirHandle=opendir($dir);
		$i=0;
		$curVersion="";
		$cur=0;
		while (false !== ($fileName= readdir($dirHandle))) {
			$subFile = $dir . DIRECTORY_SEPARATOR . $fileName; 
			if (is_file($subFile)) {
				$fileNameAll=substr($subFile, strrpos($subFile, DIRECTORY_SEPARATOR)+1);
				$suffix=substr($fileNameAll,strrpos($fileNameAll, '.'));
				if ($suffix=='.apk') {
					$fileArr['android'][$i]['name']=substr($fileNameAll,0,strlen($fileNameAll)-strlen($suffix));
					$fileArr['android'][$i]['suffix']=substr($fileNameAll,-strlen($suffix));
					$len=strlen($suffix)+10;
					$filetime=substr($fileArr['android'][$i]['name'], -10);

					$fileArr['android'][$i]['date']=date('Y-m-d H:i:s',$filetime);
					$fileArr['android'][$i]['code']=$fileArr['android'][$i]['name'].'.png';
					$fileArr['android'][$i]['type']='安卓';
					// if ($filetime>$cur) {
					// 	$cur=$filetime;
					// 	$curVersion=$fileArr['android'][$i]['name'];
					// }
					$i++;
				} else if ($suffix=='.ipa') {
					$fileArr['ios'][$i]['name']=substr($fileNameAll,0,strlen($fileNameAll)-strlen($suffix));
					$fileArr['ios'][$i]['suffix']=substr($fileNameAll,-strlen($suffix));
					$len=strlen($suffix)+10;
					$filetime=substr($fileArr['ios'][$i]['name'], -10);
					$fileArr['ios'][$i]['date']=date('Y-m-d H:i:s',$filetime);
					$fileArr['ios'][$i]['code']=$fileArr['ios'][$i]['name'].'.png';
					$fileArr['ios'][$i]['type']='安卓';
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
	$dateOrder=array();
	if (array_key_exists('android', $fileArr)) {
		foreach ($fileArr['android'] as $key => $value) {
			$dateOrder[$key]=$value['date'];
		}
		array_multisort($dateOrder,SORT_DESC,$fileArr['android']);
	}
	// var_dump($fileArr);die;
	if (array_key_exists('ios ', $fileArr) ) {
		$dateOrder=array();
		foreach ($fileArr['ios'] as $key => $value) {
			$dateOrder[$key]=$value['date'];
		}
		array_multisort($dateOrder,SORT_DESC,$fileArr['ios']);
	}
	
	
	
	return $fileArr;
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