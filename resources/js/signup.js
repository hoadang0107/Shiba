$(document).ready(function(e) {
	$('#Up_img').click(function(){
        $('#img_up').trigger('click');
        console.log(1);
	});
	var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $("#img_up").on('change', function(){
        readURL(this);
    });
});