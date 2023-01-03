 <?php
    include_once('Navigation/nav.php');
    include_once('Login/modal.php');
    include_once('Shops/uploadimage.php');
?>
 <html>
     <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
     <style>
        
         @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400&display=swap');
         body{
             background-color:#FFC064;
             font-family:'Roboto Slab'
         }
         button:focus {
             outline: none;
         }
         #buy:hover,#sell:hover,#rent:hover{
            opacity: 0.5;
            cursor:pointer;
        }
        
        #search:hover,#upload:hover{
             background-color:#361500;
             opacity: 0.8;
             color:white;
             cursor:pointer;
             font-weight:400;
         }
        
     </style>
     </head>
     <body style="background-color:#FFC064;" class="example">
         <div style="text-align:center;margin-top:40px;">
             <button id="buy" onclick="location.href = 'Shops/catalog.php'">BUY<img src="assets/producthover.png" /></button>
             <button id="sell" onclick="showSell()">SELL<img src="assets/producthover.png" /></button>
             <button id="rent">RENT<img src="assets/producthover.png" /></button>
         </div>
         <div id="sellBtn" style="text-align:center;margin-top:40px;display:none">
             <button id="search" data-toggle="modal" data-target="#shopsModal" style="margin-right:10px"><img src="assets/searchico.png" /> SEARCH SHOPS</button>
             <button id="upload" data-toggle="modal" data-target="#loginModal"><img src="assets/uploadicon.png" /> SELL ITEM</button>
         </div>
     </body>
     <script>
        function showSell(){
            if(document.getElementById('sellBtn').style.display == "none"){
                document.getElementById('sellBtn').style.display="block";
            }
            else{
                document.getElementById('sellBtn').style.display="none";
            }
            
        }

        $(document).ready(function() {
            $("#search").mouseenter(function() {
                $(this).children('img').attr("src", "assets/searchhover.png");
            });
            $("#search").mouseleave(function() {
                $(this).children('img').attr("src", "assets/searchico.png");
            });
            $("#upload").mouseenter(function() {
                $(this).children('img').attr("src", "assets/uploadhover.png");
            });
            $("#upload").mouseleave(function() {
                $(this).children('img').attr("src", "assets/uploadicon.png");
            });
        });

         </script>
</html>
<?php 
include_once('Slider/slider.php');
include_once('Footer/footer.php');  
?>

