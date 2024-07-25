
<?php require_once 'inc/header.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
              <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
          </div>
          <?php
          require_once 'connection.php';
          $query="select * from posts";
          $query_done=mysqli_query($connection,$query);
          if(mysqli_num_rows($query_done)>0){
            $posts=mysqli_fetch_all($query_done,MYSQLI_ASSOC);

            foreach($posts as $post){ ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="assets/images/postImage/<?php echo $post['image'] ?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?php echo $post['title'] ?></h4></a>
                <h6><?php echo $post['created_at'] ?></h6>
                <p> Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
                </div>
                
              </div>
            </div>
          </div>
     <?php  
        }


}
else{
  echo "there is no posts";
}
?>
          
        </div>
      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
