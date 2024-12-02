const weatherForm = document.querySelector(".weatherForm");
const cityInput = document.querySelector(".cityInput");
const card = document.querySelector(".card");
const api_key = "785b4593f65d1cc4674930f2be26b1b9";

weatherForm.addEventListener("submit", async event =>{
    event.preventDefault();

    const city = cityInput.value;
    if(city){
        try{

            const WeatherData = await getWeatherData(city);
            displayWeatherInfo(WeatherData);

        } catch(error){
            console.error(`this doesn't work, ${error}`);
            displayError(error);
        }
    } else {
        displayError("Please enter a city");
    }
});

async function getWeatherData(city){
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${api_key}`;
    const response = await fetch(apiUrl);

    if(!response.ok){
        throw new Error(`Something went wrong: ${response.status}`);
    } else {
        return await response.json();
    }
}

function displayWeatherInfo(data){
    const {
            name: city, 
            main: {temp, humidity, pressure}, 
            weather: [{description, id, icon}],
            sys: {country},
            coord: {lat, lon}
          } = data;

    console.log(data);
    card.textContent = "";
    card.style.display = "flex";

    const cityDisplay = document.createElement("h1");
    const tempDisplay = document.createElement("p");
    const humidityDisplay = document.createElement("p");
    const descriptionDisplay = document.createElement("p");
    const weatherEmoji = document.createElement("p");
    const countryDisplay = document.createElement("p");
    const latDisplay = document.createElement("p");
    const lonDisplay = document.createElement("p");
    const pressureDisplay = document.createElement("p");
/*     const errorDisplay = document.createElement("p"); */
    cityDisplay.textContent = city;
    cityDisplay.classList.add("cityDisplay");
    card.appendChild(cityDisplay);

    tempDisplay.textContent = `${(temp - 273.15).toFixed(2)}°C`;
    tempDisplay.classList.add("tempDisplay");
    card.appendChild(tempDisplay);

    humidityDisplay.textContent = `Humidity: ${humidity}%`;
    humidityDisplay.classList.add("humidityDisplay");
    card.appendChild(humidityDisplay);

    pressureDisplay.textContent = `Pressure: ${pressure}`;
    pressureDisplay.classList.add("humidityDisplay");
    card.appendChild(pressureDisplay);

    descriptionDisplay.textContent = description;
    descriptionDisplay.classList.add("descriptionDisplay");
    card.appendChild(descriptionDisplay);

    const weatherIcon = document.createElement("img");
    weatherIcon.src = `http://openweathermap.org/img/wn/${icon}@2x.png`;
    weatherIcon.alt = description;
    weatherIcon.classList.add("weatherEmoji");
    card.appendChild(weatherIcon);

    countryDisplay.textContent = `Country Code: ${country}`;
    countryDisplay.classList.add("countryDisplay");
    card.appendChild(countryDisplay);

    latDisplay.textContent = `Latitude: ${lat}`;
    latDisplay.classList.add("latDisplay");
    card.appendChild(latDisplay);

    lonDisplay.textContent = `Longitude: ${lon}`;
    lonDisplay.classList.add("lonDisplay");
    card.appendChild(lonDisplay);

}

function displayError(message){
    const errorDisplay = document.createElement("P");
    errorDisplay.textContent = message;
    errorDisplay.classList.add("errorDisplay");

    card.textContent = "";
    card.style.display = "flex";
    card.appendChild(errorDisplay);
}
