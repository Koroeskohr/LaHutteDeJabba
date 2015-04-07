<div>
  <h2>Product</h2>
    <div>
      <h3>Name : <?php echo $this->product["name"]; ?></h3>
      <p>Price : <?php echo $this->product["price"]; ?> €</p>
      <p>Description : <?php echo $this->product["description"]; ?></p>
      <p>Amount available : <?php echo $this->product["amount_available"]; ?></p>

      <?php if($this->logged) {
        echo "<a href=\"cart.php?add&id=".$this->product["id"]."\">Ajouter au panier</a>";
      }
      ?>
    </div>

    <a href="product.php?all">&lt;&lt; Back to Products</a>
    
    <?php if($this->reviews): ?>
    <div>
      <h2>Latest reviews : </h2>
      <?php foreach ($this->reviews as $review) : ?>
      <p><a href="user.php?id=<?php echo $review["Users_id"]; ?>"><?php echo $review["name"]."</a>  "; for($i=0;$i<$review["stars"];$i++) echo "*"; ?></p>
      <p><?php echo $review["commentary"]; ?></p>
      <?php endforeach; ?>

    </div>
    <?php endif; ?>
    
    <?php if($this->logged && !$this->hasCommented): ?>
    <form action="review.php" method="post">
      <h2>Add a review</h2>
      <input type="hidden" name="product" value="<?php echo $this->product["id"]; ?>">
      <input type="number" name="stars" min="0" max="5" value="5">
      <br>
      <textarea name="commentary" placeholder="Commentaire"></textarea>
      <input type="submit">
    </form>
  <?php endif; ?>
  
</div>