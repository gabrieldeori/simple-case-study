<?php
  function basicInput($id, $type, $place_holder, $src, $value = "", $isRequired) {
    global $erro_geral, $usuario;
?>
  <div class="input-group">
    <img class="input-icon" src=<?php echo "\"$src\"" ?> alt="">
    <input
      <?php
        if(isset($erro_geral) or isset($usuario->erro["erro_$id"])) {
          echo "class=\"erro-input\""; 
        }
      ?>
        value=<?php echo "\"$value\""; ?>
        type=<?php echo "\"$type\""; ?>
        name=<?php echo "\"$id\""; ?>
        id=<?php echo "\"$id\""; ?>
        placeholder=<?php echo "\"$place_holder\""; ?>
        <?php if ($isRequired) { echo "required"; } ?>
      >
      <?php
        if(isset($usuario->erro["erro_$id"])) {
          echo "<div class=\"erro\">" . $usuario->erro["erro_".$id] . "</div>";
        }
      ?>
  </div>
<?php
}
?>
