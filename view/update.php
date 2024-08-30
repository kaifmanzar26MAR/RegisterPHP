<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update</title>
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
        <form  id="form">
          <input type="number" name="userId"
            placeholder="Enter Id (must be unique)"
            id="userId"
            class="userIddiv"
            readonly
            >
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
          <label id="selectedImage" for="userImage"></label>
          <input type="file" name="userImage" id="userImage"/>

          <input type="submit" id="submit" value="Update User" />
        </form>
      </div>
    </div>
  </body>
  <script src="../js/update.js"></script>
</html>
