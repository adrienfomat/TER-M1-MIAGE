document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        resetErrors();

        const email = emailInput.value.trim();
        const password = passwordInput.value;

        let isValid = true;

        // Vérification des champs vides
        if (!email) {
            showError(emailInput, "L'email est requis");
            isValid = false;
        }
        if (!password) {
            showError(passwordInput, "Le mot de passe est requis");
            isValid = false;
        }

        // Vérification du format de l'email
        if (email && !validateEmail(email)) {
            showError(emailInput, "Format d'email incorrect");
            isValid = false;
        }

        if (isValid) {
            alert("Connexion réussie !");
            window.location.href = "dashboard.html"; 
        }
    });

    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }

    function showError(input, message) {
        input.style.backgroundColor = "#ffcccc";
        const error = document.createElement("div");
        error.className = "error-message";
        error.style.color = "red";
        error.textContent = message;
        input.parentNode.appendChild(error);
    }

    function resetErrors() {
        document.querySelectorAll(".error-message").forEach(error => error.remove());
        document.querySelectorAll("input").forEach(input => input.style.backgroundColor = "");
    }
});