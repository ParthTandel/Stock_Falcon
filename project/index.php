<?php

require_once('config.php');
require_once('database.php');
$cookie_name = "user" ;
$login = false;
$test = new data_base();

if(isset($_GET['auth_id']))
{
    $check = $_GET['auth_id'];
   	$sql = "UPDATE ".DB_NAME.".personal_info SET auth_status = 'TRUE' WHERE auth_key = '".$check."'";
    $result = mysql_query($sql);
    $sql= "SELECT cookie FROM ".DB_NAME.".personal_info  WHERE auth_key = '".$check."'";
    $result = mysql_query($sql);

    if($result != null )
    {
		$row = mysql_fetch_assoc($result);
		$cookie_name = "user";
		$cookie_value = $row["cookie"];
		$sql = "CREATE TABLE IF NOT EXISTS ".$cookie_value."_portfolio (stock_ticker varchar(20) NOT NULL, quantity int(10) NOT NULL DEFAULT '0', cost_price double NOT NULL , stock_name varchar(100) NOT NULL ,
		CONSTRAINT 
    	FOREIGN KEY (stock_ticker)
    	REFERENCES prediction(stock_ticker)
   		ON DELETE CASCADE
   		)";
		echo $sql;
		$result = mysql_query($sql);
		$sql = "CREATE TABLE IF NOT EXISTS ".$cookie_value."_watchlist ( stock_ticker varchar(20) NOT NULL , hit_value int(11) NOT NULL , stock_name varchar(100) NOT NULL ,
		CONSTRAINT 
    	FOREIGN KEY (stock_ticker)
    	REFERENCES prediction(stock_ticker)
   		ON DELETE CASCADE
   		)";
		echo $sql;
		$result = mysql_query($sql);
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		header("Location: index.php");
	}
}

if(!isset($_COOKIE[$cookie_name])) 
{

}
else 
{  

      $login = true;
      $table = 'personal_info';
    
      $sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
      $result = mysql_query($sql);
	  $row = mysql_fetch_assoc($result);


	  $string  ='';	 
	  $string2 ='';

	  if($row['gender'] == "MALE" || $row['gender'] == "male")
	  {
		  $string  = '<td> <label><input type="radio" name="gender" checked="checked" value="MALE">Male</label> </td>'	; 
		  $string2 ='<td> <label><input type="radio" name="gender" value ="FEMALE">Female</label> </td>';
	  }
	  else
	  {
	  	  $string  = '<td> <label><input type="radio" name="gender"  value="MALE">Male</label> </td>'	 ;
		  $string2 ='<td> <label><input type="radio" name="gender" checked="checked" value ="FEMALE">Female</label> </td>' ;
	  }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stock Falcon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="main2.css">
  <script type="text/javascript" src="js/validate.js" ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="sweetalert-master/lib/sweet-alert.min.js"></script> 
  <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
  <script src="http://code.highcharts.com/stock/highstock.js"></script>
  <script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert-master/lib/sweet-alert.css">
  <script>

		function refresh()
	    {
	        $(document).ready(function(){
	            setInterval(function() {
	              $("#content2").each(function()
	            {
	              var images = $(this).find("div");
	              $("#latestData").load("getLatestData.php");
	          });
	            }, 2000);
	        });
	    }

	    function poll(e)
	    {
	    	var x=document.getElementById("s_ticker");
	        var myString = x.innerHTML;
	        var newString = myString.substr(15, myString.length);
	        var val = e.value;
	         $.ajax({   type: "POST",
                    url: 'poll.php',
                    data: { 'stock_ticker': newString , 'value' : val },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        
                        if(result[0] == "success")
                        {
                        	swal("Poll successful", "Thanks for voting click to continue.", "success");
                        }
                        else if(result[0] == 'please_login')
                        {
                            $(document).ready(function() {
                            swal({ 
                              title: "Please Login !",
                               text: "Click the button to continue",
                                type: "error" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });    

                        }
                        else
                        {
                        	swal("Already Voted", "Already voted for this stock Click to continue.", "error");
                        }

                    } });
	    }

	    
	    function refresh2()
	    {
	        $(document).ready(function(){
	            setInterval(function() 
	            {
	                var x=document.getElementById("s_ticker");
	                var myString = x.innerHTML;
	                var newString = myString.substr(15, myString.length);
	                $.ajax({   type: "POST",
                    url: 'update_current_stock.php',
                    data: { 'stock_ticker': newString },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        document.getElementById('pr_close_price').innerHTML="<h5>Previous Close Rs."+result[1]+"</h5>";
						if(result[0] < result[1])
						{
						 	document.getElementById("curr_price").style.background="#FF6666";
						 	document.getElementById("curr_price").innerHTML ='<h5>Current Rs.'+ result[0]+'</h5><span class=".glyphicon .glyphicon-circle-arrow-down"></span>';
						 
						}
						else
						{
							document.getElementById("curr_price").style.background="#33FF33";
							document.getElementById("curr_price").innerHTML ="<h5>Current Rs."+ result[0]+'</h5><span class=".glyphicon .glyphicon-circle-arrow-up"></span>';
						}
						document.getElementById("people_opinion").innerHTML=result[2];

                    } });
	            }, 1000);
	        });
	    }

		function graph(e)
		{
			$(".incorrect_change").remove();	
			e = e.toUpperCase();
			$.ajax({   type: "POST",
                    url: 'check_stock.php',
                    data: { 'stock_ticker': e },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == 'success')
                        {

							$('#home_box').hide(1000);
							$('#About_box').hide(1000); 
							$('#FAQ_box').hide(1000); 
							$('#results_box').show(1000);
							$('#search_box').hide(1000);
							document.getElementById('s_ticker').innerHTML="Stock Ticker : "+e;
							document.getElementById("s_name").innerHTML = "Stock Name : "+result[1];

							document.getElementById('pr_close_price').innerHTML="<h5>Previous Close <br>Rs."+result[3]+"</h5>";
							document.getElementById("curr_price").innerHTML ="<h5>Current <br>Rs."+ result[2]+"</h5>";
							document.getElementById("pred_iprice").innerHTML ="<h5>Predicted <br>Rs."+ result[4]+"</h5>";
							document.getElementById("confidence_price").innerHTML ="<h5>Confidence Value : "+ result[5]+"</h5>";
							document.getElementById("confidence_price").style.background="#666699";
							if(result[2] < result[3])
							{
								
							    document.getElementById("curr_price").style.background="#FF6666";
							}
							else
							{
								
								document.getElementById("curr_price").style.background="#33FF33";
							}

							if(result[4] < result[3])
							{
								
							    document.getElementById("pred_iprice").style.background="#FF6666";
							}
							else
							{
								
								document.getElementById("pred_iprice").style.background="#33FF33";
							}
							
							$(function() {
							$.getJSON('csvparse.php?callback=?&sn='+e+'.ns', function(data) 
							{
									$('#container').highcharts('StockChart', {
										rangeSelector : {
											selected : 1
										},
							
										title : {
											text : e
										},
										
										series : [{
											name : e,
											data : data,
											tooltip: {
												valueDecimals: 1
											}
										}]
									});
								});
							
							});

                        }
                        else
                        {
                        	var str1 = "<div style='color:red'; class='incorrect_change'>";
			                var str2 ="</div>";
			                var str3 = "Incorrect stock Ticker";
			                var res = str1.concat(str3,str2);
			                $("#search_button").append(res);
			                $("#search_button1").append(res);
                        }
                      
                    } });

		}
 
function loadImage() {
    alert("Image is loaded");
}
</script>
<style>

#container1 {
    float:left;
    width:100%;
}

  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  
#container2 {
    float:left;
    width:100%;
}
#container
{
	border-radius: 10px;
}
.col-lg-2
{

	margin-right: 3%;
	padding: 2%;
	border-radius: 10px;
	color: white;
	background-color: rgba(255, 255, 255,0.6);
}
#pr_close_price
{
	background: #666699;
}
#people_opinion
{
	background-color: rgba(5, 5, 5,0.3);
	margin-left: 20%;
	padding: 2%;
	width : 70%;
	border-radius: 5px;

}

</style>
</head>
<header>
	
		<img id ="head" src="images/StockFalconLogo-other.jpg" alt="Mountain View" style="width:152px;height:147px">
		<br>
		<br>
		<br>
		
		<ul class="nav navbar-nav navbar-right">
		<font face="verdana">      
				
			 	
			  	<a href="#" data-toggle="modal" data-target="#contactusModal">Contact Us</a>
			  	<br>
			  	<a href="#" data-toggle="modal" data-target="#disclaimerModal">Disclaimer</a>
		</font>
		</ul>

		</ul>
		
		<h1 id="head1">Stock Falcon</h1>
</header>

<body onload="refresh();">
 <div class="modal fade" id="disclaimerModal" tabindex="-1" role="dialog" aria-labelledby="disclaimerModal" aria-hidden="true">
   		 <div class="modal-dialog">
        		<div class="modal-content">
   	         <div class="modal-header">
      		      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            		<h4 class="modal-title" id="myModalLabel">Disclaimer</h4>
            	</div>
            	<div class="modal-body" style="color:black;">
            		<p>Stock Falcon does not provide personal investment or financial advice to individuals, or act as personal financial, legal, or institutional investment advisors, or individually advocate the purchase or sale of any security or investment or the use of any particular financial strategy. All investing, stock forecasts and investment strategies include the risk of loss for some or even all of your capital. Before pursuing any financial strategies discussed on this website, you should always consult with a licensed financial advisor.</p>
						<p>Stock Falcon is a website mainly to learn the behavior of the market and to predict the price of stocks and hence, not responsible for any of the actions taken by the user with respect to the stock market.</p>            
            	</div>
            	<div class="modal-footer">
              		<button type="button" class="btn btn-success" data-dismiss="modal">Got it</button>
        			</div>
    			</div>
  			</div>
		</div>
			        
		 <div class="modal fade" id="contactusModal" tabindex="-1" role="dialog" aria-labelledby="contactusModal" aria-hidden="true">
   		 <div class="modal-dialog">
        		<div class="modal-content">
            	<div class="modal-header">
            		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            		<h4 class="modal-title" id="myModalLabel">Contact Us</h4>
            	</div>
            	<div class="modal-body" style="color:black;">
                	 <p>Mahesh Aswani</p>
                	 <p>1006, B-wing, Atma house,</p>
                   <p>Opposite Times of India,</p>
                   <p>Ashram road,Ahmedabad 380009</p>
                   <p>Ph no: +91 (0)79 26580493,26580494</p>
               </div>           
            	<div class="modal-footer">
            		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			</div>
        		</div>
    		</div>
  		</div>			     






<div>
	<nav class="navbar navbar-default">
			 <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
				     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span> 
				     </button>

    			
			    
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li><a href="#" onClick="$('#search_box').hide(2000); $('#FAQ_box').hide(2000); $('#About_box').hide(2000); $('#results_box').hide(1000); $('#learn_box').hide(1000);$('#home_box').show(2000)"	>Home</a></li>
				        <li><a href="#" onClick="$('#home_box').hide(2000); $('#About_box').hide(2000); $('#FAQ_box').hide(2000); $('#results_box').hide(1000);$('#learn_box').hide(1000);$('#search_box').show(2000)"	>Search</a></li>
				       	<li><a href="#" onClick="$('#search_box').hide(2000); $('#FAQ_box').hide(2000); $('#home_box').hide(2000); $('#results_box').hide(1000);$('#learn_box').show(1000);$('#About_box').hide(2000)"	>Learn</a></li>
				       	<li><a href="#" onClick="$('#search_box').hide(2000); $('#home_box').hide(2000); $('#About_box').hide(2000);$('#results_box').hide(1000);$('#learn_box').hide(1000); $('#FAQ_box').show(2000)"	>FAQ</a></li>
				       	<li><a href="#" onClick="$('#search_box').hide(2000); $('#FAQ_box').hide(2000); $('#home_box').hide(2000); $('#results_box').hide(1000);$('#learn_box').hide(1000);$('#About_box').show(2000)"	>About Us</a></li>
				      </ul>
					</div>

				</div>
			
			     


			     <?php
				      if($login == false)
				      { echo '
				      <ul class="nav navbar-nav navbar-right">
				        <li class="dropdown">

				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login/Register<span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li>
				            	<button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal_reg">Login</button>
				            </li>
				            <li>
				            	<button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal_log">Register</button>
				            </li>
				          </ul>
				        </li>
				      </ul>


				     <div class="modal fade" id="myModal_reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Login</h4>
								      </div>
								      <div class="modal-body">
								        <form id="loginform" class="form-horizontal" role="form">
									        <div style="margin-bottom: 20px" id="email_append">
												<div style="margin-bottom: 5px" class="input-group" >
									            	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									            	<input id="login-username" type="text" class="form-control" name="username" placeholder="User Email"> 
									            </div>
									        </div>   
									         <div style="margin-bottom: 20px" id="password_append">
									            <div style="margin-bottom: 5px" class="input-group">
									              	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									                <input id="login-password" type="password" class="form-control" name="password" placeholder="password"></div>
									            </div> 
									         <div style="margin-top:10px" class="form-group">
									         	<div class="col-sm-12 controls">
									                <a id="btn-login" href="#" class="btn btn-success" onclick="return validate()">Login  </a>
									                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#forgot_Password">Forgot Password</a>
												</div>
									         </div>
									    </form> 
									  </div>
						    	</div>
							</div>
					 </div>
					 <div class="modal fade" id="myModal_log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								   <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">Register</h4>
								    </div>
								    <div class="modal-body">
								       <form name = "sign_up" id="signupform" class="form-horizontal" role="form">      
				                        		<div class="form-group" >
				                        		
				                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
				                                    <div class="col-md-9">
				                                    <div id="firstname_append">
				                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
				                                    </div>
				                                	</div>
				                                </div>
				                                <div class="form-group">
				                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
				                                    <div class="col-md-9">
				                                    <div id="lastname_append">
				                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
				                                    </div>
				                                    </div>
				                                </div>
				                                <div class="form-group">
				                                    <label for="password" class="col-md-3 control-label">Password</label>
				                                    <div class="col-md-9">
				                                    <div id="passwd_append">
				                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
				                                    </div>
				                                    </div>
				                                </div>
				                                <div class="form-group">
				                                    <label for="Retype password" class="col-md-3 control-label">Retype Password</label>
				                                    
				                                    <div class="col-md-9">
				                                    <div id="passwd1_append">
				                                        <input type="password" class="form-control" name="passwd1" placeholder="Retype Password">
				                                    </div>
				                                    </div>
				                                </div>
				                                <div class="form-group">
				                                    <label for="birthdate" class="col-md-3 control-label">Birth date</label>
				                                    <div class="col-md-9">
				                                    <div id="birthdate_append">
				                                        <input type="date" class="form-control" name="birthdate">
				                                    </div>
				                                    </div>
				                                </div>
				                                <div class="form-group">
				                                    <label for="email" class="col-md-3 control-label">Email</label>
				                                    <div class="col-md-9">
				                                    <div id="Email_append">
				                                        <input type="email" class="form-control" name="email" placeholder="xyz@domain.com">
				                                    </div>
				                                    </div>
				                                </div>
				                                    
				                                <div class="form-group">
				                                    <label for="gender" class="col-md-3 control-label">Gender</label>
							                          <div class="radio">
								                           <div class="col-md-9">
								                           <div id="gender_append">
									                           <tr>
									                           <td> <label><input type="radio" name="gender" value="MALE">Male</label> </td>
									                           <td> <label><input type="radio" name="gender" value ="FEMALE">Female</label> </td>
									                           </tr>
								                           </div>
								                           </div>
							                           </div>
				                          		</div>
												<div class="form-group">
				                                    <!-- Button -->                                        
				                                    <div class="col-md-offset-3 col-md-9">
				                                        <button id="btn-signup" type="button" onclick="return validate_registeration()" class="btn btn-info"><i class="icon-hand-right"></i> Sign Up</button>
				                                        <span style="margin-left:8px;"></span>  
				                                    </div>
				                                </div>
				                        </form>
								    </div>
								</div>
				    		</div>
				 	 </div>
	                           
	                 <div class="modal fade" id="forgot_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
								</div>
								<div class="modal-body">
									<form id="pass_reset" class="form-horizontal" role="form">		                                    
									<div class="form-group">
									
							         	<label for="email" class="col-md-3 control-label">E-mail address</label>
							            <div class="col-md-9">
							            <div class=rpass_append>
							            <div id ="forgot_email_append">
							            	<input type="text" name="email" class="form-control" >
							       		</div>
							       		</div>
							        	</div>
							        </div>
							        <div class="form-group">
							        <label for="email" class="col-md-2 control-label"></label>
							         	<div class="col-md-9">
							         	<p>A Randomly generated password would be sent to the specified email address you can then change the password.</p>
							         	</div>
									</form> 
								</div>
								<div class="modal-footer">
						          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						          <button type="button" class="btn btn-primary" onclick="pass_reset()">Send Password</button>
						        </div>
							</div>
						</div>
					</div>     

				      ';
				  	}
				  	else
				  	{
				  		echo '<ul class="nav navbar-nav navbar-right">';
				      	if($row['type'] != "USER")
						  {
						  	echo '<li><a href="admin.php">Advance Settings </a></li>';
						  }
						  else
						  {
						  	 echo '<li><a href="user_profile.php">Dashboard</a></li>';
				  		  }
				    echo '<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello '.$row['first_name'].' ! <span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal1">Change Password</button></li>
				            <li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal2"> Edit Profile</button></li>';
				            if($row['type'] != "ADMIN")
				            {
				            echo '<li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal3">Help</button></li>
				            '; }
				            echo '
				            <li><button type="button" class="btn btn-default btn-sm temp_button" onclick="return logout()">Logout</button></li>
				          </ul>
				        </li>
				      </ul>
				      ';
				  	}
				?>
							
        </div> 
    </nav>
</div>





<div id = "content" >
		<div id="home_box" >
			<div id = "txt">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000" style="width :100%">
			    <!-- Indicators -->
			    <ol class="carousel-indicators">
			      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
			    </ol>

			    <!-- Wrapper for slides -->
			    <div class="carousel-inner" role="listbox">
			      <div class="item active">
			        <img src="Learn.png" alt="image2">
			        <div class="carousel-caption">
			        <h1>LEARN</h1>
			        </div>
			      </div>    
			      <div class="item">
			        <img src="stockmarket.png" alt="image1">
			        <div class="carousel-caption">
			        <h1>FORSEE</h1>
			        </div>
			      </div>
			      <div class="item">
			        <img src="decide.png" alt="image2">
			        <div class="carousel-caption" style="text-align:center">
			        <h1>DECIDE</h1>
			        </div>
			      </div>
			      <div class="item">
			        <img src="invest.png" alt="image2">
			        <div class="carousel-caption">
			        <h1>INVEST</h1>
			        </div>
			      </div>    
			    </div>

			    <!-- Controls -->
			    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			      <span class="sr-only">Previous</span>
			    </a>
			    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			      <span class="sr-only">Next</span>
			    </a>
			  </div>  
						
			</div>	
		</div>

		<div id="search_box" style="display:none; margin-bottom: 10% ">
			<div class="col-lg-9" id= "search_button"> 
	    			<div class="input-group">
	      				<input id="this_val" type="text" class="form-control" onkeyup="if(event.keyCode==13){graph(document.getElementById('this_val').value); refresh2(); }else{showHint(this.value);}"  placeholder="Stock Name">
	     				<span class="input-group-btn">
	       	 				<button class="btn btn-default" onclick="graph(document.getElementById('this_val').value); refresh2()" type="button">Go!</button>
	     				</span>
	    			</div>
	    			<br>
	    			<div class ="hint"></div>
	  		</div>
		</div>
		
		<div id="results_box" style="display:none; margin-bottom: 10% ">
			<div class="col-lg-9" id= "search_button1"> 
	    			<div class="input-group">
	      				<input id="this_valu" type="text" class="form-control" onkeyup="if(event.keyCode==13){graph(document.getElementById('this_valu').value); refresh2(); }else{showHint(this.value);}" placeholder="Stock Name">
	     				<span class="input-group-btn">
	       	 				<button class="btn btn-default" onclick="graph(document.getElementById('this_valu').value); refresh2()" type="button">Go!</button>
	     				</span>
	    			</div>
	    			<br>
	    			<div class ="hint"></div>
	    			
	  		</div>
  			<br>
  			<div id="container1">		 
				 <div class="container">
					 <h3 id="s_ticker"> Stock Ticker:</h3>
					 <h3 id="s_name"> Stock Name:</h3>
				 </div>

			 </div>
			 <br>
			 <div class="container">
			 	<div class="col-md-9">
					<div class="colorCard">
						<div class="row">
							<div id="curr_price" class="col-lg-2">Current Price</div>
							<div id="pr_close_price" class="col-lg-2">Previous Close Price</div>		
							<div id="pred_iprice" class="col-lg-2"><h5>Predicted price</h5></div>		
							<div id="confidence_price" class="col-lg-2"><h5>Predicted price</h5></div>		
						</div>
			 		</div>
			 	</div>
			 </div>
			 <br>

			 <div id="people_opinion" style="margin-left:2.1%" >
			 </div>
			

	 <?php
		 if($login == true)
			{
			echo ' 
			 <div id="buy_sell_hold" style="margin-top:2% ;">
				 	<div id="total_price_profit_loss" style="margin-left:2.1%" >
						<div class="btn-group" role="group" >
							  <button type="button" value="buy_poll" class="btn btn-primary" onclick="poll(this)">Buy</button>
							  <button type="button" value="hold_poll" class="btn btn-success" onclick="poll(this)">Hold</button>
							  <button type="button" value="sell_poll" class="btn btn-danger"  onclick="poll(this)">Sell</button>
						</div> 
					</div>
			</div> ';
			}
			?>


			<div id="temp" style="margin:2%;">
				<div id="container" style="height: 400px; min-width: 650px">			 					
				</div>
			</div>    	 
			
			

		</div>
     





		<div id="FAQ_box" style="display:none;">
			<div id="wrapper">
			
		
			 <div id="primary">
                    <h1 id="1">Here are some of the facts of Stock Markets</h1>
                    <ul class="section_menu">
                        <li><a class = "faq" href="#1_1">What exactly is Stock Falcon?</a></li>
                        <li><a class = "faq" href="#1_2">Which stock exchanges of India does this website cover?</a></li>
                        <li><a class = "faq" href="#1_3">What is NSE?</a></li>
                        <li><a class = "faq" href="#1_4">What is dashboard?</a></li>
                        <li><a class = "faq" href="#1_5">What is portfolio?</a></li>
                        <li><a class = "faq" href="#1_6">Can I add the same stock in my portfolio if I have bought some more shares of the same stock at the same/different price?</a></li>
                        <li><a class = "faq" href="#1_7">What is watchlist?</a></li>
                        <li><a class = "faq" href="#1_8">At what intervals do I get the notification mails from Stock Falcon if I have added some stocks in my watchlist?</a></li>
                        <li><a class = "faq" href="#1_9">Where can I get the predicted value for any stock?</a></li>
                        <li><a class = "faq" href="#1_10">Till what time range is the prediction value given,valid? (or) Is the prediction value given only applicable for few hours or days?</a></li>
                        <li><a class = "faq" href="#1_11">A particular stock has a lot of prices attached to it. Which of these prices is taken into consideration for prediction?</a></li>
                        <li><a class = "faq" href="#1_12">How do I know how accurate the predicted value for a stock is?</a></li>
                        <li><a class = "faq" href="#1_13">What does the ‘Learn’ feature do?</a></li>
                        <li><a class = "faq" href="#1_14"> On what basis are the stocks suggested to us?</a></li>
                    </ul>

                    <dl class="faq_1">
                        <dt id="1_1">What exactly is Stock Falcon?</dt>
                        <dd>Please visit our About Us Page. For that, please click on the ‘About Us’ tab in the navigation bar right below the logo of our website.</dd>
                       	<br>
                        <dt id="1_2">Which stock exchanges of India does this website cover?</dt>
                        <dd>Stock Falcon covers the stocks listed under only the National Stock Exchange of India(NSE).</dd>
                        <br>
                        <dt id="1_3">What is NSE?</dt>
                        <dd>The National Stock Exchange (NSE) is India's leading stock exchange covering various cities and towns across the country. NSE was set up by leading institutions to provide a modern, fully automated screen-based trading system with national reach.</dd>
                        <br>
                        <dt id="1_4">What is dashboard?</dt>
                        <dd>Dashboard is the view provided to the users wherein they can get a complete overview of all the features available to them. It contains the following modules-Trading portfolio of the user, Watchlist, User profile</dd>
                        <br>
                        <dt id="1_5">What is portfolio?</dt>
                        <dd>The portfolio is basically the trading portfolio of the user. It will keep a log of all the stocks that the user invests in , in the stock market.</dd>
                        <br>
                        <dt id="1_6">Can I add the same stock in my portfolio if I have bought some more shares of the same stock at the same/different price?</dt>
                        <dd>Yes.If you buy the same stock at a different price or quantity, then you have add the  same stock again with the appropriate quantity and cost price.</dd>
                        <br>
                        <dt id="1_7">What is watchlist?</dt>
                        <dd>In the watchlist feature, the user can add the stocks which they want to track. An email is sent to the user on his registered email id with predicted price of all stocks ini his/her watchlist.</dd>
                        <br>
                        <dt id="1_8">At what intervals do I get the notification mails from Stock Falcon if I have added some stocks in my watchlist?</dt>
                        <dd>The values for all stocks are predicted at the end of each day for the next. So, the users are sent the notification mail at the start of each day before the market opens.</dd>
                        <br>
                        <dt id="1_9">Where can I get the predicted value for any stock?</dt>
                        <dd>The user can get the predicted value for any stock by searching for that stock. If the user has that stock in his/her portfolio then he/she can access the predicted value in the portfolio view too.</dd>
                        <br>
                        <dt id="1_10">Till what time range is the prediction value given,valid? (or)Is the prediction value given only applicable for few hours or days?</dt>
                        <dd>Stock Falcon runs its prediction algorithm even after the stock market closes the day. So we give the prediction for the next day. The stock market is closed on Saturdays and Sundays. Hence the prediction at the end of each Friday is the prediction for the coming Monday.</dd>
                        <br>
                        <dt id="1_11">A particular stock has a lot of prices attached to it. Which of these prices is taken into consideration for prediction?</dt>
                        <dd>For prediction, we take into consideration the adjacent close price of the stock.The adjusted closing price is a useful tool for examination of historical returns because it provides an accurate representation of the firm's equity value beyond the simple market price. It accounts for all corporate actions such as stock splits, dividends/distributions and rights offerings. Hence, we take this price into consideration while running the prediction algorithm.</dd>
                        <br>
                        <dt id="1_12">How do I know how accurate the predicted value for a stock is?</dt>
                        <dd>For every prediction Stock Falcon makes for a stock, a confidence value is calculated. This confidence value is calculated by predicting the values for the last 2 months from today and then comparing them with their actual prices.If both values follow the same trend (increase or decrease) for the day, then the prediction is considered to be correct. The confidence value is then calculated by taking the percentage of the correct predictions.</dd>
                        <br>
                        <dt id="1_13">What does the ‘Learn’ feature do?</dt>
                        <dd>The ‘Learn’ feature gives information about the prediction algorithm used by Stock Falcon and also the basic information one needs to be aware of if he/she wants to enter the share market.</dd>
                        <br>
                        <dt id="1_14">On what basis are the stocks suggested to us?</dt>
                        <dd>Stock Falcon calculates the difference between the predicted price for a day and the closing price of previous day. The stocks with high difference imply that the user will gain if he/she invests in the stock as soon as the stock market opens for trading the very next day. Note that the predicted price calculated by Stock Falcon is not the open price for the next day. Instead it implies that the price of the stock may reach the price predicted at anytime during the next day.</dd>
                    </dl>
                	
				</div>
			
			</div>

		</div>
		<div id="About_box" style="display:none;">
			<div id = "txt">
				<h1>Hardik Fintrade Pvt. Ltd</h1>
                <p>Our company was incorporated in 1996, by promoters, Mr. Dev Aswani, Mr. Narain Aswani and Mr. Mahesh Aswani, all of who are directors of the company. Later in the year 2000, Mr. Suresh Aswani also joined HFPL as a director of the company.</p>

                <p>Earlier,</p>

                <p>Before the company came into existence, its promoters were engaged in brokerage business through a proprietary firm. Mr. Mahesh Aswani start    ed the firm and offered services such as initial public offers and secondary market to its clients. The firm promoters were sub-brokers of the ASE and BSE.</p>

                <p>There used to be a ring where saudas (transactions) took place through a OUT-CRY system. With the introduction of computerised transactions, many exchanges lost their trade volumes which resulted in closure of many of such stock exchanges including the ASEL. However, SEBI permitted extinguishing exchanges to form its subsidiaries and allow their members to trade through market platforms such as the BSE and NSE of India. Such an arrangement allowed HFPL to be affiliated to ASE Capital Market Ltd. (subsidiary of ASEL) and continue serving to its huge client base.</p>

                <p>Now,</p>

                <p>The company has acquired cards of BSE and CDSL (for demate services).</p>

                <p>The company has large number of individual and corporate clients (6000+ as of November 2010). The company has three branches spread across the city and is planning for more branches in the nearby future.</p>

                <p>The company also received best businessman award from All India Sindhi Chamber of Commerce and Industry.</p>
                </div>
		</div>
		<div id="learn_box" style="display:none;">
			<div id="txt">
					<h1>How does the predictor work?</h1>
					<p> One of the main features of Stockfalcon is to enable the users to know the logic behind predicting the price of the stock.
					</p>
					<p align="center"><img src="learn_algo.jpg" alt="Mountain View" style="width:304px;height:228px"></p>
					<h2>Artificial Neural Network</h2>
					<p>
					<h3>What is the concept behind Artificial Neural Network?</h3>
					Neural networks have been used with computers since the 1950s. Through the years, many different models have been presented. The perceptron is one of the earliest neural networks. It was an attempt to understand human memory, learning and cognitive processes. To construct a computer capable of "human-like thought", the researchers have used the only working model they have available - the human brain. However, the human brain as a whole is far too complex to model. Rather, the individual cells that make up the human brain are studied. Following is introduced the schema of the most used artificial neural network.
					</p>
					<p>
					<h3>How is this implemented?</h3>
					<p>For the task of predicting the indexes, we'll be using the so called multilayer feed forward network which is the best choice for this type of application. In a feed forward neural network, neurons are only connected forward. Each layer of the neural network contains connections to the next layer, but there are no connections back. Typically, the network consists of a set of sensory units (source nodes) that constitute the input layer, one or more hidden layers of computation nodes, and an output layer of computation nodes. In its common use, most neural networks will have one hidden layer, and it's very rare for a neural network to have more than two hidden layers. The input signal propagates through the network in a forward direction, on a layer by layer basis. These neural networks are commonly referred as multilayer perceptrons (MLPs). Shown below is a simple MLP with 4 inputs, 1 output, and 1 hidden layer.</p>
					<p align="center"><img src="ann-1.jpg"></p>
					<br>  
					<p>The input layer is the conduit through which the external environment presents a pattern to the neural network. Once a pattern is presented to the input layer, the output layer will produce another pattern. In essence, this is all the neural network does - it matches the input pattern to one which best fits the training's output. It is important to remember that the inputs to the neural network are floating point numbers, represented as C# double type (most of the time you'll be limited to this type).The output layer of the neural network is what actually presents a pattern to the external environment (the result of the computation). The number of output neurons should be directly related to the type of work that the neural network is to perform.</p>

					<p>There are really two decisions that must be made regarding the hidden layers: how many hidden layers to actually have in the network and how many neurons will be in each of these layers. Problems that require two hidden layers are rarely encountered. There is currently no theoretical reason to use neural networks with any more than two hidden layers, thus almost all current problems solved by neural networks are fine with just one hidden layer. Even though the hidden layers do not directly interact with the external environment, they have a tremendous influence on the final output, thus you should carefully choose the number of neurons within it. Using too few neurons in the hidden layers will result in so called "under-fitting", which occurs when the hidden layers are not able to adequately detect the signals in a complicated data set. The "over-fitting" problem can occur, when the neural network has so much information processing capacity that the limited amount of information contained in the training set is not enough to train all of the neurons in the hidden layers. There are many rule-of-thumb methods for determining the correct number of neurons to use in the hidden layers, here are just a few of them:
					<br><br>
					1.	The number of hidden neurons should be between the size of the input layer and the size of the output layer.<br><br>
					2.	The number of hidden neurons should be 2/3 the size of the input layer plus the size of the output layer.<br><br>
					3.	The number of hidden neurons should be less than twice the size of the input layer.<br><br></p>

					<p>Multilayer perceptrons have been applied successfully to solve some difficult and diverse problems, by training them in a supervised manner with a highly popular algorithm known as the error backpropagation algorithm. Please note that in our application, we will be using the Resilient propagation algorithm, which is very similar to backpropagation. The neural network itself will be composed from neurons (main information-processing units as neurons within a human brain) of the same kind, placed within different layers. They will exhibit the same characteristics; hence if you understand how one neuron is designed you will not have problems in understanding how the entire network works. Generally, the model of a neuron can be summarized in the following block diagram:</p>
					<p align="center"><img src="ann-2.jpg"></p>
					<br>
					One can see that there are 3 basic element of a neuronal model:<br><br>
					1.	A set of synapses or connecting links, each characterized by a weight or strength of its own: X1,X2,...,Xn with corresponding weights: Wk0, Wk1,...,Wkm. As you will see further, the weights represent the "knowledge" that the neural network contains about a specific training data. Their values will directly affect the output of the neural network.<br><br>
					2.	An adder for summing the input signals, weighted by the respective synapses of the neuron: Vk = ∑(WkjXj+bk), where k=[1,r], (r=number of neurons), j=[1,m] (m=number of input synapses). Simply speaking - the input signal X is multiplied by the weight W and summed in the adder with all the other items. The result of this summation V will go to the input of the activation function.<br><br> 
					3.	An activation function for limiting the output of a neuron: Yk = Φ(x). The activation function has an important role in the schema of a neuron. It generates the output according to the summed input signals calculated in the adder. Summarized, the output signal of each neuron can be defined as follows: Yk = Φ(∑(WkjXj+bk)). It is important to emphasize that if you want to use Back Propagation learning algorithm for training, then you should take care that your activation function is differentiable. This requirement comes from the fact that since this method requires computation of the Gradient of the error function at each iteration step, we must guarantee the continuity and differentiability of the error function. A commonly used non-linearity that satisfies this requirement is sigmoid nonlinearity defined by the logistic function: Φ(v) = 1/(1+exp(-αv)), where a is the slope parameter of the sigmoid function. By varying the parameter a, we obtain sigmoid functions of different slopes, as illustrated in the following figure (3 different a values):<br><br></p>
					<p align="center"><img src="ann-3.jpg"</p>

					<p>
					<h4>Supervised Training</h4>
					<p>Training is the means by which the weights and threshold values of a neural network are adjusted to give desirable outputs, thus making the network adjust the response to the value which best fits the training data.Propagation Training is a form of supervised training, where the expected output is given to the training algorithm. Propagation training can be a very effective form of training for feed-forward, simple recurrent and other types of neural networks. There are several forms of propagation training. We will analyze 2 of them.</p>
					<br><br>
					<h4>Back Propagation Algorithm</h4>
					<p>Back Propagation algorithm is by far one of the most commonly used algorithms of learning. It is a supervised learning method, and is a generalization of the delta rule. It requires a teacher that knows, or can calculate, the desired output for any input in the training set.</p>
					<p align="center"><img src="ann-4.jpg"></p>
					<br>
					Generally, it can be summarized in the following main steps:<br><br>
					<ul>
					<li>Present a training sample to the neural network.</li>
					<li>Compare the network's output to the desired output from that sample. Calculate the error in each output neuron.</li>
					<li>For each neuron, calculate what the output should have been, and a scaling factor, how much lower or higher the output must be adjusted to match the desired output. This is the local error.</li>
					<li>Adjust the weights of each neuron to lower the local error.</li>
					<li>Assign blame for the local error to neurons at the previous level, giving greater responsibility to neurons connected by stronger weights.</li>
					<li>Present a training sample to the neural network.</li>
					<li>Repeat from step 3 on the neurons at the previous level, using each one's blame as its error.</li>
					</ul>
					<br><br>
					In the below figure, one can visualize the process within which the neural network is trained to work as XOR logical gate.
					<br>
					<p align="center"><img src="ann-5.gif"></p>
					<p>Generally, XOR problem is considered the "Hello World" application in this field of science. The purpose is very straightforward: we will make our neural network "smart enough" to solve the XOR problem.</p>
					<p>The structure of the neural network is very simple: the input layer consists of 2 elements (XOR gate needs 2 Boolean values as input parameters, thus the input is of size 2). The hidden layer contains 3 neurons and finally the output layer has one, which represents the result of XOR operation. At its initial stage (Iteration 0), the weights between the neurons are assigned random values, thus the network does not contain any valuable information by now. Once, we start using Back Propagation algorithm (Iteration 1 - 59), the weights between the neurons are adjusted in a manner that will decrease the error rate, and will generate the output which we do expect. By Iteration 59 we achieve acceptable error rate, thus training process ends, and we can proudly say that the network contains enough "knowledge" to solve the XOR problem. By visualizing the way the values are changed, you can observe that at the initial iterations they fluctuate dramatically on each step (mathematically speaking the algorithm tries to find the steepest descent for the error function). Once the error value starts decreasing significantly, (Iteration 30-59), the weights of the neural network are adjusted in a more granular fashion. The network was trained with 4 combination of XOR gate. Because of the 2D limitation, the figure itself contains an example of only 1 training set (True - True (encoded as 1)), which ultimately should generate False at the output (encoded as 0). If you are interested in more details related to this algorithm, please consult any available material related to it. We will not discuss the mathematics behind Back Propagation algorithm, because we'll use a framework which already has this algorithm implemented (Encog framework).</p>
					<p>
					<h4>Resilient Algorithm</h4>
					<p>One of the problems with the Back Propagation training algorithm is the degree to which the weights are changed. In order to understand better the way error decreases, consider the following error surface:<br>
					<p align="center"><img src="ann-6.jpg"></p>
					<p>Our initial point resides within a place where the error value is highest. The goal of any training algorithm is to minimize the error function. In an ideal case, the algorithm will choose the path (from an infinite amount of paths) to the global minimum, thus achieving the best possible adjustment for the weight components. Unfortunately, Back Propagation algorithm doesn't handle well scenarios when the error surface contains local minims. There is a high probability that the path chosen will lead the error decrease in the direction of local minima. Once it will achieve the point where it cannot decrease anymore (getting stuck into the deepening), it will stop looking for new paths (simply speaking it won't be able to "jump" out from the local minima "hole"). In order to use a "smarter" way of searching the global minimum, the Resilient Propagation algorithm has been introduced. As the Back Propagation algorithm can often apply too large of a change to the weight matrix (delta parameter being too big, which may alter significantly the path chosen in the direction of error decrease), the Resilient Propagation training algorithms only use the sign of the gradient and not the value itself (which will allow it to minimize the chance of falling into the local minimum trap). Once the magnitude is discarded, this means it is only important if the gradient is positive, negative or near zero. The Resilient Propagation training (RPROP) algorithm is usually the most efficient training algorithm provided by Encog (framework used in this application) for supervised feed-forward neural networks. One particular advantage to the RPROP algorithm is that it requires no setting of parameters before using it. There are no learning rates, momentum values or update constants that need to be determined. This is good because it can be difficult to determine the exact learning rate that might be optimal.</p>
					</p>
					<p><h2>Ifs and Buts Related To Stock Market</h2></p>
					<ul>
					<li><b>Am I required to sign any agreement with the broker or sub-broker?</b><br><br> Yes.For the purpose of engaging a broker to execute trades on your behalf from time to time and furnish details relating to yourself for enabling the broker to maintain client registration form you have to sign the "Member - Client agreement" if you are dealing directly with a broker. In case you are dealing through a sub-broker then you have to sign a "Broker - Sub broker - Client Tripartite Agreement". Model Tripartite Agreement between Broker-Sub broker and Clients is applicable only for the cash segment. The Model Agreement has to be executed on the non-judicial stamp paper. The Agreement contains clauses defining the rights and responsibility of Client vis-à-vis broker/ sub broker. The documents prescribed are model formats. The stock exchanges/stock broker may incorporate any additional clauses in these documents provided these are not in conflict with any of the clauses in the model document, as also the Rules, Regulations, Articles, Bylaws, circulars, directives and guidelines.</li>
					<br>
					<li><b>How do I decide how much to invest.</b><br><br> Since equities are high risk, high return instruments, how much you should invest would really depend on how much risk you can tolerate. Take this quiz to find out what your risk profile is. Once you have done that, use this asset allocation test to calculate exactly how much of your savings you should invest in equities.</li>
					<br>					
					<li><b>How do I know if the broker or sub broker is registered?</b><br><br> You can confirm it by verifying the registration certificate issued by SEBI. A broker's registration number begins with the letters "INB" and that of a sub broker with the letters "INS". For the brokers of derivatives segment, the registration number begins with the letters "INF". There is no sub-broker in the derivatives segment.</li>
					<br>
					<li><b>How do I know whether my order is placed?</b><br><br> The Stock Exchanges assign a Unique Order Code Number to each transaction, which is intimated by broker to his client and once the order is executed, this order code number is printed on the contract note. The broker member has also to maintain the record of time when the client has placed order and reflect the same in the contract note along with the time of execution of the order.</li>
					<br>
					<li><b>How do I place my orders with the broker or sub broker?</b><br><br> You can either go to the broker's / sub broker's office or place an order over the phone / internet or as defined in the Model Agreement given above.</li>
					<br>
					<li><b>How long it takes to receive my money for a sale transaction and my shares for a buy transaction?</b><br><br> Brokers were required to make payment or give delivery within two working days of the pay - out day. However, as settlement cycle has been reduced from T+3 rolling settlement to T+2 w.e.f. April 01, 2003, the payout of funds and securities to the clients by the broker will be within 24 hours of the payout.</li>
					<br>
					<li><b>In case of purchase of shares, when do I make payment to the broker?</b><br><br> The payment for the shares purchased is required to be done prior to the pay in date for the relevant settlement or as otherwise provided in the Rules and Regulations of the Exchange.</li>
					<br>
					<li><b>In case of sale of shares, when should the shares be given to the broker?</b><br><br> The delivery of shares has to be done prior to the pay in date for the relevant settlement or as otherwise provided in the Rules and Regulations of the Exchange and agreed with the broker/sub broker in writing.</li>
					<br>
					<li><b>Is there any provision where I can get faster delivery of shares in my account?</b><br><br> The investors/clients can get direct delivery of shares in their beneficial owner accounts. To avail this facility, you have to give details of your beneficial owner account and the DP-ID of your DP to your broker along with the Standing Instructions for 'Delivery-In' to your Depository Participant for accepting shares in your beneficial owner account. Given these details, the Clearing Corporation/Clearing House shall send payout instructions to the depositories so that you receive payout of securities directly into your beneficial owner account.</li>
					<br>
					<li><b>Learn how to choose a stock.</b><br><br> Having understood the markets, it is important to know how to go about selecting a company, a stock and the right price. A little bit of research, some smart diversification and proper monitoring will ensure that things seldom go wrong. It's not that difficult: Just follow these 4 golden rules. And while you are at it why don't you also check out How to buy low, sell high.</li>
					<br>
					<li><b>Monitor and review.</b><br><br> Monitoring your equity investments regularly is recommended. Keep in touch with the quarterly-results announcements and update the prices on your portfolio worksheet atleast once a week. You can use Moneycontrol's Portfolio to update the prices of your equity holdings. Also, review the reasons you earlier identified for buying a stock and check whether they are still valid or there have been significant changes in your earlier assumptions and expectations. And use an annual review process to review your exposure to equity shares within your overall asset allocation and rebalance, if necessary. Ideally, revisit the Risk Analyser at every such review because your risk capacity and risk profile could have undergone a change over a 12-month period. Finally, ensure that you avoid these seven most common investing mistakes and sail smoothly into your financial bright future.</li>
					<br>
					</ul>
					
					</p>
				</div>				
			</div>			
			
		

</div>
<div id = "content2">
 		<div id="latestData" >
 			<?php
 			 	$sql_card = "SELECT * FROM stockfalcon.last WHERE id = 1";
				$result_card = mysql_query($sql_card);
				$row_card = mysql_fetch_array($result_card);
				$var = $row_card['stock_ticker'];
				$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($var);
				$varq = "";
				$output = @file_get_contents($url);
				$vfar = substr($output,6,(strlen($output)-8));
				$obj = json_decode($vfar);
				if(isset($obj->{"t"}))
				{
				echo "<h4>".$obj->{"t"}."</h4>";
				echo "<h4>Current ".$obj->{"l_cur"}."</h4>";
				echo "<h5>Previous Close Rs. ".$obj->{"pcls_fix"}."</h5>"."";
 				}
 			?>
 		</div>



</div>

<?php
 if($login == true)
 {
  echo '
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
       <form name="change_password" class="form-horizontal" role="form">
								                                    
			<div class="form-group">
			    <label for="password" class="col-md-3 control-label">Current Password</label>
			        
			        
			        <div class="col-md-9">
			        <div id="cpass_append">
			        	<input type="password" name ="passwd" class="form-control" >
			        </div>
			        </div>
			</div>
			 <div class="form-group">
			     <label for="new_password" class="col-md-3 control-label">New Password</label>
			        
			        <div class="col-md-9">
			        <div id="npass_append">
			        	<input type="password" name ="newpasswd" class="form-control" >
			        </div>
			        </div>
			</div>
			<div class="form-group">
			     <label for="re_password" class="col-md-3 control-label">Re-type New Password</label>
			        <div class="col-md-9">
			        <div id="rpass_append">
			            <input type="password" name ="repasswd" class="form-control" >
			        </div>
			        </div>
			</div>
								   
		</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return change_pass()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Your Profile</h4>
      </div>
      <div class="modal-body">
        <form id="update_profile" class="form-horizontal" role="form">
								                                    
								                    <div class="form-group">
			                                   			<label for="firstname" class="col-md-3 control-label">First Name</label>
			                                   				<div class="col-md-9">
				                                   				<div id="cfn_append">
				                                      			<input type="text" name="firstname" value ="'.$row['first_name'].'" class="form-control" >
				                                    			</div>
			                                    			</div>
			                               			</div>
			                                		
			                                		<div class="form-group">
			                                    		<label for="lastname" class="col-md-3 control-label">Last Name</label>
			                                    			<div class="col-md-9">
				                                    			<div id="cln_append">
				                                        		<input type="text" name="lastname" value="'.$row['last_name'].'" class="form-control" >
				                                    			</div>
			                                    			</div>
			                                		</div>

			                                		<div class="form-group">
			                                    		<label for="firstname" class="col-md-3 control-label">Birth Date</label>
			                                    			<div class="col-md-9">
				                                    			<div id="cbd_append">
				                                        		<input type="date" name="birthdate" value="'.$row['birthdate'].'" class="form-control" >
				                                    			</div>
			                                    			</div>
			                                		</div>

			                                		<div class="form-group">
				                                    <label for="gender" class="col-md-3 control-label">Gender</label>
							                          <div class="radio">
								                           <div class="col-md-9">
								                           <div id="cg_append">
								                          
									                           <tr>
									                           '.$string.$string2.'
									                           </tr>
								                           
								                           </div>
								                           </div>
							                           </div>
				                          			</div>
			</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return edit_profile()">Save changes</button>
      </div>
    </div>
  </div>
</div>
';
if($row['type'] != "ADMIN")
{
echo'
<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email Help</h4>
      </div>
      <div class="modal-body">
        <form id="help" class="form-horizontal" role="form">
								                                    
			 <div class="form-group">
			    <label for="firstname" class="col-md-3 control-label">Subject</label>
			        <div class="col-md-9">
			        <div id="sub_append">
			            <textarea class="form-control" rows="1" name="subject"></textarea>
			        </div>
			        </div>
			 </div>
			                                		
			 <div class="form-group">
			     <label for="firstname" class="col-md-3 control-label">Message</label>
			    	<div class="col-md-9">
			    	<div id="msg_append">
			     		<textarea class="form-control" rows="4" name="Message"></textarea>
					</div>
					</div>
			 </div>
		</form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return send_message()">Send Message</button>
      </div>
    </div>
  </div>
</div>
';
 }
 }


?>
</body>
</html>