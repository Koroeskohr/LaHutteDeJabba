<div>
  <h2>Product</h2>
    Products in category :<br/>
      <?php foreach($this->products as $product) : ?>
        <div>
          <h3><?php echo $product["name"]; ?></h3>
          <p><?php echo $product["price"]; ?>€</p>
          <p><?php echo $product["description"]; ?></p>
        </div>
      <?php endforeach; ?>
  
</div>