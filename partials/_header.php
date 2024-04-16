<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="contact.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contacts</a>
      </li>
    </ul>
    <div class="d-flex mx-2">';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        echo '<form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
        <p class="text-light my-0 mx-2"> Welcome ' . $_SESSION['useremail'] . '</p>
        <a href="partials/_logout.php" class="btn btn-outline-primary my-0 mx-2">Logout</a>
        </form>';
}
else{
  echo '<form class="d-flex" role="search">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-success" type="submit">Search</button>
  </form>
  <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
}
    echo '</div>
  </div>
</div>
</nav>';
include 'partials/loginModal.php';
include 'partials/signupModal.php';
include 'partials/_handleSignup.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success</strong> You can now login !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else{
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Error</strong> ' . $showError . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>