<?php
$dbhost="140.135.9.72";
$dbuser="jason";
$dbpass="123456789";
$dbname="farm_454";
$conn=mysql_connect($dbhost,$dbuser,$dbpass,$dbname) or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

//炸： 1(LEDa  GW  10)  2( )
$growths1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'LEDa' AND`type`= 'GW' ORDER BY `Date` DESC LIMIT 0 ,10;";
$growths2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'LEDa' AND`type`= 'GW' ORDER BY `Date` DESC LIMIT 0 ,10;";

//色： 
$Light1 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'LUX' ORDER BY `Date` DESC LIMIT 0 ,10;";
$Light2 = "SELECT value ,Date , nwkAddr FROM `log_envirparameters` where `location` = 'BSTEST' AND`type`= 'LUX' ORDER BY `Date` DESC LIMIT 0 ,10;";
//saved in here
 $result_growths1=mysql_query($growths1) or die('MySQL query error');
 $result_growths2=mysql_query($growths2) or die('MySQL query error');
 $result_Light1=mysql_query($Light1) or die('MySQL query error');
 $result_Light2=mysql_query($Light2) or die('MySQL query error');
//炸 
while($growths1_row =mysql_fetch_assoc($result_growths1))
{
    $growths1_value[] = $growths1_row['value'];
    $growths1_Date[] = $growths1_row['Date'];
    }
while($growths2_row =mysql_fetch_assoc($result_growths2))
{
    $growths2_value[] = $growths2_row['value'];
    $growths2_Date[] = $growths2_row['Date'];
}
//色：
while($Light1_row =mysql_fetch_assoc($result_Light1))
{
    $Light1_value[] = $Light1_row['value'];
    $Light1_Date[] = $Light1_row['Date'];
    }
while($Light2_row =mysql_fetch_assoc($result_Light2))
{
    $Light2_value[] = $Light2_row['value'];
    $Light2_Date[] = $Light2_row['Date'];
}

$DLI_Date[0] = ($Light1_value[0] + $Light1_value[1] + $Light1_value[2] + $Light1_value[3] +$Light1_value[4] + $Light1_value[5] + $Light1_value[6] + $Light1_value[7] +$Light1_value[8] +$Light1_value[9] ) * ( strtotime($Light1_Date[9]) - strtotime($Light1_Date[0]) ) / 1000000
?>
<!-- saved from url=(0035)http://140.135.9.72/WEB2/SAMPLE.PHP -->

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8";>
  <link rel="stylesheet" type="text/css" href="css/website2.css">
  <link type="text/css" href="css/lrtk.css" rel="stylesheet">
  <script src="js/echarts.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <title>不同红蓝比在室内培育幼苗</title>
  </head>
<body>
<div class="container" id="container">
<h1 align="center">Implementation of an LED lighting system </h1>
<h4 align="center">with varying red blue ratios in indoor seedling  production
</h4>
</div>
<div class="home">
<nav>
	<inline><a href="#container" class="light">Home</a></inline>
    <inline><a href="#table" class="light">Table</a></inline>
    <inline><a href="#light" class="light">Light Intensity</a></inline>
     <inline><a href="#growths" class="light">Growths</a></inline>
     <inline><a href="#DLI" class="light">DLI</a></inline>
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
  <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48);">
    <td><i class="fa fa-lightbulb-o" ></i>  Light Intensity</td>
    <td> <?php  echo $Light1_value[0] ?> </td>  
    <td> <?php  echo $Light1_Date[0] ?> </td>       
  </tr>
   <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48)">
    <td><i class="fa fa-arrow-up" ></i>  Growths</td>
    <td> <?php  echo $growths1_value[0] ?> </td>  
    <td> <?php  echo $growths1_Date[0] ?> </td>  
  </tr>
  <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48);">
    <td><i class="fa fa-sun-o" ></i>  DLI</td>
    <td> </td>  
    <td> </td>  
  </tr>
 <!--  <tr class="icon">
    <td colspan="3">
         <p> </p>
    	<p><i class="fa fa-lightbulb-o" ></i> 最新的光照强度</p>
    	<p><i class="fa fa-arrow-up"> </i> 植物的生长高度</p>
    	<p><i class="fa fa-sun-o"> </i> 日常光照数值</p>
     </td>
  </tr> -->


</tbody></table>
</div>
<div class="compare-b-rgb" id="table">
  <table border="0">
   <tbody>
    <caption >conditon 1</caption>
   <tr class="table-b-1">
    <td style="width: 11%;font-weight: bolder;">Parameter</td>
    <td style="width: 13%;font-weight: bolder;">Value</td>  
    <td style="width: 16%;font-weight: bolder;">Time received</td>      
  </tr>
  <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48);">
    <td><i class="fa fa-lightbulb-o" style="#C5423D"></i>  Light Intensity</td>
    <td> <?php  echo $Light2_value[0] ?> </td>  
    <td> <?php  echo $Light2_Date[0] ?> </td>      
  </tr>
   <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48);">
    <td><i class="fa fa-arrow-up"></i>  Growths</td>
    <td> <?php  echo $growths2_value[0] ?> </td>  
    <td> <?php  echo $growths2_Date[0] ?> </td>         
  </tr>
  <tr style="border-bottom: 2px solid rgba(107, 123, 124, 0.48);">
    <td><i class="fa fa-sun-o"></i>  DLI</td>
    <td> </td>  
    <td> </td>  
  </tr>
  <!-- <tr class="icon">
    <td colspan="3">
         <p> </p>
    	<p><i class="fa fa-lightbulb-o"></i>最新的光照强度</p>
    	<p><i class="fa fa-arrow-up"> </i>植物的生长高度</p>
    	<p><i class="fa fa-sun-o"> </i>日常光照数值</p>
     </td>
  </tr> -->
</tbody></table>
</div>
</div>

<div class="linechart-a" id="light">
 <div id="main" style="width:90%;height:70%;margin:auto;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
     title: {
        text: 'light Intensity'
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
        data: ['<?php  echo $Light1_Date[0] ?>',
        '<?php  echo $Light1_Date[1] ?>',
        '<?php  echo $Light1_Date[2] ?>',
        '<?php  echo $Light1_Date[3] ?>',
        '<?php  echo $Light1_Date[4] ?>',
        '<?php  echo $Light1_Date[5] ?>',
        '<?php  echo $Light1_Date[6] ?>',
        '<?php  echo $Light1_Date[7] ?>',
        '<?php  echo $Light1_Date[8] ?>',
        '<?php  echo $Light1_Date[9] ?>'
        ]
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[<?php  echo $Light1_value[0] ?>,
            <?php  echo $Light1_value[1] ?>,
            <?php  echo $Light1_value[2] ?>,
            <?php  echo $Light1_value[3] ?>,
            <?php  echo $Light1_value[4] ?>,
            <?php  echo $Light1_value[5] ?>,
            <?php  echo $Light1_value[6] ?>,
            <?php  echo $Light1_value[7] ?>,
            <?php  echo $Light1_value[8] ?>,
            <?php  echo $Light1_value[9] ?>
            ]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[<?php  echo $Light2_value[0] ?>,
            <?php  echo $Light2_value[1] ?>,
            <?php  echo $Light2_value[2] ?>,
            <?php  echo $Light2_value[3] ?>,
            <?php  echo $Light2_value[4] ?>,
            <?php  echo $Light2_value[5] ?>,
            <?php  echo $Light2_value[6] ?>,
            <?php  echo $Light2_value[7] ?>,
            <?php  echo $Light2_value[8] ?>,
            <?php  echo $Light2_value[9] ?>
            ]
        }
    ]
};

        myChart.setOption(option);
    </script>  

</div>
<div style="height: 1px"></div>




<div class="linechart-b" id="growths">
 <div id="main-b" style="width:90%;height:70%;margin: auto;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main-b'));
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
        data: ['<?php  echo $Humi1_value[0] ?>',
        '<?php  echo $Humi1_value[1] ?>',
        '<?php  echo $Humi1_value[2] ?>',
        '<?php  echo $Humi1_value[3] ?>',
        '<?php  echo $Humi1_value[4] ?>',
        '<?php  echo $Humi1_value[5] ?>',
        '<?php  echo $Humi1_value[6] ?>',
        '<?php  echo $Humi1_value[7] ?>',
        '<?php  echo $Humi1_value[8] ?>',
        '<?php  echo $Humi1_value[9] ?>']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'conditon_1',
            type:'line',
            stack: '总量',
            data:[<?php  echo $growths1_value[0] ?>,
            <?php  echo $growths1_value[1] ?>,
            <?php  echo $growths1_value[2] ?>,
            <?php  echo $growths1_value[3] ?>,
            <?php  echo $growths1_value[4] ?>,
            <?php  echo $growths1_value[5] ?>,
            <?php  echo $growths1_value[6] ?>,
            <?php  echo $growths1_value[7] ?>,
            <?php  echo $growths1_value[8] ?>,
            <?php  echo $growths1_value[9] ?>
            ]
        },
        {
            name:'conditon_2',
            type:'line',
            stack: '总量',
            data:[<?php  echo $growths2_value[0] ?>,
            <?php  echo $growths2_value[1] ?>,
            <?php  echo $growths2_value[2] ?>,
            <?php  echo $growths2_value[3] ?>,
            <?php  echo $growths2_value[4] ?>,
            <?php  echo $growths2_value[5] ?>,
            <?php  echo $growths2_value[6] ?>,
            <?php  echo $growths2_value[7] ?>,
            <?php  echo $growths2_value[8] ?>,
            <?php  echo $growths2_value[9] ?>
            ]
        }
    ]
};
        myChart.setOption(option);
    </script>  

</div>

<div style="height: 1px"></div>

<div class="linechart-c" id="DLI">
 <div id="main-c" style="width:90%;height:70%;margin: auto;"></div>
    <script type="text/javascript">
 
        var myChart = echarts.init(document.getElementById('main-c'));
        var option = {
 title: {
        text: 'DLI'
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



<!-- <div id="foot" class="foot" >
	  <p>@our team's first project.</p> 
</div> -->
<div id="code"></div>
<div id="code_img"></div>
<a id="gotop" href="javascript:void(0)"></a>
</body>
</html>