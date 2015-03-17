<form action="category.php" method="post">
  <input type="hidden" name="id" value="<?php echo $this->id; ?>">
  <input type="hidden" name="method" value="edit">
  <p>Name : <input type="text" name="name" value="<?php echo $this->category["name"]; ?>"></p>
  <input type="submit">

</form>