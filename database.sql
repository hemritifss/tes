-- =====================================================
-- UniClubs - Database Schema + Sample Data
-- Database: bdd_iit
-- =====================================================

CREATE DATABASE IF NOT EXISTS `bdd_iit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bdd_iit`;

-- =====================================================
-- Drop existing tables (in correct order for FK)
-- =====================================================
DROP TABLE IF EXISTS `inscriptions_evenements`;
DROP TABLE IF EXISTS `evenements`;
DROP TABLE IF EXISTS `membres`;
DROP TABLE IF EXISTS `clubs`;
DROP TABLE IF EXISTS `users`;

-- =====================================================
-- Table: users
-- =====================================================
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `prenom` VARCHAR(100) NOT NULL,
    `nom` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `mot_de_passe` VARCHAR(255) NOT NULL,
    `role` ENUM('etudiant', 'admin_club') NOT NULL DEFAULT 'etudiant',
    `filiere` VARCHAR(255) DEFAULT NULL,
    `bio` TEXT DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table: clubs
-- =====================================================
CREATE TABLE `clubs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `categorie` VARCHAR(100) NOT NULL DEFAULT 'autre',
    `emoji` VARCHAR(10) DEFAULT '📌',
    `couleur_gradient` VARCHAR(255) DEFAULT 'linear-gradient(135deg, #e8f0fc, #c5d8ff)',
    `admin_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`admin_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table: membres (memberships)
-- =====================================================
CREATE TABLE `membres` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `club_id` INT NOT NULL,
    `statut` ENUM('en_attente', 'accepte', 'refuse') NOT NULL DEFAULT 'en_attente',
    `date_demande` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`club_id`) REFERENCES `clubs`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_membership` (`user_id`, `club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table: evenements (events)
-- =====================================================
CREATE TABLE `evenements` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `club_id` INT NOT NULL,
    `lieu` VARCHAR(255) NOT NULL,
    `date_debut` DATETIME NOT NULL,
    `date_fin` DATETIME NOT NULL,
    `max_participants` INT NOT NULL DEFAULT 50,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`club_id`) REFERENCES `clubs`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Table: inscriptions_evenements (event registrations)
-- =====================================================
CREATE TABLE `inscriptions_evenements` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `evenement_id` INT NOT NULL,
    `date_inscription` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`evenement_id`) REFERENCES `evenements`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_registration` (`user_id`, `evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Indexes
-- =====================================================
CREATE INDEX `idx_clubs_admin` ON `clubs`(`admin_id`);
CREATE INDEX `idx_membres_user` ON `membres`(`user_id`);
CREATE INDEX `idx_membres_club` ON `membres`(`club_id`);
CREATE INDEX `idx_membres_statut` ON `membres`(`statut`);
CREATE INDEX `idx_evenements_club` ON `evenements`(`club_id`);
CREATE INDEX `idx_evenements_date` ON `evenements`(`date_debut`);
CREATE INDEX `idx_inscriptions_user` ON `inscriptions_evenements`(`user_id`);
CREATE INDEX `idx_inscriptions_event` ON `inscriptions_evenements`(`evenement_id`);

-- =====================================================
-- SAMPLE DATA
-- Passwords are hashed with password_hash('password123', PASSWORD_DEFAULT)
-- =====================================================

-- Users (password: password123 for all)
INSERT INTO `users` (`prenom`, `nom`, `email`, `mot_de_passe`, `role`, `filiere`, `bio`) VALUES
('Ikram', 'Bali', 'ikram@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin_club', 'Génie Informatique', 'Passionnée de technologie et de leadership étudiant.'),
('Youssef', 'Amrani', 'youssef@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin_club', 'Génie Logiciel', 'Développeur full-stack et organisateur d''événements.'),
('Fatima', 'Zahra', 'fatima@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'Data Science', 'Étudiante curieuse, passionnée par l''IA et le machine learning.'),
('Omar', 'Benali', 'omar@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'Cybersécurité', 'Fan de CTF et de sécurité informatique.'),
('Sara', 'Idrissi', 'sara@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'Génie Informatique', 'Designer UI/UX et développeuse front-end.'),
('Amine', 'Tahiri', 'amine@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'Réseaux & Télécoms', 'Passionné de cloud computing et DevOps.'),
('Hajar', 'Moussaoui', 'hajar@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin_club', 'Génie Logiciel', 'Artiste digitale et responsable du club culturel.'),
('Karim', 'Fassi', 'karim@uni.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'Génie Informatique', 'Joueur compétitif et amateur d''esport.');

-- Clubs
INSERT INTO `clubs` (`nom`, `description`, `categorie`, `emoji`, `couleur_gradient`, `admin_id`) VALUES
('CodeCraft', 'Le club de développement logiciel. Hackathons, workshops et projets collaboratifs pour tous les niveaux.', 'scientifique', '💻', 'linear-gradient(135deg, #1a3a6b, #2d5da8)', 1),
('CyberShield', 'Club de cybersécurité. Capture The Flag, veille sécurité et formations pratiques.', 'scientifique', '🛡️', 'linear-gradient(135deg, #1a4a2e, #2d8a4a)', 2),
('Artify', 'Club culturel et artistique. Photographie, design graphique, expositions et ateliers créatifs.', 'culturel', '🎨', 'linear-gradient(135deg, #6b1a6b, #a82da8)', 7),
('SportZone', 'Club sportif universitaire. Football, basketball, running et événements sportifs inter-universités.', 'sportif', '⚽', 'linear-gradient(135deg, #6b3a1a, #a85d2d)', 1),
('AI Lab', 'Intelligence artificielle et machine learning. Projets de recherche, tutoriels et conférences.', 'scientifique', '🤖', 'linear-gradient(135deg, #0d2744, #1a5276)', 2),
('EcoVert', 'Club de développement durable. Sensibilisation environnementale, projets verts et initiatives campus.', 'autre', '🌿', 'linear-gradient(135deg, #0d4429, #1a8a52)', 7);

-- Membres (memberships)
INSERT INTO `membres` (`user_id`, `club_id`, `statut`, `date_demande`) VALUES
-- CodeCraft members
(3, 1, 'accepte', '2026-01-15 10:00:00'),
(4, 1, 'accepte', '2026-01-20 14:30:00'),
(5, 1, 'accepte', '2026-02-01 09:15:00'),
(6, 1, 'en_attente', '2026-04-18 11:00:00'),
-- CyberShield members
(4, 2, 'accepte', '2026-01-18 16:00:00'),
(6, 2, 'accepte', '2026-02-05 10:45:00'),
(8, 2, 'en_attente', '2026-04-20 09:30:00'),
-- Artify members
(3, 3, 'accepte', '2026-02-10 13:20:00'),
(5, 3, 'accepte', '2026-02-15 11:00:00'),
-- SportZone members
(4, 4, 'accepte', '2026-01-25 15:00:00'),
(6, 4, 'accepte', '2026-02-08 17:30:00'),
(8, 4, 'accepte', '2026-02-12 08:00:00'),
(3, 4, 'en_attente', '2026-04-19 14:00:00'),
-- AI Lab members
(3, 5, 'accepte', '2026-03-01 10:00:00'),
(5, 5, 'accepte', '2026-03-05 12:30:00'),
-- EcoVert members
(5, 6, 'accepte', '2026-03-10 09:00:00'),
(6, 6, 'en_attente', '2026-04-21 16:00:00');

-- Événements (future dates)
INSERT INTO `evenements` (`titre`, `description`, `club_id`, `lieu`, `date_debut`, `date_fin`, `max_participants`) VALUES
('Hackathon Spring 2026', 'Hackathon de 24h pour résoudre des défis tech. Équipes de 3-5 personnes. Prix pour les 3 premières équipes !', 1, 'Amphithéâtre A - Campus Principal', '2026-05-10 09:00:00', '2026-05-11 09:00:00', 60),
('Workshop React & Next.js', 'Atelier pratique sur React 19 et Next.js 15. Apportez vos laptops ! Niveau intermédiaire requis.', 1, 'Salle Info 3 - Bâtiment B', '2026-05-15 14:00:00', '2026-05-15 17:00:00', 30),
('CTF Challenge #4', 'Compétition Capture The Flag interne. Catégories: Web, Crypto, Forensics, Reverse. Tous niveaux bienvenus.', 2, 'Lab Sécurité - Bâtiment C', '2026-05-20 10:00:00', '2026-05-20 18:00:00', 40),
('Conférence Cybersécurité', 'Intervenant invité: Expert en pentesting. Thème: "Sécuriser les apps web modernes en 2026".', 2, 'Amphithéâtre B - Campus Principal', '2026-05-25 15:00:00', '2026-05-25 17:30:00', 100),
('Expo Photo "Perspectives"', 'Exposition des œuvres photographiques des membres. Vernissage avec rafraîchissements.', 3, 'Hall d''exposition - Bâtiment A', '2026-05-18 10:00:00', '2026-05-22 18:00:00', 200),
('Tournoi Inter-Universitaire Football', 'Tournoi de football 7v7 entre 8 universités. Phase de groupes + élimination directe.', 4, 'Terrain de sport - Campus', '2026-06-01 09:00:00', '2026-06-01 18:00:00', 80),
('Séminaire IA Générative', 'Exploration des derniers modèles d''IA générative. Démonstrations live et discussion éthique.', 5, 'Salle de conférence - Bâtiment D', '2026-05-28 14:00:00', '2026-05-28 17:00:00', 50),
('Journée Verte Campus', 'Plantation d''arbres, ateliers recyclage et conférence sur le développement durable.', 6, 'Jardin du Campus', '2026-06-05 09:00:00', '2026-06-05 16:00:00', 120);

-- Inscriptions aux événements
INSERT INTO `inscriptions_evenements` (`user_id`, `evenement_id`, `date_inscription`) VALUES
(3, 1, '2026-04-15 10:00:00'),
(4, 1, '2026-04-16 11:30:00'),
(5, 1, '2026-04-16 14:00:00'),
(6, 1, '2026-04-17 09:00:00'),
(3, 2, '2026-04-18 10:00:00'),
(5, 2, '2026-04-18 12:00:00'),
(4, 3, '2026-04-19 10:00:00'),
(6, 3, '2026-04-19 15:00:00'),
(8, 3, '2026-04-20 08:30:00'),
(3, 5, '2026-04-20 11:00:00'),
(5, 5, '2026-04-21 09:00:00'),
(4, 6, '2026-04-21 14:00:00'),
(8, 6, '2026-04-21 16:00:00'),
(3, 7, '2026-04-22 10:00:00'),
(5, 7, '2026-04-22 11:00:00'),
(5, 8, '2026-04-22 12:00:00'),
(6, 8, '2026-04-22 13:00:00');
