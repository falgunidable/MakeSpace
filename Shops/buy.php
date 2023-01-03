
<?php
include_once('../db/connect.php');
include_once('../Navigation/shopNav.php');
$itemid = $_GET['id'];

$sql = "SELECT d.contact,u.image,r.name,i.`userid`,i.`price`,i.`item_condition`,i.`title` FROM `item_desc` as i,registerusers as r,imageupload as u,userdetails as d where r.userid = i.userid and u.itemid = i.itemid and d.userid = i.userid and i.itemid = '$itemid' LIMIT 1;";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$sql1 = "SELECT image from imageupload where itemid = '$itemid'";
$result1 = mysqli_query($db, $sql1);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="buy.css"/>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap');

body{
    font-family: 'Roboto Slab', sans-serif;
    background-color:#FFC064
}
.product {
    background-color: #DADADA;
    color:#1C0A00;
    font-weight: 900;
}

 .act-price {
    color: white;
    font-size:16px;
    font-weight:600
}
.title,.about {
    font-weight: 600;
}
#chat{
    border-radius:5px;
    margin-top:0px;
    background-color:#1C0A00;
    border:none;
    color:white;
    padding:7px;
    margin-right:10px
}
#chat:hover{
    font-weight:600;
    opacity:0.7;
}

#tool{
  width: 70px;
  margin: 0px 5px;
  height: 50px;
  position:relative;
  cursor: pointer;
}

#tool .fa-info-circle{
    position:absolute;
    margin-top:5px;                          
  font-size: 26px;
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
  background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
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
#footerdiv{
        font-family: 'Roboto Slab', sans-serif;
        bottom: 0px;
        position:absolute;
        background-color:#1C0A00;
        width:100%;
        height:6%;
        color:white;
        padding:10px;
        font-weight:500;
        vertical-align: middle
    }
    #main-image{
        width:250px
    }
    .con{
        font-size:14px;font-weight:600;color:#A9A9A9
    }
    #imgst{
        width:25%
    }
    .container{
    height:550px;
    overflow-y: hidden;
}


    /* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  .container{
    height:525px;
    overflow-y: auto;
  }
  #main-image{
        width:230px
    }
    .product{
    font-size:14px
  }
  .title,.about {
    font-size:14px
    }
    h6{
        font-size:14px
    }
    .con{
        font-size:13px
    }
    .about span{
        font-size:13px
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
  .container{
    height:525px;
    overflow-y: auto;
  }
  #main-image{
        width:230px
    }
    .product{
    font-size:14px
  }
  .title,.about {
    font-size:14px
    }
    h6{
        font-size:14px
    }
    .con{
        font-size:13px
    }
    .about span{
        font-size:13px
    }
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  #imgst{
        width:30%
    }
  .product{
    font-size:14px
  }
  .title,.about {
    font-size:14px
    }
    #main-image{
        width:200px
    }
    h6{
        font-size:14px
    }
    .con{
        font-size:13px
    }
    .about span{
        font-size:13px
    }
} 

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
  #imgst{
        width:25%
    }
  #main-image{
        width:250px
    }
  .card{
    margin-bottom:20px
  }
  .product{
    font-size:16px
  }
  .title,.about {
    font-size:15px
}
}
</style>
<body>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-12">
            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);margin-top:50px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4">
                                <img id="main-image" src="../uploads/<?php echo $row['image']?>"/>
                            </div>
                            <div class="thumbnail text-center">
                                <?php
                                while($row1 = mysqli_fetch_assoc($result1)){
                                ?>
                                <img
                                    onclick="change_image(this)"
                                    src="../uploads/<?php echo $row1['image']?>"
                                    width="70">
                                <?php } ?>
                            </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product p-4" style="height:100%">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center" style="cursor:pointer" onclick="history.back()">
                                            <i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i>
                                            <span class="ml-1" style="vertical-align:middle;"><b>Back</b></span>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-3" style="color:white;background-color:#361500;padding:20px;border-radius:5px">
                                        <img id="imgst" style="float:right" src="../assets/image.png"/>
                                        <h5 class="title text-uppercase"><?php echo $row['title']?></h5>
                                        <div class="price d-flex flex-row align-items-center">
                                            <h6 class="act-price"><i class="fa fa-inr"></i> <?php echo $row['price']?></h6>
                                        </div><br/>
                                        <p class="about">Description: <span style="font-weight: 600;margin-left:10px"><?php echo $row['item_condition']?></span></p><br/>
                                        <h6 style="font-weight:600">Contact No.</h6>
                                        <h6 class="con"><?php echo $row['contact']?></h6><br/>
                                    </div>
                                    
                                    <div class="sizes mt-5" style="position:relative">
                                        <div style="right:-10px;position:absolute;"><button id="chat">LET'S CHAT</button></div>
                                    </div>
                                    <div class="cart mt-4 align-items-center">
                                        <button class="btn text-uppercase mr-1 px-4 text-muted" style="background-color:#1C0A00;opacity:0.3;"><b>BUY</b></button>
                                        <span id="tool" onclick="showModal()"><i class="fa fa-info-circle text-muted" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footerdiv">
        <a class="" href="../index.php"><img src="../assets/logofoot.png" width="130" height="25"/></a>
        <p style="font-size:14px;vertical-align:middle;color:white;float:right"><i class="fa fa-envelope" style="font-size:20px"></i> falgunidable@gmail.com</p>
    </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
        <!-- Modal content -->
            <div class="modal-content">
                <h5 style="text-align:center"><b>Terms & Conditions</b></h5><br/>
                <ul>
                    <li>The <b>personal information</b> / data provided to us by you during the course of usage will be treated as <b>strictly confidential</b> and in accordance with the Privacy Notice and applicable laws and regulations.</li>
                    <li>You agree, understand and acknowledge that the website is an online platform that enables you to <b>purchase and sell products</b> listed on the website at the price indicated therein at any time from any location.</li>
                    <li><b>Retruns</b> for a product are valid for a duration of 5 days, after which returns are not accepted.</li>
                </ul>
            </div>
        </div>
</body>
        <script>
            function change_image(image) {
                var container = document.getElementById("main-image");
                container.src = image.src;
            }
            document.addEventListener("DOMContentLoaded", function (event) {});

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
        </script>