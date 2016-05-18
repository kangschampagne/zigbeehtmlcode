<?php
$dbhost="140.135.9.72";
$dbuser="jason";
$dbpass="123456789";
$dbname="farm_454";
$conn=mysql_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

//燦： 1(VERTa  GW  10) 2( )
$growths1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'VERTa' AND`type`= 'GW' ORDER BY `Date` DESC LIMIT 0 ,1;";
$growths2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'VERTa' AND`type`= 'GW' ORDER BY `Date` DESC LIMIT 0 ,1;";

// //pp: condtion1
// $Temp1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";
// $Humi1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";
// $Light1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";

// //pp: condtion2
// $Temp2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";
// $Humi2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";
// $Light2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'RT' ORDER BY `Date` DESC LIMIT 0 ,10;";

//saved in here
 $result_growths1 = mysql_query($growths1) or die('MySQL query error result_growths1');
 $result_growths2 = mysql_query($growths2) or die('MySQL query error result_growths2');
 // $result_Temp1 = mysql_query($Temp1) or die('MySQL query error result_Temp1');
 // $result_Humi1 = mysql_query($Humi1) or die('MySQL query error result_Humi1');
 // $result_Light1 = mysql_query($Light1) or die('MySQL query error result_Light1');
 // $result_Growth = mysql_query($Growth) or die('MySQL query error result_Growth'); //
 // $result_Temp2 = mysql_query($Temp2) or die('MySQL query error result_Temp2');
 // $result_Humi2 = mysql_query($Humi2) or die('MySQL query error result_Humi2');
 // $result_Light2 = mysql_query($Light2) or die('MySQL query error result_Light2');

$row_growths1=mysql_fetch_row($result_growths1);
$row_growths2 =mysql_fetch_row($result_growths2);
// $row_Temp1=mysql_fetch_row($result_Temp1);
// $row_Humi1 =mysql_fetch_row($result_Humi1);
// $row_Light1=mysql_fetch_row($result_Light1);
// $row_Growth =mysql_fetch_row($result_Growth);
// $row_Temp2=mysql_fetch_row($result_Temp2);
// $row_Humi2 =mysql_fetch_row($result_Humi2);
// $row_Light2=mysql_fetch_row($result_Light2);


?>
<!-- saved from url=(0035)http://140.135.9.72/WEB2/pp_nini.html-->

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8";>
  <link rel="stylesheet" type="text/css" href="css/pp_nini.css">
  <script src="js/echarts.min.js"></script>
    <link type="text/css" href="css/pn.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <title>####</title>
  </head>
<body>
<div class="container" id="container">
<h1 align="center">Evaluation of an LED lighting system for seedling vertical farming </h1>
<h4 align="center">with a machine vision-based measurement system</h4>
</div>
<div class="home">
<nav>
	<inline><a href="#container" class="light">Home</a></inline>
    <inline></i><a href="#table" class="light">Table</a></inline>
     <inline><a href="#Temperature" class="light">Temperature</a></inline>
    <inline><a href="#Humidity" class="light">Humidity</a></inline>
     <inline><a href="#Light" class="light">Light Intergity</a></inline>
     <inline><a href="#Growths" class="light">Growths</a></inline>
    
</nav>
</div>
<div class="compare-rgb" id="table">
<div class="compare-a-rgb">
<table border="0" >
   <tbody>
   <caption>conditon 1</caption>
   <tr class="table-a-1">
    <td style="width: 11%;font-weight: bolder;">Parameter</td>
    <td style="width: 13%;font-weight: bolder;">Value</td>  
    <td style="width: 16%;font-weight: bolder;">Time received</td>      
  </tr>
  <tr  class="table-border">
    <td> Temperature</td>
    <td> <?php  echo $row_Temp1[0] ?> </td>  
    <td> <?php  echo $row_Temp1[1] ?> </td>  
  </tr>
  <tr class="table-border">
    <td> Humidity</td>
    <td> <?php  echo $row_Humi1[0] ?> </td>  
    <td> <?php  echo $row_Humi1[1] ?> </td>   
  </tr>
  <tr class="table-border">
    <td> Light Intensity</td>
    <td> <?php  echo $row_Light1[0] ?> </td>  
    <td> <?php  echo $row_Light1[1] ?> </td>       
  </tr>
   <tr class="table-border">
    <td>  Growths</td>
    <td> <?php  echo $row_growths1[0] ?> </td>  
    <td> <?php  echo $row_growths1[1] ?> </td>       
  </tr>
  
  


</tbody></table>
</div>
<div class="compare-b-rgb" id="table">
  <table border="0">
   <tbody>
    <caption >conditon 2</caption>
   <tr class="table-b-1">
    <td style="width: 11%;font-weight: bolder;">Parameter</td>
    <td style="width: 13%;font-weight: bolder;">Value</td>  
    <td style="width: 16%;font-weight: bolder;">Time received</td>      
  </tr>
  <tr class="table-border">
    <td> Temperature</td>
    <td> <?php  echo $row_Temp2[0] ?> </td>  
    <td> <?php  echo $row_Temp2[1] ?> </td>  
  </tr>
  <tr class="table-border">
    <td> Humidity</td>
    <td> <?php  echo $row_Humi2[0] ?> </td>  
    <td> <?php  echo $row_Humi2[1] ?> </td>   
  </tr>
  <tr class="table-border">
    <td> Light Intensity</td>
    <td> <?php  echo $row_Light2[0] ?> </td>  
    <td> <?php  echo $row_Light2[1] ?> </td>      
  </tr>
   <tr class="table-border">
    <td>  Growths</td>
    <td> <?php  echo $row_growths2[0] ?> </td>  
    <td> <?php  echo $row_growths2[1] ?> </td>           
  </tr>
  
</tbody></table>
</div>
</div>

<div class="linechart-a" id="Temperature">
 <div id="main" style="width:90%;height:70%;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
     title: {
        text: 'Temperature'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['conditon_1','conditon_2']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImamge: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};

        myChart.setOption(option);
    </script>  

</div>
<div style="height: 1px"></div>




<div class="linechart-b" id="Humidity">
 <div id="main-b" style="width:90%;height:70%;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main-b'));
        var option = {
title: {
        text: 'Humidity'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['conditon_1','conditon_2']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImamge: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};
        myChart.setOption(option);
    </script>  

</div>

<div style="height: 1px"></div>

<div class="linechart-c" id="Light">
 <div id="main-c" style="width:90%;height:70%;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main-c'));
        var option = {
 title: {
        text: 'Light Intensity'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['conditon_1','conditon_2']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImamge: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};
        myChart.setOption(option);
    </script>  

</div>
<div class="linechart-d" id="Growths">
 <div id="main-d" style="width:90%;height:70%;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main-d'));
        var option = {
 title: {
        text: 'Growths'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['conditon_1','conditon_2']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImamge: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};
        myChart.setOption(option);
    </script>  
<div id="code"></div>
<div id="code_img"></div>
<a id="gotop" href="javascript:void(0)"></a>
	
</div>
</body>
</html>