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
        <td><a href="user.php?id=<?php echo $user["id"]; ?>"><?php echo $user["name"]; ?></a></td>
      </tr>
<?php endforeach; ?>
  </table>
</div>