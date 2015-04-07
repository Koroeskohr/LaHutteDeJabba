<div>
  <h2>Résultats de la recherche : </h2>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Desc</td>
      <td>Price</td>
      <td>Amount</td>
      <td>Category_id</td>
    </tr>

    <?php if(!$this->results) echo "no result"; ?>
    <?php foreach($this->results as $key => $result) :?>
      <tr>
        <td><?php echo $result["id"]; ?></td>
        <td><a href="product.php?id=<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></a></td>
        <td><?php echo $result["description"]; ?></td>
        <td><?php echo $result["price"]; ?></td>
        <td><?php echo $result["amount_available"]; ?></td>
        <td><?php echo $result["Categories_id"]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>