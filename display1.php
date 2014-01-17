<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Exception Display Sample 1</title>
	    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Count'],
          ['Not started',     250],
          ['Waiting on fund',      14],
          ['In progress',  88],
          ['Waiting for review', 34],
          ['Complete',    56]
        ]);

        var options = {
          title: 'Fund Status',
	  is3D: true,
	  chartArea: {left:80,top:20,height:200},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>



<script type="text/javascript">
    google.load("visualization", '1.1', {packages:['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Status', 'Open', 'Closed' ,{ role: 'annotation' }  ],
        ['Level 1', 350, 985, '' ],
        ['Level 2', 125, 602, ''],
        ['Level 3', 305, 123, ''],
	['Level 4', 241, 33, '' ],
      ]);

      var options = {
	title: "EMS Exceptions",
	chartArea: {left:80,top:20,height:200},
        // width: 600,
        // height: 400,
        legend: { position: 'top', maxLines: 3 },
	bar: {groupWidth: '75%'},
        isStacked: true,
	colors: ['#FFCC33','blue'],
      };

      var chart = new google.visualization.BarChart(document.getElementById('barchart_stacked'));
      chart.draw(data, options);
  }
  </script>

<script type="text/javascript">
	function GetClock(){
	d = new Date();
	nhour  = d.getHours();
	nmin   = d.getMinutes();
	nsec   = d.getSeconds();

	     if(nhour ==  0) {ap = " AM";nhour = 12;} 
	else if(nhour <= 11) {ap = " AM";} 
	else if(nhour == 12) {ap = " PM";} 
	else if(nhour >= 13) {ap = " PM";nhour -= 12;}

	if(nmin <= 9) {nmin = "0" +nmin;}
	if(nsec <= 9) {nsec = "0" +nsec;}


	document.getElementById('clockbox').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+"";
	setTimeout("GetClock()", 1000);
	}
	//window.onload=GetClock;
</script>

<script type="text/javascript">
	function getSP() {
	    var url = "http://query.yahooapis.com/v1/public/yql";
	    var symbol = $("#symbol").val();
	    var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in ('^GSPC')");
	    var lastTradePriceSP = 0; 

		$.ajax({
			url: url,
			dataType: 'json',
			async: false,
			data: 'q=' + data + "&format=json&diagnostics=true&env=http://datatables.org/alltables.env",
			success: function (data) { 
				 lastTradePriceSP = data.query.results.quote.LastTradePriceOnly;
				 changeSp = data.query.results.quote.Change;
						}
	    });
	    document.getElementById('sp').innerHTML = lastTradePriceSP;	
	    document.getElementById('changeSp').innerHTML = changeSp;	
	    }
	    
	function getNasdaq() {
	    var url = "http://query.yahooapis.com/v1/public/yql";
	    var symbol = $("#symbol").val();
	    var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in ('^IXIC')");
	    var lastTradePriceNasdaq = 0; 

		$.ajax({
			url: url,
			dataType: 'json',
			async: false,
			data: 'q=' + data + "&format=json&diagnostics=true&env=http://datatables.org/alltables.env",
			success: function (data) { 
				 lastTradePriceNasdaq = data.query.results.quote.LastTradePriceOnly;
				 changeNasdaq = data.query.results.quote.Change;

						}
	    });	    
	    document.getElementById('nasdaq').innerHTML = lastTradePriceNasdaq;	
	    document.getElementById('changeNasdaq').innerHTML = changeNasdaq;	
	}
	
	function getDIA() {
	    var url = "http://query.yahooapis.com/v1/public/yql";
	    var symbol = $("#symbol").val();
	    var data = encodeURIComponent("select * from yahoo.finance.quotes where symbol in ('DIA')");
	    var lastTradePriceDIA = 0; 

		$.ajax({
			url: url,
			dataType: 'json',
			async: false,
			data: 'q=' + data + "&format=json&diagnostics=true&env=http://datatables.org/alltables.env",
			success: function (data) { 
				 lastTradePriceDIA = data.query.results.quote.LastTradePriceOnly;
				 changeDIA = data.query.results.quote.Change;
				 //return data;
						}
	    });	    
	    document.getElementById('dia').innerHTML = lastTradePriceDIA * 100;	
	    document.getElementById('changeDia').innerHTML = changeDIA * 100;	
	}

	setTimeout("getSP()", 1000);	   
	setTimeout("getNasdaq()", 1000);	   
	setTimeout("getDIA()", 1000);	   

</script>


</head>    

<body onload=GetClock(),getSP(),getNasdaq(),getDIA()>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">	</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <li><a href="#"><div id="clockbox"></div></a></li>
	<li class="active"><a href="#">All funds</a></li>
          <li ><a href="#mutual">Mutual</a></li>
          <li><a href="#hedge">Hedge</a></li>
	<li><a href="#third">Third Party</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<hr>
    
	<div class="container"> 
		<div class="alert alert-success">
		<strong>Status</strong> No known issues
		</div>
	</div>
      

<table class="table ">
<tr>
<td width=50%>

	<div id="piechart" style="width: 100%; height: 250px;"></div>

</td>
<td >
	<div id="barchart_stacked" style="width: 100%; height: 200px" ></div>
</td>
</tr>
<tr>
<td>
	<h5>
	<table class="table table-bordered">
		<thead>
		  <tr>
		    <th>Date</th>
		    <th>Exceptions</th>
		  </tr>
		</thead>
		<tbody>
		  <tr >
		    <td>Today</td>
		    <td>1,305</td>
		  </tr>
		  <tr class="warning">
		    <td>1/17/2014</td>
		    <td>3,080</td>
		  </tr>
		  <tr class="danger">
		    <td>1/16/2014</td>
		    <td>2,653</td>
		  </tr>
		  <tr class="warning">
		    <td>1/15/2014</td>
		    <td>2,791</td>
		  </tr>
		  <tr class="success">
		    <td>1/14/2014</td>
		    <td>2,136</td>
		  </tr>
		  <tr class="danger">
		    <td>1/13/2014</td>
		    <td>5,197</td>
		  </tr>
		</tbody>
	      </table>
	      </h5>
</td>
<td>
	<h5>
	<table class="table table-bordered">
		<thead>
		  <tr>
		    <th>Price Source</th>
		    <th>Status</th>
		  </tr>
		</thead>
		<tbody>
		  <tr class="success">
		    <td>CBOE </td>
		    <td>Final @ 1:17pm</td>
		  </tr>
		  <tr class="success">
		    <td>Eurex</td>
		    <td>Final @ 2:30pm</td>
		  </tr>
		  <tr class="danger">
		    <td>ICAP</td>
		    <td>Waiting for file</td>
		  </tr>
		  <tr class="success">
		    <td>Nasdaq</td>
		    <td>Final @ 3:57pm</td>
		  </tr>
		  <tr class="success">
		    <td>NYSE</td>
		    <td>Final @ 3:59pm</td>
		  </tr>
		  <tr class="warning">
		    <td>NYSE ARCA</td>
		    <td>In validation</td>
		  </tr>
		</tbody>
	      </table>
	      </h5>
</td>
</tr>
</table>


   
    <div class="navbar navbar-inverse navbar-fixed-bottom " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">	</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <li ><a href="#"> DJIA: <span id="dia">fetching</span>  <span id="changeDia">fetching</span></a></li>
          <li ><a >S&ampP 500: <span id="sp">fetching</span>  <span id="changeSp">fetching</span></a></li>
          <li ><a>NASDAQ: <span id="nasdaq">fetching</span>  <span id="changeNasdaq">fetching</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

</div> <!-- /container -->
    
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../docs-assets/js/holder.js"></script>
  </body>
</html>
