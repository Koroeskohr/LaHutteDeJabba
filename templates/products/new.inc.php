<form action="product.php" method="post">
  <input type="hidden" name="method" value="create" />
  <p>Name : <input type="text" name="name"></p>
  <p>Desc: <input type="text" name="description"></p>
  <p>Category : 
    <select name="category_id">
    <?php foreach ($this->categories as $key => $category) : ?>
      <option value="<?php echo $category["id"]; ?>"> <?php echo $category["name"]?></option>
    <?php endforeach; ?>
    </select>
  </p>  
  <p>price : <input type="text" name="price"></p>
  <p>amount available : <input type="text" name="amount"></p>

  <input type="submit">
</form>