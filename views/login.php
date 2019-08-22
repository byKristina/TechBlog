<body class="body-green" data-elink-extension-installed="1.1.5">

    <!-- Body -->
	<div class="wrapper body-inverse"> <!-- wrapper -->
	  <div class="container">
	    <div class="row">
		  <!-- Login form -->
		  <div class="col-sm-5 col-sm-offset-1">
            <p></p>
		    <h3>Login</h3>
			<p class="text-muted">
			  Please fill out the form below to login to your account.
			</p>
			<div class="form-white">
			  <form role="form" method="POST" action="modules/login.php"  onSubmit='return checkLogin()' name="submitLog">
			    <div class="form-group">
				  <label for="email">Email address</label>
				  <input type="email" class="form-control" id="email" placeholder="Enter email" name="tbEmail">
			    <span id="errorEmail" ></span>
				  </div>
			    <div class="form-group">
				  <label for="password">Password</label>
				  <input type="password" class="form-control" id="password" placeholder="Password" name="tbPassword">
					<span id="errorPassword" ></span>
			    </div>
			    
			    
					<button type="submit" class="btn btn-block btn-color btn-xxl" id="btnLogin" name="btnLogin">Login</button>
			  </form>
			 			 
			
			  <div class="form-avatar hidden-xs">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-user fa-stack-1x"></i>
				</span>
			  </div>
			</div>
		  </div>
		  <!-- Registration form -->
		  <div class="col-sm-5">
              <p></p>
		    <h3 class="text-right-xs">Registration </h3>
			<p class="text-muted text-right-xs">
			  Please fill out the form below to create a new account.
			</p>
			<div class="form-white">
				<form role="form" method="POST" action="modules/register.php" name="submitR" onSubmit='return checkRegistration()' >
				  <div class="form-group">
				    <label for="name">First Name</label>
					<input type="text" class="form-control" id="firstName" placeholder="Your first name" name="tbFirstName">
					<span id="errorFirstName" ></span>
					</div>
					<div class="form-group">
				    <label for="name">Last Name</label>
					<input type="text" class="form-control" id="lastName" placeholder="Your last name" name="tbLastName">
				  <span id="errorLastName" ></span>
					</div>
				  <div class="form-group">
				    <label for="username">Username</label>
					<input type="text" class="form-control" id="username" placeholder="Username" name="tbUsername">
				  <span id="errorUsername" ></span>
					</div>
				  <div class="form-group">
				    <label for="email2">Email address</label>
					<input type="email" class="form-control" id="emailR" placeholder="Enter email" name="tbEmailR">
				  <span id="errorEmailR" ></span>
				  </div>
				  <div class="form-group">
					<div class="row">
					  <div class="col-md-12">
					  <label for="password2">Password</label>
					  <input type="password" class="form-control" id="passwordR" placeholder="Password" name="tbPasswordR">
					  <span id="errorPasswordR" ></span>
						</div>
					  
					</div>
				  </div>
				 
				
					<button type="submit" class="btn btn-block btn-color btn-xxl" id="btnRegister" name="btnRegister">Create an account</button>
					
					<div id="messageRegister"></div>

				</form>

			</div>
		  </div>
		</div>
	  </div>
	</div> 
