function togglePassword() {
  var passwordField = document.getElementById("password");
  var showPasswordButton = document.getElementById("showPasswordButton");

  if (passwordField.type === "password") {
      passwordField.type = "text";
      showPasswordButton.textContent = "Hide";
  } else {
      passwordField.type = "password";
      showPasswordButton.textContent = "Show";
  }
}

console.log("JavaScript loaded successfully.");
