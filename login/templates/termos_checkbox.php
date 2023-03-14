<div
  <?php
    if(isset($erro_geral) or isset($erro_checkbox)) {
      echo "class=\"erro-input\" \"input-check-group\"";
    } else {
      echo "class=\"input-check-group\"";
    }
  ?>
>
  <input type="checkbox" name="termos" id="termos" value="ok" required>
  <label for="termos">
    Ao se cadastrar você concorda com a nossa
    <a class="link" href="">Política de Privacidade</a>
    e os nossos <a class="link" href="">Termos de Uso</a>.
  </label>
  <?php
    if(isset($erro_checkbox)) {
      echo "<div class=\"erro\">$erro_checkbox</div>";
    }
  ?>
</div>
