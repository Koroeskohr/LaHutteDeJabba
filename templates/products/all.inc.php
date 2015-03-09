<div>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Desc</td>
      <td>Price</td>
      <td>Amount</td>
      <td>Category_id</td>
    </tr>

    <?php foreach($this->products as $key => $product) :?>
      <tr>
        <td><?php echo $product["id"]; ?></td>
        <td><?php echo $product["name"]; ?></td>
        <td><?php echo $product["description"]; ?></td>
        <td><?php echo $product["price"]; ?></td>
        <td><?php echo $product["amount_available"]; ?></td>
        <td><?php echo $product["Categories_id"]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>