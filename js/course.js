'use strict';

/* Controllers */

var WecheckApp = angular.module('WecheckApp', []);

WecheckApp.controller('CourseListCtrl', function($scope, $http) {
  $http.get('/wecheck/index.php/main/course_json').success(function(data) {
    $scope.wecheck = data;




  });

  $scope.add = function() {
  
  if ($scope.inputCourse.CourseName==null) 
  {
  	alert('请填写课程名称');
  }
  else if ($scope.inputCourse.CourseLenth==null)
  {
  	alert('请填写周课时');
  }
 
  else
  {
  
  
 $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/add_course',

        data    : $.param($scope.inputCourse),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

 

          alert(data.message);
          $scope.wecheck.push(data.insert);
 
          $scope.inputCourse=null;

        });
      }
  
}
  $scope.removeRow = function(name){       
    var index = -1;    
    var comArr = eval( $scope.wecheck );
    if (window.confirm("确认吗?")) {
    for( var i = 0; i < comArr.length; i++ ) {
      if(comArr[i].CourseID===name) {
        index = i;
        break;
      }
    }
    $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/delete_course',

        data    : $.param({'CourseID':name}),  // pass in data as strings

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





