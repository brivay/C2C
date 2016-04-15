<?php include "templates/includes/header.php"; ?>

  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-12 about-text intro">
  				<h3>Hi! Do you have another great resource to reccomend? Send it on over! 
  					<br>All feedback is welcomed and appreciated.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 about-text send">
          <h2>Send: </h2>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 about-text center-block switch">
          <div class="radio1">
            <p class="link1">Feedback</p>
          </div>
          <div class="radio2">
            <p class="link2">Resource</p>
          </div>
        </div>
      </div>

        <div class="row">      
            <div class="feedback-form about-text" style="display: none">
                <form method="POST" action="contactpage/feedback.php" enctype="multipart/form-data">
                    <div class=col-md-6 col-xs-12>
                        <input type="text" name="name" id="name" required="required" placeholder="Name" class="form"/>
                        <input type="text" name="email" id="email" required="required" placeholder="Email" class="form"/>
                    </div>
                    
                    <div class=col-md-6 col-xs-12>
                        <!-- <input type="text" name="feedback-message" id="feedback-message" required="required" placeholder="Message" class="form textarea"/> -->
                        <textarea name="message" id="feedbackm"class="form textarea" required="required" placeholder="Message"></textarea>
                    </div>

                    <div class=col-md-12 col-xs-12>
                        <button type="submit" id="submit" name="submit" value="insert record" class="send-button">Send Message</button>
                    </div>
                </form>
            </div>


            <div class="resource-form about-text" style="display: none">
                <form method="post" action="contactpage/resourcesubmit.php">
                    <div class=col-md-6 col-xs-12>
                        <input type="text" name="name" id="name" required="required" placeholder="Name" class="form"/>
                        <input type="text" name="email" id="email" required="required" placeholder="Email" class="form"/>

                        <select class="dropdown form" name="resource-type">
                            <option selected disabled>Resource Type</option>
                            <option value="Learn">Learn</option>
                            <option value="Practice">Practice</option>
                            <option value="Everything Else">...and Everything Else</option>
                        </select>
                    </div>

                    
                    <div class=col-md-6 col-xs-12>
                        <input type="text" name="url" id="url" required="required" placeholder="URL" class="form"/>
                        <!-- <input type="text" name="feedback-message" id="feedback-message" required="required" placeholder="Message" class="form textarea"/> -->
                        <textarea name="comment" id="resource-comment"class="form textarea" required="required" placeholder="Comments"></textarea>
                    </div>

                    <div class=col-md-12 col-xs-12>
                        <button type="submit" id="submit" name="submit" class="send-button">Send Message</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        
    </div>
  	</div>





<?php include "templates/includes/footer.php" ?>




