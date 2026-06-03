(function () {
  "use strict";

  var form = document.getElementById("contact_form");
  if (!form) {
    return;
  }

  function getValue(name) {
    var field = form.elements[name];
    return field ? String(field.value || "").trim() : "";
  }

  function showMessage(message, type) {
    var result = document.getElementById("form-result");
    if (!result) {
      result = document.createElement("div");
      result.id = "form-result";
      result.className = "alert";
      result.setAttribute("role", "alert");
      var submitButton = form.querySelector("button[type='submit']");
      var target = form.querySelector(".mb-5") || (submitButton && submitButton.parentElement) || form;
      target.insertBefore(result, submitButton || target.firstChild);
    }

    result.className = "alert alert-" + (type || "success");
    result.textContent = message;
    result.style.display = "block";
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    var name = getValue("form_name");
    var email = getValue("form_email");
    var subject = getValue("form_subject") || "Uraca Realty Inquiry";
    var phone = getValue("form_phone");
    var message = getValue("form_message");

    if (!email || !subject || !message) {
      showMessage("Please enter your email, subject, and message before sending.", "warning");
      return;
    }

    var body = [
      "Name: " + (name || "Not provided"),
      "Email: " + email,
      "Phone: " + (phone || "Not provided"),
      "",
      message
    ].join("\n");

    window.location.href =
      "mailto:uracarealty@gmail.com?subject=" +
      encodeURIComponent(subject) +
      "&body=" +
      encodeURIComponent(body);

    showMessage("Your email app should open with the message ready to send.", "success");
  });
})();
