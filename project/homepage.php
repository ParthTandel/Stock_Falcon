<?php

require_once('config.php');
require_once('database.php');
$cookie_name = "user" ;
$login = false;
if(!isset($_COOKIE[$cookie_name])) 
{

}
else 
{  

      $login = true;
      $table = 'personal_info';
      $test = new data_base();
      $sql= "SELECT first_name FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
      $result = mysql_query($sql);
	  $row = mysql_fetch_assoc($result);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<header >
	
		<img id ="head" src="images/StockFalconLogo-other.jpg" alt="Mountain View" style="width:152px;height:147px">
		<br>
		<br>
		<br>
		<ul class="nav navbar-nav navbar-right">
			 <font face="verdana"> 
			 	<font color="green">     
			 	 <a href="#" onClick="">Site Map</a>
			 	 <br>
			  	<a href="#" onClick="">Contact Us</a>
			  	<br>
			  	<a href="#" onClick="">Disclaimer</a>
			  </font>
			</font>

		</ul>
		<h1 id="head1">Stock Falcon</h1>
		 
			        
			     
		
</header>

<body>



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
			 </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <ul class="nav navbar-nav">
			      <li><a href="#" onClick="$('#search_box').hide(2000); $('#FAQ_box').hide(2000); $('#About_box').hide(2000); $('#home_box').show(2000)"	>Home</a></li>
			      <li><a href="#" onClick="$('#home_box').hide(2000); $('#About_box').hide(2000); $('#FAQ_box').hide(2000); $('#search_box').show(2000)"	>Search</a></li>
			      <li><a href="#" onClick="$('#search_box').hide(2000); $('#home_box').hide(2000); $('#About_box').hide(2000); $('#FAQ_box').show(2000)"	>FAQ</a></li>
			      <li><a href="#" onClick="$('#search_box').hide(2000); $('#FAQ_box').hide(2000); $('#home_box').hide(2000); $('#About_box').show(2000)"	>About Us</a></li> 	
			    </ul>  
			    <ul class="nav navbar-nav navbar-right">
			       <li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login/Register<span class="caret"></span></a>
			        	<ul class="dropdown-menu" role="menu">
			            <li>
						 	<button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal_reg">
							Login
							</button>

			            </li>
			            <li>
			            	<button type="button" class="btn btn-default btn-sm temp_button" data-toggle="modal" data-target="#myModal_log">
							 Register
							</button>

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
								        <div style="margin-bottom: 5px" class="input-group">
								        	 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								         	 <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="User Email">                                        
								        </div>
								        </div>  
								        <div style="margin-bottom: 20px" id="password_append">                    
								        <div style="margin-bottom: 25px" class="input-group">
								             <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								             <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
								        </div>
								        </div>     
								        <div style="margin-top:10px" class="form-group">
								       		<div class="col-sm-12 controls">
								                <a id="btn-login" href="#" class="btn btn-success">Login  </a>
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
			                            
			                                <div class="form-group">
			                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
			                                    <div class="col-md-9">
			                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
			                                    <div class="col-md-9">
			                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="password" class="col-md-3 control-label">Password</label>
			                                    <div class="col-md-9">
			                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="Retype password" class="col-md-3 control-label">Retype Password</label>
			                                    <div class="col-md-9">
			                                        <input type="password" class="form-control" name="passwd" placeholder="Retype Password">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="birthdate" class="col-md-3 control-label">Birth date</label>
			                                    <div class="col-md-9">
			                                        <input type="date" class="form-control" name="birthdate">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label for="email" class="col-md-3 control-label">Email</label>
			                                    <div class="col-md-9">
			                                        <input type="email" class="form-control" name="email" placeholder="xyz@domain.com">
			                                    </div>
			                                </div>
			                                    
			                                <div class="form-group">
			                                    <label for="gender" class="col-md-3 control-label">Gender</label>
						                          <div class="radio">
							                           <div class="col-md-9">
							                           <tr>
							                           <td> <label><input type="radio" name="gender">Male</label> </td>
							                           <td> <label><input type="radio" name="gender">Female</label> </td>
							                           </tr>
						                           </div>
			                         		 </div>
			                                <div class="form-group">
			                                    <!-- Button -->                                        
			                                    <div class="col-md-offset-3 col-md-9">
			                                        <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> Sign Up</button>
			                                        <span style="margin-left:8px;"></span>  
			                                    </div>
			                                </div>
			                   		</form>
			                   	</div>
						</div>
			    	</div>
			  </div>
		</nav>
</div>


<div id = "content" >
		<div id="home_box" >
			<div id = "txt">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</div>	
		</div>
		<div class="container">
			<br>
			<br>
		<div id="search_box" style="display:none; ">


			  <div class="col-lg-6" id= "search_button"> 
    			<div class="input-group">
      				<input type="text" class="form-control" placeholder="Search for...">
     				<span class="input-group-btn">
       	 				<button class="btn btn-default" type="button">Go!</button>
     				 </span>
    			</div><!-- /input-group -->
  			  </div><!-- /.col-lg-6 -->
		</div>

		</div>
		<div id="FAQ_box" style="display:none;">
			<div id="wrapper">
			
		
			<div id="primary">
				<h3 id="1">Here are some of the facts of Stock Markets</h3>
				<ul class="section_menu">
					<li><a class = "faq" href="#1_1">WHY WOULD I CHOOSE STOCKS IN THE FIRST PLACE?</a></li>
					<li><a class = "faq" href="#1_2">WHAT INSTRUMENTS ARE TRADED IN THE STOCK MARKETS?</a></li>
					<li><a class = "faq" href="#1_3">WHERE DO I BUY STOCKS?</a></li>
					<li><a class = "faq" href="#1_4">WHERE DO I FIND STOCK RELATED INFORMATION?</a></li>
					<li><a class = "faq" href="#1_5">WHAT ARE ADVANCES AND DECLINES?</a></li>
					<li><a class = "faq" href="#1_6">HOW CAN YOU QUALIFY THE MARKET AS BULL OR BEAR?</a></li>
					<li><a class = "faq" href="#1_7">WHAT NEXT?</a></li>
				</ul>
				<dl class="faq_1">
				  <dt id="1_1">WHY WOULD I CHOOSE STOCKS IN THE FIRST PLACE?</dt>
				    <dd>Stocks are one of the most effective tools for building wealth, as stocks are a share of ownership of a company. You thus have great potential to receive monetary benefits when you own stock shares. Owning stocks of fundamentally strong companies simply lets your money work harder for you since they appreciate in value over a period of time while also offering rich dividends on a periodic basis.</dd>
				  <dt id="1_2">WHAT INSTRUMENTS ARE TRADED IN THE STOCK MARKETS?</dt>
				    <dd>The various types of instruments traded in the stock market include shares, mutual funds, IPOs, futures and options.</dd>
				  <dt id="1_3">WHERE DO I BUY STOCKS?</dt>
				    <dd>Stock trading happens on stock exchanges. However, you cannot buy directly at the exchange. To buy stocks, you need to find a suitable broker who will understand your needs and buy stocks on your behalf. You can think of them as agents who will conduct transactions for you without actually owning any of the securities themselves. In exchange for facilitating or executing a trade, brokers will charge you a commission. You can easily buy stocks through our website. Once you are registered with us, you can trade using the Stock Falcon website, our desktop trading application and Trade facility.</dd>
				  <dt id="1_4">WHERE DO I FIND STOCK RELATED INFORMATION?</dt>
				    <dd>Some of the most accessible avenues to get stock information are the internet, business news channels and print media. You could alternatively access our website and get all the information that you wanted within a matter of seconds.</dd>
				  <dt id="1_5">WHAT ARE ADVANCES AND DECLINES?</dt>
				    <dd>Advances and declines give you an indication of how the overall market has performed. You get a good overview of the general market direction. As the name suggest 'advances' inform you how the market has progressed. In contrast, 'declines' signal if the market has not performed as per expectations. The Advance-Decline ratio is a technical analysis tool that indicates market movement. </dd>
				  <dt id="1_6">HOW CAN YOU QUALIFY THE MARKET AS BULL OR BEAR?</dt>
				    <dd>Bull and bear markets signify relatively long-term movements of significant proportion. Hence, these runs can be gauged only when the market has been moving in its current direction (by about 20% of its value) for a sustained period. One does not consider small, short-term movements that last for a few days, as they may only indicate corrections or short-lived movements.</dd>
				  <dt id="1_7">WHAT NEXT?</dt>
				    <dd>Congrats, now you know all about the trading in the equity markets, different kinds of stocks as well as the prerequisites for trading – demat and trading accounts. Now, let’s move on to the currency market. Click here.
					In case you have any more queries regarding your accounts or trading, check here.</dd>
				</dl>
				
			</div>
			
		</div>

		</div>
		<div id="About_box" style="display:none;">
			<div id = "txt">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</div>
		</div>

</div>



</body>
</html>