<?php

require_once('config.php');
require_once('database.php');
$cookie_name = "user" ;
$login = false;
$test = new data_base();

if(!isset($_COOKIE[$cookie_name])) 
{
	
	header("Location: index.php");
}
else 
{  

      $login = true;
      $table = 'personal_info';
    
      $sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
      $result = mysql_query($sql);
	  $row = mysql_fetch_assoc($result);

	  if($row['type'] != "USER")
	  {
	  	header("Location: index.php");
	  }

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


	  $sql= "SELECT * FROM ".DB_NAME.".prediction ";
	  $result2 = mysql_query($sql);
	  $result3 = mysql_query($sql);
}


?>





	<!DOCTYPE html>
	<html lang="en">
	<head>
	  <title>Stock Falcon</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="main.css">
	  <script type="text/javascript" src="js/validate.js" ></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	  <script src="sweetalert-master/lib/sweet-alert.min.js"></script> 
	  <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
	  <link rel="stylesheet" type="text/css" href="sweetalert-master/lib/sweet-alert.css">
	  <style type="text/css">

	  .col-lg-4
		{

			margin-right: 3%;
			padding: 2%;
			border-radius: 10px;
			color: white;
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
		<h1 id="head1">Stock Falcon</h1>			      		
	</header>
	
<body onload="load_comp()">
		
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
				    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				     
		</div>
	
				    <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="#" onClick="$('#Watchlist_box').hide(1000); $('#suggest_box').hide(1000); $('#Profile_box').hide(1000);$('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#portfolio_box').show(1000)">Portfolio</a></li>
				<li><a href="#" onClick="$('#portfolio_box').hide(1000); $('#suggest_box').hide(1000);$('#Profile_box').hide(1000); $('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#Watchlist_box').show(1000)">Watchlist</a></li>
				<li><a href="#" onClick="$('#Watchlist_box').hide(1000); $('#suggest_box').hide(1000); $('#portfolio_box').hide(1000);$('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#Profile_box').show(1000)">Profile</a></li>
				
		  	
			</ul>
		

		<?php

			if($login == true)
			{
				echo '
						
						<ul class="nav navbar-nav navbar-right">
					     
					        <li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello '.$row['first_name'].' ! <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal1">Change Password</button></li>
					            <li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal2"> Edit Profile</button></li>
					            <li><button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal3">Help</button></li>
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


?>
	
	
		<div id="content">
		<div id="addstock_box" style="display:none;">
			<p>Select the list of stock(s) you want to add to your portfolio and fill in the quantity.</p>	
			<div class="panel panel-default">
			<div class="panel-heading"><b>NSE Stock List</b></div>	
			<table class="table table-hover table-bordered table-responsive table-condensed">
				<tr>

					<td><b>#</b></td>
					<td><b>Stock Name</b></td>
					<td><b>Stock Ticker</b></td>
					<td><b>Quantity</b></td>
					<td><b>Cost Price</b></td>
					<td><b>Add</b></td>
				</tr>

				<?php
				$count = 0;
					if(isset($result2))
					{
						while($row2 = mysql_fetch_assoc($result2))
						{
							$count ++;
							echo '
							<tr id="'.$count.'">
								<td>'.$count.'</td>
								<td class="stock_name">'.$row2['stock_name'].'</td>
								<td class="stock_ticker">'.$row2['stock_ticker'].'</td>
								<td class="quantity" contenteditable="true"></td>
								<td class="cost_price" contenteditable="true"></td>
								<td><button class="btn btn-info"  onclick="port_click(this);">ADD</button> </td>
							</tr>';
						}
					}
				?>
			</table>
			</div>
			<button class="btn btn-info" onClick="$('#Watchlist_box').hide(1000);$('#suggest_box').hide(1000); $('#Profile_box').hide(1000);$('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#portfolio_box').show(1000)">Back to Portfolio</button>
		</div>
		
		

		<div id="addwatchstock_box" style="display:none;">
		<p>Select the list of stock(s) you want to add to your watchlist.</p>	
		<div class="panel panel-default">
		<div class="panel-heading"><b>NSE Stock List</b></div>
				
			<table class="table table-hover table-bordered table-responsive table-condensed">
				<tr>
					<td><b>#</b></td>
					<td><b>Stock Name</b></td>
					<td><b>Stock Ticker</b></td>
					<td><b>Add</b></td>
				</tr>
				
				<?php
				$count = 0;
					if(isset($result3))
					{
						while($row2 = mysql_fetch_assoc($result3))
						{
							$count ++;
							echo '
							<tr id="'.$count.'">
								<td>'.$count.'</td>
								<td class="stock_name">'.$row2['stock_name'].'</td>
								<td class="stock_ticker">'.$row2['stock_ticker'].'</td>
								<td><button class="btn btn-info"  onclick="watch_click(this);">ADD</button> </td>
							</tr>';
						}
					}
				?>
				
			</table>
		</div>
			<button class="btn btn-info" onClick="$('#portfolio_box').hide(1000); $('#suggest_box').hide(1000);$('#Profile_box').hide(1000);$('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#Watchlist_box').show(1000);">Back to Watchlist</button>
		</div>		
		
								
		<div id="Profile_box" style="display:none;">
						<div id = "txt">
								<div class="container">
										<div class="col-lg-9">
										<div class="well">
										<h2>Personal Information</h2>
												<table class="table table-hover table-condensed">
													<tr>
														<td><b>First Name</b></td>
														<td><?php echo $row['first_name']; ?></td>
													</tr>
													<tr>
														<td><b>Last Name</b></td>
														<td><?php echo $row['last_name']; ?></td>
													</tr>
													<tr>	
														<td><b>E-mail</b></td>
														<td><?php echo $row['email']; ?></td>
													</tr>
		
													<tr>
														<td><b>Date of Birth</b></td>
														<td><?php echo $row['birthdate']; ?></td>
													</tr>	
													<tr>
														<td><b>Gender</b></td>
														<td><?php echo $row['gender']; ?></td>
													</tr>	
												</table>	
									</div>
								</div>
							</div>
						</div>	
				</div>

		<div id="suggest_box" style="display:none;">
			<div class="container">
				<div class="col-lg-9">
				<div class="colorCard">
					<div class="panel panel-default">
					<div class="panel-heading"><b>Suggested Stocks</b></div>
					<table class="table table-hover table-bordered table-responsive table-condensed">
						<tr bgcolor="#85C2FF">
							<td><b>#</b></td>
							<td><b>Stock Ticker</b></td>		
							<td><b>Stock Name</b></td>		
						</tr>	

					<?php
						$sql2= "SELECT * FROM ".DB_NAME.".prediction ORDER BY difference DESC";
	  					$result2_log = mysql_query($sql2);
	  					$count = 0;
						if(isset($result2_log))
						{
							while($row2 = mysql_fetch_assoc($result2_log))
							{
								$count ++;
								echo '
								<tr>
									<td>'.$count.'</td>
									<td class="stock_ticker">'.$row2['stock_ticker'].'</td>
									<td class="stock_name">'.$row2['stock_name'].'</td>
								</tr>';
							}
						}
					?>		
					</table>	
					</div>	
				</div>
				<br>
				<button class="btn btn-info" onClick="$('#Watchlist_box').hide(1000); $('#Profile_box').hide(1000);$('#addstock_box').hide(1000);$('#addwatchstock_box').hide(1000);$('#suggest_box').hide(1000);$('#portfolio_box').show(1000)">Back to Portfolio</button>
				</div>
			</div>
			<br><br>
			
					
		</div>
	

	
		<div id="portfolio_box">
			<div id = "txt">
				Maintain list of stocks you own,know your status in the market everyday.
				<br><br>
			</div>
			<div class="container">
				<button class="btn btn-info" onClick="$('#portfolio_box').hide(1000);$('#addstock_box').show(1000);" align="left">Add Stock to Portfolio</button>
				<button class="btn btn-info" onClick="$('#portfolio_box').hide(1000);$('#addstock_box').hide(1000);$('#suggest_box').show(1000);" align="left">Suggest Stock</button>
				<br>
				<br>		
				<br>		
				<div id="total_price_profit_loss" class="col-lg-4"></div>
			</div>
			<br>	
			<div class="panel panel-default">
			<div class="panel-heading"><b>Portfolio</b></div>		
			<table id = "portfolio" class="table table-hover table-bordered table-responsive table-condensed">
				<tr bgcolor="#85C2FF">
					<td><b>Stock Name</b></td>
					<td><b>Stock Ticker</b></td>
					<td><b>Quantity</b></td>
					<td><b>Cost Price</b></td>				
					<td><b>Current Price</b></td>
					<td><b>Profit/Loss</b></td>
					<td><b>Predicted Price</b></td>
					<td><b>Delete</b></td>				
				</tr>
				<?php
								$table2 = $_COOKIE[$cookie_name].'_portfolio';
								$sql2 = "SELECT * FROM ".DB_NAME.".".$table2;
							  	$result4 = mysql_query($sql2);
							  	$count = 0 ;


								if(isset($result4))
								{
									while($row3 = mysql_fetch_assoc($result4))
									{
										$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($row3['stock_ticker']);
										$varq = "";
										$output = @file_get_contents($url); 
										$vfar = substr($output,6,(strlen($output)-8));
										$obj = json_decode($vfar);
										$values_now = 0 ;
										$actualprice = 0;
										$set = "false";

										if(isset($obj->{"l_cur"}))
										{
											$values_now = $obj->{"l_cur"} ;
											$temp = substr($values_now,3,strlen($values_now));
											$actualprice = preg_replace("/[^0-9.]/", "", $temp);
											$set = "true";
										}
										
										$profit_loss = (float)$actualprice - (float)$row3['cost_price'];
										$profit_loss = $row3['quantity'] * $profit_loss ;
										if($set == "false")
										{
											$profit_loss = 0;
										}




										$count ++;
										$var1 = $row3['stock_ticker'];
										$vfar = substr($var1,0,(strlen($var1)));
										$sqll = "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker = '".$vfar."'";
										$r5 = mysql_query($sqll);
							  			$r = mysql_fetch_assoc($r5);
							  			
							  		
										echo '
										<tr class = "stock_portfolio" id = "'.$row3['stock_ticker'].$row3['cost_price'].'" data-visible="false" >
											<td class="stock_name">'.$row3['stock_name'].'</td>
											<td class="stock_ticker">'.$row3['stock_ticker'].'</td>
											<td class="quantity">'.$row3['quantity'].'</td>
											<td class="cost_price">Rs.'.$row3['cost_price'].'</td>
											<td class="current_price">'.$values_now.'</td>
											<td class ="profit_loss">Rs. '.$profit_loss.'</b></td>
											<td class="prediction">Rs.'.$r['predicted_value'].'</td>
											<td><button class="btn btn-danger"  onclick="remove_portfolio(this);">Delete</button> </td>
										</tr>';
									}
								}


				?>						
			</table>	
			</div>	
			
		</div>	


	
		<div id="Watchlist_box" style="display:none;">
			<div id = "txt">
				Follow the stocks you wish to track and get notified if a notable prediction happens.<br><br>
				<div class="container">
					<div class="col-lg-9">
					<button class="btn btn-info" onClick="$('#Watchlist_box').hide(1000);$('#addwatchstock_box').show(1000);">Add Stock to Watchlist</button>
					<br><br>
					<div class="panel panel-default">
					<div class="panel-heading"><b>Watchlist</b></div>	
						
						<table id="watch_list" class="table table-hover table-bordered table-responsive table-condensed">
							<tbody>
							<tr bgcolor="#85C2FF">
								
								<td><b>Stock Name</b></td>
								<td><b>Stock Ticker</b></td>
								<td><b>Remove</b></td>			
							</tr>

							<?php
								$table = $_COOKIE[$cookie_name].'_watchlist';
								$sql = "SELECT * FROM ".DB_NAME.".".$table;
							  	$result3 = mysql_query($sql);
							  	$count = 0;
								if(isset($result3))
								{
									while($row3 = mysql_fetch_assoc($result3))
									{
										$count ++;
										echo '
										<tr id = "'.$row3['stock_ticker'].'" data-visible="false" >
											<td class="stock_name">'.$row3['stock_name'].'</td>
											<td class="stock_ticker">'.$row3['stock_ticker'].'</td>
											<td><button class="btn btn-danger"  onclick="remove_watchlist(this);">Delete</button> </td>
										</tr>';
									}
								}


							?>

							</tbody>			
						</table>
					</div>						
					</div>
				</div>
			</div>	
		</div>
	
	</div>

</body>
</html>