<div>
  <?php //echo $this->id; ?>

  <h2><?php //echo $this->user["name"]; ?></h2>
  <p class="address">
  <?php foreach($this->debug["getby_name"] as $info){
    echo "$info <br />";
  }
  //echo $this->user["address"]; ?>
  </p>
  <p class="email"><?php echo $this->user["email"]; ?></p>

  <?php 
  /*
  afficher tous les utilisateurs
   */
  /*
  foreach($this->allUsers as $user){ 
    echo $user["name"]."\n";
  } 
   */
  ?>
</div>