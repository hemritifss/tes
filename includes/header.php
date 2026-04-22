<?php
// ============================================
// Header commun à toutes les pages
// ============================================

// Vérifier si un titre de page a été défini, sinon mettre un titre par défaut
if (!isset($page_title)) {
    $page_title = "UniClubs";
}
if (!isset($active_page)) {
    $active_page = "";
}

// Vérifier si l'utilisateur est connecté (grâce à la session)
$logged_in = isset($_SESSION['user_id']);

// Si connecté, récupérer le rôle
if ($logged_in) {
    $is_admin = ($_SESSION['role'] == 'admin_club');
    $is_student = ($_SESSION['role'] == 'etudiant');
    $initials = strtoupper(substr($_SESSION['prenom'], 0, 1) . substr($_SESSION['nom'], 0, 1));
} else {
    $is_admin = false;
    $is_student = false;
    $initials = '';
}

// Base URL (dynamic depending on whether we are in root or subdirectories)
$is_subfolder = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false || strpos($_SERVER['SCRIPT_NAME'], '/auth/') !== false || strpos($_SERVER['SCRIPT_NAME'], '/actions/') !== false;
$base_url = $is_subfolder ? '../' : './';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="UniClubs - Plateforme de gestion des clubs universitaires" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Global Design System (loaded BEFORE page CSS) -->
    <link rel="stylesheet" href="<?= $base_url ?>css/global.css?v=<?= time() ?>" />

    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="<?= $base_url . htmlspecialchars($page_css) ?>?v=<?= time() ?>" />
    <?php endif; ?>

    <!-- Theme Initialization Script (Prevent Flash) -->
    <script>
        (function () {
            var theme = localStorage.getItem('theme');
            if (theme === 'light' || theme === 'dark') {
                document.documentElement.setAttribute('data-theme', theme);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand brand" href="<?php echo $base_url; ?>index.php">Uni<span>Clubs</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <?php if (!$logged_in): ?>
                        <!-- Menu pour les visiteurs (non connectés) -->
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'index' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>index.php">
                                <i class="bi bi-house-door me-1"></i>Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'clubs' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/clubs.php">
                                <i class="bi bi-people me-1"></i>Clubs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'events' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/events.php">
                                <i class="bi bi-calendar-event me-1"></i>Événements
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-accent btn-sm px-3" href="<?php echo $base_url; ?>pages/login.php">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                            </a>
                        </li>
                    <?php elseif ($is_student): ?>
                        <!-- Menu pour les étudiants -->
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'dashboard' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/dashboard.php">
                                <i class="bi bi-grid-1x2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'clubs' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/clubs.php">
                                <i class="bi bi-people me-1"></i>Clubs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'events' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/events.php">
                                <i class="bi bi-calendar-event me-1"></i>Événements
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'profile' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/profile.php">
                                <i class="bi bi-person me-1"></i>Profil
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2 d-flex align-items-center gap-2">
                            <span class="avatar-sm"><?= $initials ?></span>
                            <a class="nav-link p-0" href="<?php echo $base_url; ?>auth/logout.php" title="Déconnexion">
                                <i class="bi bi-box-arrow-right"></i>
                            </a>
                        </li>
                    <?php elseif ($is_admin): ?>
                        <!-- Menu pour les administrateurs de club -->
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'dashboard' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/dashboard.php">
                                <i class="bi bi-grid-1x2 me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'clubs' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/clubs.php">
                                <i class="bi bi-people me-1"></i>Clubs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'events' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/events.php">
                                <i class="bi bi-calendar-event me-1"></i>Événements
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'admin' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/admin.php">
                                <i class="bi bi-shield-lock me-1"></i>Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_page == 'profile' ? 'active' : '' ?>"
                                href="<?php echo $base_url; ?>pages/profile.php">
                                <i class="bi bi-person me-1"></i>Profil
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2 d-flex align-items-center gap-2">
                            <span class="avatar-sm"><?= $initials ?></span>
                            <a class="nav-link p-0" href="<?php echo $base_url; ?>auth/logout.php" title="Déconnexion">
                                <i class="bi bi-box-arrow-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item ms-lg-3 d-flex align-items-center">
                        <button onclick="toggleTheme()"
                            class="btn btn-sm btn-secondary-ghost rounded-circle d-flex align-items-center justify-content-center p-0"
                            style="width:34px;height:34px;border:none!important;" title="Changer de thème">
                            <i id="theme-icon" class="bi bi-moon-stars-fill"
                                style="font-size: 1.1rem; color: var(--accent);"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <?php
            // Afficher un message de succès ou d'erreur (stocké dans la session)
            if (isset($_SESSION['message'])) {
                if ($_SESSION['message_type'] == 'succes') {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['message']) . '</div>';
                } else {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['message']) . '</div>';
                }
                // Supprimer le message après l'avoir affiché
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>