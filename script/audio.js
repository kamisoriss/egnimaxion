document.addEventListener("DOMContentLoaded", function() {

    const musiqueFond = document.getElementById("musique-fond");
    const volumePiste = document.getElementById("volume-piste");
    const remplissageBarre = document.getElementById("remplissage-barre");
    const curseurRond = document.getElementById("curseur-rond");
    const iconeOn = document.getElementById("icone-volume-on");
    const iconeOff = document.getElementById("icone-volume-off");
    const textePourcentage = document.getElementById("volume-texte");
    const boutonMute = document.getElementById("bouton-mute");

    let volumePrecedent = 0.15;
    let isDragging = false;

    // --- VARIABLES POUR L'AMPLIFICATEUR VIRTUEL (iOS FIX) ---
    let audioCtx;
    let gainNode;
    let audioEstConfigure = false;

    if (musiqueFond) {

        // 1. Initialisation du "Moteur Audio" (Se lance au premier clic)
        function configurerAudioAvance() {
            if (audioEstConfigure) return;

            const AudioContext = window.AudioContext || window['webkitAudioContext'];
            audioCtx = new AudioContext();

            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }

            const source = audioCtx.createMediaElementSource(musiqueFond);
            gainNode = audioCtx.createGain();

            source.connect(gainNode);
            gainNode.connect(audioCtx.destination);

            audioEstConfigure = true;

            const volumeSauvegarde = sessionStorage.getItem("musiqueVolume");
            const volInitial = volumeSauvegarde !== null ? parseFloat(volumeSauvegarde) : 0.15;
            gainNode.gain.value = volInitial;
        }

        // --- LE NOUVEAU PATCH POUR iOS ---
        // Force le réveil du contexte audio dès qu'on touche l'écran
        document.addEventListener('touchstart', function() {
            if (audioCtx && audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
        }, { passive: true });
        // --- LECTURE AUTO ET RÉCUPÉRATION DU VOLUME ---
        const volumeSauvegarde = sessionStorage.getItem("musiqueVolume");
        let volumeDeDepart = volumeSauvegarde !== null ? parseFloat(volumeSauvegarde) : 0.15;

        // Sur PC, on met le volume direct. Sur iOS, ce sera géré par l'ampli.
        musiqueFond.volume = volumeDeDepart;

        const tempsSauvegarde = sessionStorage.getItem("musiqueTemps");
        if (tempsSauvegarde !== null) {
            musiqueFond.currentTime = parseFloat(tempsSauvegarde);
        }
        // Fonction lancée au premier clic sur la page
        const lancerMusique = () => {
            configurerAudioAvance(); // On allume l'ampli pour iOS !

            musiqueFond.play().then(() => {
                sessionStorage.setItem("musiqueEnLecture", "true");
                window.removeEventListener('click', lancerMusique);
                window.removeEventListener('touchstart', lancerMusique);
            }).catch(e => console.log("Attente interaction :", e));
        };

        if (sessionStorage.getItem("musiqueEnLecture") === "true") {
            musiqueFond.play().then(() => {
                configurerAudioAvance(); // Si la musique reprend toute seule
            }).catch(() => {
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

        // --- GESTION DE LA BARRE DE VOLUME ---
        if (volumePiste) {

            function majVisuelVolume(ratio) {
                const pourcentage = ratio * 100;

                // 1. Découpage parfait de l'image cyan
                if (remplissageBarre) {
                    remplissageBarre.style.clipPath = `inset(0 ${100 - pourcentage}% 0 0)`;
                }

                // 2. Les "butées" pour le rond (ajuste le 8 et le 92 si besoin)
                if (curseurRond) {
                    const positionCurseur = Math.max(8, Math.min(92, pourcentage));
                    curseurRond.style.left = `${positionCurseur}%`;
                }

                if (textePourcentage) textePourcentage.innerText = Math.round(pourcentage) + "%";

                if (ratio === 0) {
                    if (iconeOn) iconeOn.classList.remove("show");
                    if (iconeOff) iconeOff.classList.add("show");
                } else {
                    if (iconeOn) iconeOn.classList.add("show");
                    if (iconeOff) iconeOff.classList.remove("show");
                }
            }

            function majVolume(ratio) {
                // Pour PC/Android classique
                musiqueFond.volume = ratio;

                // LA MAGIE POUR iOS : On ajuste notre amplificateur virtuel !
                if (gainNode) {
                    // Petite astuce de pro : on fait une transition douce de 0.1s pour éviter les "clics" sonores
                    gainNode.gain.setTargetAtTime(ratio, audioCtx.currentTime, 0.1);
                }

                if (ratio > 0 && musiqueFond.muted) {
                    musiqueFond.muted = false;
                }

                majVisuelVolume(ratio);
                if (ratio > 0) volumePrecedent = ratio;

                // On sauvegarde
                sessionStorage.setItem("musiqueVolume", ratio);
            }

            function calculerRatio(e) {
                const largeurPiste = volumePiste.offsetWidth;
                const rect = volumePiste.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const ratio = (clientX - rect.left) / largeurPiste;
                return Math.max(0, Math.min(1, ratio));
            }

            const debutGlissement = (e) => {
                e.preventDefault();
                configurerAudioAvance(); // Sécurité : allume l'ampli si l'utilisateur touche la barre en premier
                isDragging = true;
                majVolume(calculerRatio(e));
            };

            volumePiste.addEventListener('mousedown', debutGlissement);
            volumePiste.addEventListener('touchstart', debutGlissement, { passive: false });

            window.addEventListener('mousemove', (e) => {
                if (isDragging) { e.preventDefault(); majVolume(calculerRatio(e)); }
            });
            window.addEventListener('touchmove', (e) => {
                if (isDragging) { e.preventDefault(); majVolume(calculerRatio(e)); }
            }, { passive: false });

            window.addEventListener('mouseup', () => isDragging = false);
            window.addEventListener('touchend', () => isDragging = false);

            if (boutonMute) {
                boutonMute.addEventListener('click', () => {
                    configurerAudioAvance(); // Sécurité
                    if (musiqueFond.muted || (gainNode && gainNode.gain.value === 0) || musiqueFond.volume === 0) {
                        musiqueFond.muted = false;
                        majVolume(volumePrecedent);
                    } else {
                        musiqueFond.muted = true;
                        majVolume(0); // Met l'ampli à 0
                    }
                });
            }

            // Initialisation visuelle
            majVisuelVolume(volumeDeDepart);
        }
    }
});