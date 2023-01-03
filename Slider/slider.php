<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.css"/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css"/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <link rel="stylesheet" type="text/css" href="Slider/slider.css" />
<style>
    .owl-prev {
        background: url("https://res.cloudinary.com/milairagny/image/upload/v1487938188/left-arrow_rlxamy.png") left center no-repeat;
        height: 54px;
        position: absolute;
        top: 50%;
        width: 27px;
        z-index: 1000;
        left: 2%;
        cursor: pointer;
        color: transparent;
        margin-top: -27px;
    }

    .owl-next {
        background: url("https://res.cloudinary.com/milairagny/image/upload/v1487938220/right-arrow_zwe9sf.png") right center no-repeat;
        height: 54px;
        position: absolute;
        top: 50%;
        width: 27px;
        z-index: 1000;
        right: 2%;
        cursor: pointer;
        color: transparent;
        margin-top: -27px;
    }

    .owl-next:hover,
    .owl-prev:hover {
        opacity: 0.5;
    }

    /* Owl Carousel */

    /* Popup Text */

    .white-popup-block {
        background: #FFF;
        padding: 20px 30px;
        text-align: left;
        max-width: 650px;
        margin: 40px auto;
        position: relative;
    }

    .popuptext {
        display: table;
    }
    .popuptext p {
        margin-bottom: 10px;
    }
    .popuptext span {
        font-weight: bold;
        float: right;
    }
    /* Popup Text */

    /* Icon CSS */
    .item {
        position: relative;
    }
    .item i {
        display: none;
        font-size: 2rem;
        color: #FFF;
        opacity: 1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
    }
    .item a {
        display: block;
        width: 100%;
    }
    .item a:hover:before {
        content: "";
        background: rgba(0, 0, 0, 0.5);
        position: absolute;
        height: 100%;
        width: 100%;
        z-index: 1;
    }
    .item a:hover i {
        display: block;
        z-index: 2;
    }
</style>
<div class="owl-carousel" style="margin-top:100px">
    <div class="item">
        <a href="">
            <img id="slidimg" src="assets/1.png"/>
            <i class="fa fa-inr"> 2000</i>
        </a>
    </div>
    <div class="item">
        <a href="">
            <img id="slidimg" src="assets/3.png" />
            <i class="fa fa-inr"> 500</i>
        </a>
    </div>
    <div class="item">
        <a href="">
            <img id="slidimg" src="assets/4.png" />
            <i class="fa fa-inr"> 3000</i>
        </a>
    </div>
    <div class="item">
        <a href="">
            <img id="slidimg" src="assets/2_.png" width="20%"/>
            <i class="fa fa-inr"> 5000</i>
        </a>
    </div>
    <div class="item">
        <a href="">
            <img id="slidimg" src="assets/5.png" />
            <i class="fa fa-inr"> 2000</i>
        </a>
    </div>
</div>
<script>
  $('.owl-carousel').owlCarousel({
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      loop: true,
      margin: 50,
      responsiveClass: true,
      nav: true,
      loop: true,
      stagePadding: 100,
      responsive: {
          0: {
              items: 1
          },
          568: {
              items: 2
          },
          600: {
              items: 3
          },
          1000: {
              items: 3
          }
      }
  })
  
</script>