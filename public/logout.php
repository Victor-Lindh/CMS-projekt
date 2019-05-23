<?php
   require 'main.js';
   session_start();

   session_destroy();

   // header('Location: index.php');
?>

<script>
  loadView(views.startUp);
</script> 