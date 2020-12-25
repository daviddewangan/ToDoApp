<?php include('db.php');?>
<?php
if(isset($_POST['save'])){
    $title = $_POST['title'];
    $status = $_POST['status'];
    $desc = $_POST['desc'];
    $deadline = $_POST['deadline'];
    $is_active = 1;
    
    $query = mysqli_query($conn,"INSERT INTO task_list(task,description,deadline,status,is_active) VALUES('$title','$desc','$deadline','$status','$is_active')");
    if($query){
        $msg = "Task is added successfully";
    }else{
        $msg = "Error Try After Some time";
    }
}
    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>ToDoApp!</title>
  </head>
  <body class="btn-dark">

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <div class="container">
  <h1>To Do Application</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Task List | <span class="badge bg-warning"><?php $list = mysqli_query($conn,"SELECT * FROM task_list WHERE is_active = 1");
    $count = mysqli_num_rows($list);
    echo $count;?></span></a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Restore Task</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="container">
   <div class="form-group">
   <form method="post" style="margin-top: 50px;">
   <label for="task" >Task Title</label>
   <div class="input-group mb-3">
   
  <input type="text" class="form-control" name="title" placeholder="Enter Task Title" required>
</div>
<label for="status" >Select Status</label>
<div class="input-group mb-3">
  
   <select name="status" class="form-control" required>
   <option value=" ">------------------------------------Select status-------------------------------------------</option>
   <option value="ongoing">Ongoing</option>
   <option value="cancel">cancel</option>
   <option value="complete">Completed</option>
   </select>
  
  
</div>
<label for="description" >Task Description</label>
<div class="input-group mb-3">
  
    <textarea class="form-control" name="desc" placeholder="Enter Task Description" required></textarea>
  
  
</div>
<label for="deadline" >Task Deadline</label>
<div class="input-group mb-3">
  
    <input class="form-control" name="deadline" type="date" required>
  
  
</div>
<div class="input-group">
<input type="submit" name="save" class="btn btn-primary" value="save"> 
</div>
   </form>
   </div>
   </div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <span class="badge bg-primary">Completed Task | <span class="badge bg-dark"><?php $list_complete = mysqli_query($conn,"SELECT * FROM task_list WHERE is_active = 1 AND status = 'complete' ");
    $count_complete = mysqli_num_rows($list_complete);
    echo $count_complete;?></span></span>
<span class="badge bg-success">Ongoing Tsk | <span class="badge bg-dark"><?php $list_ongoing = mysqli_query($conn,"SELECT * FROM task_list WHERE is_active = 1 AND status = 'ongoing' ");
$count_ongoing = mysqli_num_rows($list_ongoing);
echo $count_ongoing; ?></span></span>
<span class="badge bg-danger">Canceled Task | <span class="badge bg-dark"><?php $list_cancel = mysqli_query($conn,"SELECT * FROM task_list WHERE is_active = 1 AND status = 'cancel' ");
$count_cancel = mysqli_num_rows($list_cancel);
echo $count_cancel; ?></span></span>

<table class="table">
  <thead>
    <tr>
      <th scope="col" style="color: white;">No.</th>
      <th scope="col" style="color: white;">Task</th>
      <th scope="col" style="color: white;">Status</th>
      <th scope="col" style="color: white;">Deadline</th>
      <th scope="col" style="color: white;">Action</th>
      <th scope="col" style="color: white;">Read More</th>
    </tr>
  </thead>
  <tbody>
  <?php $fetch = mysqli_query($conn,"SELECT * FROM task_list WHERE is_active = 1");
    while($row = mysqli_fetch_array($fetch)){ ?>
    <tr>
      <th scope="row" style="color: white;">1</th>
      <td style="color: white; font-weight: bold;"><?php echo $row['task']; ?></td>
      <td style="color: white; font-weight: bold;"><?php echo $row['status']; ?></td>
      <td style="color: white; font-weight: bold;"><?php echo $row['deadline']; ?></td>
      <td><a href="#" class="btn btn-success">Edit</a> | <a class="btn btn-danger" href="#">Delete</a></td>
      <td><a href="#" class="btn btn-primary">Read More..</a>
      
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>


</div>
  
  </body>
</html>
