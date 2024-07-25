<?php 
      require_once 'connection.php';
      if(isset($_SESSION['error'])){
        foreach($_SESSION['error'] as $err){?>
        <div class="alert alert-danger"><?php echo $err ?></div>

     <?php  }

     unset($_SESSION['error']);
      }
    
    ?>