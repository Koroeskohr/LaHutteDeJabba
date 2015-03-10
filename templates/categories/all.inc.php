<div>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
    </tr>
<?php foreach($this->categories as $category) :?>
      <tr>
        <td><?php echo $category["id"]; ?></td>
        <td><?php echo $category["name"]; ?></td>
      </tr>
<?php endforeach; ?>
  </table>
</div>