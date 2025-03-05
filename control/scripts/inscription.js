document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailField = document.getElementById("email");
    const passwordField = document.getElementById("password");
    const passwordConfirmField = document.getElementById("passwordConfirm");
    const dateNaissanceField = document.getElementById("date_de_naissance");
    const nomField = document.getElementById("nom");
    const prenomField = document.getElementById("prenom"); 
    const pseudoField = document.getElementById("pseudo");
    

    const emailSuggestions = ["gmail.com", "yahoo.fr", "outlook.com", "hotmail.com"];
    
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Empêcher l'envoi du formulaire par défaut

        let isValid;

        // Réinitialisation des erreurs
        document.querySelectorAll(".error-message").forEach(el => el.remove());
        [emailField, passwordField, passwordConfirmField, dateNaissanceField,nomField,prenomField,pseudoField].forEach(field => field.style.backgroundColor = "");

        const email = emailField.value;
        const password = passwordField.value;
        const passwordConfirm = passwordConfirmField.value;
        const dateNaissance = dateNaissanceField.value;
        const nom = nomField.value;
        const prenom = prenomField.value;
        const pseudo = pseudoField.value
        
        // Conversion des noms et prénoms en majuscules
        nomField.value = nomField.value.toUpperCase();
        prenomField.value = prenomField.value.toUpperCase(); 
        
        /* Validation des champs */

        // Vérification de l'adresse email
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {// On exclut l'utilisateur connecté de la liste des utilisateurs
            let suggestionMessage = "Veuillez entrer une adresse email valide. Suggestions: ";
            suggestionMessage += emailSuggestions.map(domain => email.split("@")[0] + "@" + domain).join(", ");
            showError(emailField, suggestionMessage);
            isValid = false;
        }
        
        // Vérification du mot de passe
        if (password.length < 6) {
            showError(passwordField, "Le mot de passe doit contenir au moins 6 caractères.");
            isValid = false;
        }

        // Vérification du nom
        if (nom.length < 1) {
            showError(nomField, "Le nom ne doit pas être vide.");
            isValid = false;
        } else {
            const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
            if (specialCharRegex.test(nom)) {
                showError(nomField, "Le nom ne doit pas contenir de caractères spéciaux.");
                isValid = false;
            }
        }

        // Vérification du nom
        if (prenom.length < 1) {
            showError(prenomField, "Le prénom ne doit pas être vide.");
            isValid = false;
        } else {
            const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
            if (specialCharRegex.test(prenom)) {
                showError(prenomField, "Le prénom ne doit pas contenir de caractères spéciaux.");
                isValid = false;
            }
        }

        // Vérification du pseudo
        if (pseudo.length < 1) {
            showError(pseudoField, "Le pseudo ne doit pas être vide..");
            isValid = false;
        }
        
        // Vérification de la confirmation du mot de passe
        if (password !== passwordConfirm) {
            showError(passwordConfirmField, "Les mots de passe ne correspondent pas.");
            isValid = false;
        }
        
        // Vérification de la date de naissance
        const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(dateNaissance)) {
            showError(dateNaissanceField, "Veuillez entrer une date de naissance au format AAAA-MM-JJ.");
            isValid = false;
        } else {
            const dateParts = dateNaissance.split("-");
            const year = parseInt(dateParts[0], 10);
            const month = parseInt(dateParts[1], 10);
            const day = parseInt(dateParts[2], 10);
            const date = new Date(year, month - 1, day);

            if (date.getFullYear() !== year || date.getMonth() + 1 !== month || date.getDate() !== day) {
                showError(dateNaissanceField, "Veuillez entrer une date de naissance valide.");
                isValid = false;
            } else {
                const daysInMonth = new Date(year, month, 0).getDate();
                if (day < 1 || day > daysInMonth) {
                    showError(dateNaissanceField, `Le jour doit être compris entre 1 et ${daysInMonth} pour le mois ${month}.`);
                    isValid = false;
                }
            }
        }

        // Empêcher l'envoi du formulaire si des erreurs sont présentes
            //if (!isValid) {
             //   event.preventDefault();
          //  }
        
        /* Envoi du formulaire  si tout les champs sont bon*/
        if (isValid) {
            const formData = new FormData(form);
            fetch('/TER_MIAGE/control/inscription.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Afficher la réponse du serveur dans la console
                alert("Inscription réussie ! Redirection vers la connexion...?");
                window.location.href = "/TER_MIAGE/view/connexion_view.php";
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Erreur lors de l'inscription. Veuillez réessayer.");
            });
        }

    });

    // Fonction pour afficher un message d'erreur sous un champ
    function showError(field, message) {
        field.style.backgroundColor = "#ffcccc";
        const error = document.createElement("div");
        error.className = "error-message";
        error.style.color = "red";
        error.style.fontSize = "12px";
        error.textContent = message;
        field.parentNode.insertBefore(error, field.nextSibling);
    }
});