document.addEventListener("DOMContentLoaded", function () {
  const clientsTableContainer = document.getElementById(
    "clients-table-container"
  );
  const usersTableContainer = document.getElementById("users-table-container");

  const clientsLink = document.getElementById("clients-link");
  const usersLink = document.getElementById("users-link");

  if (clientsLink) {
    clientsLink.addEventListener("click", function () {
      clientsTableContainer.classList.remove("hidden");
      usersTableContainer.classList.add("hidden");
    });
  }
});

function validateForm() {
  // Validate name (allow only letters)
  var nameInput = document.getElementById("company-name");
  var nameValue = nameInput.value;

  if (!/^[a-zA-Z\s]+$/.test(nameValue)) {
    alert("Please enter a valid name (letters only).");
    return false;
  }

  // Validate phone-number format
  var phoneNumber = document.getElementById("phone");
  var phoneNumberValue = phoneNumber.value;

  // Allow optional characters like parentheses, spaces, and hyphens
  if (!/^[0-9()+\- ]{10,}$/.test(phoneNumberValue)) {
    alert("Please enter a valid phone number.");
    return false;
  }
  return true;
}
