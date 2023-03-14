<?php
  function basicInput($id, $type, $place_holder, $src, $type_error, $value = "") {
?>
  <div class="input-group">
    <img class="input-icon" src=<?php echo "\"$src\"" ?> alt="">
    <input
      <?php
        if(isset($erro_geral) or isset($usuario->erro[$type_error])) {
          echo "class=\"erro-input\""; 
        }
      ?>
        value=<?php echo "\"$value\""; ?>
        type=<?php echo "\"$type\""; ?>
        name=<?php echo "\"$id\""; ?>
        id=<?php echo "\"$id\""; ?>
        placeholder=<?php echo "\"$place_holder\""; ?>
        required
      >
      <?php
        if(isset($usuario->erro[$type_error])) {
          echo "<div class=\"erro\">" . $usuario->erro . "[type_error]</div>";
        }
      ?>
  </div>
<?php
}
?>
