<link rel="stylesheet" href="../Login/modal.css"/>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400&display=swap');
   h4{
        style="font-family:'Roboto Slab'
    }
</style>

<div class="modal" tabindex="-1" role="dialog" id="shopsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div style="text-align:center;font-family: 'Poppins', sans-serif;">
                <h4><b>SEARCH SHOPS</b></h4><br/>
                    <img id="blah" src="assets/scan.png" height="160px" width="250px"/>
                    <br/>
                    <h6 style="margin-top:5px"><b>Upload Photo of Product</b></h6><br/>
                    <form action="Shops/shops.php" method="post" enctype="multipart/form-data">
                        <input
                            type="file"
                            name="fileToUpload"
                            id="fileToUpload"
                            onchange="readURL(this);">
                        <input type="submit" value="Upload" name="submit" style="width:80px">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>