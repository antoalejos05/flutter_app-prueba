<?php
require 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;
// Inicializar Firestore
$firestore = new FirestoreClient([
    'projectId' => 'flutter-app-vbtecnologi'
]);

// Ejemplo de consulta a Firestore
$collection = $firestore->collection('users');
$documents = $collection->documents();

foreach ($documents as $document) {
    if ($document->exists()) {
        printf('Document data: %s' . PHP_EOL, $document->data());
    } else {
        printf('Document %s does not exist' . PHP_EOL, $snapshot->id());
    }
}
