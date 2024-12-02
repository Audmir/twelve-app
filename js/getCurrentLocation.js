const locationSerial = document.getElementById("loc");
locationSerial.textContent = "dd";

function getLocation(position) {
    const locationSerial = document.getElementById("loc");
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    console.log(lat + "  " + lon);

    // this is the API that helps us fetch a city name through the logitude and latitude got by the navigator
    const API_URL = `https://api.bigdatacloud.net/data/reverse-geocode-client?
                     latitude=${lat}&longitude=${lon}&localitylonguage=fr`;
    fetch(API_URL).then(res => res.json()).then(data => {
        console.log(data);
        console.log(data.countryName);
        locationSerial.textContent = data.countryName;
    });
}

function FailedToGetLocation() {
    console.log("There was some issue!");
}

const pos = navigator.geolocation.getCurrentPosition(getLocation, FailedToGetLocation);
console.log(pos);
