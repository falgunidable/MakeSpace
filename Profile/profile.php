<?php
ob_start();
    session_start();
    require '../db/connect.php';

    if ($_SESSION['email'] != "") {
        $email = $_SESSION['email'];
        include('../Navigation/logNav.php');
        $sql = "SELECT userid,name,email,CAST(date AS DATE) as date FROM registerusers WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $userid = $row['userid'];
        $card= "SELECT u.image,u.itemid,d.title,d.category,d.sub_cat,d.verifyid from item_desc as d,imageupload as u WHERE userid = '$userid' and d.itemid = u.itemid GROUP by u.itemid;";
        $resultp = mysqli_query($db, $card);
?>
<head>
    <link rel="stylesheet" type="text/css" href="../Profile/profile.css"/>
    <script type="text/javascript" src="categorySub.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        #sidebar {
    background-color: #1C0A00;
    }
        #sidebar ul li:hover {
            border-left: 5px solid #F7F5F2;
            background-color: #873400;
        }
        #sidebar ul li.active {
    background-color: #873400;
}
        #sidebar ul li{
    margin-top: 2px;
}
.imgGallery img {
      padding: 8px;
      max-width: 100px;
    }
    .nav{
        border:none
    }
    .nav li{
        padding:10px
    }
    .nav li .active{
        border-top:1px solid #8f8f8f;
        border-left:1px solid #8f8f8f;
        border-right:1px solid #8f8f8f;
        border-bottom:0px;
        padding:10px;
        border-radius:10px 10px 0px 0px
    }
    .nav li a{
        color:black
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
    #next:hover,#submit:hover{
    background-color: #1C0A00;
    }
    #submitdesc{
        margin-top:15px;
        background-color: #1C0A00;
        color:white
    }
    #submitdesc:hover{
        opacity: 0.5;
    }
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 50px; /* Location of the box */
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
  padding: 40px;
  border: 1px solid #888;
  width: 50%;
}
.close {
  color: black;
  font-size: 28px;
  font-weight: bold;
  margin-left:600px
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
  font-weight: bolder;
}

#proedit:hover{
    opacity: 0.7;
}
    </style>
</head>
<body style="background-color: #FFC064;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3 my-lg-0 my-md-1">
                <div id="sidebar" class="bg-purple">
                    <div class="h4 text-white">Account</div>
                    <ul>
                        <li class="active" id="sellNav">
                            <a href="#" class="text-decoration-none d-flex align-items-start" style="text-decoration:none" onclick="showSell()">
                                <!-- <div class="fas fa-box-open pt-2 me-3"></div> -->
                                <div class="d-flex flex-column">
                                    <div class="link">Sell Product</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a>
                        </li>
                        <li id="orderNav">
                            <a href="#" class="text-decoration-none d-flex align-items-start" style="text-decoration:none" onclick="showOrders()">
                                <!-- <div class="fas fa-box-open pt-2 me-3"></div> -->
                                <div class="d-flex flex-column">
                                    <div class="link">My Orders</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a>
                        </li>
                        <li id="profileNav">
                            <a href="#" class="text-decoration-none d-flex align-items-start" style="text-decoration:none" onclick="showProfile()">
                                <!-- <div class="fas fa-box pt-2 me-3"></div> -->
                                <div class="d-flex flex-column">
                                    <div class="link">My Profile</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 my-lg-0 my-1">
                <div id="sell" class="bg-white border" style="padding:10px"><br/>
                    <div class="d-flex flex-column">
                        <div style="text-align:center;font-weight:bolder;background-color:#873400;color:white">SELL A PRODUCT</div>
                    </div>
                    <div id="personalinfodiv"></div>

                    <form action="../db/itemInsert.php" method="post" action="" enctype="multipart/form-data">
                        <table id="categoryUpload">
                            <tr>
                                <td style=""><img src="../assets/image.png" width="80%"/></td>
                                <td style="width:70%;padding:20px">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Category Type</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="category" id="category" onchange="subCategory(this,document.getElementById('subcat'))">
                                                <option selected disabled>Select Category</option>
                                                <option value="Furniture">Furniture</option>
                                                <option value="Electronics">Electronics</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Select Category</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="subcat" id="subcat" onchange="subTypeCategory(this,document.getElementById('subsubcat'))">
                                                <option selected disabled>Select Sub-Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Sub-Category</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="subsubcat" id="subsubcat" onchange="valItem()">
                                                <option selected disabled>Select Item</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Title</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Condition</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="condition" id="condition">
                                                <option selected disabled>Select Condition</option>
                                                <option>Used - like new</option>
                                                <option>Used - like good</option>
                                                <option>Used - like fair</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Price</label>
                                        <div class="col-sm-6">
                                            <span id="priceerr" style="width:100px;position:absolute;margin-left:260px;margin-top:5px;font-size:14px;font-weight:bold"></span>
                                            <input onchange="valItem()" type="number" class="form-control" name="price" id="price" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Brand</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="brand" id="brand">
                                                <option selected disabled>Select Brand</option>
                                                <option>Godrej</option>
                                                <option>IKEA</option>
                                                <option>Urban Ladder</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="text-align:center">
                                        <button id="next" style="" type="button" onclick="nextUpload()"><span>NEXT</span></button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    

                        <div  class="mb-3" id="photoUpload" style="display:none">
                        <i class="fa fa-arrow-circle-left" style="font-size: 25px;color:black;margin-top:20px;cursor:pointer" onclick="previous()"></i>
                        <br/><h5 style="text-align:center"><b>Upload Photos</b><img src="../assets/camera.png" width="30px"/></h5>
                            <div class="custom-file">
                                <input type="button" value="Browse" style="border:none;color:white;font-weight:bold;text-align:center;cursor:pointer;background-color:#0082CB;float: right;padding:5px;border-radius:5px" onclick="showInfo()"/>
                                <div style="overflow: hidden; padding-right: .5em;">
                                    <input type="text" placeholder="Select File" style="border:1px solid #DCDCDC;padding:5px;border-radius:5px;width: 100%" />
                                </div>
                            </div>
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                <span onclick="document.getElementById('myModal').style.display='none'" class="close">&times;</span>
                                    <h5 style="text-align:center"><b>Instructions to be Considered while Image Upload</b></h5><br/>
                                    <div>
                                    <ul>
                                        <li>Atleast <b>5 images</b> should be uploaded for verificaton.</li>
                                        <li>Images should be taken from <b>all angles</b> of product, so that it is understood by the user.</li>
                                        <li>Acceptable file formats:<b> PDF, PNG, GIF, JPG</b></li>
                                        <li>Images should be <b>oriented</b> so that they are right side up.</li>
                                    </ul>
                                    </div>
                                    <div class="imgGallery">
                                         <!-- image preview -->
                                    </div>
                                    <input type="file" name="fileUpload[]" class="custom-file-input" id="chooseFile" multiple style="cursor:pointer">
                                    <label class="custom-file-label" for="chooseFile" style="margin-top:260px;">Select file</label>
                                    <input name="userid" value="<?php echo $userid ?>" type="hidden" />
                                    <div style="text-align:center">
                                        <button id="submitdesc" type="submit" name="submit" class="btn">
                                            Upload Files
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </form>

                </div>
                <!--ORDERS TAB-->
                <div id="orders" class="bg-white border" style="display:none;padding:10px;height:500px;overflow-y:scroll;overflow-x: hidden;"><br/>
                    <div class="d-flex flex-column">
                        <div style="text-align:center;font-weight:bolder;background-color:#873400;color:white">PRODUCTS UPLOADED</div>
                    </div>
                    
                    <div class="row" style="margin-bottom:10px">
                        <?php
                            while($rowdesc = mysqli_fetch_assoc($resultp)){
                                $vid = $rowdesc['verifyid'];
                                if($vid == 0){
                                    $status = "Pending";
                                }else if($vid == 1){
                                    $status = "Verified";
                                }else{
                                    $status = "Rejected";
                                }
                        ?>
                        <div class="col-sm-4" style="margin-top:20px;">
                            <div class="card" style="box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.5);">
                            <img class="card-img-top" src="../uploads/<?php echo $rowdesc['image']?>" alt="Card image cap" width="30px" height="200px">
                                <div class="card-body" style="text-align:center">
                                    <h5 class="card-title"><?php echo $rowdesc['title'] ?></h5>
                                    <p class="card-text"><?php echo $rowdesc['category']; echo '-'; echo $rowdesc['sub_cat'];?></p>
                                    <a href="#" class="btn" style="background-color:#873400;color:white;opacity:0.8">Status:<?php echo $status ?></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                </div>
                <!--PROFILE TAB-->
                <div id="profile" class="bg-white border" style="display:none;padding:10px"><br/>
                    <div class="d-flex flex-column">
                        <div style="text-align:center;font-weight:bolder;background-color:#873400;color:white">EDIT PROFILE</div>
                    </div>
                    <div class="col-sm-9" style="margin-top:20px">
                                <ul class="nav nav-tabs">
                                    <li id="profileset" style="background-color:#F4F4F4;border-radius:10px 10px 0px 0px;border-top:1px solid #e7e7e7;border-left:1px solid #e7e7e7;border-right:1px solid #e7e7e7;border-bottom:0px;">
                                        <a href="">Home</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="width:770px;margin-bottom:10px;">
                                    <div id="home" style="font-weight:600;padding:10px;background-color:#F4F4F4">
                                        <form class="form" id="registrationForm" action="editpersonalinfo.php" method="post">
                                            <div class="form-group row">
                                                    <label for="first_name" class="col-sm-2 col-form-label">Full Name</label>
                                                    <div class="col-sm-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="name"
                                                            id="name"
                                                            value="<?php echo $name?>"
                                                            placeholder="Full Name" disabled>
                                                    </div>
                                                    <label for="last_name" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-4">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="email"
                                                            id="email"
                                                            value="<?php echo $row['email'] ?>"
                                                            placeholder="Email" disabled>
                                                    </div> 
                                            </div>
                                            <?php
                                            $details = "Select * from userdetails where userid = '$userid'";
                                            $resultd = mysqli_query($db, $details);
                                            $row1 = mysqli_fetch_assoc($resultd);
                                            $con = $row1['contact'] ?? null;
                                            $state = $row1['state'] ?? null;
                                            $city = $row1['city'] ?? null;
                                            $add = $row1['address'] ?? null;
                                            ?>
                                            <div class="form-group row">
                                                <label for="first_name" class="col-sm-2 col-form-label">Contact No.</label>
                                                <div class="col-sm-4">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="contact"
                                                        id="contact"
                                                        placeholder="Enter Contact No"
                                                        value="<?php echo $con; ?>">
                                                </div>
                                                <label for="last_name" class="col-sm-2 col-form-label">Joining Date</label>
                                                <div class="col-sm-4">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="date"
                                                        id="date"
                                                        value="<?php echo $row['date']?>">
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <label for="first_name" class="col-sm-1 col-form-label">State</label>
                                                <div class="col-sm-3">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="state"
                                                        id="state"
                                                        placeholder="State"
                                                        value="<?php echo $state; ?>">
                                                </div>
                                                <label for="last_name" class="col-sm-1 col-form-label">City</label>
                                                <div class="col-sm-2">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="city"
                                                        id="city"
                                                        placeholder="City" value="<?php echo $city; ?>">
                                                </div>
                                                <label for="last_name" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-3">
                                                <textarea class="form-control" aria-label="With textarea" name="address" placeholder="Address"><?php echo $add ?></textarea>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-12" style="text-align:center">
                                                    <br>
                                                    <input type="hidden" name="userid" value="<?php echo $row['userid'] ?>"/>
                                                        <button class="btn btn-lg" id="proedit" type="submit" style="background-color:#873400;color:white;">
                                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                                            Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/tab-pane-->
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
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>

    $(document).ready(function () {

    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function () {
        readURL(this);
    });
    });

    function nextUpload(){
        if(document.getElementById('photoUpload').style.display == "none"){
                document.getElementById('photoUpload').style.display="block";
                document.getElementById('categoryUpload').style.display="none";
            }
        else{
            document.getElementById('photoUpload').style.display="none";
        }
    }
    function previous(){
        if(document.getElementById('categoryUpload').style.display == "none"){
                document.getElementById('categoryUpload').style.display="block";
                document.getElementById('photoUpload').style.display="none";
            }
        else{
            document.getElementById('categoryUpload').style.display="none";
        }
    }

    var subcat = "";

    function valItem(){
        subcat = document.getElementById("subsubcat").value;
        if(subcat == 'Office Chairs' || subcat == 'Swing Chairs' || subcat == 'Gaming Chairs'){
            document.getElementById('price').placeholder = "Range 2000-5000";
            subcat="Office Chairs";
            subcat1="Swing Chairs";
            subcat2="Gaming Chairs";
        }else if(subcat == 'Sofa Set' || subcat == 'L-Shape Sofa' || subcat == 'Sofa Beds'){
            document.getElementById('price').placeholder = "Range 5000-10000";
            subcat="Sofa Set";
            subcat1="L-Shape Sofa";
            subcat2="Sofa Beds";
        }else if(subcat == 'Chairs' || subcat == 'Bean Bags'){
            document.getElementById('price').placeholder = "Range 500-3000";
            subcat="Chairs";
            subcat1="Bean Bags";
            subcat2="Other";
        }else if(subcat == 'Laptop' || subcat == 'iPad' || subcat == 'Other'){
            subcat="Laptop";
            subcat1="iPad";
            subcat2="Other";
        }else{
            document.getElementById('price').placeholder = "Select Sub-Category";
        }

        limit(subcat,subcat1,subcat2);
    }

    function limit(subcat1,subcat2,subcat3) {
        var price = document.getElementById('price');

        if(subcat === "Office Chairs" || subcat === "Swing Chairs" || subcat === "Gaming Chairs"){
            if (price.value < 1999){
                price.value = 2000;
                document.getElementById('priceerr').innerHTML = "more than 2000";
                return false;
            }
            if (price.value > 5001){
                price.value = 5000;
                document.getElementById('priceerr').innerHTML = "less than 5000";
                return false;
            }
            if (2000 <= price.value <= 5000 ){
                document.getElementById('priceerr').innerHTML ='<i class="fa fa-check-circle" style="margin-top:10px;color:green;font-size:16px"></i>';
                return true;
            }
        }
        if(subcat === "Sofa Set" || subcat === "L-Shape Sofa" || subcat === "Sofa Beds"){
            if (price.value < 4999){
                price.value = 5000;
                document.getElementById('priceerr').innerHTML = "more than 5000";
                return false;
            }
            if (price.value > 10001){
                price.value = 10000;
                document.getElementById('priceerr').innerHTML = "less than 10000";
                return false;
            }
            if (5000 <= price.value <= 10000 ){
                document.getElementById('priceerr').innerHTML ='<i class="fa fa-check-circle" style="margin-top:10px;color:green;font-size:16px"></i>';
                return true;
            }
        }
        if(subcat === "Chairs" || subcat === "Bean Bags" || subcat === "Other"){
            if (price.value < 499){
                price.value = 500;
                document.getElementById('priceerr').innerHTML = "more than 500";
                return false;
            }
            if (price.value > 3001){
                price.value = 3000;
                document.getElementById('priceerr').innerHTML = "less than 3000";
                return false;
            }
            if (500 <= price.value <= 3000 ){
                document.getElementById('priceerr').innerHTML ='<i class="fa fa-check-circle" style="margin-top:10px;color:green;font-size:16px"></i>';
                return true;
            }
        }
        if(subcat === "Laptop" || subcat === "iPad" || subcat === "Other"){
            if (price.value < 8000){
                price.value = 8000;
                document.getElementById('priceerr').innerHTML = "more than 8000";
                return false;
            }
            if (price.value > 10000){
                price.value = 10000;
                document.getElementById('priceerr').innerHTML = "less than 10,000";
                return false;
            }
            if (8000 <= price.value <= 10000 ){
                document.getElementById('priceerr').innerHTML ='<i class="fa fa-check-circle" style="margin-top:10px;color:green;font-size:16px"></i>';
                return true;
            }
        }
    }

    $(function () {
    // Multiple images preview with JavaScript
        var multiImgPreview = function (input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function (event) {
                $($.parseHTML('<img width="200px" height="100px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
            }
            reader.readAsDataURL(input.files[i]);
            }
        }
        if (input.files.length < 5){
            $($.parseHTML('<h6 style="margin-top:5px;text-align:center;font-weight:600">Upload Atleast 5 images of the product</h6>')).appendTo(imgPreviewPlaceholder);;
        }
        };
        
        $('#chooseFile').on('change', function () {
        multiImgPreview(this, 'div.imgGallery');
        });
    });

    function showProfile(){
            document.getElementById("profileNav").className = "active";
            document.getElementById('profile').style.display = 'block';
            document.getElementById('sell').style.display = 'none'; 
            document.getElementById('orders').style.display = 'none'; 
            document.getElementById('sellNav').classList.remove('active');
            document.getElementById('orderNav').classList.remove('active');      
    }
    function showSell(){
            document.getElementById("sellNav").className = "active";
            document.getElementById('profile').style.display = 'none';
            document.getElementById('sell').style.display = 'block';  
            document.getElementById('orders').style.display = 'none';
            document.getElementById('profileNav').classList.remove('active');
            document.getElementById('orderNav').classList.remove('active');      
    }
    function showOrders(){
            document.getElementById('profileNav').classList.remove('active');
            document.getElementById('sellNav').classList.remove('active'); 
            document.getElementById("orderNav").className = "active";
            document.getElementById('orders').style.display = 'block';
            document.getElementById('profile').style.display = 'none';
            document.getElementById('sell').style.display = 'none';      
    }

    var modal = document.getElementById("myModal");

    function showInfo() {
        modal.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>