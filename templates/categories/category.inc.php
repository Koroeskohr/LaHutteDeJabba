<div>
  <h2>Category</h2>
    <div>
      <h3><?php echo $this->category["id"]; ?></h3>
      <p><?php echo $this->category["name"]; ?></p>
    </div>

  <?php if (!empty($this->products)): ?>
  <h3>Products : </h3>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Desc</td>
      <td>Price</td>
      <td>Amount</td>
    </tr>
    <?php foreach($this->products as $product) :?>
      <tr>
        <td><?php echo $product["id"]; ?></td>
        <td><?php echo $product["name"]; ?></td>
        <td><?php echo $product["description"]; ?></td>
        <td><?php echo $product["price"]; ?></td>
        <td><?php echo $product["amount_available"]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
  
</div>