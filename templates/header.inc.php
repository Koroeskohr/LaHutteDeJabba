<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo (isset($this->title) ? $this->title." - " : "")."La Hutte de Jabba";  ?></title>
</head>
<body>
  <header>
    <h1><a href="index.php">IMAC Ecommerce</a></h1>
    <?php if($this->logged) {
      echo "<p>Bonjour, ".$_SESSION['name']."</p>"; 
      echo "<a href=\"logout.php\">Logout &gt;&gt;</a>";
    } 
    ?>
    
    <?php if($this->logged) : ?>
    <p><a href="cart.php?list">Mon panier</a> : <?php echo purify(count($_SESSION["cart"]));?> objet<?php echo (count($_SESSION["cart"]) > 1 ? "s":""); ?></p>
    <p><a href="user.php">Mon profil</a></p>  
  
    <?php endif; ?>

    <?php if($this->flash) {
        echo "Messages : <br/>";
        foreach ($this->flash as $key => $error) {
          echo "Message $key : $error<br/>";
        }
      }
    ?>

    <?php if(!$this->logged) : ?>
    <form action="login.php" method="post">
      <p>Se connecter :</p>
      <input type="text" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
      <input type="submit">
    </form>

    <form action="register.php" method="post">
      <p>S'inscrire :</p>
      <input type="text" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
      <input type="text" name="name" placeholder="name">
      <input type="text" name="address" placeholder="address">
      <input type="submit">
    </form>
    <?php endif; ?>
  </header>
  <hr>
  