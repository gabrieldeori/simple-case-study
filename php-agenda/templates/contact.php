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
  <form method="POST" class="contact" action="edit.php">
      <article
        id=<?php echo "\"$id\"" ?>
        class="contact"
      >
        <button type="submit" class="info">
          <img class="preview-profile-pic" src=<?php echo "\"$photo\"" ?> alt="">
          <div class="flex-column">
            <h4 class="name"><?php echo "$name $surname" ?></h4>
            <h4 class="nick"><?php echo "$nick" ?></h4>
            <h5 class="phone"><?php echo "$number" ?></h5>
          </div>
        </button>
        <nav>
          <a type="submit" id="call"><i class="fa-solid fa-phone"></i></a>
          <a type="submit" id="videoCall"><i class="fa-solid fa-video"></i></a>
          <a type="submit" id="sendMessage"><i class="fa-solid fa-comment-sms"></i></a>
        </nav>
        <input type="hidden" name="teste" value="ABC">
      </article>
    </button>
    <?php
      echo "<input hidden name='id' value=" . $assocContact->id . ">";
      echo "<input hidden name='name' value=" . $assocContact->name . ">";
      echo "<input hidden name='surname' value=" . $assocContact->surname . ">";
      echo "<input hidden name='nick' value=" . $assocContact->nick . ">";
      echo "<input hidden name='email' value=" . $assocContact->email . ">";
      echo "<input hidden name='number' value=" . $assocContact->number . ">";
      echo "<input hidden name='birthdate' value=" . $assocContact->birthdate . ">";
      echo "<input hidden name='photo' value=" . $assocContact->photo . ">";
      echo "<input hidden name='data_register' value=" . $assocContact->date_register . ">";
    ?>
  </form>
<?php } ?>
