<?php
include('../db/connect.php');
include_once('../Navigation/shopNav.php');

    /// Make sure the above function is included...
    // Check file is uploaded
    error_reporting(E_ERROR | E_PARSE);
    $store ="";
    if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"])) {
    //     // Process and return results
        $file   =   UploadImage();
        // If success, show image
        if($file != false) { ?>
              <!-- <img src=" -->
              <?php 
    // //         // echo $file['localpath']; ?>
               <!-- " />  -->
               <?php
            // echo $file['fullpath'];
            $file_path = $file['fullpath'];
            $api_credentials = array(
                'key' => 'acc_940b30f748861e4',
                'secret' => '2d2a77647b3d3b00e744056feb5588be'
            );

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/tags");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, 1);
            $fields = [
                'image' => new \CurlFile($file_path, 'image/jpeg', 'image.jpg')
            ];
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            $response = curl_exec($ch);
            curl_close($ch);

            $json_response = json_decode($response);
            
            // var_dump($json_response);
            $percent = 0;
            $tags_e = array("equipment","technology","device","computer","speaker","mobile","laptop","keyboard","digital","monitor","desktop","printer","scanner");
            $tags_f = array("armrest","chair","seat","armchair","furniture","chairs","desk","sofa","table");
            
            $obj = $json_response->result;
            // $obj1 = json_decode($obj);
            foreach($obj as $a){
                foreach($a as $s){
                    $percent = $s->confidence;
                    if($percent >= 40){
                        foreach($s as $y){
                            foreach($y as $z){
                                // print_r($z);
                                if(in_array($z,$tags_f)){
                                    $store = "Furniture";
                                }
                                if(in_array($z,$tags_e)){
                                    $store = "Electronics";
                                }
                            }
                        }
                    }
                }
                
            }
            }
    }

    function UploadImage($settings = false)
    {
        // Input allows you to change where your file is coming from so you can port this code easily
        $inputname      =   (isset($settings['input']) && !empty($settings['input']))? $settings['input'] : "fileToUpload";
        // Sets your document root for easy uploading reference
        $root_dir       =   (isset($settings['root']) && !empty($settings['root']))? $settings['root'] : $_SERVER['DOCUMENT_ROOT'];
        // Allows you to set a folder where your file will be dropped, good for porting elsewhere
        $target_dir     =   (isset($settings['dir']) && !empty($settings['dir']))? $settings['dir'] : "/makespace/uploads/";
        // Check the file is not empty (if you want to change the name of the file are uploading)
        if(isset($settings['filename']) && !empty($settings['filename']))
            $filename   =   $settings['filename'];
        // Use the default upload name
        else
            $filename   =   preg_replace('/[^a-zA-Z0-9\.\_\-]/',"",$_FILES[$inputname]["name"]);
        // If empty name, just return false and end the process
        if(empty($filename))
            return false;
        // Check if the upload spot is a real folder
        if(!is_dir($root_dir.$target_dir))
            // If not, create the folder recursively
            mkdir($root_dir.$target_dir,0755,true);
        // Create a root-based upload path
        $target_file    =   $root_dir.$target_dir.$filename;
        // If the file is uploaded successfully...
        if(move_uploaded_file($_FILES[$inputname]["tmp_name"],$target_file)) {
                // Save out all the stats of the upload
                $stats['filename']  =   $filename;
                $stats['fullpath']  =   $target_file;
                $stats['localpath'] =   $target_dir.$filename;
                $stats['filesize']  =   filesize($target_file);
                // Return the stats
                return $stats;
            }
        // Return false
        return false;
    }
    
    if($store == "Furniture"){
        $sql = "SELECT * FROM shops where cat_type='Furniture'";
    }else if($store == "Electronics"){
        $sql = "SELECT * FROM shops where cat_type='Electronics'";
    }else{
        $sql = "SELECT * FROM shops";
    }
    
    $result = mysqli_query($db,$sql);    

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="../Navigation/nav.php" />

<style>
 .card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
</style>
        
        <div class="container-fluid" style="margin-top:80px;padding:50px">
        <?php 
        echo '<h3><b>';echo $store; echo '</b></h3>';
            while($row = mysqli_fetch_assoc($result)){
            ?>
                     <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="300px" />   
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><b><?php echo $row['name']; ?></b></h4>
                                        <p class="card-text"><?php echo $row['address']; ?></p>
                                        <p>Contact No. <?php echo $row['contact']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                