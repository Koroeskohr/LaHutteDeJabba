<div>
  <?php foreach ($this->cartItems as $item) {
    echo "<a href=\"product.php?id=".$item->item["id"]."\"><p>".$item->item["name"]."</a> : ".$item->amount."</p>";
  } ?>

  <a href="checkout.php">Checkout</a>
  <?php /// TODO ^ ?>
</div>