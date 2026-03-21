// nav.js
// Gestion de la navigation latérale (ouverture/fermeture, épinglage, hover intent)
// Commentaires en français ajoutés pour faciliter la lecture et la maintenance.
// Petit script pour gérer l'ouverture/fermeture de la navigation latérale
// Objectif:
// - Ouvrir au survol avec un léger délai (hover intent) pour éviter les ouvertures accidentelles
// - Fermer au survol sortant avec un léger délai pour éviter le clignotement à la limite
// - Permettre d'épingler via clic (la nav reste ouverte) et de désépingler via re-clic/clic extérieur/Echap
// - Rester accessible au clavier (focus-within) et fermer à Escape
(function(){
  document.addEventListener('DOMContentLoaded', function(){
    // Récupération des éléments principaux
    var nav = document.querySelector('.enigmatic-nav'); // conteneur de la navigation
    var toggle = document.querySelector('.nav-toggle'); // bouton/flèche pour ouvrir/fermer
    if(!nav || !toggle) return;

    // Gestion unifiée du clic sur le toggle: ouvrir/fermer + épingler/désépingler
    function handleToggleClick(e){
      e.preventDefault();
      var isOpen = nav.classList.contains('expanded');
      var isPinned = nav.dataset.pinned === 'true';
      if(!isOpen){
        // Ouvrir et épingler (intention explicite de l'utilisateur)
        nav.classList.add('expanded');
        nav.dataset.pinned = 'true';
        var firstBtn = nav.querySelector('button, a');
        if(firstBtn) firstBtn.focus();
      } else if(isPinned){
        // Si c'était épinglé, on désépinglera et fermera
        nav.dataset.pinned = 'false';
        nav.classList.remove('expanded');
        toggle.focus();
      } else {
        // Si ouvert mais non épinglé, le clic signifie: épingler
        nav.dataset.pinned = 'true';
      }
    }

    let clickGuardUntil = 0; // ms timestamp to ignore hover timers right after click
    toggle.addEventListener('click', function(e){
      clickGuardUntil = Date.now() + 300; // petite fenêtre anti-flicker
      handleToggleClick(e);
    });
    toggle.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' ' || e.key === 'Spacebar'){
        handleToggleClick(e);
      }
    });

    // Hover intent: ouvrir après petit délai, fermer après petit délai
    // Ces temporisations évitent les basculements rapides lorsque la souris frôle le bord de la nav
    var openTimer = null;
    var closeTimer = null;
  var OPEN_DELAY = 140; // ms (léger délai à l'ouverture)
  var CLOSE_DELAY = 220; // ms (un peu plus long à la fermeture pour tolérer les micro-sorties)

    function openWithDelay(){
      if(Date.now() < clickGuardUntil) return; // ignorer hover juste après un clic
      clearTimeout(closeTimer);
      if(nav.classList.contains('expanded')) return;
      openTimer = setTimeout(function(){
        nav.classList.add('expanded');
      }, OPEN_DELAY);
    }
    function closeWithDelay(){
      if(Date.now() < clickGuardUntil) return; // ignorer hover juste après un clic
      clearTimeout(openTimer);
      // si l'utilisateur a épinglé via clic, rester ouvert
      // on utilise un attribut data-pinned pour savoir s'il a cliqué
      if(nav.dataset.pinned === 'true') return;
      closeTimer = setTimeout(function(){
        nav.classList.remove('expanded');
      }, CLOSE_DELAY);
    }

    // Zone tampon (hover guard): petite zone invisible placée à droite de la nav
    // pour éviter la perte de hover quand la souris traverse la limite.
    var guard = document.createElement('div');
    guard.className = 'nav-hover-guard';
    // On insère la zone de garde en tant que soeur de la nav (dans le body)
    document.body.appendChild(guard);

    // Synchroniser la position/hauteur de la zone de garde avec la nav
    function positionGuard(){
      var rect = nav.getBoundingClientRect();
      // largeur de la zone de garde: petite (ex: 16px)
      var guardWidth = 16;
      guard.style.position = 'fixed';
      guard.style.top = rect.top + 'px';
      guard.style.left = (rect.left + rect.width) + 'px';
      guard.style.width = guardWidth + 'px';
      guard.style.height = rect.height + 'px';
      guard.style.zIndex = 59; // sous la flèche, au-dessus du fond
      guard.style.pointerEvents = 'auto';
      guard.style.background = 'transparent';
    }
    positionGuard();
    window.addEventListener('resize', positionGuard);
    window.addEventListener('scroll', positionGuard, true);

    // Entrer/sortir sur la nav, le toggle, ou la zone de garde déclenche les timers
    nav.addEventListener('mouseenter', openWithDelay);
    nav.addEventListener('mouseleave', closeWithDelay);
  // Ne pas lancer de hover timers depuis la flèche (évite les conflits clic/hover)
  guard.addEventListener('mouseenter', openWithDelay);
  guard.addEventListener('mouseleave', closeWithDelay);

    // Close nav if click outside
    document.addEventListener('click', function(e){
      if(!nav.classList.contains('expanded')) return;
      if(nav.contains(e.target) || toggle.contains(e.target)) return;
      nav.dataset.pinned = 'false';
      nav.classList.remove('expanded');
    });

    // Close on Escape
    document.addEventListener('keydown', function(e){
      if(e.key === 'Escape'){
        nav.dataset.pinned = 'false';
        nav.classList.remove('expanded');
      }
    });

    // Fin gestion du clic (unifiée ci-dessus)
  });
})();

// Positionnement aléatoire pour les boutons .level1
(function(){
  function placeLevel1Randomly(){
    var buttons = document.querySelectorAll('button.level1');
    if(!buttons || buttons.length === 0) return;
    // Calculer zone utilisable: éviter la nav fixe à gauche (200px)
    var leftOffset = 220; // laisse marge pour la nav
    var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
    buttons.forEach(function(btn){
      // ne pas repositionner si déjà placé (stabilité après découverte)
      if(btn.dataset.placed === 'true') return;
  // rendre positionnement fixed pour rester dans la fenêtre (éviter hors-champ lors du scroll)
  btn.style.position = 'fixed';
      // largeur/hauteur du bouton
      var bw = btn.offsetWidth || 150;
      var bh = btn.offsetHeight || 50;
      // zone aléatoire disponible
      var maxLeft = Math.max(vw - bw - 16, leftOffset + 16);
      var minLeft = leftOffset + 16;
      var maxTop = Math.max(vh - bh - 16, 16);

      // construire les rectangles interdits en coordonnées viewport: nav, header, et éléments décoratifs (ex: .maze-bg)
      function rect(x,y,w,h){ return {left:x, top:y, right:x+w, bottom:y+h}; }
      var forbidden = [];
      // nav (fixe à gauche)
      forbidden.push(rect(0, 0, leftOffset, vh));
      // header si présent
      var header = document.querySelector('.enigmatic-header');
      if(header){
        var hr = header.getBoundingClientRect();
        forbidden.push(rect(hr.left, hr.top, hr.width, hr.height));
      }
      // any decorative elements to avoid (e.g. .maze-bg)
      var decos = document.querySelectorAll('.maze-bg, .header-bg-puzzle');
      decos.forEach(function(d){
        var dr = d.getBoundingClientRect();
        forbidden.push(rect(dr.left, dr.top, dr.width, dr.height));
      });

      function intersects(r1, r2){
        return !(r2.left >= r1.right || r2.right <= r1.left || r2.top >= r1.bottom || r2.bottom <= r1.top);
      }

      // essayer plusieurs fois pour trouver une position qui n'intersecte pas les zones interdites
      var attempts = 0;
      var placed = false;
      while(attempts < 60 && !placed){
        attempts++;
        var left = Math.floor(Math.random() * (maxLeft - minLeft + 1)) + minLeft;
        var top = Math.floor(Math.random() * (maxTop - 16 + 1)) + 16;
        var candidate = rect(left, top, bw, bh);
        var bad = forbidden.some(function(f){ return intersects(f, candidate); });
        if(!bad){
          btn.style.left = left + 'px';
          btn.style.top = top + 'px';
            btn.style.zIndex = 200; // au-dessus du fond et des zones de garde
            btn.style.pointerEvents = 'auto';
            btn.style.cursor = 'pointer';
          placed = true;
        }
      }
      // si pas trouvé après essais, placer de façon fallback (ancienne méthode)
      if(!placed){
        var leftFb = Math.floor(Math.random() * (maxLeft - minLeft + 1)) + minLeft;
        var topFb = Math.floor(Math.random() * (maxTop - 16 + 1)) + 16;
  btn.style.left = leftFb + 'px';
  btn.style.top = topFb + 'px';
  btn.style.zIndex = 200;
  btn.style.pointerEvents = 'auto';
  btn.style.cursor = 'pointer';
      }
      // marquer comme placé pour éviter repositionnements automatiques
      btn.dataset.placed = 'true';
    });
  }
  // expose for manual triggering (keyboard shortcut) and for tests
  window.placeLevel1Randomly = placeLevel1Randomly;
  // If the DOM is already parsed (script loaded late), call immediately, otherwise wait for DOMContentLoaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', placeLevel1Randomly);
  } else {
    // DOM already ready
    setTimeout(placeLevel1Randomly, 0);
  }
  window.addEventListener('resize', function(){
    // repositionner légèrement après redimensionnement
    setTimeout(placeLevel1Randomly, 120);
  });
})();

// Raccourcis clavier: Ctrl+Shift+R => repositionner; Ctrl+Shift+D => debug outline
(function(){
  function repositionAll(){
    // effacer le flag placed pour forcer repositionnement
    document.querySelectorAll('button.level1').forEach(function(b){ delete b.dataset.placed; });
    // appeler la fonction principale
    var ev = new Event('resize'); window.dispatchEvent(ev); // déclenche le repositionnement via listener
    // appeler directement aussi
    try{ window.placeLevel1Randomly && window.placeLevel1Randomly(); }catch(e){}
  }

  // debug outline bref
  function flashDebug(){
    document.querySelectorAll('button.level1').forEach(function(b){
      b.style.outline = '3px solid rgba(255,0,0,0.85)';
    });
    setTimeout(function(){
      document.querySelectorAll('button.level1').forEach(function(b){ b.style.outline = ''; });
    }, 800);
  }

  document.addEventListener('keydown', function(e){
    if(e.key === 'R' && e.ctrlKey && e.shiftKey){
      e.preventDefault(); repositionAll();
    }
    if(e.key === 'D' && e.ctrlKey && e.shiftKey){
      e.preventDefault(); flashDebug();
    }
  });
})();