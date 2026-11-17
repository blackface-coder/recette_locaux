<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: recette.php', true, 303);
    exit;
}

$nom = isset($_POST['nom']) && is_string($_POST['nom']) ? trim($_POST['nom']) : '';
$numero = isset($_POST['numero']) && is_string($_POST['numero']) ? trim($_POST['numero']) : '';
$recette = isset($_POST['recette']) && is_string($_POST['recette']) ? trim($_POST['recette']) : '';

if ($nom === '' || strlen($nom) > 150 || $numero === '' || strlen($numero) > 30 || $recette === '' || strlen($recette) > 10000) {
    http_response_code(422);
    $message = 'Vérifiez les champs : le nom, le téléphone et la recette sont obligatoires. Respectez les longueurs maximales indiquées.';
} else {
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=test;charset=utf8mb4',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
        );
        $requete = $bdd->prepare('INSERT INTO recette (nom, numero, recette) VALUES (:nom, :numero, :recette)');
        $requete->execute(array(':nom' => $nom, ':numero' => $numero, ':recette' => $recette));
        header('Location: recettes.php?success=1', true, 303);
        exit;
    } catch (PDOException $e) {
        error_log('Échec de la soumission d’une recette : ' . $e->getMessage());
        http_response_code(500);
        $message = 'La recette n’a pas pu être enregistrée. Veuillez réessayer plus tard.';
    }
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
    <title>Soumission impossible — Faso Ri Nondo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="site.css">
  </head>
  <body>
    <nav class="navbar navbar-dark site-nav">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="projet.html">
          <img src="logo.png" alt="" width="44" height="44" class="brand-logo">
          <span>Faso Ri Nondo</span>
        </a>
      </div>
    </nav>
    <main class="container page-wrap">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="alert alert-danger" role="alert">
            <h1 class="h4">Soumission impossible</h1>
            <p class="mb-0"><?php echo e($message); ?></p>
          </div>
          <a class="btn btn-brand" href="recette.php">Retour au formulaire</a>
        </div>
      </div>
    </main>
    <footer class="site-footer">
      <div class="container"><a href="projet.html">Retour à l’accueil</a></div>
    </footer>
  </body>
</html>
