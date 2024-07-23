<?php
  $username="root";
  $server="localhost";
  $password="";
  $database="notes";
  $conn=mysqli_connect($server,$username,$password,$database);
  $insert=false;
  if(!$conn){
    die("sorry we failed to connect: "+mysqli_connect_error());
  }
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $desc=$_POST['desc'];
    $sql="INSERT INTO `notes` (`title`, `desc`, `time`) VALUES ('$title', '$desc', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if($result){
      $insert=true;
    }
    else{
      echo "error";
    }
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div>
<?php 
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success</strong>You have added the note successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  // else{
  //   echo "notes cant added";
  // }
?>
</div>

    <div class="container">
        
          <form action="/TO-DO-LIST/index.php" method="post">
              <div class="my-3">
                  <h2>Add a Note</h2>
                  <label for="title" class="form-label">Note Title</label>
                  <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                  
              </div>
              <div class="mb-3">
                  <div class="mb-3">
                      <label for="desc" class="form-label">Notes Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="3"></textarea>
                  </div>
              </div>
              <!-- <div class="mb-3 form-check">
              </div> -->
              <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>
    <div class="container my-4" >
    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $sql="SELECT * FROM `notes`";
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo "<tr>
          <th scope='row'>".$row["sno"]."</th>
          <td>".$row["title"]."</td>
          <td>".$row["desc"]."</td>
          <td>delet edit</td>
        </tr>";
        } 
      ?>
    
  </tbody>
</table>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    
    <script>
      $(document).ready(function(){
        $('#myTable').DataTable();
      });
    </script>
  </body>
</html>