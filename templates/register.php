<main>
<?php
require("./inc/dp.php");
?>
<form class="m-5" action="#">
  <div class="mb-3">
    <label for="firstname" class="form-label">Prénom</label>
    <input type="text" class="form-control" id="firstname" name="firstname">
    <label for="lastname" class="form-label">Nom</label>
    <input type="text" class="form-control" id="lastname" name="lastname">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// var_dump($_GET);
$erreur=[];
$message=[];
// test prenom
if(isset($_GET['firstname']) && preg_match('/[a-z]+$/', $_GET['firstname'])){
    array_push($message, 'ok pour le prénom');
}else{
    array_push($erreur, 'Le prénom n\'est pas valide');
}
// test nom
if(isset($_GET['lastname']) && preg_match('/[a-z]+$/', $_GET['lastname'])){
    array_push($message, 'ok pour le nom');
}else{
    array_push($erreur, 'Le nom n\'est pas valide');
}
// test email
if(isset($_GET['email']) && preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $_GET['email'])){
    array_push($message, 'ok pour l\'email');
}else{
    array_push($erreur, 'L\'email n\'est pas valide');
}
// test password
if(isset($_GET['password']) && preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@!#\?])(?=.*[a-zA-Z]).{8,}$/', $_GET['password'])){
    array_push($message, 'ok pour le mdp');
}else{
    array_push($erreur, 'Le mdp n\'est pas valide');
}
// var_dump($message);
// var_dump($erreur);

if($erreur==[]){
    $encrypted_password=hash('sha512', $_GET['password']);
    $request=$pdo->prepare("INSERT INTO user (prenom, nom, email, password) VALUES (?, ?, ?, ?);");
    $request->execute([$_GET['firstname'], $_GET['lastname'], $_GET['email'], $encrypted_password]);
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