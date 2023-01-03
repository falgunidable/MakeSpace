<?php
        $id = $_POST['id'];
        echo $id;
        $sqlimage = "SELECT * FROM imageupload where itemid = '$id'";
        ?>
<style>
      .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form action="" method="">
    <!-- <p id="val"></p> -->
    <?php
    // $id = $_POST['id'];
    // echo $id;
    // $sqlimage = "SELECT * FROM imageupload where itemid = '$id'";
    ?>
    
    <input type="checkbox" name="vehicle1" value="Bike">
    <label for="vehicle1"> Everthing uploaded is same during verification</label><br>
    <input type="submit" value="Submit">
</form>
</div>

</div>