function readURL(event , id){
    var getImagePath = URL.createObjectURL(event.target.files[0]);
    $('#'+id).prop('src', getImagePath );
}