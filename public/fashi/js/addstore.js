$(document).ready(function() {
    //upload store image
	$('#img_store').click(function(){
        $('#store_img').trigger('click');
        console.log(1);
	});
	$("#store_img").change(function(e) {
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

			var file1 = e.originalEvent.srcElement.files[i];

			var img1 = document.createElement("img");
			var reader1 = new FileReader();
			reader1.onloadend = function(e) {
				img1.src = reader1.result;
				img1.style.height = "90px";
				img1.style.width = "90px";
				img1.style.marginLeft = "10px";
				img1.style.objectFit = "contain"
			}
			reader1.readAsDataURL(file1);
            $("#image_store").append(img1);
        }
    });

// upload menu image
    $('#img_menu').click(function(){
        $('#menu_img').trigger('click');
	});
    $("#menu_img").change(function(e) {
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

			var file = e.originalEvent.srcElement.files[i];

			var img = document.createElement("img");
			var reader = new FileReader();
			reader.onloadend = function(e) {
				img.src = reader.result;
				img.style.height = "90px";
				img.style.width = "90px";
				img.style.marginLeft = "10px";
				img.style.objectFit = "contain"
			}
			reader.readAsDataURL(file);
            $("#image_menu").append(img);
        }
    });

});