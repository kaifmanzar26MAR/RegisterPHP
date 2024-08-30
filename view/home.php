<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php 
      include ("navbar.php");
    ?>
    <div class="main">
        <div class="bubble" id="one"></div>
        <div class="bubble" id="two"></div>
      <div class="container">
        <h1>Add a new User</h1>
        <form  id="form" enctype="multipart/form-data">
          <input
            type="number"
            name="userId"
            placeholder="Enter Id (must be unique)"
            id="userId"

          />
          <input type="text" name="name" placeholder="Your Name" id="name" required />
          <input type="email" name="email" placeholder="Your Email" id="email" required />
          <input
            type="number"
            name="contact"
            placeholder="Your contact"
            id="contact"
            required
          />
          <input
            type="text"
            name="address"
            placeholder="Enter your full address"
            id="address"
            required
          />
          <input type="file" name="userImage" id="userImage"/>

          <input type="submit" id="submit" value="Add User" />
        </form>
      </div>
    </div>
  </body>
  <script src="../js/script.js"></script>
</html>
