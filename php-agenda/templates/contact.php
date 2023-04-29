<?php
  function createContact($assocContact) {
    $id = $assocContact->id;
    $name = $assocContact->name;
    $surname = $assocContact->surname;
    $nick = $assocContact->nick;
    $email = $assocContact->email;
    $number = $assocContact->number;
    $birthdate = $assocContact->birthdate;
    $photo = $assocContact->photo;
    $date_register = $assocContact->date_register;
?>
<form method="POST" action="edit.php" class="form-contact">
  <article class="contact" id=<?php echo "\"$id\"" ?>>
    <button type="submit">
      <img class="preview-profile-pic" src=<?php echo "\"$photo\"" ?> alt="">
      <div class="info">
        <h4 class="name"><?php echo "$name $surname" ?></h4>
        <h4 class="nick"><?php echo "$nick" ?></h4>
        <h4 class="nick"><?php echo "$number" ?></h4>
        <h4 class="nick"><?php echo "$birthdate" ?></h4>
        <h4 class="nick"><?php echo "$email" ?></h4>
      </div>
    </button>
    <nav>
      <a type="submit" id="call"><i class="fa-solid fa-phone"></i></a>
      <a type="submit" id="videoCall"><i class="fa-solid fa-video"></i></a>
      <a type="submit" id="sendMessage"><i class="fa-solid fa-comment-sms"></i></a>
    </nav>
  </article>
  </button>
  <?php
    echo "<input hidden name='id' value='$id'>";
    echo "<input hidden name='name' value='$name'>";
    echo "<input hidden name='surname' value='$surname'>";
    echo "<input hidden name='nick' value='$nick'>";
    echo "<input hidden name='email' value='$email'>";
    echo "<input hidden name='number' value='$number'>";
    echo "<input hidden name='birthdate' value='$birthdate'>";
    echo "<input hidden name='photo' value='$photo'>";
    echo "<input hidden name='data_register' value='$date_register'>";
    ?>
</form>
<?php } ?>