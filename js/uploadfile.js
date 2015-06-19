app.controller('UploadController',function($scope,$http){ 
  // $scope.phones = [
  //   {"name": "Nexus S",
  //    "snippet": "Fast just got faster with Nexus S."},
  //   {"name": "Motorola XOOM™ with Wi-Fi",
  //    "snippet": "The Next, Next Generation tablet."},
  //   {"name": "MOTOROLA XOOM™",
  //    "snippet": "The Next, Next Generation tablet."}
  // ]; 
	$scope.uploadSubmit= function(){ 
		var form = {name:'x'};
		$http.post('action/index.php', form).
		success(function(data, status, headers, config) {
			$scope.phones=data;
		}).
		error(function(data, status, headers, config) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
			$scope.phones=headers;
			alert(222);
		}); 
	};  
	// $scope.uploadFinished=function(e,data){
	// 	console.log(111);
	// }

});  
