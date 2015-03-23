<form action="register.php" method="post">
  <input type="hidden" name="method" value="create" />
  <p>Email : <input type="text" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" ></p>
  <p>Name : <input type="text" name="name" required></p>
  <p>Address : <input type="text" name="address" required></p>
  <p>Password : <input type="password" name="password" required></p>
  <p>
    Captcha : <?php echo $this->captcha[0]." + ".$this->captcha[1]." ?" ?>
    <input type="text" name="captcha">
    <input type="hidden" name="captcha1" value="<?php echo $this->captcha[0]; ?>">
    <input type="hidden" name="captcha2" value="<?php echo $this->captcha[1]; ?>">
  </p>
  <input type="submit">
</form>