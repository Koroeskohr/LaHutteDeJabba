<div>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
    </tr>
<?php if (isset($this->categories)) :
      foreach($this->categories as $category) :?>
      <tr>
        <td><?php echo $category["id"]; ?></td>
        <td><a href="category.php?id=<?php echo $category["id"]; ?>"><?php echo $category["name"]; ?></a></td>
      </tr>
<?php endforeach; endif;?>
  </table>
</div>