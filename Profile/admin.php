<?php
session_start();

require '../vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;  

$name = $_SESSION['name'];

include_once('../db/connect.php');

$sql = "SELECT * FROM `registerusers` WHERE usertype='customer';";
$result=mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

$sql1 = "SELECT * FROM `item_desc` WHERE verifyid = 1;";
$result1=mysqli_query($db,$sql1);
$count1 = mysqli_num_rows($result1);

$people = "SELECT * FROM `peopleincharge`";
$res=mysqli_query($db,$people);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $company = $_POST['company'];
    $contact = '+91'.$_POST['contact'];
    $location = $_POST['location'];
    // $email = $_POST['email'];

    $insert = "INSERT INTO `peopleincharge`(`name`, `company`, `contact`, `location`) VALUES ('$name','$company','$contact','$location')";
    if(mysqli_query($db,$insert)){
        

        $AccountSid = "AC46ff9f149a5ce3e339003b7970ca9aa2"; 
        $AuthToken = "21ce756140d9347fea577f0797fe8304"; 
        $client = new Client($AccountSid, $AuthToken);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            $contact,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+19499892974',
                // the body of the text message you'd like to send
                'body' => 'Verifier, '.$name.', Registered Successfully'
            ]
            );
            // print($client->sid);
            echo '<script>
        alert("Person Registered Successfully");
        window.location.href="admin.php";
        </script>';
    }else {
            echo "Error: " . $insert . "<br>" . mysqli_error($db);
            }
}

?>
<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap');

            body {
                margin: 0;
                font-family: 'Roboto Slab', sans-serif;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                width: 23%;
                background-color: #1C0A00;
                position: fixed;
                height: 100%;
                overflow: auto;
            }

            li a {
                display: block;
                color: white;
                padding: 20px;
                text-decoration: none;
                font-size: 18px;
                margin-top: 7px;
            }

            li a.active {
                background-color: #FFC064;
                color: black;
                font-weight: 600;
            }

            li a:hover:not(.active) {
                background-color: #FFC064;
                color: black;
                font-weight: 800;
            }

            /* Float four columns side by side */
            .column {
                float: left;
                width: 28%;
                padding: 0 10px;
            }

            /* Remove extra left and right margins, due to padding */
            .row {
                margin: 0 -5px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Style the counter cards */
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.7);
                padding: 16px;
                text-align: center;
                background-color: white;
                color: black;
                border-radius: 10px;
            }
            .card button {
                background-color: #361500;
                padding: 10px;
                color: white;
                border: none;
                border-radius: 7px;
            }
            form {
                width: 30em;
                margin: 5px;
                padding: 40px;
                margin-left: 50px;
                font-size:14px;
                border: none;
                background-color: #F3F3F3;
                text-align: center;
                height: 250px;
                margin-top: 20px;
                color: black;
                font-weight: 600;
                border-radius: 7px;
            }
            label {
                width: 8em;
                float: left;
                text-align: right;
                margin: 0.7rem 1em;
                clear: both;
            }
            input,
            textarea {
                margin: 0.5em 0;
                width: 17em;
                padding: 7px;
            }
            #compreg {
                display: none;
            }
            table,
            td,
            th {
                padding: 10px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            th {
                background-color: #361500;
                color: white;
            }

            td {
                text-align: center;
            }

            table {
                border-collapse: collapse;
                width: 80%;
                margin-top: 30px;
                background-color: white;
                border-radius: 7px;
            }
        </style>
    </head>
    <body style="background-color:#FFC064">
        <ul>
            <li>
                <h3 style="padding:20px;color:white;"><?php echo $name ?></h3>
            </li>
            <li onclick="showUpload()">
                <a id="up" class="active" href="#home"><img style="vertical-align:middle" src="../assets/upload.png" width="25px"/>
                    Uploaded</a>
            </li>
            <li onclick="showCompany()">
                <a id="comp" href="#news"><img style="vertical-align:middle" src="../assets/edit.png" width="25px"/>
                    Company Registered</a>
            </li>
            <li>
                <a href="../db/logout.php"><img style="vertical-align:middle" src="../assets/logout.png" width="25px"/>
                    Logout</a>
            </li>
        </ul>

        <div style="margin-left:30%;padding:1px 16px;height:500px;">
        <div id="upload">
            <div class="row" style="margin-top:50px">
                <div class="column">
                    <div class="card">
                        <h3>Total Users Registered</h3>
                        <h3><?php echo $count; ?></h3>
                        <p>
                            <button style="cursor:pointer" onclick="userReg()">Show Records</button>
                        </p>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <h3>Total Products Uploaded</h3>
                        <h3><?php echo $count1; ?></h3>
                        <p>
                            <button style="cursor:pointer" onclick="proUpload()">Show Records</button>
                        </p>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <h3>Total Products Bought</h3>
                        <h3>10</h3>
                        <p>
                            <button style="cursor:pointer">Show Records</button>
                        </p>
                    </div>
                </div>
            </div>
            <div id="userreg" style="text-align:center;margin-left:50px;margin-top:40px;width:900px">
            <table style="margin-left:60px">
                    <tr>
                        <th>Incharge Name</th>
                        <th>Company Name</th>
                        <th>Contact</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($result)) {         
                            echo "<tr>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['usertype']."</td>";                  
                        }
                    ?>
                </table>
                </div>

                <div id="proup" style="margin-left:50px;margin-top:40px;display:none;width:900px">
                <table style="margin-left:60px">
                    <tr>
                        <th>Item Id</th>
                        <th>Category</th>
                        <th>Sub_category</th>
                        <th>Userid</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($result1)) {         
                            echo "<tr>";
                            echo "<td>".$row['itemid']."</td>";
                            echo "<td>".$row['category']."</td>";
                            echo "<td>".$row['sub_cat']."</td>"; 
                            echo "<td>".$row['userid']."</td>";                  
                        }
                    ?>
                </table>
                    </div>
        </div>

            <div style="margin-left:80px" id="compreg">
                <table>
                    <tr>
                        <th>Incharge Name</th>
                        <th>Company Name</th>
                        <th>Contact</th>
                        <th>Location</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($res)) {         
                            echo "<tr>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['company']."</td>";
                            echo "<td>".$row['contact']."</td>";    
                            echo "<td>".$row['location']."</td>";                 
                        }
                    ?>
                </table>
                <button
                    type="submit"
                    style="cursor:pointer;border-radius:7px;margin-top:10px;margin-left:300px;padding:12px;background-color:#873400;color:white;border:none"
                    onclick="addPerson()">ADD PERSON</button>

                <form action="" method="post" id="formid" style="display:none">
                    <div>
                        <label for="first">Incharge Name:</label>
                        <input type="text" name="name" />
                        <label for="last">Company Name:</label>
                        <input type="text" name="company" />
                        <label for="last">Contact:</label>
                        <input type="text" name="contact" />
                        <label for="last">Location:</label>
                        <input type="text" name="location" />
                    </div>
                    <button
                    name="submit"
                        type="submit"
                        style="cursor:pointer;border-radius:7px;margin-top:10px;margin-left:40px;padding:12px;background-color:#873400;color:white;border:none">SUBMIT</button>
                </form>
            </div>

        </div>

    </body>
</html>
<script>
    function showUpload() {
        document
            .getElementById("upload")
            .style
            .display = 'block';
        document
            .getElementById("compreg")
            .style
            .display = 'none';
        document
            .getElementById('comp')
            .classList
            .remove('active');
        document
            .getElementById("up")
            .className = "active";
    }
    function showCompany() {
        document
            .getElementById("compreg")
            .style
            .display = 'block';
        document
            .getElementById("upload")
            .style
            .display = 'none';
        document
            .getElementById('up')
            .classList
            .remove('active');
        document
            .getElementById("comp")
            .className = "active";
    }
    function addPerson() {
        var x = document.getElementById("formid");
        if (x.style.display === "none") {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }
    function userReg(){
        document.getElementById("userreg").style.display='table-cell';
        document.getElementById("proup").style.display='none';
    }
    function proUpload(){
        document.getElementById("userreg").style.display='none';
        document.getElementById("proup").style.display='table-cell';
    }
</script>