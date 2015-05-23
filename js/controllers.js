'use strict';

/* Controllers */

var WecheckApp = angular.module('WecheckApp', ['ui.bootstrap']);

WecheckApp.controller('CourseListCtrl', function($scope, $http) {
  $http.get('/wecheck/index.php/main/all_json').success(function(data) {
    $scope.wecheck = data;



  });
//$scope.customSelected=$scope.SelClass.class_id;
 // $scope.orderProp = 'age';
// $scope.customSelected=$scope.SelClass;
   $scope.update = function (selectedValue) {
    $scope.level2 = selectedValue.course_name;
    $scope.statesWithFlags = selectedValue.student;
  
     //$scope.List={};
    }
$scope.updateLenth = function (selectedValue)
{
  $scope.lenth=selectedValue.CourseLenth;
}
    $scope.List=[];

   $scope.addForm = function(){

    var date=$scope.customSelected.SelDate;
    var class_id= $scope.customSelected.SelClass.class_id;
    var course_id= $scope.customSelected.SelArea.CourseID;
    var student_id=$scope.customSelected.student.StudentID;
    var reason=$scope.customSelected.reason;
    var student_name=$scope.customSelected.student.StudentName;
    var class_name=$scope.customSelected.SelClass.class_name;
    var course_name=$scope.customSelected.SelArea.CourseName;
    var lenth=$scope.lenth;
    if (date==null )
    {
      alert('请选择日期');
    }
    else if ( class_name==null)
    {
      alert('请选择班级');
    }
    else if ( course_name==null)
    {
      alert('请选择课程');
    }
    else if (student_name==null )
    {
      alert('请填写学生姓名');
    }
    else if ( reason==null)
    {
      alert('请选择原因');
    }
    else if (lenth==null ) 
    {
      alert('请填写节数');
    }
    else
    {
     $scope.List.push({date:date,class_id:class_id,course_id:course_id,student_id:student_id,reason:reason,student_name:student_name,class_name:class_name,course_name:course_name,lenth:lenth});
     $scope.customSelected.student=null;//添加完后清空学生姓名

    }
    
   }
   $scope.removeRow = function(name){       
    var index = -1;    
    var comArr = eval( $scope.List );
    if (window.confirm("确认吗?")) {
    for( var i = 0; i < comArr.length; i++ ) {
      if( comArr[i].student_name===name  ) {
        index = i;
        break;
      }
    }
    $scope.List.splice( index, 1 );    
  }

   
    
  };

   $scope.add = function() {
  
   
    var arrayObj=$scope.List;
    var aToStr=JSON.stringify(arrayObj); 
    if ($scope.List===null)
     {
      alert('还没添加数据');
     }
     else
     {

     
    $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/proccess',

        data    : aToStr,  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

 
           $scope.List=null;
           $scope.customSelected=null;
          alert(data.message);

        });
      }
      
 
}


});





