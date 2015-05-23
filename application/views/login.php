<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" href= "/weiqu/bootstrap/css/bootstrap.min.css"; media="screen">
	<link rel="stylesheet" href= "/weiqu/resource/css/styles.css"; media="screen">
  <link rel="stylesheet" type="text/css" href="http://wx.8531.cn/weiqu/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href= "/weiqu/csslinegraph/csslinegraph.css" rel="stylesheet" type="text/css" media="screen" >
  

	<title>登入</title>
	       
    
</head>

<body>


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
   

      <!-- Begin page content -->
      <div class="container" >
      <form action="checklogin" method="post" class="well" style="width:280px;margin:0px auto;">
        <h3>系统登录</h3>
        <?php if(isset($error)) echo "<p class='text-error'>".$error."</p>";?>
      <input class="input-xlarge" type="text" name="uname" value="用户名" style="height:30px" class="span3" onfocus="if(value=='用户名') {value='';}" onblur="if(value=='') {value='用户名';}">
      <input class="input-xlarge" type="text" name="upwd" value="密码" style="height:30px" class="span3" onfocus="if(value=='密码') {type='password';value='';}" onblur="if(value=='') {value='密码';type='text';}"><br/>
      <table width="100%">
        <tr>
          
            <td align="right">
            <button type="submit" class="btn btn-link">忘记密码</button>
            </td>
          </tr>
        </table>
      <button type="submit" class="btn btn-success">登录系统</button>
    </form>
 </div>

      <div id="push"></div>
    </div>




		
	
</body>
</html>