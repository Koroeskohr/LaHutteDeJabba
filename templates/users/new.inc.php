<form action="user.php" method="post">
  <input type="hidden" name="method" value="create" />
  <p>Email : <input type="text" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" ></p>
  <p>Name : <input type="text" name="name" required></p>
  <p>Address : <input type="text" name="address" required></p>
  <p>Password : <input type="password" name="password" required></p>
  <input type="submit">
</form>

<?php 
  /// TODO : intégrer captcha
?>