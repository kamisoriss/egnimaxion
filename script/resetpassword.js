/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

const formReset = document.getElementById("password-reset");
const messageRetour = document.getElementById("message-retour");

if (formReset) {
    formReset.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(formReset);

        fetch("reset_mdp.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text()) // On attend la réponse du serveur (texte ou HTML)
            .then(data => {
                messageRetour.innerHTML = data;
                formReset.reset();
            })
            .catch(error => {
                console.error("Erreur lors de la requête :", error);
                messageRetour.innerHTML = "<p style='color:red;'>Une erreur est survenue.</p>";
            });
    });
}