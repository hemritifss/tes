// ============================================
// UniClubs — Clubs Actions JS
// ============================================

// JavaScript pour filtrer les clubs (recherche et catégorie)
window.currentFilter = "tous";

window.setFilter = function(filter, btn) {
    window.currentFilter = filter;
    // Retirer la classe active de tous les boutons
    var btns = document.querySelectorAll(".filter-btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].classList.remove("active", "btn-accent");
        btns[i].classList.add("btn-secondary-ghost");
    }
    // Ajouter la classe active au bouton cliqué
    btn.classList.add("active", "btn-accent");
    btn.classList.remove("btn-secondary-ghost");
    filterClubs();
};

window.filterClubs = function() {
    var q = document.getElementById("searchInput").value.toLowerCase().trim();
    var cards = document.querySelectorAll(".club-item");

    for (var i = 0; i < cards.length; i++) {
        var name = cards[i].querySelector(".club-title").textContent.toLowerCase();
        var cat = cards[i].getAttribute("data-cat");
        var mem = cards[i].getAttribute("data-member");

        // Vérifier si le nom correspond à la recherche
        var matchSearch = name.indexOf(q) !== -1;

        // Vérifier si la catégorie correspond au filtre
        var matchFilter = true;
        if (window.currentFilter == "mes-clubs") {
            matchFilter = mem == "true";
        } else if (window.currentFilter != "tous") {
            matchFilter = cat == window.currentFilter;
        }

        if (matchSearch && matchFilter) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
};
