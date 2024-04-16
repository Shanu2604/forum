<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>idiscuss - coding forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>
    <?php
    $showAlert = false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // insert into comment db
        $comment = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> Your comment has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>

    <!-- Ctaegory container starts here -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc;?> </p>
            <hr class="my-4">
            <p>This is a peer forum for sharing knowledge with each other.</p>
            <p>Posted by: <b>Shantanu</b></p>
        </div>
    </div>

    <div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>

    <div class="container" >
        <h1 class="py-2">Discussions</h1>

        <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
    
        echo '<div class="media my-3">
            <img src="img/user.jpeg" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">Anonymous User at ' .$comment_time. '</p>
                <p>' . $content . '</p>
            </div>
        </div>';
    }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Comments Found</p>
                    <p class="lead">Be the first person to put a comment</p>
                </div>
            </div>';
        }
    ?> 
    </div>
    <?php include 'partials/_footer.php';?>
        <!-- optional javascript -->
        <!-- jquery first, then popper.js, then bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384
    C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>