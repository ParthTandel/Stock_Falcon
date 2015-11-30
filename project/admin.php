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
	  <link rel="stylesheet" type="text/css" href="main.css">
	  <script type="text/javascript" src="js/validate.js" ></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	  <script src="sweetalert-master/lib/sweet-alert.min.js"></script> 
	  <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
	  <link rel="stylesheet" type="text/css" href="sweetalert-master/lib/sweet-alert.css">

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

<body>

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
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="#" onClick="$('#userlog_box').hide(1000); $('#userlogresults_box').hide(1000); $('#edittimers_box').hide(1000); $('#add_removestocks_box').show(1000);$('#Profile_box').hide(1000)">Add/Remove Stocks</a></li>
					<li><a href="#" onClick="$('#add_removestocks_box').hide(1000); $('#userlogresults_box').hide(1000); $('#edittimers_box').hide(1000); $('#userlog_box').show(1000);$('#Profile_box').hide(1000)">Stock Log</a></li>
					<li><a href="#" onClick="$('#userlog_box').hide(1000); $('#add_removestocks_box').hide(1000); $('#userlogresults_box').hide(1000);$('#edittimers_box').show(1000);$('#Profile_box').hide(1000)">Edit Timers</a></li>
					<li><a href="#" onClick="$('#userlog_box').hide(1000); $('#add_removestocks_box').hide(1000); $('#userlogresults_box').hide(1000);$('#edittimers_box').hide(1000);$('#Profile_box').show(1000)">Profile</a></li>
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
					            <li><button type="button" class="btn btn-default btn-sm temp_button" onclick="return logout()">Logout</button></li>
					          </ul>
					        </li>
					      </ul>
					    
					      ';
			}

		?>
			</div>
		</div>
	</nav>	

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


			 }

?>

	<div id="content">
		<div id = "edittimers_box" style="display:none;">
			<div class = "well">
				<div class = "row">
					<div class="col-lg-6" "search_button"> 
					<div id="timer_append">
						<div class="input-group">
						
							<input type="text" class="form-control" placeholder="Prediction Timer in Days(enter number)" onkeyup="if(event.keyCode==13){ timer()}" id = "pred_timer">
							<span class="input-group-btn">
								<button class="btn" type="button" onclick="timer()">Edit</button>
							</span>
						</div>
						</div>
					</div>					
				</div>
			</div>
		</div>

		<div id = "userlog_box" style = "display:none;">
			<div class="panel panel-default">
			<div class="panel-heading"><b>Stock Log</b></div>
				<table class="table table-hover table-bordered table-responsive table-condensed">
					<tr>
						<td><b>#</b></td>
						<td><b>Stock Ticker</b></td>
						<td><b>Stock Name</b></td>
					</tr>
					<?php
						$sql2= "SELECT * FROM ".DB_NAME.".prediction ORDER BY counter DESC , stock_ticker ASC";
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

		<div id = "add_removestocks_box">
			<div class="row">
				<div class="col-lg-2">
   	 				<button class="btn btn-success" type="button" data-toggle = "modal" data-target = "#myModal_addstocks" style="color:white">Add Stocks</button>
   	 			</div>
			</div>			
			<br>		
			<div class="well">
				<div class="panel panel-default">
				<table class="table table-hover table-bordered table-responsive table-condensed">
					<tr>
						<td><b>#</b></td>
						<td><b>Stock Ticker</b></td>
						<td><b>Stock Name</b></td>
						<td><b>Remove</b></td>
					</tr>
					<?php
						$sql= "SELECT * FROM ".DB_NAME.".prediction ";
	  					$result2 = mysql_query($sql);
	  					$count = 0;
						if(isset($result2))
						{
							while($row2 = mysql_fetch_assoc($result2))
							{
								$count ++;
								echo '
								<tr id="'.$row2['stock_name'].'">
									<td>'.$count.'</td>
									<td class="stock_ticker">'.$row2['stock_ticker'].'</td>
									<td class="stock_name">'.$row2['stock_name'].'</td>
									<td><button class="btn btn-danger"  onclick="remove_admin_stock(this);">Remove</button> </td>
								</tr>';
							}
						}
					?>
					
				</table>	
				</div>
			</div>					
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
	</div>



		<div class= "modal fade" id="myModal_addstocks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type = "button" class="close" data-dismiss = "modal" aria-label = "Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Stock</h4>
					</div>
					<div class="modal-body">						
						<form id="signupform" class="form-horizontal" role="form">
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label for="ticker" class="col-md-3 control-label">Stock Ticker</label>
								<div class="col-md-9">
								<div id="ST_append">
									<input id="stock_ticker" type="text" class="form-control" name="ticker" placeholder="Ticker Symbol" value = "">
								</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" onclick="add_admin_stock()" >Add Stock</button>
								<button type="button" class="btn btn-info" data-dismiss = "modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
