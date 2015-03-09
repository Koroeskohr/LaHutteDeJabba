<form action="product.php" method="post">
  <input type="hidden" name="id" value="<?php echo $this->id; ?>">
  <input type="hidden" name="method" value="edit">
  <p>Name : <input type="text" name="name"></p>
  <p>Desc: <input type="text" name="description"></p>
  <p>cat id : <input type="text" name="category_id"></p>
  <p>price : <input type="text" name="price"></p>
  <p>amount available : <input type="text" name="amount"></p>

  <input type="submit">

</form>