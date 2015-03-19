<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo (isset($this->title) ? $this->title." - " : "")."La Hutte de Jabba";  ?></title>
</head>
<body>
  <header>
    <h1>IMAC Ecommerce</h1>
    <?php if($this->logged) echo "Bonjour, ".$_SESSION['name']; ?>
    
    <?php if($this->flash) {
        echo "Une (Des) erreur(s) est (sont) survenue(s) : <br/>";
        foreach ($this->flash as $key => $error) {
          echo "Error $key : $error<br/>";
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
  