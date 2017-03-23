function displayNewReservationModal(ev) {
    var carName = this.getAttribute("data-car-name");
    var carId = this.getAttribute("data-car-id");
    var day = this.getAttribute("data-day");
    var who = this.getAttribute("data-who");
    var comment = this.getAttribute("data-comment");
    var reservationId = this.getAttribute("data-reservationId");


    var modal = document.getElementById("signup-modal");

    // Making sure that we "deselect" all cars before showing the modal...
    var allCarOptions = document.querySelectorAll("#is-car-selector option");
    for(var i = 0; i<allCarOptions.length; i++) {
        allCarOptions[i].removeAttribute("selected");
    }

    // If we pass an "car_id" to the modal, then it should be pre-selected...
    if (carId) {
        document.getElementById("car-" + carId).setAttribute("selected", true);
    }

    modal.classList.add("is-active");
    console.log("[MODAL] new sign up request",carName, day);
}


/*
 * Code to save/edit reservation to the database.
 */

function saveReservation() {

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