app.controller('GetfileController',function($scope,$http){ 
	$scope.phones="asd";
	$scope.getfile=function(){
		alert(111);
		$http.get('action/getfiles.php').
		success(function(data, status, headers, config) {
			$scope.phones=data;
		}).
		error(function(data, status, headers, config) {
			$scope.phones=headers;
			alert(222);
		});
	};
	 
}); 