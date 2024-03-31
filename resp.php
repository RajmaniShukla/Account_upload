<!DOCTYPE html>
<html>
  <head>
  <script>
  function x1(f)
  {
    alert("dd");
 var val;
  var ele = document.forms[f].elements;
  for (i=0;i<ele.length;i++)
  {
   val = ele[i].id;
   if (val.substring(0,5)=="entry")
   {
 	  var tt= document.getElementById(val);
 	  //alert(tt);
 	  tt.style.backgroundColor="red";
	alert(val);
	}	   
  }
  
}
function x2()
{
 document.getElementById('e').innerHTML = "<input type='text' id='entry-3' name = 'p'>" ;

}
    </script>
    <meta charset="utf-8" />
    <title>Responsive Registration Form</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="resp.css" />
  </head>
  <body onload="x1('x');">
    <div class="container">
      <h1 class="form-title">Registration</h1>
      <form action="#" name = 'x'>
 <span id = 'e'></span>
        <div class="main-user-info">
          <div class="user-input-box">
            <label for="fullName">Full Name</label>
            <input type="text"
                    id="entry-1"
                    name="fullName" value="kk"
                    placeholder="Enter Full Name" onblur = "x2(); x1('x')"/>
          </div>
          <div class="user-input-box">
            <label for="username">Username</label>
            <input type="text"
                    id="entry-2"
                    name="username"
                    placeholder="Enter Username"/>
          </div>
 <div class="user-input-box">
            <label for="fullName">Full Name</label>
            <input type="text"
                    id="fullName1"
                    name="fullName"
                    placeholder="Enter Full Name"/>
          </div>
          <div class="user-input-box">
            <label for="username">Username</label>
            <input type="text"
                    id="display-1"
                    name="username"
                    placeholder="Enter Username" style="background-color:red;"/>
          </div>
           <div class="user-input-box">
            <label for="fullName">Full Name</label>
            <input type="text"
                    id="fullName2"
                    name="fullName"
                    placeholder="Enter Full Name"/>
          </div>
          <div class="user-input-box">
            <label for="username">Username</label>
            <input type="text"
                    id="username"
                    name="username"
                    placeholder="Enter Username"/>
          </div>
          <div class="user-input-box">
            <label for="email">Email</label>
            <input type="email"
                    id="email"
                    name="email"
                    placeholder="Enter Email"/>
          </div>
          <div class="user-input-box">
            <label for="phoneNumber">Phone Number</label>
            <input type="text"
                    id="phoneNumber"
                    name="phoneNumber"
                    placeholder="Enter Phone Number"/>
          </div>
          <div class="user-input-box">
            <label for="password">Password</label>
            <input type="password"
                    id="password"
                    name="password"
                    placeholder="Enter Password"/>
          </div>
          <div class="user-input-box">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Confirm Password"/>
          </div>
        </div>
        <div class="gender-details-box">
          <span class="gender-title">Gender</span>
          <div class="gender-category">
            <input type="radio" name="gender" id="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female">
            <label for="female">Female</label>
            <input type="radio" name="gender" id="other">
            <label for="other">Other</label>
          </div>
        </div>
        <div class="form-submit-btn">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </body>
</html>
