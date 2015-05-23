'use strict';

/* Controllers */

var WecheckApp = angular.module('WecheckApp', []);

WecheckApp.controller('CourseListCtrl', function($scope, $http) {
  $http.get('/wecheck/index.php/main/checklist_json').success(function(data) {
    $scope.wecheck = data;});
  $http.get('/wecheck/index.php/main/all_json').success(function(data) {
    $scope.optiondata = data;




  });
  $scope.update = function (selectedValue) {
    $scope.level2 = selectedValue.course_name;
  
     
    }
   $scope.customSelected=null;
$scope.search = function()
{
  var BeginDate=null;
  var EndDate=null;
  var ClassID=null;
  var CourseID=null;

if ($scope.customSelected.BeginDate!=null) {
    BeginDate=$scope.customSelected.BeginDate;
  }
  
if ($scope.customSelected.EndDate!=null) {
    EndDate=$scope.customSelected.EndDate;
  }
 if ($scope.customSelected.SelCourse!=null) {
      CourseID=$scope.customSelected.SelCourse.CourseID;
  }
  if ($scope.customSelected.SelClass!=null) {
    ClassID=$scope.customSelected.SelClass.class_id;
  }
  //alert($.param({'CourseID':CourseID,'ClassID':ClassID,'BeginDate':BeginDate,'EndDate':EndDate}));
  $http({

        method  : 'POST',

        url     : '/wecheck/index.php/checklist/search_checklist',

        data    : $.param({'CourseID':CourseID,'ClassID':ClassID,'BeginDate':BeginDate,'EndDate':EndDate}),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

          $scope.wecheck=data.array;

          //alert(data.message);
            });
      
         


}

  $scope.removeRow = function(ID){       
    var index = -1;    
    var comArr = eval( $scope.wecheck );
    if (window.confirm("确认吗?")) {
    for( var i = 0; i < comArr.length; i++ ) {
      if(comArr[i].CheckListID===ID) {
        index = i;
        break;
      }
    }
      $http({

        method  : 'POST',

        url     : '/wecheck/index.php/checklist/delete_checklist',

        data    : $.param({'CheckListID':ID}),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

       })

        .success(function(data) {

           // console.log(data);

 

          alert(data.message);
         $scope.wecheck.splice( index, 1 ); 

        });
 
       
      }

   
    
    }

    $scope.download = function() {
  
   
    var arrayObj=$scope.wecheck;
    var aToStr=JSON.stringify(arrayObj); 
   // alert(aToStr);
    if ($scope.wecheck===null)
     {
      alert('还没添加数据');
     }
     else
     {

     
      $http({

          method  : 'POST',

          url     : '/wecheck/index.php/exportexecl/importvalue',

          data    : aToStr,  // pass in data as strings

          headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

      })

          .success(function(data) {

             // console.log(data);

            alert('成功');

          });
      }
      
 
     }

});





