function displayNewReservationModal(ev) {
    var carName = this.getAttribute("data-car-name");
    var carId = this.getAttribute("data-car-id");
    var day = this.getAttribute("data-day");
    var who = this.getAttribute("data-who");
    var comment = this.getAttribute("data-comment");
    var reservationId = this.getAttribute("data-reservationId");
    var hour_start = this.getAttribute("reservation-hour-start");
    var hour_end = this.getAttribute("reservation-hour-end");


    var modal = document.getElementById("signup-modal");

    // Making sure that we "deselect" all cars before showing the modal...
    var allCarOptions = document.querySelectorAll("#reservation-car option");
    for(var i = 0; i<allCarOptions.length; i++) {
        allCarOptions[i].removeAttribute("selected");
    }

    // If we pass an "car_id" to the modal, then it should be pre-selected...
    if (carId) {
        document.getElementById("car-" + carId).setAttribute("selected", true);
    }

    if (hour_start) {
        document.getElementById("reservation-hour-start").value = hour_start;
    }

    if (hour_end) {
        document.getElementById("reservation-hour-end").value = hour_end;
    }

    if (day) {
        document.getElementById("reservation-date").value = day;
    }

    if (comment) {
        document.getElementById("reservation-comments").value = comment;
    }

    if (who) {
        document.getElementById("reservation-who").value = who;
    }



    modal.classList.add("is-active");
    console.log("[MODAL] new sign up request",carName, day);
}


/*
 * Code to save/edit reservation to the database.
 */

function saveReservation() {
    var reservation_date = document.getElementById("reservation-date").value
    var hour_start = document.getElementById("reservation-hour-start").value
    var hour_end = document.getElementById("reservation-hour-end").value
    var who = document.getElementById("reservation-who").value
    var comments = document.getElementById("reservation-comments").value
    var id = document.getElementById("reservation-car").value

    var obj = {
        id: id,
        data: {
            date: reservation_date,
            start: hour_start,
            end: hour_end,
            who: who,
            comment: comments
        }
    }

    $.post("/signup/new", obj, function(data) {
        console.log("[AJAX] /signup/new", data);

        if (data.status === "ok") {
            window.location.reload();
        } else {
            alert("Error making reservation");
        }
    });


}

document.getElementById("is-save-reservation-trigger").addEventListener("click", saveReservation);


/*
 * Code to open modal dialog for adding a new reservation to the database.
 */


var allAddButtons = document.querySelectorAll(".is-signup-trigger");

for(var i = 0; i<allAddButtons.length; i++) {
    allAddButtons[i].addEventListener("click", displayNewReservationModal);
}

/*
 * Code to close modal dialogs.
 */

var allCloseModalButtons = document.querySelectorAll(".has-modal-close-behavior");

for(var i = 0; i<allCloseModalButtons.length; i++) {
    allCloseModalButtons[i].addEventListener("click", function() {
        var modalId = this.getAttribute("data-modal");
        document.getElementById(modalId).classList.remove("is-active");
    });
}

$('.timepicker').wickedpicker();
