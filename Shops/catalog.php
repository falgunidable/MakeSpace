<?php
require '../db/connect.php';
include_once('../Navigation/shopNav.php');
$check = "SELECT itemid from item_desc where verifyid = 1";
$resultc = mysqli_query($db, $check);

$sql = "SELECT * FROM `imageupload` GROUP BY itemid;";
$result = mysqli_query($db, $sql);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap');
    h4{
        font-family: 'Roboto Slab', sans-serif;
        font-weight:600;
    }
    .card{
    margin-top: 20px;
	width: 280px;
    }
    .new-price{
	font-size: 13px;
}

    .product-detail-container{
    background-color: #361500;
    }
    #buyItem{
    background-color: #873400;
    border-radius: 0px 0px 10px 10px;
    opacity:0.8;
    }
    #buyItem:hover{
    background-color: #873400;
    opacity:1.0;
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
        vertical-align: middle;
        justify-content:center
    }
    .container{
	width: 1000px;
    height:480px;
    overflow-y:auto;
    overflow-x:hidden;
    }
    #catimg{
        max-width:180px;
        max-height:180px;
        height:180px
    }

    /* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    h4{
        font-size:20px
    }
    .container{
	max-width: 60%;
    }
  }
  
  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {
    .container{
	max-width: 50%;
    }
  }
  
  /* Medium devices (landscape tablets, 768px and up) */
  @media only screen and (min-width: 768px) {
    h4{
        font-size:22px
    }
    .container{
	max-width: 100%;
    }
    .card{
	width: 250px;
    }
    #catimg{
        max-width:140px;
        max-height:170px;
        height:140px
    }
    .new-price{
	font-size: 12px;
    }
    .dress-name{
        font-size: 12px;
    }
    #buyItem{
        font-size: 15px;
    } 
  }
  
  /* Large devices (laptops/desktops, 992px and up) */
  @media only screen and (min-width: 992px) {
    .container{
	max-width: 100%;
    }
    .card{
	width: 270px;
    }
    .new-price{
	font-size: 13px;
    }
    .dress-name{
        font-size: 13px;
    }
    #catimg{
        max-width:150px;
        max-height:170px;
        height:150px
    }
    #buyItem{
        font-size: 16px;
    } 

    } 
  
  /* Extra large devices (large laptops and desktops, 1200px and up) */
  @media only screen and (min-width: 1200px) {
    .card{
    margin-top: 20px;
	width: 280px;
    }
    .dress-name{
        font-size: 14px;
    }
    .new-price{
	font-size: 14px;
    }
    #catimg{
        max-width:180px;
        max-height:180px;
        height:180px
    }
    #buyItem{
        font-size: 16px;
    }
  }
</style>

<body style="background-color: #FFC064;padding:0px">

<h4 style="text-align:center;color:white;margin-top:70px;background-color:#1C0A00;padding:3px">BUY A PRODUCT</h4>
    <div class="container mt-4">
            <div class="row" style="margin-bottom:30px">
                <?php
                while($row = mysqli_fetch_assoc($resultc)){
                        $item = $row['itemid'];
                        
                        $sql1 = "SELECT d.title,d.price,u.image FROM item_desc as d,imageupload as u WHERE d.itemid = u.itemid and d.itemid = '$item';";
                        $result1 = mysqli_query($db, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="image-container">
                            <img id="catimg" src="../uploads/<?php echo $row1['image']?>" class="img-fluid rounded thumbnail-image">
                        </div>
                        <div class="product-detail-container p-2" style="height: 50px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="dress-name"><?php echo $row1['title']?></h5>
                                    <div class="d-flex flex-column mb-2">
                                        <span class="new-price">Rs. <?php echo $row1['price']?></span>
                                    </div>
                                </div>
                        </div>
                        <button id="buyItem" onclick="location.href = 'buy.php?id=<?php echo $item?>'">BUY</button>
                    </div>
                </div>
                <?php 
            } 
            ?>
    	</div>
    </div>

    <div id="footerdiv">
        <a class="" href="../index.php"><img src="../assets/logofoot.png" width="130" height="25"/></a>
        <p style="font-size:14px;vertical-align:middle;color:white;float:right"><i class="fa fa-envelope" style="font-size:20px"></i> falgunidable@gmail.com</p>
    </div>
</body>