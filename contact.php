<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family:Sans-serif ;
    }
</style>
<?php include('header.php') ?>


<br><br><br>
<body>
  <div class="container">
    <h1 style="text-align: center;">Contact Us</h1>
    <p style="text-align: center;">We would love to hear from you! Reach out to us using the contact information below or fill out the form.</p>
    
    <div class="row">
      <div class="col-md-6">
        <h3>Contact Information</h3>
        <p><strong>Address:</strong> 4213 Nairobi, Kenya</p>
        <p><strong>Phone:</strong> +254 722-456-789</p>
        <p><strong>Email:</strong> info@supermetro.com</p>
      </div>
      
      <div class="col-md-6">
        <h3>Contact Form</h3>
        <form>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>
    </div>
  </div>