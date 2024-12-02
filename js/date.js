const date_button = document.getElementById("dropdownMenuDate2");
const serial_hour = document.getElementById("h");


setInterval(() => {
    const today = new Date();

    let hour = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();

    let year = today.getFullYear();
    let day = today.getDate();
    let months = today.getMonth() + 1;
    switch (months) {
        case 1: month = "Janvier"; break;
        case 2: month = "Février"; break;
        case 3: month = "Mars"; break;
        case 4: month = "Avril"; break;
        case 5: month = "Mai"; break;
        case 6: month = "Juin"; break;
        case 7: month = "Juillet"; break;
        case 8: month = "Aout"; break;
        case 9: month = "Septembre"; break;
        case 10: month = "Octobre"; break;
        case 11: month = "Novembre"; break;
        case 12: month = "Décembre"; break;
    }

    date_button.innerHTML = `<i class="mdi mdi-calendar"></i> Aujourd'hui (${day} ${month} ${year})`;
    serial_hour.textContent = `Heure: ${hour}h : ${minutes}m : ${seconds}s`;

}, 500);
