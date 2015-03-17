<div>
  <table>
    <tr>
      <td>ID</td>
      <td>Email</td>
      <td>Name</td>
      <td>Address</td>

    </tr>
<?php foreach($this->users as $user) :?>
      <tr>
        <td><?php echo $user["id"]; ?></td>
        <td><?php echo $user["name"]; ?></td>
      </tr>
<?php endforeach; ?>
  </table>
</div>