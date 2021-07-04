<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php

include "admin/config.php";
$limit =5;

if(isset ($_GET['page'])){
    $page_number = $_GET['page'];

}else{
    $page_number = 1;
}
$offset = ($page_number -1) * $limit;

$query = "SELECT post.post_id, post.title, post.description, post.post_img, post.post_date,post.category, category.category_name, user.username, post.author FROM post 
LEFT JOIN category ON post.category = category.category_id
LEFT JOIN user ON post.author = user.user_id

ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

$result = mysqli_query($connection, $query)or die("Failed.");
$count = mysqli_num_rows($result);

if($count> 0){
    while($row = mysqli_fetch_assoc($result)){
    
    ?>

                        <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author_id=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'] ?>
                                        </span>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                               

<?php

    }
}else{
    echo "No Record Found.";
}


$query2 = "SELECT * FROM post";
$result2 = mysqli_query($connection, $query2) or die("Failed.");

if(mysqli_num_rows($result2)){
    $total_records = mysqli_num_rows($result2);
    $total_page = ceil($total_records/$limit);

    
}

?>
    <!-- /recent posts box -->
</div>
