<?php
// ici on informe le chemin de la variable
$filename = __DIR__ . "/data/todos.json";
// ici on sécurise en filtrant 
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);
// on declare la valeur id si elle est renseignée
$id = $_GET['id'] ?? '';

if ($id) {
  $data = file_get_contents($filename);
  $todos = json_decode($data, true) ?? [];

  if (count($todos)) {
    // on récupère l'index en cherchant l'id dans un tableau en colonne
    $todoIndex = (int)array_search($id, array_column($todos, 'id'));
    $todos[$todoIndex]['done'] = !$todos[$todoIndex]['done'];
    file_put_contents($filename, json_encode($todos));
  }
}
header('location:index.php');
