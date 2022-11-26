<?php
$title = 'INSERT TASK';

session_start();

include 'include/Database.php';
include 'include/Task.php';

$db = new Database();
$conn = $db->getConn();

// CODE FOR INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $task = new Task();
  $task->name = $_POST['name'];
  $task->email = $_POST['email'];
  $task->phone = $_POST['phone'];
  $task->course = $_POST['course'];
  $task->created = $_POST['created'];
  if ($task->insertTask($conn)) {
    header('Location: tasks.php');
  }
}

?>

<?php include 'layout/header.php'; ?>

<form method="POST">
  <div class="mb-3">
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name" require>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email" require>
  </div>
  <div class="mb-3">
    <label>Phone</label>
    <input type="text" class="form-control" name="phone" placeholder="Phone" require>
  </div>
  <div class="mb-3">
    <label>Course</label>
    <input type="text" class="form-control" name="course" placeholder="Course" require>
  </div>
  <div class="mb-3">
    <label>Date</label>
    <input type="date" class="form-control" name="created" placeholder="Date" require>
  </div>
  <div class="mb-3">
    <button class="btn btn-primary"><?= $title ?></button>
  </div>
</form>
<?php include 'layout/footer.php'; ?>
