<?php require_once 'inc/header.php' ?>

    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php 
          require_once 'connection.php';
          if(isset($_GET['id'])){
            $id=$_GET['id'];
          }else{
            header("location:index.php");
          }

            $query="select * from posts where id=$id";
            $res=mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
              $post=mysqli_fetch_assoc($res);
            }
            else{
              echo "No Posts";

            }
              ?>

    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Background</h2>
            </div>
          </div>
       
              <div class="col-md-6">
              <div class="right-image">
                <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="left-content">
                <h4><?php echo $post['title'] ?></h4>
                <p><?php echo $post['created_at'] ?><p>
                <p><?php echo $post['body'] ?></p>
                
                <?php 
                 if(isset($_SESSION['user_id'])){
                ?>
                <div class="d-flex justify-content-center">
                    <a href="editPost.php?id=<?php echo $post['id'] ?>" class="btn btn-success mr-3 "> edit post</a>
                
                    <a href="deletePost.php?id=<?php echo $post['id'] ?>" class="btn btn-danger "> delete post</a>
                </div>
                <?php } ?>
              </div>
            </div>

          

          
          
          
         
        
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
