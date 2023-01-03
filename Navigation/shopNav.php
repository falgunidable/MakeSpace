<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Navigation/style.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap');
            *{
                font-family: 'Roboto Slab', sans-serif;
            }
            #logbtn{
                color: #1C0A00;
                
            }
            #logbtn:focus{
                outline:none;
            }
            #logbtn:hover{
                background-color: #361500;
                color: white;
                font-weight:400;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color:#FFC064">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/logoicon.png" width="180" height="45" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <button id="logbtn" class="btn btn-outline-success my-2 my-lg-0" data-toggle="modal" data-target="#loginModal"><b>LogIn / SignUp</b></button>  
            </div>
        </nav>
    </body>

</html>