'use strict';

/* Controllers */

var WecheckApp = angular.module('WecheckApp', ['ui.bootstrap']);

WecheckApp.controller('ClassListCtrl', function($scope, $http) {
  $http.get('/wecheck/index.php/main/class_json').success(function(data) {
    $scope.wecheck = data;




  });

  $scope.add = function() {
  
  if ($scope.inputClass.Grade==null) 
  {
  	alert('请填写年级');
  }
  else if ($scope.inputClass.ClassName==null)
  {
  	alert('请填写班级');
  }
  else if ($scope.inputClass.Peoples==null) 
  {
  	alert('请填写人数');
  }
  else
  {
  
  
 $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/add_class',

        data    : $.param($scope.inputClass),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

 

          alert(data.message);
          $scope.wecheck.push(data.insert);
 
          $scope.inputClass=null;

        });
      }
  
}
  $scope.removeRow = function(name){       
    var index = -1;    
    var comArr = eval( $scope.wecheck );
    if (window.confirm("确认吗?")) {
    for( var i = 0; i < comArr.length; i++ ) {
      if(comArr[i].ClassID===name) {
        index = i;
        break;
      }
    }
    $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/delete_class',

        data    : $.param({'ClassID':name}),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

 

          alert(data.message);
         $scope.wecheck.splice( index, 1 ); 

        });
  
       
  }

   
    
  }

});





