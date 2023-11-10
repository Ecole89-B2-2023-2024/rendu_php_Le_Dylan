<main>
<?php
require("./inc/dp.php");
?>
<form class="m-5" action="#">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre">
    <label for="contenu" class="form-label">Contenu</label>
    <textarea type="text" class="form-control" id="contenu" name="contenu"></textarea>
    <label for="auteur" class="form-label">Auteur</label>
    <input type="text" class="form-control" id="auteur" name="auteur">

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// var_dump($_GET);
$erreur=[];
$message=[];
// test prenom
if(isset($_GET['titre']) && preg_match('/[a-z]+$/', $_GET['titre'])){
    array_push($message, 'ok pour le titre ');
}else{
    array_push($erreur, 'Le nom n\'est pas valide');
}

if(isset($_GET['contenu']) && preg_match('/[a-z]+$/', $_GET['contenu'])){
    array_push($message, 'ok pour le contenu');
}else{
    array_push($erreur, 'Le nom n\'est pas valide');
}
/*
if(isset($_GET['date_de_publication']) && preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $_GET['date_de_publication'])){
    array_push($message, 'ok pour l\'date_de_publication');
}else{
    array_push($erreur, 'Le nom n\'est pas valide');
} */
  // Définir le nouveau fuseau horaire
  date_default_timezone_set('Europe/Paris');
  $date = date('d-m-y h:i:s');
  echo $date;


if(isset($_GET['auteur']) && preg_match('/[a-z]+$/', $_GET['auteur'])){
    array_push($message, 'ok pour auteur');
}else{
    array_push($erreur, 'Le nom n\'est pas valide');
}


// var_dump($message);
// var_dump($erreur);

if($erreur==[]){
    $request=$pdo->prepare("INSERT INTO article (titre, contenu, date_de_publication, auteur) VALUES (?, ?, ?, ?);");
    $request->execute([$_GET['titre'], $_GET['contenu'],$date, $_GET['auteur']]);
}

?>
<ul>
    <?php
    foreach($message as $value){
        echo "<li>".$value."</li>";
    }
    ?>
</ul>
<ul>
    <?php
    foreach($erreur as $item){
        echo "<li>".$item."</li>";
    }
    ?>
</ul>
</main>