<?php 
  require_once 'models/product.model.php';
  require_once 'db.inc.php';

  die();

  $products = new Product($db);


  $toAdd = [];
  $toAdd[] = ["Sabre laser","C'est un ssabre laser de Star Wars",10,100,3];
  $toAdd[] = ["Crâne de cristal","Le crâne de cristal d'Indiana Jones 4",10,100,4];
  $toAdd[] = ["Tesseract","Artefact qui pourrait détruire le monde, sauvé par les avengers",10,100,4];
  $toAdd[] = ["Lanterne Verte","Artefact du corps des Green Lantern, leur permet d'utiliser leur bague",10,100,5];
  $toAdd[] = ["Bouclier de Captain America","Un beau bouclier rouge bleu et blanc",10,100,3];
  $toAdd[] = ["Mjolnir","Marteau de Thor. Seul lui peut le porter",10,100,3];
  $toAdd[] = ["Baxter Building","Immeuble des Fantastic Four",10,100,2];
  $toAdd[] = ["Tatooine","Planète de l'univers Star wars, dont est issue la famille Skywalker",10,100,2];
  $toAdd[] = ["Trône de fer","Le trône royal du continent de Westeros",10,100,1];
  $toAdd[] = ["Batarang","Boomerang de Batman",10,100,3];
  $toAdd[] = ["Excalibur","Arme légendaire du roi Arthur, arrachée de la pierre",10,100,3];
  $toAdd[] = ["Pistolet d'or","Arme a une balle d'un ennemi de James bond",10,100,3];
  $toAdd[] = ["Le cinquième élément","Il sauva la terre d'une invasion grace à bruce willis. Leeloo Dalla multipass",10,100,1];
  $toAdd[] = ["Lunettes de soleil de Horacio Kaine","YEAAAAAAAAAAH",10,100,1];
  $toAdd[] = ["Trombone de MacGyver","Vous servira à tout, surtout à desamorcer des bombes",10,100,4];
  $toAdd[] = ["Chapeau melon d'Alex DeLarge","Chapeau imprégné de violence physique et psychologique",10,100,1];
  $toAdd[] = ["Coeur de Davy Jones","Le coeur d'un poulpe humanoide",10,100,4];
  $toAdd[] = ["Gants de boxe de Rocky","Ils te casseront les dents et appeleront Adrienne",10,100,1];
  $toAdd[] = ["Tête du chevalier sans tête","On la cherchait depuis Sleepy Hollow, ce dullahan l'a perdue",10,100,4];
  $toAdd[] = ["Masque de Guy Fawkes","ANONIMOUSSE",10,100,5];
  $toAdd[] = ["Le Masque","Splendide !",10,100,5];

  foreach ($toAdd as $item) {
    $products->create($item[0], $item[1], $item[4], $item[3], $item[2]);
  }





 ?>