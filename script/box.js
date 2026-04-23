document.addEventListener("DOMContentLoaded", () => {

    // =========================================================
    // 1. GESTION DU VISUEL (OUVERTURE/FERMETURE DES BOÎTES)
    // =========================================================
    const loginopenboxbutton = document.getElementById("login-open-box-buton");
    const loginOpenBox = document.getElementById("login-open-box");
    const btnForgetPassword = document.getElementById("forgetpassword");
    const btnBackToLogin = document.getElementById("connexionbox");
    const containerLogin = document.getElementById("form-login");
    const containerForgot = document.getElementById("forgetpasswordbox");

    if(loginopenboxbutton && loginOpenBox) {
        loginopenboxbutton.addEventListener("click", () => {
            if(window.getComputedStyle(loginOpenBox).display === "none") {
                loginOpenBox.style.display = "block";
                if (containerLogin && containerForgot) {
                    containerLogin.style.display = "block";
                    containerForgot.style.display = "none";
                }
            } else {
                loginOpenBox.style.display = "none";
            }
        });
    }

    if (btnForgetPassword && containerLogin && containerForgot) {
        btnForgetPassword.addEventListener("click", () => {
            containerLogin.style.display = "none";
            containerForgot.style.display = "block";
        });
    }

    if (btnBackToLogin && containerLogin && containerForgot) {
        btnBackToLogin.addEventListener("click", () => {
            containerForgot.style.display = "none";
            containerLogin.style.display = "block";
        });
    }

    // =========================================================
    // 2. GESTION DE L'ENVOI DE L'EMAIL (LE CODE QUI MANQUAIT !)
    // =========================================================
    const formReset = document.getElementById("password-reset");
    const messageRetour = document.getElementById("message-retour");

    if (formReset) {
        formReset.addEventListener("submit", function(event) {

            // CETTE LIGNE EST CRUCIALE : Elle empêche la page de se recharger !
            event.preventDefault();

            // On affiche un petit message pour montrer que ça charge
            if(messageRetour) {
                messageRetour.innerHTML = "<p style='color:#00ffff;'>Vérification en cours...</p>";
            }

            // On récupère l'adresse e-mail tapée par le joueur
            const formData = new FormData(formReset);

            // On envoie les données à votre fichier PHP en arrière-plan
            fetch("reset_mdp.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text()) // On attend la réponse de PHP
                .then(data => {
                    // On affiche la réponse (le texte vert ou l'erreur rouge) dans la boîte
                    if(messageRetour) {
                        messageRetour.innerHTML = data;
                    }
                })
                .catch(error => {
                    // S'il y a un gros problème de connexion
                    console.error("Erreur lors de la requête :", error);
                    if(messageRetour) {
                        messageRetour.innerHTML = "<p style='color:red;'>Erreur de communication avec le serveur.</p>";
                    }
                });
        });
    }
});