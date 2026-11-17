<?php
$erreur = null;
$recettes = array();

try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=test;charset=utf8mb4',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
    );
    $recettes = $bdd->query('SELECT id, nom, recette FROM recette ORDER BY id DESC')->fetchAll();
} catch (PDOException $e) {
    error_log('Impossible de charger les recettes : ' . $e->getMessage());
    http_response_code(500);
    $erreur = 'La liste des recettes est momentanément indisponible. Veuillez réessayer plus tard.';
}

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recettes partagées — Faso Ri Nondo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="site.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark site-nav">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="projet.html">
          <img src="logo.png" alt="" width="44" height="44" class="brand-logo">
          <span>Faso Ri Nondo</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir le menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
            <li class="nav-item"><a class="nav-link" href="projet.html">Accueil</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="recettes.php">Les recettes</a></li>
            <li class="nav-item"><a class="btn btn-nav ms-lg-2" href="recette.php">Partager une recette</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="container page-wrap">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 page-intro">
        <div>
          <p class="eyebrow text-brand">La communauté partage</p>
          <h1>Toutes les recettes</h1>
          <p class="mb-0">Découvrez les recettes transmises par les passionnés de cuisine.</p>
        </div>
        <a class="btn btn-brand" href="recette.php">+ Soumettre une recette</a>
      </div>

      <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
        <div class="alert alert-success" role="status">Votre recette a bien été soumise. Merci de la partager !</div>
      <?php endif; ?>

      <?php if ($erreur !== null): ?>
        <div class="alert alert-danger" role="alert"><?php echo e($erreur); ?></div>
      <?php elseif (count($recettes) === 0): ?>
        <div class="empty-state text-center">
          <h2 class="h4">La première recette est à écrire</h2>
          <p>La liste est encore vide. Partagez votre spécialité avec la communauté.</p>
          <a class="btn btn-brand" href="recette.php">Soumettre la première recette</a>
        </div>
      <?php else: ?>
        <p class="text-secondary mb-4"><?php echo count($recettes); ?> recette<?php echo count($recettes) > 1 ? 's' : ''; ?> partagée<?php echo count($recettes) > 1 ? 's' : ''; ?></p>
        <div class="row g-4">
          <?php foreach ($recettes as $index => $item): ?>
            <div class="col-md-6 col-xl-4">
              <article class="recipe-card h-100">
                <div class="recipe-card-top">
                  <span class="recipe-number">Recette <?php echo count($recettes) - $index; ?></span>
                  <h2><?php echo e($item['nom']); ?></h2>
                </div>
                <div class="recipe-content"><?php echo nl2br(e($item['recette'])); ?></div>
              </article>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </main>

    <footer class="site-footer">
      <div class="container d-flex flex-column flex-sm-row justify-content-between gap-2">
        <span>Faso Ri Nondo — Les saveurs de nos régions</span>
        <a href="projet.html">Retour à l’accueil</a>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
