
<!DOCTYPE html>
<html lang="en" ng-app="WecheckApp">
<head>
  <meta charset="UTF-8">
   <link rel="stylesheet" href= "http://wx.8531.cn/weiqu/bootstrap/css/bootstrap.min.css"; media="screen">  
    <link rel="stylesheet" href= "http://wx.8531.cn/weiqu/resource/css/styles.css"; media="screen">
   
     <link rel="Stylesheet" href="http://wx.8531.cn/wecheck/css/jquery.autocomplete.css" />

    <script type="text/javascript" src="http://wx.8531.cn/wecheck/js/jquery.autocomplete.min.js"></script>
  <script src="http://wx.8531.cn/resource/js/angular-1.2.9/angular.js"></script>
 
  
  <script src="http://wx.8531.cn/wecheck/js/controllers.js"></script>


<script src="http://www.w3cschool.cc/try/bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>
<script type="text/javascript" src="http://wx.8531.cn/wecheck/js/jquery.autocomplete.min.js"></script>
 
    
     <script type="text/javascript">
         
     var tValue;
         function clearWord( )
        {　 tValue =document.getElementById("content").Value
            alert(tValue);

        }

 setInterval('clearWord( )', 3000);

          var emails = [
             { name: "dt", to: "大同" },
             { name: "bj", to: "北京" },
             { name: "tj", to: "天津" },
             { name: "hf", to: "合肥" },
             { name: "sh", to: "上海" }
             
         ];
 
              

             $(function() {$('#keyword').autocomplete(emails, {
                     max: 12,    //列表里的条目数
                     minChars: 0,    //自动完成激活之前填入的最小字符
                     width: 400,     //提示的宽度，溢出隐藏
                     scrollHeight: 300,   //提示的高度，溢出显示滚动条
                     matchContains: true,    //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
                     autoFill: false,    //自动填充
                     formatItem: function(row, i, max) {
                         //return i + '/' + max + ':"' + row.name + '"[' + row.to + ']';
                         return row.to;
                     },
                     formatMatch: function(row, i, max) {
                         return row.name + row.to;
                     },
                     formatResult: function(row) {
                         return row.to;
                     }
                 }).result(function(event, row, formatted) {
                    alert(tValue); 
                 });
             });

     </script>
     <script type="text/javascript">



</script>
  <title>考勤系统</title>
 </head>
 <body >
     <form id="form1" >

  <div class="container" ng-controller="CourseListCtrl">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">考勤系统</h3>
      </div>

  <div  >
  <input type="date" name="user_date" /> 
  <select ng-model="SelCity" ng-options="City.class for City in wecheck" ng-change="update(SelCity)">
    <option value="">--请选择--</option>
  </select>
    
     <select ng-model="SelArea" ng-options="SelCity for  SelCity in level2" >
    <option value="">--请选择--</option>
  </select>
  
  </div>
     <div>
         <input id="keyword" />
<!--          <input id="getValue" value="GetValue" type="button" />
 -->     </div>
     </form>
      <span id="content">a</span>
 </body>
 </html>