<?php
  function createContact($contactId) {
?>
  <a href="edit.html">
    <article id=<?php echo "\"$contactId\"" ?> class="contact">
      <div class="info">
        <img class="preview-profile-pic" src="src/img/profile.svg" alt="">
        <div class="flex-column">
          <h4 class="name">Gabriel de Oliveira Ribeiro</h4>
          <h5 class="phone">+55 (32) 9 8844-7670</h5>
        </div>
      </div>
      <nav>
        <button type="submit" id="call"><i class="fa-solid fa-phone"></i></button>
        <button type="submit" id="videoCall"><i class="fa-solid fa-video"></i></button>
        <button type="submit" id="sendMessage"><i class="fa-solid fa-comment-sms"></i></button>
      </nav>
    </article>
  </a>
<?php } ?>
