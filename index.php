
<?php require_once 'inc/header.php' ?>
   
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
           
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
          
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
           
          </div>
        </div>
      </div>
    </div>
  

    <div class="latest-products">
      <div class="container">
        <?php require_once 'inc/sucess.php'?>
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
            
            </div>
          </div>
          <?php
          require_once 'connection.php';





          $query="select * from posts";
          $res=mysqli_query($conn,$query);
          if(mysqli_num_rows($res)>0){
            $posts=mysqli_fetch_all($res,MYSQLI_ASSOC);
          }
          else{
            echo "No Posts";
          }
?>
           <?php foreach($posts as $post){ ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="assets/images/postImage/<?php echo $post['image'] ?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?php echo $post['title'] ?></h4></a>
                <p><?php echo $post['created_at'] ?><p>
                <p><?php echo $post['body'] ?></p>
            
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
          </div>
     <?php  }?>
          
        </div>
      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
