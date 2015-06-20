app.controller('GetfileController',function($scope,$http){ 
	$scope.phones="asd";
	$http.get('action/getfiles.php').
		success(function(data, status, headers, config) {
			$scope.ss=data;
			$scope.android=data.android;
			$scope.ios=data.ios;
		}).
		error(function(data, status, headers, config) {
			$scope.files=data;
		});
	$scope.getfile=function(){
		alert(111);
		
	};
	 
}); 