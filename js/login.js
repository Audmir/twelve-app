
const form = document.getElementById("formTT");
continueBtn = document.getElementById("submitButton");
errorMessage = document.getElementById("errorMessage");


form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.addEventListener("click", () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "Success") {
                    location.href = "index-2";
                } else {
                    errorMessage.textContent = data;
                    errorMessage.style.display = "block";
                }
            }
        }
    }
    // we have to send form data through ajax to php
    let formData = new FormData(form); // creating new formData
    xhr.send(formData); //send form data to php
});


