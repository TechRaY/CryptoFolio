<!DOCTYPE html>
<html>

<head>

<?php

session_start();
if($_SESSION['user'] == '')
{
    header("Location:../../index.php");
}

?>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Stock Price Prediction</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    
    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
	
	<style>
	
	#code
	{
		font-weight:bold;
		margin-left:5px;
		width:250px;
		height:40px
	}
	
	
	#imggraph
	{
		margin-left:120px;
	}

    $
    {
        border : 2px solid black;
    }
	</style>

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


      <script>
      
    
function fetch_table(api_val)
{
        var ar = ["BITCOIN","ETHERIUM","IOTA","LITECOIN","RIPPLE"];
        var quant = [];
        var market_cap = [];
        var net_cash = [];
        
        for (var i = 0; i < 5; i++) {
            quant[i] = get_purchased(ar[i]);
            market_cap[i] = quant[i]*api_val[i];
            net_cash[i] = invested(ar[i]);
        }

        var box = "<div class=\"container-fluid\"><div class=\"row clearfix\"><div class=md-10><table class=\"table table-bordered table-striped\"><thead><tr><th>Sr. No. </th><th>Type</th><th>Quantity</th><th>Current Market Value</th><th>Total Investment Till Date</th><th>Alerts</th></tr></thead><tbody>";

      for (var i = 0; i < 5; i++) {
        box += "<tr><td>"+(i+1)+"</td><td>"+ar[i]+"</td><td>"+quant[i]+"</td><td>"+market_cap[i]+"</td><td>"+net_cash[i]+"</td><td>"+(i+1)+"</td></tr>";
      }

      box += "</tbody></table></div><div class=md-2></div></div></div>";
      $("#table1").html("");
      $("#table1").append(box);


}

      $(document).ready(function(){
    var mkt_val = [1,1,1,1,1];
    fetch_table(mkt_val);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            console.log(myObj["USD"]);
            mkt_val.push(myObj["USD"]);

        }
    };

        var shfts = ["BTC","ETH","MIOTA","LTC","XRP"]
        
        var i = 0;
        window.setInterval(function(){
                mkt_val = []
                for(i=0;i<5;i++){
                xmlhttp.open("GET", "https://min-api.cryptocompare.com/data/price?fsym="+shfts[i]+"&tsyms=BTC,USD,EUR", true);
                xmlhttp.send();
        }
            
            fetch_table(mkt_val);
    }, 10000);



        $("input").css({"border":"2px solid grey", "border-radius":"3px"});
        $("select").css({"border":"2px solid grey", "border-radius":"3px"});

      });
      $( function() {
        $( "#datepicker" ).datepicker();
      } );
      </script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Dashboard</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                   
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Id : 21065</div>
                    <div class="email">mr.x21065@nseindia.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Stocks</li>
                    <li class="active">
                        <a href="index.html">
							<span>Infosys</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
							<span>TCS</span>
                        </a>
                    </li>
					
					<div style="margin-top:50px">
                    <a  target="_blank" href="https://github.com/TechRaY/Stock-Price-Prediction-using-News-Headlines-Twitter-Sentiment-Analysis-and-Technical-Indicators"><button id="code" type="button" class="btn btn-primary">View Complete Source Code on Github</button></a>
					</div>
                </ul>
				
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">National Stock Exchange</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
       

        <div class="table1" id="table1">
        </div>

        <div class="container-fluid">
        <div class="add_pf row clearfix">
            <div class="col-md-offset-5 col-md-3">
                <button type="button" onclick="add_pf()" class="btn btn-primary btn-lg btn-block">Add Portfolio</button>
            </div>
        </div> 
    </div>
    </section>

   

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

   
   

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script src="js/custom.js"></script>
	

    <!--My script-->
	<script type="text/javascript">

    function add_pf()
    {
        $('#myModal').modal('show'); 
    }
    </script>
    

<!-- modal here -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Make a Portfolio
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
             <form class="form-horizontal" role="form" id="my_form">
                        <div class="form-group">
                            <label for="type">Select Cryptocurrency</label>
                                <select class="form-control" id="type">
                                    <option>BITCOIN</option>
                                    <option>LITECOIN</option>
                                    <option>IOTA</option>
                                    <option>ETHERIUM</option>
                                    <option>RIPPLE</option>
                                </select>
                        </div>

                            <hr/>
                        
                        <div class="form-group">
                            <label for="place">Select Exchange</label>
                                <select class="form-control"  id="place">
                                    <option>COINBASE</option>
                                    <option>BITBAY</option>
                                    <option>ABUCOINS</option>
                                    <option>COINSBANK</option>
                                </select>
                        </div>

                            <hr/>

                        <div class="form-group">
                            <label for="quant">Input Quantity</label>
                            <br/>
                            <input type="number" class="form-control" placeholder="Quantity" id="quant" required />
                        </div>

                            <hr/>

                        <div class="form-group">
                            <label for="exrt">Amount</label>
                            <br/>
                            <input type="number" class="form-control" placeholder="Price" id="exrt" required>
                        </div>
                        
                         <hr/>

                        <div class="form-group"> 
                            <label for="datepicker">Date</label>
                            <br/>
                            <input type="date" id="datepicker">
                        </div>  

                         <hr/>
  
                        <div class="form-group">
                            <label for="bs">Trade Type</label>
                                <select class="form-control"  id="bs">
                                    <option>BUY</option>
                                    <option>SELL</option>
                                </select>
                        </div>
        </form>   
                
                
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
                <button type="button" class="btn btn-primary" onclick="send_data()">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>




</body>



<script>



function get_purchased(ar)
{
    var ans=0;
     $.ajax({
        url   : "php/get_quant.php",
        type  : "POST",
        async : false,
        data  : {
                  "curr" : ar ,
                },
        success: function(data)
        {
           ans = data;
        }
});
     return ans;
}

function invested(ar)
{
    var ans=0;
    $.ajax({
        url   : "php/get_invested.php",
        type  : "POST",
        async : false,
        data  : {
                  "curr" : ar ,
                },
        success: function(data)
        {
           ans = data;
        }
});
    return ans;
}


function send_data()
{
      var curr = $('#type option:selected').val();
      var exc = $('#place option:selected').val();
      var quant = $('#quant').val();
      var amt = $('#exrt').val();
      var dt = $('#datepicker').val();
      var bs = $('#bs option:selected').val();
      var buy = 0;
      
      if(bs === "BUY")
      buy = 1;
      else
      {

        nums = get_purchased(curr);
        if(nums < quant)
        {
            alert("You dont have enough "+curr+" to sell");
            return;
        }


      }

      $.ajax({
        url   : "php/insert_trans.php",
        type  : "POST",
        async : false,
        data  : {
                  "curr" : curr ,
                  "exc"  : exc ,
                  "quant"  : quant ,
                  "amt" : amt,
                  "dt" : dt,
                  "buy" : buy
                },
        success: function(data)
        {
           alert(data);
           fetch_table();
           $('#myModal').modal('hide');
           fetch_table();
        }
});
}


</script>
</html>












