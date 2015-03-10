<form action="product.php" method="post">
  <input type="hidden" name="id" value="<?php echo $this->id; ?>">
  <input type="hidden" name="method" value="edit">
  <p>Name : <input type="text" name="name" value="<?php echo $this->product["name"]; ?>"></p>
  <p>Desc: <input type="text" name="description" value="<?php echo $this->product["description"]; ?>"></p>
  <p>cat id : 
  <select name="category_id">
<?php foreach ($this->categories as $key => $category) : ?>
    <option value="<?php echo $category["id"]; ?>" <?php if($category["id"] == $this->product["Categories_id"]) echo "selected"; ?> ><?php echo $category["name"] ?></option>
<?php endforeach; ?>
  </select>
  <p>price : <input type="text" name="price" value="<?php echo $this->product["price"]; ?>"></p>
  <p>amount available : <input type="text" name="amount" value="<?php echo $this->product["amount_available"]; ?>"></p>

  <input type="submit">

</form>