
<div class="container ">
	<div class="row ">
      <div class="col-md-6 col-md-offset-3 ">
        <div class="well well-sm">
          <form class="form-horizontal" method="POST" name="contactform">
          <p></p>
          <fieldset>
            
            <legend class="text-center">Contact us</legend>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="subject">Subject</label>
              <div class="col-md-12">
                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control">
                <span id="errorSubject" class="errorMessage"></span>
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Your E-mail</label>
              <div class="col-md-12">
                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                <span id="errorEmail" class="errorMessage"></span>

              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-12">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                <span id="errorMessage" class="errorMessage"></span> 
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="button" class="btn btn-primary btn-md" id="btnSend" name="btnSend">Submit</button>
              </div>
            </div>
          </fieldset>
          <div class="text-center" id="messageAlert"></div>
          
          </form>
          
        </div>
      </div>
	</div>
</div>
