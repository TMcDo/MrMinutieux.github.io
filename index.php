<?php
// --- CONFIGURATION ---
$site_title = 'Monsieur Minutieux';
$pages_dir = 'pages';

// --- LOGIQUE DE NAVIGATION ---
// Scanne le dossier 'pages' pour trouver les fichiers .php
$pages = glob($pages_dir . '/*.php');

// Détermine la page à afficher
// Si le paramètre 'page' n'est pas dans l'URL, on affiche 'accueil' par défaut
$current_page_name = isset($_GET['page']) ? $_GET['page'] : 'accueil';
$current_page_path = $pages_dir . '/' . $current_page_name . '.php';

// Sécurité : on vérifie que le fichier demandé existe bien avant de l'inclure
if (!file_exists($current_page_path)) {
    // Si la page n'existe pas, on affiche la page d'accueil
    $current_page_name = 'accueil';
    $current_page_path = $pages_dir . '/accueil.php';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($current_page_name) . ' | ' . $site_title; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="site-container">
        <header class="site-header">
            <a href="index.php" class="logo"><?php echo $site_title; ?></a>
            <nav class="site-nav">
                <ul>
                    <?php
                    // Boucle pour créer les liens de navigation automatiquement
                    foreach ($pages as $page) {
                        $page_name = basename($page, '.php');
                        $class = ($page_name == $current_page_name) ? 'active' : '';
                        echo '<li><a href="?page=' . $page_name . '" class="' . $class . '">' . ucfirst($page_name) . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </header>

        <main class="site-content">
            <?php
            // Inclusion du contenu de la page demandée
            include($current_page_path);
            ?>
        </main>

        <footer class="site-footer">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $site_title; ?>. Tous droits réservés.</p>
        </footer>
    </div>

</body>
</html>