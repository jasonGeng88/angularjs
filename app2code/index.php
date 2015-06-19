<!DOCTYPE html>
<html ng-app>
<head>
	<title>APP二维码扫描</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="js/augular.min.js"></script> -->
	<script type="text/javascript" src="js/app.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<style type="text/css">
		body {  font-family: 微软雅黑;}
		table,tr{border:solid 1px #000;}
	</style>
</head>
<body>
	<?php include 'info.php'; ?>
	<?php 
		if (!empty($error)) {
			echo $error;
		}
	?>
	<form action="http://localhost/app2code/createcode.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="token" value="yb2f5L6qgpRZwQNNsiZYde8U9K3bqy4P_v2.0">
		<label>文件上传</label>
		<input type="file" name="file" id="file" accept=".apk,.ipa">
		<br />
		<input type="submit" name="uploadfile" value="提交" class="uploadfile" />
	</form>

	<ul id="myTab" class="nav nav-tabs">
	   <li class="active">
	      <a href="#andriod" data-toggle="tab">android</a>
	   </li>
	   <li><a href="#ios" data-toggle="tab">iOS</a></li>
	</ul>
	<div id="myTabContent" class="tab-content">
	   <div class="tab-pane fade in active" id="andriod">
	      <table>
			<thead style="background: beige;">
				<td width="200">创建日期</td>
				<td width="200">文件名</td>
				<td>二维码</td>
			</thead>
			<tbody style="background: aliceblue;">
		
		<?php 
			if (array_key_exists('android', $fileArr)) {
				foreach ($fileArr['android'] as $key => $value) {			
		?>	<tr>
			<td><?php echo $value['date']; ?></td>
			<td><?php echo $value['name'].$value['suffix']; ?></td>
			<td><a href="downloadApp/<?php		echo $value['code']; ?>">
			<img src="downloadApp/<?php		echo $value['code']; ?> 	">
			</a></td>
			</tr>
		<?php	} }?>
			</tbody>
			</table>
			</div>
			<div class="tab-pane fade" id="ios">
			<table>
			<thead style="background: beige;">
			<td width="200">创建日期</td>
			<td width="200">文件名</td>
			<td>二维码</td>
			</thead>
			<tbody style="background: aliceblue;">
		
		<?php 
			if (array_key_exists('ios', $fileArr)) {
				foreach ($fileArr['ios'] as $key => $value) {
		?>	<tr>
			<td><?php echo $value['date']; ?></td>
			<td><?php echo $value['name'].$value['suffix']; ?></td>
			<td><a href="downloadApp/<?php		echo $value['code']; ?>">
			<img src="downloadApp/<?php		echo $value['code']; ?> 	">
			</a></td>
			</tr>
		<?php	} } ?>
		
			</tbody>
		</table>
	   </div>
	</div>


	<!-- <table>
		<thead style="background: beige;">
			<td width="200">创建日期</td>
			<td width="200">文件名</td>
			<td>二维码</td>
		</thead>
		<tbody style="background: aliceblue;">
	<?php include 'info.php'; ?>
	<?php 
		foreach ($fileArr as $key => $value) {
	?>	<tr>
		<td><?php echo $value['date']; ?></td>
		<td><?php echo $value['name'].$value['suffix']; ?></td>
		<td><a href="downloadApp/<?php		echo $value['code']; ?>">
		<img src="downloadApp/<?php		echo $value['code']; ?> 	">
		</a></td>
		</tr>
	<?php	} ?>
	
		</tbody>
	</table> -->
</body>
</html>