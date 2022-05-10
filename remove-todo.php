<?php
// ici on informe le chemin de la variable
$filename = __DIR__ . "/data/todos.json";
$_GET = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);
// on declare la valeur id si elle est renseignée
$id = $_GET['id'] ?? '';

if ('id') {
  $data = file_get_contents($filename);
  $todos = json_decode($data, true) ?? [];
  if (count($todos)) {
    $todoIndex = array_search($id, array_column($todos, 'id'));
    array_splice($todos, $todoIndex, 1);
    file_put_contents($filename, json_encode($todos));
  }
}
header('location:index.php');
