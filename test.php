<!-- <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<?php


echo "IN TEST";

    // Make sure the above function is included...
    // Check file is uploaded

    // if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"])) {
//         // Process and return results
//         $file   =   UploadImage();
//         // If success, show image
//         if($file != false) { ?>
//            <img src="
//            <?php 
//             // echo $file['localpath']; ?>
//             " /> 
//             <?php
//             // echo $file['fullpath'];
//             $file_path = $file['fullpath'];
//             $api_credentials = array(
//                 'key' => 'acc_940b30f748861e4',
//                 'secret' => '2d2a77647b3d3b00e744056feb5588be'
//             );

//             $ch = curl_init();

//             curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/tags");
//             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//             curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//             curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);
//             curl_setopt($ch, CURLOPT_HEADER, FALSE);
//             curl_setopt($ch, CURLOPT_POST, 1);
//             $fields = [
//                 'image' => new \CurlFile($file_path, 'image/jpeg', 'image.jpg')
//             ];
//             curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

//             $response = curl_exec($ch);
//             curl_close($ch);

//             $json_response = json_decode($response);
            
//             var_dump($json_response);
//             // echo $dict;
//             // echo $dict[1];
//             // for(int i=0;i<$dict.length();i++){

//             // }
//             }
//     }
// ?>
// <form action="" method="post" enctype="multipart/form-data">
//     Select image to upload:
//     <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">
//     <img id="blah" src="#" alt="your image" />
//     <input type="submit" value="Upload Image" name="submit">
// </form>
// <?php
//     function UploadImage($settings = false)
//         {
//             // Input allows you to change where your file is coming from so you can port this code easily
//             $inputname      =   (isset($settings['input']) && !empty($settings['input']))? $settings['input'] : "fileToUpload";
//             // Sets your document root for easy uploading reference
//             $root_dir       =   (isset($settings['root']) && !empty($settings['root']))? $settings['root'] : $_SERVER['DOCUMENT_ROOT'];
//             // Allows you to set a folder where your file will be dropped, good for porting elsewhere
//             $target_dir     =   (isset($settings['dir']) && !empty($settings['dir']))? $settings['dir'] : "/makespace/uploads/";
//             // Check the file is not empty (if you want to change the name of the file are uploading)
//             if(isset($settings['filename']) && !empty($settings['filename']))
//                 $filename   =   $settings['filename'];
//             // Use the default upload name
//             else
//                 $filename   =   preg_replace('/[^a-zA-Z0-9\.\_\-]/',"",$_FILES[$inputname]["name"]);
//             // If empty name, just return false and end the process
//             if(empty($filename))
//                 return false;
//             // Check if the upload spot is a real folder
//             if(!is_dir($root_dir.$target_dir))
//                 // If not, create the folder recursively
//                 mkdir($root_dir.$target_dir,0755,true);
//             // Create a root-based upload path
//             $target_file    =   $root_dir.$target_dir.$filename;
//             // If the file is uploaded successfully...
//             if(move_uploaded_file($_FILES[$inputname]["tmp_name"],$target_file)) {
//                     // Save out all the stats of the upload
//                     $stats['filename']  =   $filename;
//                     $stats['fullpath']  =   $target_file;
//                     $stats['localpath'] =   $target_dir.$filename;
//                     $stats['filesize']  =   filesize($target_file);
//                     // Return the stats
//                     return $stats;
//                 }
//             // Return false
//             return false;
//         }
?>
<script>
    // function readURL(input) {
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function (e) {
    //                 $('#blah')
    //                     .attr('src', e.target.result)
    //                     .width(150)
    //                     .height(200);
    //             };

    //             reader.readAsDataURL(input.files[0]);
    //         }
    //     } 
</script> -->
<script>
    File tfliteModel = "***.tflite";
tflite = new Interpreter(tfliteModel);  # Load model.

final float IMAGE_MEAN = 127.5f;
final float IMAGE_STD = 127.5f;
final int IMAGE_SIZE_X = 224;
final int IMAGE_SIZE_Y = 224;
final int DIM_BATCH_SIZE = 1;
final int DIM_PIXEL_SIZE = 3;
final int NUM_BYTES_PER_CHANNEL = 4;  # Quantized model is 1
final int NUM_CLASS = 1001;

// The example uses Bitmap ARGB_8888 format.
Bitmap bitmap = ...;

int[] intValues = new int[IMAGE_SIZE_X * IMAGE_SIZE_Y];
bitmap.getPixels(intValues, 0, bitmap.getWidth(), 0, 0, bitmap.getWidth(), bitmap.getHeight());

ByteBuffer imgData =
    ByteBuffer.allocateDirect(
        DIM_BATCH_SIZE
            * IMAGE_SIZE_X
            * IMAGE_SIZE_Y
            * DIM_PIXEL_SIZE
            * NUM_BYTES_PER_CHANNEL);
imgData.rewind();

// Float model.
int pixel = 0;
for (int i = 0; i < IMAGE_SIZE_X; ++i) {
  for (int j = 0; j < IMAGE_SIZE_Y; ++j) {
    int pixelValue = intValues[pixel++];
    imgData.putFloat((((pixelValue >> 16) & 0xFF) - IMAGE_MEAN) / IMAGE_STD);
    imgData.putFloat((((pixelValue >> 8) & 0xFF) - IMAGE_MEAN) / IMAGE_STD);
    imgData.putFloat(((pixelValue & 0xFF) - IMAGE_MEAN) / IMAGE_STD);
  }
}

// Quantized model.
int pixel = 0;
for (int i = 0; i < IMAGE_SIZE_X; ++i) {
  for (int j = 0; j < IMAGE_SIZE_Y; ++j) {
    imgData.put((byte) ((pixelValue >> 16) & 0xFF));
    imgData.put((byte) ((pixelValue >> 8) & 0xFF));
    imgData.put((byte) (pixelValue & 0xFF));
  }
}

// Output label probabilities.
float[][] labelProbArray = new float[1][NUM_CLASS];

// Run the model.
tflite.run(imgData, labelProbArray);
</script>