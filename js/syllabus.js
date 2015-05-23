'use strict';

/* Controllers */

var WecheckApp = angular.module('WecheckApp', []);

WecheckApp.controller('CourseListCtrl', function($scope, $http) {
  $http.get('/wecheck/index.php/main/syllabus_json').success(function(data) {
    $scope.wecheck = data;




  });
  $http.get('/wecheck/index.php/main/all_class_json').success(function(data) {
    $scope.clas = data;//clas就是class 防止跟系统重名




  });
  $http.get('/wecheck/index.php/main/all_course_json').success(function(data) {
    $scope.course = data;




  });


    

  $scope.add = function() {
  

 
 
  
    var class_id = $scope.customSelected.SelClass.class_id;
     var course_id = $scope.customSelected.SelCourse.CourseID;
    var time= $scope.customSelected.SelTime;
    var course_info;
    course_info= $scope.customSelected.Info;
    var class_name= $scope.customSelected.SelClass.class_name;
    var course_name= $scope.customSelected.SelCourse.CourseName;
    var times;
    if (time==1) {
      times='周一';
    }
    else if(time==2)
    {
      times='周二';
    }
    else if(time==3)
    {
      times='周三';
    }
    else if(time==4)
    {
      times='周四';
    }
    else if(time==5)
    {
      times='周五';
    }

    if (time==null || class_id==null || course_id==null ) 
    {
      alert('请填写完整再添加');
    }
    else
    {
    // var obj={time:time,class_id:class_id,course_id:course_id,course_info:course_info};
    // $scope.customSelected=null;//添加完后清空选项

     //alert('abc');
  
 $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/add_syllabus',

        data    : $.param({time:time,class_id:class_id,course_id:course_id,course_info:course_info}),  // pass in data as strings

        headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)

    })

        .success(function(data) {

           // console.log(data);

 

          alert(data.message);
          $scope.wecheck.push({class_name:class_name,course_name:course_name,time:times,syllabus_id:data.syllabus_id,course_info:course_info});
 
          // $scope.inputCourse=null;

        });
      }
      
  
}
  $scope.removeRow = function(name){       
    var index = -1;    
    var comArr = eval( $scope.wecheck );
    if (window.confirm("确认吗?")) {
    for( var i = 0; i < comArr.length; i++ ) {
      if(comArr[i].syllabus_id===name) {
        index = i;
        break;
      }
    }
    $http({

        method  : 'POST',

        url     : '/wecheck/index.php/main/delete_syllabus',

        data    : $.param({'syllabus_id':name}),  // pass in data as strings

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





