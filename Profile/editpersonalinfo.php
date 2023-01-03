<?php 
include_once('../db/connect.php');
$city = $_POST['city'];
$state = $_POST['state'];
$mobno = $_POST['contact'];
$address= $_POST['address'];
$uid = $_POST['userid'];

$sqlc = "SELECT * FROM userdetails WHERE userid = '$uid'";
$result = mysqli_query($db, $sqlc);
if (mysqli_num_rows($result) === 1){
  $sql = "UPDATE userdetails SET contact = '$mobno',state = '$state',city= '$city',address='$address' WHERE userid = '$uid'";
  if (mysqli_query($db, $sql)){
    echo "<script>window.location.href='profile.php'</script>;
    <p>Updated succesfully ..</p>";  
    }else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
    } 
}else{
// if(isset($_POST['cty']) OR isset($_POST['mobno']) OR isset($_POST['state']) ){
  $sql = "INSERT INTO userdetails (userid, contact, state,city,address) VALUES ('$uid','$mobno','$state','$city','$address')";
  // $sql = "UPDATE userdetails SET userid='$uid',contact = '$mobno',state = '$state',city= '$city' WHERE userid = '$uid'";
  if (mysqli_query($db, $sql)){
           echo "<script>window.location.href='profile.php'</script>;
           <p>Inserted succesfully ..</p>";  
   }       else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  } 
}
?>   