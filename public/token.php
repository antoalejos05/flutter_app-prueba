<?php
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Auth;

$auth = $firebase->getAuth();
$signInResult = $auth->signInWithEmailAndPassword('user@example.com', 'password');
$idToken = $signInResult->idToken();
?>