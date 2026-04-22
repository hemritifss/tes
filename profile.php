<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniClubs - Profil</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap"
    rel="stylesheet" />

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    rel="stylesheet" />

  <link rel="stylesheet" href="styleprofile.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand brand" href="index.html">Uni<span>Clubs</span></a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.html">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clubs.html">Clubs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="event.html">Événements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.html">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.html">Déconnexion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-5">
    <div class="container">
      <!-- HERO -->
      <section class="profile-hero p-4 mb-4">
        <div class="row align-items-center g-4">
          <div class="col-md-auto text-center">
            <div class="profile-avatar mx-auto">AM</div>
          </div>

          <div class="col">
            <span class="badge badge-accent mb-3">Mon Profil</span>
            <h1 class="page-title mb-2">Ikram Bali</h1>
            <p class="hero-mail mb-1">Ikram.Bali@universite.tn</p>
            <p class="hero-sub mb-0">
              Étudiante en Génie Informatique - 2ème année
            </p>
          </div>

          <div class="col-lg-auto ms-lg-auto">
            <div class="row g-4 text-center profile-stats">
              <div class="col-4">
                <div class="stat-number">3</div>
                <div class="stat-text">Clubs</div>
              </div>
              <div class="col-4">
                <div class="stat-number">7</div>
                <div class="stat-text">Événements</div>
              </div>
              <div class="col-4">
                <div class="stat-number">24</div>
                <div class="stat-text">Activités</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="row g-4">
        <div class="col-lg-8">
          <div class="card profile-card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 p-lg-5">
              <h2 class="section-title mb-4">
                <i class="bi bi-pencil-fill me-2 icon-accent"></i>
                Modifier mon profil
              </h2>

              <form action="profilepdo.php" method="POST">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Prénom</label>
                    <input
                      type="text"
                      name="prenom"
                      class="form-control"
                      value="<?php echo $data['prenom']; ?>" />
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Nom</label>
                    <input
                      type="text"
                      name="nom"
                      class="form-control"
                      value="<?php echo $data['nom']; ?>" />
                    />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Adresse email</label>
                    <input
                      type="email"
                      name="email"
                      class="form-control"
                      value="<?php echo $data['nom']; ?>" />
                    />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Filière / Département</label>
                    <input
                      type="text"
                      name="filiere"
                      class="form-control"
                      value="Génie Informatique - 2ème année" />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="4">
Passionné de technologie et d'intelligence artificielle. Actif dans plusieurs clubs universitaires et toujours prêt pour de nouveaux défis.</textarea>
                  </div>
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-accent px-4">
                    Enregistrer les modifications
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="card profile-card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-lg-5">
              <h2 class="section-title mb-4">
                <i class="bi bi-lock-fill me-2 text-warning"></i>
                Changer le mot de passe
              </h2>

              <form action="password_update.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Mot de passe actuel</label>
                  <input
                    type="password"
                    name="old_password"
                    class="form-control"
                    placeholder="••••••••" />
                </div>

                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input
                      type="password"
                      name="new_password"
                      class="form-control"
                      placeholder="••••••••" />
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Confirmer</label>
                    <input
                      type="password"
                      name="confirm_password"
                      class="form-control"
                      placeholder="••••••••" />
                  </div>
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-dark px-4">
                    Mettre à jour
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card profile-card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
              <h3 class="side-title mb-4">
                <i class="bi bi-mortarboard-fill me-2 icon-accent"></i>
                Mes Clubs
              </h3>

              <div class="club-item">
                <div class="club-icon">💻</div>
                <div class="flex-grow-1">
                  <div class="club-name">Club Informatique</div>
                  <div class="club-sub">Membre depuis Jan 2024</div>
                </div>
                <span class="status-pill active-pill">Actif</span>
              </div>

              <div class="club-item">
                <div class="club-icon">🎨</div>
                <div class="flex-grow-1">
                  <div class="club-name">Club Arts & Culture</div>
                  <div class="club-sub">Membre depuis Fév 2024</div>
                </div>
                <span class="status-pill active-pill">Actif</span>
              </div>

              <div class="club-item mb-0">
                <div class="club-icon">🔬</div>
                <div class="flex-grow-1">
                  <div class="club-name">Club Sciences</div>
                  <div class="club-sub">Demande en cours...</div>
                </div>
                <span class="status-pill wait-pill">En attente</span>
              </div>
            </div>
          </div>

          <div class="card profile-card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
              <h3 class="side-title mb-4">
                <i class="bi bi-clock-history me-2 icon-accent"></i>
                Activité récente
              </h3>

              <div class="activity-item">
                <span class="dot blue"></span>
                <div>
                  <div class="activity-main">
                    Inscrit à Hackathon National 2024
                  </div>
                  <div class="activity-sub">Il y a 2 heures</div>
                </div>
              </div>

              <div class="activity-item">
                <span class="dot green"></span>
                <div>
                  <div class="activity-main">
                    Rejoint le Club Arts & Culture
                  </div>
                  <div class="activity-sub">Il y a 3 jours</div>
                </div>
              </div>

              <div class="activity-item mb-0 border-0 pb-0">
                <span class="dot orange"></span>
                <div>
                  <div class="activity-main">
                    Demande envoyée au Club Sciences
                  </div>
                  <div class="activity-sub">Il y a 4 jours</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>