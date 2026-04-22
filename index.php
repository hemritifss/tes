<?php
require_once 'actions/auth_check.php';
require_once 'actions/connexion.php';

$page_title = "UniClubs — Plateforme de Gestion de Clubs Universitaires";
$page_css = "css/styleindex.css";

// Statistiques
$nb_clubs = $cnx->query("SELECT COUNT(*) as total FROM clubs")->fetch()['total'];
$nb_users = $cnx->query("SELECT COUNT(*) as total FROM users")->fetch()['total'];
$nb_events = $cnx->query("SELECT COUNT(*) as total FROM evenements")->fetch()['total'];

// Clubs à la une
$latest_clubs = $cnx->query("SELECT * FROM clubs ORDER BY created_at DESC LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);

// Événements à venir
$upcoming_events = $cnx->query("
    SELECT e.*, c.nom as club_nom, c.emoji 
    FROM evenements e 
    JOIN clubs c ON e.club_id = c.id 
    WHERE e.date_debut >= NOW() 
    ORDER BY e.date_debut ASC 
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<!-- Close the container and main opened by header.php so we can have full-width sections -->
</div></main>

<!-- HERO SECTION -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  
  <div class="container position-relative z-1 text-center">
    <div class="index-badge mx-auto" data-reveal>
      <div class="badge-dot"></div>
      La nouvelle référence universitaire
    </div>
    
    <h1 class="hero-title display-3 fw-bold mb-4" data-reveal>
      La vie étudiante,<br>
      <span class="grad">réinventée</span>
    </h1>
    
    <p class="hero-sub mx-auto mb-5" data-reveal>
      Rejoignez des clubs, participez aux événements, gérez vos activités étudiantes. 
      Tout ce dont vous avez besoin pour une vie universitaire épanouie sur une seule plateforme premium.
    </p>

    <div class="hero-actions" data-reveal>
      <a href="<?= isset($_SESSION['user_id']) ? ($is_admin ? 'pages/admin.php' : 'pages/dashboard.php') : 'pages/login.php' ?>" class="btn btn-accent btn-lg px-5 py-3 rounded-pill shadow-lg">Commencer maintenant &rarr;</a>
      <a href="pages/clubs.php" class="btn btn-secondary-ghost btn-lg px-5 py-3 rounded-pill">Explorer les clubs</a>
    </div>

    <!-- Stats -->
    <div class="hero-stats d-flex justify-content-center flex-wrap gap-4 mt-5 pt-4" data-reveal>
      <div class="stat-box glass-card p-4 rounded-4 text-center">
        <div class="stat-number grad-text" data-counter="<?= $nb_clubs ?>">0</div>
        <div class="stat-label text-muted small fw-bold text-uppercase mt-2">Clubs Actifs</div>
      </div>
      <div class="stat-box glass-card p-4 rounded-4 text-center">
        <div class="stat-number grad-text" data-counter="<?= $nb_users ?>" data-suffix="+">0</div>
        <div class="stat-label text-muted small fw-bold text-uppercase mt-2">Étudiants Inscrits</div>
      </div>
      <div class="stat-box glass-card p-4 rounded-4 text-center">
        <div class="stat-number grad-text" data-counter="<?= $nb_events ?>">0</div>
        <div class="stat-label text-muted small fw-bold text-uppercase mt-2">Événements Organisés</div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section py-5 my-5">
  <div class="container text-center">
    <div class="section-label mb-2" data-reveal>Processus</div>
    <h2 class="section-title h1 mb-3" data-reveal>Comment ça marche ?</h2>
    <p class="text-muted mx-auto mb-5" style="max-width: 600px;" data-reveal>
      Une expérience fluide conçue pour vous connecter instantanément à la vie de campus.
    </p>

    <div class="row g-4 position-relative">
      <!-- Ligne connectrice sur desktop -->
      <div class="d-none d-lg-block position-absolute top-50 start-50 translate-middle w-75" style="height: 2px; background: var(--border); z-index: 0;"></div>

      <div class="col-lg-4 z-1" data-reveal>
        <div class="step-card glass-card p-5 h-100 rounded-4 text-center position-relative">
          <div class="step-number bg-accent text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800; border: 4px solid var(--bg);">1</div>
          <h3 class="h4 fw-bold">Découvrez</h3>
          <p class="text-muted small mt-3">Explorez notre catalogue riche de clubs culturels, scientifiques et sportifs. Trouvez la communauté qui partage vos passions.</p>
        </div>
      </div>
      <div class="col-lg-4 z-1" data-reveal>
        <div class="step-card glass-card p-5 h-100 rounded-4 text-center position-relative">
          <div class="step-number bg-accent text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800; border: 4px solid var(--bg);">2</div>
          <h3 class="h4 fw-bold">Rejoignez</h3>
          <p class="text-muted small mt-3">Envoyez votre demande d'adhésion en un clic. Gérez vos statuts et interagissez avec les administrateurs directement.</p>
        </div>
      </div>
      <div class="col-lg-4 z-1" data-reveal>
        <div class="step-card glass-card p-5 h-100 rounded-4 text-center position-relative">
          <div class="step-number bg-accent text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: 800; border: 4px solid var(--bg);">3</div>
          <h3 class="h4 fw-bold">Participez</h3>
          <p class="text-muted small mt-3">Inscrivez-vous aux événements exclusifs, suivez le calendrier et devenez un membre actif de la vie universitaire.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section py-5 bg-surface2">
  <div class="container text-center">
    <div class="section-label mb-2" data-reveal>Fonctionnalités</div>
    <h2 class="section-title h1 mb-3" data-reveal>Tout ce qu'il vous faut</h2>
    <p class="text-muted mx-auto mb-5" style="max-width: 600px;" data-reveal>
      Une plateforme puissante offrant tous les outils nécessaires aux étudiants et aux responsables de clubs.
    </p>

    <div class="row g-4 text-start">
      <div class="col-md-6 col-lg-4" data-reveal>
        <div class="feature-card glass-card p-4 h-100 rounded-4">
          <div class="feature-icon-box bg-soft-blue mb-4"><i class="bi bi-people-fill text-primary"></i></div>
          <h3 class="h5 fw-bold">Gestion des membres</h3>
          <p class="text-muted small mb-0">Rejoignez des clubs, gérez vos adhésions et suivez vos activités depuis votre tableau de bord personnel.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-reveal>
        <div class="feature-card glass-card p-4 h-100 rounded-4">
          <div class="feature-icon-box bg-soft-cyan mb-4"><i class="bi bi-calendar-event-fill text-info"></i></div>
          <h3 class="h5 fw-bold">Événements & Activités</h3>
          <p class="text-muted small mb-0">Créez, modifiez et inscrivez-vous aux événements organisés par les différents clubs de l'université.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4" data-reveal>
        <div class="feature-card glass-card p-4 h-100 rounded-4">
          <div class="feature-icon-box bg-soft-purple mb-4"><i class="bi bi-shield-check text-purple"></i></div>
          <h3 class="h5 fw-bold">Espace Administrateur</h3>
          <p class="text-muted small mb-0">Les responsables disposent d'outils avancés pour gérer les validations, les membres et les événements.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- UPCOMING EVENTS (NEW) -->
<section class="section py-5 my-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-5" data-reveal>
      <div>
        <div class="section-label mb-2">Agenda</div>
        <h2 class="section-title h1 mb-0">Événements à Venir</h2>
      </div>
      <a href="pages/events.php" class="btn btn-secondary-ghost d-none d-md-inline-flex">Voir tout l'agenda</a>
    </div>

    <div class="row g-4">
      <?php if (count($upcoming_events) > 0): ?>
        <?php foreach($upcoming_events as $evt): 
          $d = new DateTime($evt['date_debut']);
        ?>
          <div class="col-lg-4 col-md-6" data-reveal>
            <div class="event-card glass-card h-100 rounded-4 overflow-hidden position-relative group">
              <div class="event-img-placeholder d-flex align-items-center justify-content-center bg-surface3" style="height: 160px; font-size: 3rem;">
                <?= htmlspecialchars($evt['emoji']) ?>
              </div>
              <div class="event-date-badge position-absolute top-0 end-0 m-3 bg-surface text-center rounded-3 shadow-sm border p-2" style="min-width: 60px;">
                <div class="fw-bold h4 mb-0 text-accent"><?= $d->format('d') ?></div>
                <div class="small text-uppercase text-muted" style="font-size: 0.7rem;"><?= $d->format('M') ?></div>
              </div>
              <div class="p-4">
                <div class="badge pill-blue mb-3"><?= htmlspecialchars($evt['club_nom']) ?></div>
                <h3 class="h5 fw-bold mb-2"><?= htmlspecialchars($evt['titre']) ?></h3>
                <p class="text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                  <?= htmlspecialchars($evt['description']) ?>
                </p>
                <div class="d-flex align-items-center gap-2 text-muted small mt-auto">
                  <i class="bi bi-geo-alt-fill text-accent"></i> <?= htmlspecialchars($evt['lieu']) ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted py-5 glass-card rounded-4">
          <i class="bi bi-calendar-x fs-1 mb-3 d-block opacity-50"></i>
          Aucun événement prévu pour le moment.
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CLUBS SHOWCASE -->
<section class="section py-5 bg-surface2">
  <div class="container text-center">
    <div class="section-label mb-2" data-reveal>Découverte</div>
    <h2 class="section-title h1 mb-5" data-reveal>Clubs à la une</h2>

    <div class="row g-4 text-start">
      <?php foreach($latest_clubs as $club): ?>
        <div class="col-lg-4 col-md-6" data-reveal>
          <div class="club-showcase-card glass-card p-4 rounded-4 h-100 d-flex flex-column transition-all">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="club-avatar rounded-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;font-size:1.5rem;background:rgba(59,130,246,0.1);">
                <?= htmlspecialchars($club['emoji']) ?>
              </div>
              <div>
                <h3 class="h6 fw-bold mb-1"><?= htmlspecialchars($club['nom']) ?></h3>
                <span class="badge" style="background:rgba(59,130,246,0.1);color:#60A5FA;border:1px solid rgba(59,130,246,0.2);"><?= htmlspecialchars(ucfirst($club['categorie'])) ?></span>
              </div>
            </div>
            <p class="text-muted small mb-4 flex-grow-1">
              <?= htmlspecialchars(strlen($club['description']) > 100 ? substr($club['description'], 0, 100) . '...' : $club['description']) ?>
            </p>
            <a href="pages/club_details.php?id=<?= $club['id'] ?>" class="stretched-link text-accent fw-bold small text-decoration-none d-flex align-items-center gap-1">
              Voir le club <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <div class="mt-5" data-reveal>
      <a href="pages/clubs.php" class="btn btn-outline-primary rounded-pill px-4">Explorer tous les clubs</a>
    </div>
  </div>
</section>

<!-- TESTIMONIALS (NEW) -->
<section class="section py-5 my-5">
  <div class="container text-center">
    <div class="section-label mb-2" data-reveal>Témoignages</div>
    <h2 class="section-title h1 mb-5" data-reveal>Ce qu'ils en pensent</h2>

    <div class="row g-4 text-start">
      <div class="col-lg-4" data-reveal>
        <div class="glass-card p-4 rounded-4 position-relative">
          <i class="bi bi-quote position-absolute top-0 end-0 m-3 text-accent opacity-25" style="font-size: 3rem; line-height: 1;"></i>
          <p class="text-muted small fst-italic mb-4 position-relative z-1">"Grâce à UniClubs, j'ai pu découvrir le club CyberShield et m'inscrire facilement à leurs événements. L'interface est incroyablement fluide et intuitive !"</p>
          <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm bg-accent text-white">OB</div>
            <div>
              <div class="fw-bold small text-text">Omar Benali</div>
              <div class="text-muted" style="font-size: 0.75rem;">Étudiant en Cybersécurité</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4" data-reveal>
        <div class="glass-card p-4 rounded-4 position-relative">
          <i class="bi bi-quote position-absolute top-0 end-0 m-3 text-accent opacity-25" style="font-size: 3rem; line-height: 1;"></i>
          <p class="text-muted small fst-italic mb-4 position-relative z-1">"En tant que responsable de CodeCraft, la gestion des membres et la création d'événements n'a jamais été aussi simple. Un outil indispensable."</p>
          <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm bg-accent text-white">IB</div>
            <div>
              <div class="fw-bold small text-text">Ikram Bali</div>
              <div class="text-muted" style="font-size: 0.75rem;">Admin - CodeCraft</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4" data-reveal>
        <div class="glass-card p-4 rounded-4 position-relative">
          <i class="bi bi-quote position-absolute top-0 end-0 m-3 text-accent opacity-25" style="font-size: 3rem; line-height: 1;"></i>
          <p class="text-muted small fst-italic mb-4 position-relative z-1">"L'agenda centralisé m'aide à ne rater aucune activité sportive ou culturelle. J'adore le nouveau thème sombre de la plateforme !"</p>
          <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm bg-accent text-white">SI</div>
            <div>
              <div class="fw-bold small text-text">Sara Idrissi</div>
              <div class="text-muted" style="font-size: 0.75rem;">Étudiante en Génie Info</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ (NEW) -->
<section class="section py-5 bg-surface2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-5 mb-lg-0" data-reveal>
        <div class="section-label mb-2">Support</div>
        <h2 class="section-title h1 mb-4">Foire Aux Questions</h2>
        <p class="text-muted mb-4">Vous avez des questions sur le fonctionnement d'UniClubs ? Nous avons rassemblé les réponses aux questions les plus fréquentes.</p>
        <a href="mailto:support@uniclubs.ma" class="btn btn-secondary-ghost rounded-pill">Contacter le support</a>
      </div>
      <div class="col-lg-7" data-reveal>
        <div class="accordion custom-accordion" id="faqAccordion">
          
          <div class="accordion-item glass-card mb-3 rounded-4 border-0 overflow-hidden">
            <h2 class="accordion-header">
              <button class="accordion-button bg-transparent text-text fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                L'inscription est-elle gratuite ?
              </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-muted small pt-0 border-0">
                Oui, l'inscription à la plateforme UniClubs est totalement gratuite pour tous les étudiants de l'université. La participation à certains événements spécifiques peut parfois demander une contribution, fixée par les clubs.
              </div>
            </div>
          </div>

          <div class="accordion-item glass-card mb-3 rounded-4 border-0 overflow-hidden">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed bg-transparent text-text fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                Puis-je rejoindre plusieurs clubs en même temps ?
              </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-muted small pt-0 border-0">
                Absolument ! Il n'y a aucune limite au nombre de clubs que vous pouvez rejoindre. Nous vous encourageons à explorer différentes activités culturelles, scientifiques et sportives.
              </div>
            </div>
          </div>

          <div class="accordion-item glass-card mb-3 rounded-4 border-0 overflow-hidden">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed bg-transparent text-text fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                Comment puis-je créer un nouveau club ?
              </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-muted small pt-0 border-0">
                Pour créer un nouveau club, vous devez soumettre un dossier à l'administration de la vie étudiante. Une fois validé, un compte "Admin Club" vous sera assigné pour gérer votre espace sur UniClubs.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="section py-5 position-relative overflow-hidden">
  <div class="position-absolute inset-0 z-0 opacity-50" style="background: radial-gradient(circle at center, rgba(59,130,246,0.2) 0%, transparent 60%);"></div>
  <div class="container position-relative z-1 text-center py-5">
    <h2 class="display-5 fw-bold mb-3" data-reveal>Prêt à rejoindre la communauté ?</h2>
    <p class="text-muted mx-auto mb-5" style="max-width: 500px;" data-reveal>
      Créez votre compte gratuitement et commencez à explorer les clubs et événements dès aujourd'hui.
    </p>
    <div data-reveal>
      <a href="<?= isset($_SESSION['user_id']) ? ($is_admin ? 'pages/admin.php' : 'pages/dashboard.php') : 'pages/login.php' ?>" class="btn btn-accent btn-lg px-5 py-3 rounded-pill shadow-lg">Créer mon compte gratuitement &rarr;</a>
    </div>
  </div>
</section>

<!-- Reopen the container and main so footer.php can close them safely -->
<main><div class="container d-none">

<?php require_once 'includes/footer.php'; ?>
