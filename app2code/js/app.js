// angular.module('ui.bootstrap.demo', ['ui.bootstrap']);
// angular.module('ui.bootstrap.demo').controller('PopoverDemoCtrl', function ($scope) {
//   $scope.dynamicPopover = {
//     content: 'Hello, World!',
//     templateUrl: 'myPopoverTemplate.html',
//     title: 'Title'
//   };
// });
$( document ).ready( function(){
	$(".submit").click(function(){
		  	alert(111);

		var token="yb2f5L6qgpRZwQNNsiZYde8U9K3bqy4P_v2.0";
		$.ajax({
		  type: 'POST',
		  url: "http://localhost/webService/Api/Uploadfile",
		  data: {"token":token},
		  success: function(data){
		  	alert(111);
		  	alert(data);
		  }
		  // dataType: "xml";
		});
	})
	
} );

// function fileChange(target){
// 	alert(11);
// 	var fileSize=target.files[0].size;
// 	var size=fileSize/1024;
// 	if (size > 100) {
// 		alert("文件不能大于2M");
// 		target.value="";
//         return;
// 	};
// 	// file
// }