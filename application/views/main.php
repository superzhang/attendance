
<!DOCTYPE html>
<html lang="en" ng-app="WecheckApp">
<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href= "/wecheck/css/bootstrap.min.css"; media="screen">
   <link rel="stylesheet" href= "/weiqu/resource/css/styles.css"; media="screen">

    <link rel="stylesheet" href="/wecheck/css/main.css">

  <script src="/resource/js/angular-1.2.9/angular.js"></script>


  <script src="/wecheck/js/controllers.js"></script>


<script src="http://www.w3cschool.cc/try/bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
<script src="/wecheck/js/ui-bootstrap-tpls-0.11.0.js"></script>

     <script type="text/javascript">



</script>
  <title>考勤系统</title>
 </head>
 <body >
      

  <div class="container" ng-controller="CourseListCtrl">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">首页</a></li>
          <li><a href="main/manager_class">班级管理</a></li>
          <li><a href="#">课程管理</a></li>
        </ul>
        <h3 class="text-muted">考勤系统</h3>
      </div>
     
       
  
<form ng-submit="addForm()" class="form-inline"> 
 
    <div class="form-group">
<!--  <input type="text"  name="user_date" ng-model="customSelected.SelDate">
 -->
 <input type="date" class="form-control" name="user_date" ng-model="customSelected.SelDate">
</div>
<div class="form-group">
  <select class="form-control" ng-model="customSelected.SelClass" ng-options="Class.class_name for Class in wecheck" ng-change="update(customSelected.SelClass)">
    <option class="input-medium" value="">-------请选择班级-------</option>
  </select >
</div>
<div class="form-group">
     <select class="form-control"  ng-model="customSelected.SelArea" ng-options="SelClass.CourseName for  SelClass in level2" >
    <option class="input-medium" value="">-------请选择课程--------</option>
  </select>
     

  
</div>

 
    
  
    
   <div class="form-group">
    
    <input type="text" name="student_name" ng-model="customSelected.student" placeholder="输入学生姓名" typeahead="state as state.StudentName for state in statesWithFlags | filter:$viewValue"  class="form-control">
   </div>
    <div class="form-group">
            
          
          <button class="btn "  >添加</button>
        
   </div>
   <div class="form-group">
<label class="radio-inline">
  
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="旷课" ng-model="customSelected.reason"> 旷课

</label>

<input class="form-control input-sm " style="width:30px" type="text" placeholder="2">节

<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="迟到" ng-model="customSelected.reason"> 迟到
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="早退" ng-model="customSelected.reason"> 早退
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="公假" ng-model="customSelected.reason"> 公假
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="私假" ng-model="customSelected.reason"> 私假
</label>
         

     



   
   
   </div>
    
    <!--  <pre>Model:{{customSelected | json}}</pre> -->
         
<!--          <input id="getValue" value="GetValue" type="button" />
 -->     
     </form>
     <div class="span6">
   <!--   <pre>Model:{{List | json}}</pre>   -->
     <table class="table" ng-model="List">
  <tr>
    <th>日期
    </th>
    <th>学号
    </th>
    <th>姓名
    </th>
    <th>
      班级
    </th>
    <th>
      课程
    </th>
        <th>原因
    </th>
  </tr>
  <tr ng-repeat=" list in List">
    <td>{{list.date}}
    </td>
    <td>{{list.student_id}}
    </td>
    <td>{{list.student_name}}
    </td>
    <td>
      {{list.class_name}}
    </td>
    <td>
      {{list.course_name}}
    </td>
    <td>{{list.reason}}
    </td>
    <td>
    <input type="button" value="移除" class="btn btn-danger" ng-click="removeRow(list.student_name)"/>
    </td>
  </tr>
</table>
    <button class="btn btn-primary" ng-click="add()" >提交</button>
     </div> 
    

</div>
 </body>
 </html>