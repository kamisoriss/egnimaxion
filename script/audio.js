document.addEventListener("DOMContentLoaded", function() {
    const musiqueFond = document.getElementById("musique-fond");

    if (musiqueFond) {
        musiqueFond.volume = 0.15; // Volume à 15%

        const tempsSauvegarde = sessionStorage.getItem("musiqueTemps");
        if (tempsSauvegarde !== null) {
            musiqueFond.currentTime = parseFloat(tempsSauvegarde);
        }

        const lancerMusique = () => {
            musiqueFond.play().then(() => {
                sessionStorage.setItem("musiqueEnLecture", "true");
                window.removeEventListener('click', lancerMusique);
                window.removeEventListener('touchstart', lancerMusique);
            }).catch(e => console.log("Attente d'interaction :", e));
        };

        if (sessionStorage.getItem("musiqueEnLecture") === "true") {
            musiqueFond.play().catch(() => {
                window.addEventListener('click', lancerMusique);
                window.addEventListener('touchstart', lancerMusique);
            });
        } else {
            window.addEventListener('click', lancerMusique);
            window.addEventListener('touchstart', lancerMusique);
        }

        window.addEventListener("beforeunload", () => {
            sessionStorage.setItem("musiqueTemps", musiqueFond.currentTime);
        });

    }
});