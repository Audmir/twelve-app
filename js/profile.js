let profile_picture = document.getElementById("profile-pic");
let input_file = document.getElementById("photo");
input_file.onchange = function(){
    profile_picture.src = URL.createObjectURL(input_file.files[0]);
}