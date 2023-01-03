<?php
    session_start();
    include_once('../db/connect.php');
    if ($_SESSION['email'] != "") 
    {
        $sql = "SELECT u.image,u.itemid,d.title,d.category,d.sub_cat,d.verifyid,s.state,s.city,s.address,s.contact from item_desc as d,imageupload as u,userdetails as s WHERE d.itemid = u.itemid and d.userid = s.userid GROUP by u.itemid";
        $result = mysqli_query($db, $sql);

        $sql1 = "SELECT u.image,u.itemid,d.title,d.category,d.sub_cat,d.verifyid,s.state,s.city,s.address,s.contact from item_desc as d,imageupload as u,userdetails as s WHERE d.itemid = u.itemid and d.userid = s.userid GROUP by u.itemid";
        $result1 = mysqli_query($db, $sql1);

        $sql2 = "SELECT u.image,u.itemid,d.title,d.category,d.sub_cat,d.verifyid,s.state,s.city,s.address,s.contact from item_desc as d,imageupload as u,userdetails as s WHERE d.itemid = u.itemid and d.userid = s.userid GROUP by u.itemid";
        $result2 = mysqli_query($db, $sql2);

        $sql3 = "SELECT * FROM `peopleincharge`";
        $result3 = mysqli_query($db, $sql3);

        $sql4 = "SELECT id,name FROM `peopleincharge`";
        $result4 = mysqli_query($db, $sql4);
        
        if(isset($_POST['verified'])){
            $id = $_POST['itemid'];
            $pid = $_POST['people'];

            $ver = "UPDATE item_desc SET verifyid = 1, verifyby = '$pid' where itemid='$id'";
            if (mysqli_query($db, $ver)){
                echo 'VERIFIED';
                // echo '<script>document.getElementById("statusdis").style.display="block"
                // document.getElementById("statusdis").innerHTML="VERIFIED";</script>';
            }
        }
        if(isset($_POST['rejected'])){
            $id = $_POST['itemid'];
            $pid = $_POST['people'];
            $ver = "UPDATE item_desc SET verifyid = 2, verifyby = '$pid' where itemid='$id'";
            if (mysqli_query($db, $ver)){
                echo 'Rejected';
                // echo '<script>document.getElementById("statusdis").style.display="block"
                // document.getElementById("statusdis").innerHTML="REJECTED";</script>';
            }
        }
?>
    <link rel="stylesheet" type="text/css" href="../Profile/verify.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .sidenav {
            background-color: #1C0A00;
            width:380px;
        }

        .sidenav a:hover {
            color: black;
            font-weight:bolder
        }
  
        #mySidenav ul li:hover {
            background-color: #FFC064;
        }
        #mySidenav ul li.active {
            background-color: #FFC064;
        }
        #mySidenav ul li.active a{
            color:black;
            font-weight:bolder
        }

        #inpeople{
            padding:10;overflow-y:auto;width:1010px;height:570px
        }

    .column {
    float: left;
    width: 25%;
    padding: 0 10px;
    margin-top:30px
    }

    /* Remove extra left and right margins, due to padding */
    .row {margin: 0 -5px;}

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .flex-item {
    background-color:#FFC064;
}

    /* Responsive columns */
    @media screen and (max-width: 600px) {
    .column {
        width: 100%;
        display: block;
        margin-bottom: 20px;
    }
    }

    /* Style the counter cards */
    .card {
        transition: 0.3s;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
        padding: 16px;
        text-align: center;
        background-color: #f1f1f1;
        border-radius:10px
    }
    .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.5);
    cursor:pointer
    }

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
  width: 30%;
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
#pendpro,#verpro,#rejpro{
    width:40%;
    background-color:#361500;
    padding:15px;
    color:white;
    font-family: "Roboto Slab", sans-serif;
    border:none;
    font-weight:600;
    cursor:pointer;
    font-size:16px;
    letter-spacing: 1px;
    border-radius:5px;
}
#verpro:hover,#rejpro:hover{
    opacity: 0.6;
}
#verified .active{
    opacity: 0.6;
}
.statpend{
    font-family: "Roboto Slab", sans-serif;
    cursor:pointer;
    width:100%;
    border:none;
    background-color:#AE431E;
    padding:8px;
    color:white;
    letter-spacing:1px
}
.statpend:hover{
    opacity: 0.6;
}
.modalbtn{
    font-family: "Roboto Slab", sans-serif;
    padding:10px;
    margin-top:40px;
    background-color:#AE431E;
    border:none;
    color:white;
    font-weight:bolder;
    letter-spacing:1px;
    cursor: pointer;
    border-radius:7px
}

.modalbtn:hover{
    opacity: 0.7;
}

.cardpeople {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 250px;
  text-align: center;
  font-family: arial;
  background-color: white;
  font-family: "Roboto Slab", sans-serif;
}

.title {
  color: grey;
  font-size: 18px;
  font-weight:600
}

.cardpeople button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #AE431E;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
  font-family: "Roboto Slab", sans-serif;
}

.cardpeople button:hover{
  opacity: 0.7;
}

#peoplein{
    width:40%;
    background-color:#361500;
    padding:15px;
    color:white;
    font-family: "Roboto Slab", sans-serif;
    border:none;
    font-weight:600;
    cursor:pointer;
    font-size:16px;
    letter-spacing: 1px;
    border-radius:5px;
}
#peoplei {
    padding:7px;
    font-family: "Roboto Slab", sans-serif;
    font-size:14px;
    font-weight:600;
    border-radius:8px 8px 0px 0px
}
#peoplei option{
    padding:7px;
    font-family: "Roboto Slab", sans-serif;
    font-size:14px;
    font-weight:600;
}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  #pending{
        margin-top:80px;   
    }
    #verified{
        margin-top:80px; 
        margin-bottom:20px  
    }
    #people{
        margin-top:80px;   
    }
    #peoplein{
        margin-right:0px
    }
    .modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}
    .column {
    width: 45%;
    padding: 0 10px;
    margin-top:20px
    }
  #ham{
    display:block;
  }
  #mySidenav,#topbar{
    display:none
  }
  #topbar ul li{
    float:none;
    text-align:center;
  }
  #topbar ul li a{
    text-align:center;
  }
  #topbar ul {
  text-align: center;
  padding: 7px 0px;
  font-size:14px;
  text-align:center
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  #pending{
        margin-top:70px;   
    }
    #verified{
        margin-top:80px; 
        margin-bottom:20px  
    }
    #people{
        margin-top:80px;   
    }
    #peoplein{
        margin-right:270px
    }
    .modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}
    .column {
    width: 35%;
    padding: 0 10px;
    margin-top:30px
    }
  #ham{
    display:block;
  }
  #mySidenav,#topbar{
    display:none
  }

  #topbar ul li{
    float:none;
    text-align:center;
  }
  #topbar ul li a{
    text-align:center;
  }
  #topbar ul {
  text-align: center;
  padding: 7px 0px;
  font-size:14px;
  text-align:center
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .container{
        margin-top:60px;
    }
  #topbar{
    display:block
  }
  #mySidenav,#ham,#closeham{
    display:none
  }
  #topbar ul li{
    float:left;
    text-align:center;
    margin-left:20px
  }
  #topbar ul li a{
    text-align:center;
  }
  #topbar ul {
  text-align: center;
  padding: 0px 0px;
  font-size:13px;
    }
} 

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
    #pending{
        width:100%
    }
    .container{
        margin-top:60px;
        
    }
    #pending{
        margin-top:0px;   
        overflow-y:hidden
    }
    #verified{
        margin-top:0px; 
    }
    #people{
        margin-top:0px;   
    }
    #peoplein{
        margin-right:0
    }
    .modal-content {
  width: 40%;
}
    .column {
    width: 30%;
    padding: 0 10px;
    margin-top:30px
    }
  #topbar{
    display:block
  }
  #mySidenav,#ham,#closeham{
    display:none
  }
  .topbar ul {
    text-align:center;
    margin:auto;
    font-size:13px
  }
  .topbar ul li{
    float:none;
    text-align:center
  }
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {

  #pending{
        margin-top:0px;   
    }
    #verified{
        margin-top:0px;   
    }
    #people{
        margin-top:0px;   
    }
    #peoplein{
        margin-right:0
    }
    .modal-content {
  width: 40%;
}
    .column {
    width: 30%;
    padding: 0 10px;
    margin-top:30px
    }
  .container{
        margin-top:0px;
    }
  #mySidenav{
    display:block
  }
  #topbar,#ham,#closeham{
    display:none
  }
}

.topbar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #1C0A00;
  position: fixed;
  top: 0;
  width: 100%;
}

.topbar ul li {
  float: left; 
}

.topbar ul li a {
  display: block;
  color: white;
  text-align: center;
  padding: 15px 16px;
  text-decoration: none;
  margin-left:10px
}

.topbar a:hover {
    color: black;
    font-weight:bolder
}

.topbar ul li.active {
  background-color: #FFC064;
}

/* .topbar li:hover:not(.h3) {
    background-color: #1C0A00;
} */

.topbar ul li:hover {
  background-color: #FFC064;
}
  
#topbar ul li.active a{
    color:black;
    font-weight:bolder
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="ham" style="width:100%;background-color: #1C0A00;text-align:right;padding:10px;position:fixed" onclick="openBar()"><h3 style="color:white;padding-left:20px;float:left">Welcome, <?php echo $_SESSION['name']; ?></h3><span style="color:white;font-size:30px;padding:30px"><i class="fa fa-bars"></i></span></div>
    <div class="topbar" id="topbar">
            <ul>
            <span id="closeham" style="color:white;font-size:30px;padding:12px;float:right"  onclick="closeBar()"><i class="fa fa-close"></i></span>
                    <li>
                        <h3 class="h3" style="color:white;padding-left:40px;margin-right:10px;">Welcome, <?php echo $_SESSION['name']; ?></h3>
                    </li>
                    <li class="active" id="pend1">
                        <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showPending()">
                            <img src="../assets/package.png" width="30px" style="vertical-align:middle"/>
                            Pending Products
                        </a>
                    </li>
                    <li id="verify1">
                        <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showVerify()">
                            <img src="../assets/verify.png" width="30px" style="vertical-align:middle"/>
                            Verified & Rejected Products
                        </a>
                    </li>
                    <li id="incharge1">
                        <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showPeople()">
                            <img src="../assets/people.png" width="30px" style="vertical-align:middle"/>
                            People Incharge
                        </a>
                    </li>
                    <li>
                        <a
                            href="../db/logout.php"
                            class="text-decoration-none d-flex align-items-start">
                            <img src="../assets/logout.png" width="30px" style="vertical-align:middle"/>
                            Logout
                        </a>
                    </li>
            </ul>
    </div>
    <div class="container" style="overflow-x:hidden;overflow-y:hidden">
        <div id="mySidenav" class="sidenav">
            <ul>
                <h3 style="color:white;padding-left:40px">Welcome, <?php echo $_SESSION['name']; ?></h3>
                <li class="active" id="pend">
                    <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showPending()">
                        <img src="../assets/package.png" width="30px" style="vertical-align:middle"/>
                        Pending Products
                    </a>
                </li>
                <li id="verify">
                    <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showVerify()">
                        <img src="../assets/verify.png" width="30px" style="vertical-align:middle"/>
                        Verified & Rejected Products
                    </a>
                </li>
                <li id="incharge">
                    <a href="#" class="text-decoration-none d-flex align-items-start" onclick="showPeople()">
                        <img src="../assets/people.png" width="30px" style="vertical-align:middle"/>
                        People Incharge
                    </a>
                </li>
                <li>
                    <a
                        href="../db/logout.php"
                        class="text-decoration-none d-flex align-items-start">
                        <img src="../assets/logout.png" width="30px" style="vertical-align:middle"/>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex-item">
            <div id="pending" style="width:95%;padding:20px;">
                <div style="padding:5px;text-align:center;height:610px;overflow-y: auto;">
                    <button id="pendpro">PENDING PRODUCTS</button>
                    <h4 id="statusdis" style="display:none"></h4>
                    <div class="row">
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            $itemid = $row['itemid'];
                            $verid = $row['verifyid'];
                            if($verid == 0){
                    ?>
                        <div class="column">
                            <div class="card">
                            <img src="../uploads/<?php echo $row['image'] ?>" alt="Avatar" width="200px" height="150px">
                            <h5 style="font-size:14px"><?php echo $row['title'] ?></h5>
                            <p style="font-weight:bold;font-size:15px"><?php echo $row['state'],' - ',$row['city'] ?></p>
                            <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i> <?php echo $row['contact'] ?></p>
                            <button class="statpend" onclick="showModal(<?php echo $itemid ?>)">Status: <b>Pending</b></button>
                            </div>
                        </div>
                        <?php } } ?>
                        <div class="column">
                            <div class="card">
                            <img src="../assets/1.png" alt="Avatar" width="200px" height="150px">
                            <h5 style="font-size:14px">Sofa 4 seater</h5>
                            <p style="font-weight:bold;font-size:15px">MP - Ujjain</p>
                            <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i> 9576543244</p>
                            <button class="statpend">Status: <b>Pending</b></button>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                            <img src="../assets/5.png" alt="Avatar" width="200px" height="150px">
                            <h5 style="font-size:14px">Lison Speakers</h5>
                            <p style="font-weight:bold;font-size:15px">MP - Dewas</p>
                            <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i> 9276543232</p>
                            <button class="statpend">Status: <b>Pending</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="verified" style="width:98%;padding:10px;display:none">
                <div style="padding:5px;text-align:center;height:610px;overflow-y: auto;">
                    <button class="active" id="verpro" onclick="showVerified()">VERIFIED PRODUCTS</button>
                    <button id="rejpro" onclick="showReject()">REJECTED PRODUCTS</button>
                    <div class="row" id="ver">
                        <?php
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $verid = $row1['verifyid'];
                            if($verid == 1){
                        ?>
                        <div class="column">
                            <div class="card">
                                <img src="../uploads/<?php echo $row1['image'] ?>" alt="Avatar" width="200px" height="150px">
                                <h5 style="font-size:13px"><?php echo $row1['title'] ?></h5>
                                <p style="font-weight:bold;font-size:15px"><?php echo $row1['state'],' - ',$row1['city'] ?></p>
                                <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i> <?php echo $row1['contact'] ?></p>
                                <button class="statpend">Status:<b>Verified</b></button>
                            </div>
                        </div>
                        <?php
                            } } 
                        ?>
                        <div class="column">
                            <div class="card">
                                <img src="../uploads/2.png" alt="Avatar" width="200px" height="150px">
                                <h5 style="font-size:13px">Sofa 4 seater</h5>
                                <p style="font-weight:bold;font-size:15px">MP - Dewas</p>
                                <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i>9522587405</p>
                                <button class="statpend">Status:<b>Verified</b></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="reject" style="display:none">
                        <?php
                            while($row = mysqli_fetch_assoc($result2)){
                                $verid = $row['verifyid'];
                                if($verid == 2){
                        ?>
                        <div class="column">
                            <div class="card">
                                <img src="../uploads/<?php echo $row['image'] ?>" alt="Avatar" width="200px" height="150px">
                                <h5 style="font-size:13px"><?php echo $row['title'] ?></h5>
                                <p style="font-weight:bold;font-size:15px"><?php echo $row['state'],' - ',$row['city'] ?></p>
                                <p style="font-weight:bold;font-size:13px"><i class="fa fa-phone" style="font-size:16px;vertical-align:middle"></i> <?php echo $row['contact'] ?></p>
                                <button class="statpend">Status:<b>Rejected</b></button>
                            </div>
                        </div>
                        <?php
                            } } 
                        ?>
                    </div>
                </div>
            </div>
            <!-- people incharge -->
            <div id="people" style="width:98%;padding:10px;display:none;text-align:center;">
                <button id="peoplein">PEOPLE INCHARGE</button>
                <div id="inpeople">
                    <div class="row">
                        <?php
                            while($people = mysqli_fetch_assoc($result3)){
                            ?>
                            <div class="column">
                                <div class="cardpeople">
                                    <img src="../assets/profile.png" alt="John" style="width:50%">
                                    <h3><?php echo $people['name']; ?></h3>
                                    <p class="title"><?php echo $people['location']; ?></p>
                                    <p><?php echo $people['company']; ?></p>
                                    <p><button><i class="fa fa-phone" style="font-size:22px;vertical-align:middle"></i> <?php echo $people['contact']; ?></button></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <!-- <p id="val"></p> -->
            <form action="" method="post" style="text-align:center">
                <input type="hidden" id="check" name="itemid" value="" />
                <h3> Everthing uploaded is same during verification ?</h3><br>
                <label for="staticEmail" style="font-weight:600;margin-right:7px">Verification done By</label>
                <select name="people" id="peoplei" onchange="">
                    <option selected disabled>Select</option>
                    <?php while($rowp = mysqli_fetch_assoc($result4)){?>
                    <option value="<?php echo $rowp['id']; ?>"><?php echo $rowp['name']; ?></option>
                    <?php } ?>
                </select>
                <div style="text-align:center"><img src="../assets/check.png" /></div>
                <div style="text-align:center">
                <input class="modalbtn" type="submit" name="verified" value="Accepted">
                <input class="modalbtn" type="submit" name="rejected" value="Rejected" style="margin-left:10px">
                </div>
            </form>
        </div>
    </div>
    

    <script>

    function showPending(){
            document.getElementById('verify').classList.remove('active');
            document.getElementById('incharge').classList.remove('active');
            document.getElementById("pend").className = "active";
            document.getElementById('verify1').classList.remove('active');
            document.getElementById('incharge1').classList.remove('active');
            document.getElementById("pend1").className = "active";
            document.getElementById('pending').style.display = 'block';
            document.getElementById('verified').style.display = 'none';
            document.getElementById('people').style.display = 'none';       
    }
    function showVerify(){
            document.getElementById('pend').classList.remove('active');
            document.getElementById('incharge').classList.remove('active');
            document.getElementById("verify").className = "active";
            document.getElementById('pend1').classList.remove('active');
            document.getElementById('incharge1').classList.remove('active');
            document.getElementById("verify1").className = "active";
            document.getElementById('verified').style.display = 'block';
            document.getElementById('pending').style.display = 'none'; 
            document.getElementById('people').style.display = 'none';      
    }
    function showPeople(){
            document.getElementById('verify').classList.remove('active');
            document.getElementById('pend').classList.remove('active');
            document.getElementById("incharge").className = "active";
            document.getElementById('verify1').classList.remove('active');
            document.getElementById('pend1').classList.remove('active');
            document.getElementById("incharge1").className = "active";
            document.getElementById('pending').style.display = 'none';
            document.getElementById('verified').style.display = 'none';
            document.getElementById('people').style.display = 'block';      
    }

    var modal = document.getElementById("myModal");
 
    function showModal(id) {            
        modal.style.display = "block";
        document.getElementById("check").value = id;
    // event.preventDefault();
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    function showVerified(){
        document.getElementById("ver").style.display = 'block';
        document.getElementById("reject").style.display = 'none';
        document.getElementById('rejpro').classList.remove('active');
        document.getElementById("verpro").className = "active";
    }
    function showReject(){
        document.getElementById("reject").style.display = 'block';
        document.getElementById("ver").style.display = 'none';
        document.getElementById('verpro').classList.remove('active');
        document.getElementById("rejpro").className = "active";
    }

    function openBar(){
        document.getElementById("topbar").style.display = 'block'
        document.getElementById("closeham").style.display = 'block'
    }
    function closeBar(){
        document.getElementById("topbar").style.display = 'none'
        document.getElementById("closeham").style.display = 'none'
    }

    </script>
<?php 
}else{
    header("Location: ../index.php");
    exit();
}
?>