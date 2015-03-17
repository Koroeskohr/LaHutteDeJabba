<form action="user.php" method="post">
  <input type="hidden" name="method" value="edit">
  <p>Name : <input type="text" name="name" value="<?php echo $this->user["name"]; ?>"></p>
  <p>Email : <input type="text" name="email" value="<?php echo $this->user["email"]; ?>"></p>
  <p>Address : <input type="text" name="address" value="<?php echo $this->user["address"]; ?>"></p>
  <input type="submit">

</form>