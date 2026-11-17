<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donner une appréciation — Faso Ri Nondo</title>
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
            <li class="nav-item"><a class="nav-link" href="recettes.php">Les recettes</a></li>
            <li class="nav-item"><a class="btn btn-nav ms-lg-2" href="recette.php">Partager une recette</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="container page-wrap">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
          <div class="page-intro">
            <p class="eyebrow text-brand">Votre avis compte</p>
            <h1>Que pensez-vous de nos services&nbsp;?</h1>
            <p>Un commentaire nous aide à améliorer Faso Ri Nondo et à faire vivre les recettes de nos régions.</p>
          </div>
          <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
            <div class="alert alert-success" role="status">Merci pour votre appréciation&nbsp;! Votre avis a bien été enregistré.</div>
          <?php endif; ?>
          <form class="form-card" method="post" action="appreciation_cible.php">
            <div class="mb-4">
              <label for="nom" class="form-label">Votre nom et prénom(s)</label>
              <input type="text" class="form-control form-control-lg" id="nom" name="nom" maxlength="150" autocomplete="name" required>
            </div>
            <div class="mb-4">
              <label for="numero" class="form-label">Votre numéro de téléphone</label>
              <input type="tel" class="form-control form-control-lg" id="numero" name="numero" maxlength="30" autocomplete="tel" required>
              <div class="form-text">Votre numéro sert uniquement au suivi de votre retour.</div>
            </div>
            <div class="mb-4">
              <label for="commentaire" class="form-label">Votre commentaire</label>
              <textarea class="form-control" id="commentaire" name="commentaire" rows="7" maxlength="5000" placeholder="Dites-nous ce que vous avez aimé ou ce que nous pouvons améliorer…" required></textarea>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-sm-center">
              <a class="link-secondary text-decoration-none" href="projet.html">Retour à l’accueil</a>
              <button type="submit" class="btn btn-brand btn-lg">Envoyer mon appréciation</button>
            </div>
          </form>
        </div>
      </div>
    </main>

    <footer class="site-footer">
      <div class="container d-flex flex-column flex-sm-row justify-content-between gap-2">
        <span>Faso Ri Nondo — Les saveurs de nos régions</span>
        <a href="recettes.php">Consulter les recettes partagées</a>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
