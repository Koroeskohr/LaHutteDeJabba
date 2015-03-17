<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo (isset($this->title) ? $this->title." - " : "")."La Hutte de Jabba";  ?></title>
</head>
<body>
  <header>
    <h1>IMAC Ecommerce</h1>
    <?php if(isset($this->logged) && $this->logged) echo "Bonjour, ".$_SESSION['name']; ?>
    
    <?php if(isset($this->error) && $this->error) echo "Une erreur est survenue"; ?>
  </header>
  