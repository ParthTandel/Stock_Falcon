function validate()
{

    $("#incorrect_email").remove();
    $("#incorrect_password").remove();

    var email = document.getElementById("login-username").value;
    var passw = document.getElementById("login-password").value;
    var emp = false;
    
    if (email == null || email == "") {
       $("#email_append").append("<div style='color:red' id='incorrect_email'>Enter Email </div>");
       emp = true;
    }

   var x = document.forms["sign_up"]["lastname"].value;
    if (passw == null || passw == "") {
       $("#password_append").append("<div style='color:red' id='incorrect_password'>Enter password</div>");
        emp = true;
    }

    if(emp == false)
    {
        var url = "try_ajax.php";
        $.ajax({   type: "POST",
                    url: 'login_ajax.php',
                    data: { 'Email' : email , 'password':passw },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output);
                        if(result[0] == "email")
                        {
                             
                             document.getElementById("email_append").style.marginBottom = "5px";
                             document.getElementById("password_append").style.marginBottom = "20px";
                             $("#email_append").append("<div style='color:red' id='incorrect_email'>Incorrect Email </div>");
                             return;
                             
                        }
                        else if(result[1] == "password")
                        {
                            
                             $("#password_append").append("<div style='color:red' id='incorrect_password'>Incorrect password</div>");
                             document.getElementById("email_append").style.marginBottom = "20px";
                             document.getElementById("password_append").style.marginBottom = "5px";
                             return;
                        }
                        else if(result[0] == result[1])
                        {
                            window.location.replace("index.php");  
                        } 
                        else if(result[0] == result[1])
                        {
                            window.location.replace("index.php");  
                        }
              } }); 

    }  
}


function validate_registeration()
{

    $("#incorrect_email").remove();
    $("#incorrect_firstname").remove();
    $("#incorrect_lastname").remove();
    $("#incorrect_password").remove();
    $("#incorrect_password1").remove();
    $("#incorrect_birthdate").remove();
    $("#incorrect_gender").remove();
    var emp = false;


    var x = document.forms["sign_up"]["firstname"].value;
    if (x == null || x == "") {
       $("#firstname_append").append("<div style='color:red'; id='incorrect_firstname'>First Name cannot be empty </div>");
       emp = true;
    }

   var x = document.forms["sign_up"]["lastname"].value;
    if (x == null || x == "") {
        $("#lastname_append").append("<div style='color:red'; id='incorrect_lastname'>Last Name cannot be empty </div>");
        emp = true;
    }

    var x = document.forms["sign_up"]["passwd"].value;
    var y = document.forms["sign_up"]["passwd1"].value;
   
   if (x== null || x == "") {
        $("#incorrect_password").remove();
        $("#incorrect_password1").remove();
        $("#passwd_append").append("<div style='color:red'; id='incorrect_password'>Password cannot be empty </div>");
        emp = true;
    }

    if (x.length < 5) 
    {


        $("#incorrect_password").remove();
        $("#incorrect_password1").remove();

        $("#passwd_append").append("<div style='color:red'; id='incorrect_password'>length should be greater than or equal to 5 </div>");
        $("#passwd1_append").append("<div style='color:red'; id='incorrect_password1'>length should be greater than or equal to 5 </div>");
        emp = true;
    }

    if (y== null || y== "") {
        $("#incorrect_password").remove();
        $("#incorrect_password1").remove();
        $("#passwd1_append").append("<div style='color:red'; id='incorrect_password1'>Field cannot be empty </div>");
        emp = true;
    }

    if (x!=y && y!= "" && x != "")
    {
        $("#incorrect_password").remove();
        $("#incorrect_password1").remove();
        $("#passwd1_append").append("<div style='color:red'; id='incorrect_password1'>Password Mismatched</div>");
        emp = true;
    }

    var x = document.forms["sign_up"]["birthdate"].value;
   
    

    if (x == null || x == "") 
    {
        $("#birthdate_append").append("<div style='color:red'; id='incorrect_birthdate'>Birthdate cannot be empty </div>");
        emp = true;
    }
    else
    {
      var now = new Date();
      var past = new Date(x);
      var nowYear = now.getFullYear();
      var pastYear = past.getFullYear();
      var age = nowYear - pastYear;
      if(age < 18 || age > 125 )
      {
       
        $("#birthdate_append").append("<div style='color:red'; id='incorrect_birthdate'>Age limit between 18 to 125 only </div>");
        emp =true;
      }
    }

    var x = document.forms["sign_up"]["email"].value;
    if (x == null || x == "") {

       $("#Email_append").append("<div style='color:red'; id='incorrect_email'>Email Required</div>");
        emp = true;
    }

    var x = document.forms["sign_up"]["gender"].value;
    if (x == null || x == "") {
       $("#gender_append").append("<div style='color:red'; id='incorrect_gender'>Required Field</div>");
        emp = true;
    }

    if(emp == false)
    {
        var arr =  $('#signupform').serialize();
        var url = "register_ajax.php";
         $.ajax({   type: "POST",
                    url: 'register_ajax.php',
                    data: arr,
                    success: function(output) 
                    {
                        var result = $.parseJSON(output);
                         if(result[0] == "exists")
                        {
                             $("#Email_append").append("<div style='color:red'; id='incorrect_email'>Email already exists </div>");
                             
                        }else if (result[0] == "email_err") 
                        {
                            $("#Email_append").append("<div style='color:red'; id='incorrect_email'>Incorrect Email Format </div>");
                        }else if(result[0] == "success")
                        {
                             $(document).ready(function() {
                                swal({ 
                                  title: "Registeration Completed !",
                                   text: "Authenticate your account by clicking on the link sent to your mail account",
                                    type: "success" 
                                  },
                                  function(){
                                    window.location.href = 'index.php';
                                });
                                });    
                        }

                    } });
    }

}

function logout()
{

     $.ajax({   type: "POST",
                url: 'ajax_logout.php',
                data: "",
                success: function(output) 
                {
                    var result = $.parseJSON(output);
                    if(result[0] == "true")
                    {
                         $(document).ready(function() {
                            swal({ 
                              title: "logout successful !",
                               text: "Click the button to continue",
                                type: "success" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });    
                    }
                    else
                    {
                        $(document).ready(function() {
                            swal({ 
                              title: "already Logged Out !",
                               text: "Click the button to continue",
                                type: "error" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });  

                    }
                } });
}

function pass_reset()
{
   $("#incorrect_fepass").remove();
  var email = document.forms["pass_reset"]["email"].value;
  var emp = false;
  if (email == null || email == "") 
  {
       $(".rpass_append").append("<div style='color:red'; id='incorrect_cpass'>Cannot be empty </div>");
       emp = true;
  }

  if(emp == false)
    {
    
     $.ajax({   type: "POST",
                    url: 'reset_pass.php',
                    data: { 'email' : email },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == "email_err")
                        {
                            $("#forgot_email_append").append("<div style='color:red'; id='incorrect_fepass'>Incorrect email </div>");
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
                        else if(result[0] == 'success')
                        {
                               
                             $(document).ready(function() {
                            swal({ 
                              title: "Mail Sent !",
                              text: "Click the button to continue",
                              type: "success" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });                        
                        }
                                      
                    } });
    }

  
}

function change_pass()
{
    
    $("#incorrect_cpass").remove();
    $("#incorrect_npass").remove();
    $("#incorrect_rpass").remove();
    var emp = false;
    var cpass = document.forms["change_password"]["passwd"].value;
    var npass = document.forms["change_password"]["newpasswd"].value;
    var rpass = document.forms["change_password"]["repasswd"].value;
  	
    
    if (cpass == null || cpass == "") {
       $("#cpass_append").append("<div style='color:red'; id='incorrect_cpass'>Cannot be empty </div>");
       emp = true;
    }

  
    if (npass == null || npass == "") {
        $("#npass_append").append("<div style='color:red'; id='incorrect_npass'>Cannot be empty </div>");
        emp = true;
    }

    if (npass.length < 5) {
        $("#npass_append").append("<div style='color:red'; id='incorrect_npass'>length should be greater than or equal to 5 </div>");
        emp = true;
    }

    if (rpass == null || rpass == "") {
        $("#rpass_append").append("<div style='color:red'; id='incorrect_rpass'>Cannot be empty </div>");
        emp = true;
    }

     if (npass!=rpass && npass!= "" &&  rpass!= "")
    {
        $("#rpass_append").append("<div style='color:red'; id='incorrect_rpass'>Password Mismatched</div>");
        emp = true;
      
    }


    if(emp == false)
    {
    
     $.ajax({   type: "POST",
                    url: 'change_pass.php',
                    data: { 'cpass' : cpass , 'npass': npass },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == "pass_err")
                        {
                            $("#cpass_append").append("<div style='color:red'; id='incorrect_cpass'>Incorrect Password </div>");
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
                        else if(result[0] == 'success')
                        {
                               
                             $(document).ready(function() {
                            swal({ 
                              title: "Change successful !",
                               text: "Click the button to continue",
                                type: "success" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });                        
                        }
                                      
                    } });
    }

    
}



function edit_profile()
{
    $("#incorrect_change").remove();
    $("#incorrect_change1").remove();
    $("#incorrect_change2").remove();
    $("#incorrect_change3").remove();
    var emp = false;
    var f_name = document.forms["update_profile"]["firstname"].value;
    var l_name = document.forms["update_profile"]["lastname"].value;
    var birth_date = document.forms["update_profile"]["birthdate"].value;
    var gender = document.forms["update_profile"]["gender"].value;
  
    
    if (f_name == null || f_name == "") {
       $("#cfn_append").append("<div style='color:red'; id='incorrect_change'>Cannot be empty </div>");
       emp = true;
    }

  
    if (l_name == null || l_name == "") {
        $("#cln_append").append("<div style='color:red'; id='incorrect_change1'>Cannot be empty </div>");
        emp = true;
    }

    if (birth_date == null || birth_date == "") {
        $("#cbd_append").append("<div style='color:red'; id='incorrect_change2'>Cannot be empty </div>");
        emp = true;
    }
    else
    {
      var now = new Date();
      var past = new Date(birth_date);
      var nowYear = now.getFullYear();
      var pastYear = past.getFullYear();
      var age = nowYear - pastYear;
      if(age < 18 || age > 125 )
      {
       
        $("#cbd_append").append("<div style='color:red'; id='incorrect_change2'>Age limit between 18 to 125 only </div>");
        emp =true;
      }
    }

    if (gender == null || gender == "") {
        $("#cbd_append").append("<div style='color:red'; id='incorrect_change3'>Cannot be empty </div>");
        emp = true;
    }

    if(emp == false)
    {
        
         $.ajax({   type: "POST",
                    url: 'update_profile.php',
                    data: { 'firstname' : f_name , 'lastname': l_name , 'birthdate' : birth_date  , 'gender': gender},
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                       if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {
                               
                             $(document).ready(function() {
                            swal({ 
                              title: "Change successful !",
                               text: "Click the button to continue",
                                type: "success" 
                              },
                              function(){
                                window.location.href = 'index.php';
                            });
                            });                        
                        }
                                      
                    } });

    }

   
}

function send_message()
{
    var emp = false;
    $("#incorrect_change").remove();
    $("#incorrect_change2").remove();
    var sub = document.forms["help"]["subject"].value;
    var msg = document.forms["help"]["Message"].value;
    
    if (sub == null || sub == "") {
       $("#sub_append").append("<div style='color:red'; id='incorrect_change'>Cannot be empty </div>");
       emp = true;
    }

     if (msg == null || msg == "") {
       $("#msg_append").append("<div style='color:red'; id='incorrect_change2'>Cannot be empty </div>");
       emp = true;
    }

    if(emp == false)
    {

        $.ajax({   type: "POST",
                    url: 'help.php',
                    data: { 'subject' : sub , 'message': msg },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == 'please_login')
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
                            else if(result[0] == 'success')
                            {
                                   
                                 $(document).ready(function() {
                                swal({ 
                                  title: "Message Sent !",
                                   text: "Click the button to continue",
                                    type: "success" 
                                  },
                                  function(){
                                    window.location.href = 'index.php';
                                });
                                });                        
                            }
                                   

                    } });
    }

}



function showHint(str) 
{
     $(".incorrect_change").remove();
    if (str.length == 0) 
    { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          
                var str1 = "<div style='color:#6600FF'; class='incorrect_change'>";
                var str2 ="</div>";
                var str3 = xmlhttp.responseText;
                
                if(str3 == "no suggestion")
                {
                    var str1 = "<div style='color:red'; class='incorrect_change'>";
                }
                var res = str1.concat(str3,str2);
                $("#search_button").append(res);
                $("#search_button1").append(res);
            
              
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
  
}


function watch_click(e)
     {
        var currentRow = $(e).closest('tr');
        var row_id = currentRow.attr('id');
        var text1 = currentRow.find(".stock_name").text();
        var text2 = currentRow.find(".stock_ticker").text();
        var temp = [text , text1 , text2];
        var text = 0;
        if(isNaN(text))
        {
            swal("Error Adding !", "Enter legal value Hit value.", "error");
        }
        else
        {
        $.ajax({   type: "POST",
                    url: 'add_stock_watchlist.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2  },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                       if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {
                               
                             $(document).ready(function() {
                            swal({ 
                              title: "Stock Added !",
                               text: "Click the button to continue.",
                                type: "success" 
                              },
                              function(){
                              var newRow = jQuery('<tr id = "'+text2+'" data-visible="false" ><td class="stock_name">'+text1+'</td><td class="stock_ticker">'+text2+'</td><td><button class="btn btn-danger"  onclick="remove_watchlist(this);">Delete</button></td></tr>');
                              jQuery('table#watch_list').append(newRow);
                            });
                            });                        
                        }
                        else if(result[0] == 'update')
                        {

                          var a = document.getElementById(text2);
                          a.remove(); 
                          var newRow = jQuery('<tr id = "'+text2+'" data-visible="false" ><td class="stock_name">'+text1+'</td><td class="stock_ticker">'+text2+'</td><td><button class="btn btn-danger"  onclick="remove_watchlist(this);">Delete</button></td></tr>');
                          jQuery('table#watch_list').append(newRow);
                          swal("Stock Added !", "Click the button to continue.", "success");
                        }
                                      
                    } });
      }
    }




function remove_watchlist(e)
{
  var currentRow = $(e).closest('tr');
  var row_id = currentRow.attr('id');
  var text = currentRow.find(".hit_value").text();
  var text1 = currentRow.find(".stock_name").text();
  var text2 = currentRow.find(".stock_ticker").text();
  var temp = [text , text1 , text2];
  

  swal({   title: "Are you sure?",  
           text: "You will not be able to recover this change!",   
           type: "warning",   
           showCancelButton: true,   
           confirmButtonColor: "#DD6B55",   
           confirmButtonText: "Yes, delete it!",   
           cancelButtonText: "No, cancel!",   
           closeOnConfirm: false,   
           closeOnCancel: false }, 
           function(isConfirm){   
           if (isConfirm) 
           {    

              $.ajax({   type: "POST",
                    url: 'remove_watchlist.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2 , 'hit_value' : text },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {   
                            currentRow.remove();
                            $(document).ready(function() {
                            swal("Deleted!", "Stock has been deleted.", "success");
                            });                        
                        }

                    } });

         

           } 
           else 
           {     swal("Cancelled", "Changes discarded :)", "error");   } });

}


function port_click(e)
     {
        var currentRow = $(e).closest('tr');
        var row_id = currentRow.attr('id');
        var text = currentRow.find(".quantity").text();
        var text1 = currentRow.find(".stock_name").text();
        var text2 = currentRow.find(".stock_ticker").text();
        var text3 = currentRow.find(".cost_price").text();
        var emp = false;
       
        var temp = [text1 , text2 , text3 ,text];
        if (text == null || text == "" || text <= 0)
        {
		       emp = true;
		    }
    		if (text3 == null || text3 == "" || text3 <= 0)
    		{      
    		       emp = true;
    		}
        if(isNaN(text) || isNaN(text3) || emp == true)
        {
            swal("Error Adding !", "Enter legal value values.", "error");
        }
        else
        {
            $.ajax({   type: "POST",
                    url: 'add_stock_portfolio.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2 , 'quantity' : text , 'cost_price' : text3 },
                    success: function(output) 
                    {
                      var result = $.parseJSON(output);
                      if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {
                               
                             $(document).ready(function() {
                            swal({ 
                              title: "Stock Added !",
                               text: "Click the button to continue.",
                                type: "success" 
                              },
                              function(){
                              var newRow = jQuery('<tr class = "stock_portfolio" id = "'+text2+text3+'" data-visible="false" ><td class="stock_name">'+text1+'</td><td class="stock_ticker">'+text2+'</td><td class="quantity">'+text+'</td><td class="cost_price">Rs.'+text3+'</td><td class="current_price">Current Price</td><td class ="profit_loss" >Profit/Loss</td><td>Rs.'+result[1]+'</td><td><button class="btn btn-danger"  onclick="remove_portfolio(this);">Delete</button></td></tr>');
                              jQuery('table#portfolio').append(newRow);
                            
                            });
                            });                        
                        }
                        else if(result[0] == 'update')
                        {                      
                          swal({   title: "Same values",   
                                   text: "If you still wants to add click continue the values will be added with previous data",   
                                   type: "warning",   
                                   showCancelButton: true,   
                                   confirmButtonColor: "#DD6B55",   
                                   confirmButtonText: "Yes, add it!",   
                                   cancelButtonText: "No, discard change !",   
                                   closeOnConfirm: false,   
                                   closeOnCancel: false }, 
                                   function(isConfirm)
                                   {   
                                    if (isConfirm) 
                                      {    
                                         
                                       $.ajax({   type: "POST",
                                                  url: 'update_stock_portfolio.php',
                                                  data: { 'stock_name' : text1 , 'stock_ticker': text2 , 'quantity' : text , 'cost_price' : text3 },
                                                  success: function(output) 
                                                  {
                                                      var result = $.parseJSON(output);
                                                      var a = document.getElementById(text2+text3);
                                                      a.remove();
                                                      var newRow = jQuery('<tr class = "stock_portfolio" id = "'+text2+text3+'" data-visible="false" ><td class="stock_name">'+text1+'</td><td class="stock_ticker">'+text2+'</td><td class="quantity">'+result[1]+'</td><td class="cost_price">Rs.'+text3+'</td><td class="current_price"></td><td class ="profit_loss">Profit/Loss</td><td>Rs.'+result[0]+'</td><td><button class="btn btn-danger"  onclick="remove_portfolio(this);">Delete</button></td></tr>');
                                                      jQuery('table#portfolio').append(newRow);


                                                      swal("Stock Added!", "Your quantity value has been added.", "success");  
                                                  } });
                                        
                                      }
                                   else
                                      {     
                                        swal("Cancelled", "Your changes are discarded :)", "error");   
                                      } 
                                    });
                          
                        }
                                      
                    } });
        }

    }



function remove_portfolio(e)
{
  var currentRow = $(e).closest('tr');
  var row_id = currentRow.attr('id');
  var text = currentRow.find(".quantity").text();
  var text1 = currentRow.find(".stock_name").text();
  var text2 = currentRow.find(".stock_ticker").text();
  var text3 = currentRow.find(".cost_price").text();

  swal({   title: "Are you sure?",  
           text: "You will not be able to recover this change!",   
           type: "warning",   
           showCancelButton: true,   
           confirmButtonColor: "#DD6B55",   
           confirmButtonText: "Yes, delete it!",   
           cancelButtonText: "No, cancel!",   
           closeOnConfirm: false,   
           closeOnCancel: false }, 
           function(isConfirm){   
           if (isConfirm) 
           {    

              $.ajax({   type: "POST",
                    url: 'remove_portfolio.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2 , 'quantity' : text , 'cost_price' : text3 },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                       
                        if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {   
                            currentRow.remove();


                            $(document).ready(function() {
                            swal("Deleted!", "Stock has been deleted.", "success");
                            });                        
                        }

                    } });

         

           } 
           else 
           {     swal("Cancelled", "Changes discarded :)", "error");   } });

}


function remove_admin_stock(e)
{

  var currentRow = $(e).closest('tr');
  var row_id = currentRow.attr('id');
  var text1 = currentRow.find(".stock_name").text();
  var text2 = currentRow.find(".stock_ticker").text();

  swal({   title: "Are you sure?",  
           text: "You will not be able to recover this change!",   
           type: "warning",   
           showCancelButton: true,   
           confirmButtonColor: "#DD6B55",   
           confirmButtonText: "Yes, delete it!",   
           cancelButtonText: "No, cancel!",   
           closeOnConfirm: false,   
           closeOnCancel: false }, 
           function(isConfirm){   
           if (isConfirm) 
           {    

             $.ajax({   type: "POST",
                    url: 'remove_Stock_admin.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2 },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                       
                        if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {   
                            currentRow.remove();
                            $(document).ready(function() {
                            swal({ 
                              title: "Deleted!",
                              text: "Stock has been deleted",
                              type: "success" 
                              },
                              function(){
                                window.location.href = 'admin.php';
                            });
                            });                           
                        }

                    } });

         
           
           } 
           else 
           {     swal("Cancelled", "Changes discarded :)", "error");   } });

}

function add_admin_stock()
{

  var stock_ticker = document.getElementById("stock_ticker").value;
   $("#incorrect_symbol").remove();
 
  if(stock_ticker == "")
  {
    $("#ST_append").append("<div style='color:red' id='incorrect_symbol'>Enter Symbol </div>");
  }
  else
  {
     
     $.ajax({   type: "POST",
                    url: 'add_stock_admin.php',
                    data: {  'stock_ticker': stock_ticker },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {   
                            
                           $(document).ready(function() {
                            swal({ 
                              title: "success",
                               text: "Your stock has been Added",
                                type: "success" 
                              },
                              function(){
                                window.location.href = 'admin.php';
                            });
                            });                       
                        }
                        else if(result[0] == 'already')
                        {
                           
                           $(document).ready(function() {
                            swal({ 
                              title: "Already Present",
                               text: "You are trying to add a stock which is already present",
                                type: "error" 
                              },
                              function(){
                                window.location.href = 'admin.php';
                            });
                            });    

                         
                        }
                        else if(result[0] == 'error')
                        {   
                            $("#ST_append").append("<div style='color:red' id='incorrect_symbol'>No Such Stock exists in NSE </div>");                     
                        }

                    
                    } 
            });

  }
  
}

function timer()
{
  var time = document.getElementById("pred_timer").value;
   $("#incorrect_time").remove();
 
  if(time == null || time == "")
  {
    $("#timer_append").append("<div style='color:red' id='incorrect_time'>Timer value cannot be empty </div>");
  }
  else if(isNaN(time) || time <=0 || time%1 != 0 )
  {
    $("#timer_append").append("<div style='color:red' id='incorrect_time'>Illegal Value , Enter value in numbers </div>");
  }
  else if(time > 7)
  {
    $("#timer_append").append("<div style='color:red' id='incorrect_time'>Day limit 7 </div>");
  }
  else
  {
      $.ajax({   type: "POST",
                    url: 'timer.php',
                    data: { 'time' : time},
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 
                        if(result[0] == 'please_login')
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
                        else if(result[0] == 'success')
                        {  
                            $(document).ready(function() {
                            swal({ 
                              title: "Changed!",
                              text: "Values changed",
                              type: "success" 

                              },
                              function(){
                                 $("#pred_timer").attr("placeholder", "Prediction Timer in Days(enter number)");
                            });
                            });                           
                        }

                    } });
          
  }

}

function load_comp()
    {
       var total = 0;
        setInterval(function()
        { 
          $.each($('.stock_portfolio'), function() 
          { 
              var currentRow = $(this).closest('tr');
              var row_id = currentRow.attr('id');
              var text = currentRow.find(".quantity").text();
              var text1 = currentRow.find(".stock_name").text();
              var text2 = currentRow.find(".stock_ticker").text();
              var text3 = currentRow.find(".cost_price").text();
              $.ajax({   type: "POST",
                    url: 'getlatestportfolio.php',
                    data: { 'stock_name' : text1 , 'stock_ticker': text2 , 'quantity' : text , 'cost_price' : text3 },
                    success: function(output) 
                    {
                        var result = $.parseJSON(output); 

                         currentRow.find(".current_price").html(result[0]);
                         currentRow.find(".profit_loss").html('Rs.'+result[1]);
                         total = total + result[1];      
                         if (result[1]<0) 
                         {
                              currentRow.find(".profit_loss").css('color' , 'red');
                         }
                        else if (result[1]>0) 
                         {
                              currentRow.find(".profit_loss").css('color' , '#31B404');
                         }
                    } });
        });
        document.getElementById('total_price_profit_loss').innerHTML = "Your Current market Status : Rs."+total;
        if(total < 0)
        {
          document.getElementById("total_price_profit_loss").style.background = "rgba(255, 71, 71 , 0.8)";
        }
        else
        {
           document.getElementById("total_price_profit_loss").style.background = "rgba(0, 204, 0 , 0.6)";
        }
        total = 0;
        }, 1000);
    }






    
    