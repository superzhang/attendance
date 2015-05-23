
<!DOCTYPE html>
<html lang="en" ng-app="WecheckApp">
<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href= "http://wx.8531.cn/weiqu/bootstrap/css/bootstrap.min.css"; media="screen">
    <link rel="stylesheet" href="http://wx.8531.cn/wecheck/css/main.css">

  <script src="http://wx.8531.cn/resource/js/angular-1.2.9/angular.js"></script>


  <script src="http://wx.8531.cn/wecheck/js/controllers.js"></script>


<script src="http://www.w3cschool.cc/try/bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
<script src="//wx.8531.cn/wecheck/js/ui-bootstrap-tpls-0.11.0.js"></script>

     <script type="text/javascript">



</script>
  <title>考勤系统</title>
 </head>
 <body >
      

  <div class="container" ng-controller="CourseListCtrl">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">考勤系统</h3>
      </div>
<form ng-submit="processForm()"> 
  <div class="span12" >
  <input class="input-medium" type="date" name="user_date" ng-model="customSelected.SelDate"/>
  <select class="span2" ng-model="SelClass" ng-options="Class.class for Class in wecheck" ng-change="update(SelClass)">
    <option class="input-medium" value="">请选择</option>
  </select >

     <select class="span2" ng-model="customSelected.SelArea" ng-options="SelClass.CourseName for  SelClass in level2" >
    <option value="">请选择</option>
  </select>
     

  </div>
  <div class="span6">
        
  <h4>Custom templates for results</h4>
    <pre>Model: {{customSelected | json}}</pre>
    <pre>Model:{{SelClass.ClassID}}</pre>>
    <input type="text" name="student_name" ng-model="customSelected.student" placeholder="Custom template" typeahead="state as state.StudentName for state in statesWithFlags | filter:$viewValue"  class="form-control">
   
      
           <input type="radio" name="identity" value="0" ng-model="customSelected.reason" />旷课
          <input type="radio" name="identity" value="1" ng-model="customSelected.reason" />迟到
          <input type="radio" name="identity" value="2" ng-model="customSelected.reason" />早退
          <input type="radio" name="identity" value="3" ng-model="customSelected.reason" />公假
          <input type="radio" name="identity" value="4" ng-model="customSelected.reason" />私假
          <button class="btn btn-primary">提交</button>
     



   
   </div>
   
    
         
<!--          <input id="getValue" value="GetValue" type="button" />
 -->     </div>
     </form>
 </body>
 </html>