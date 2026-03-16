<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->get('/alunni', "AlunniController:index");
$app->get('/alunni/{id}', "AlunniController:show");
$app->post('/alunni', "AlunniController:create");
$app->put('/alunni/{id}', "AlunniController:update");
$app->delete('/alunni/{id}', "AlunniController:destroy");

$app->get('/alunni/{idAl}/certificazioni', "AlunniController:indexCertificazioni");
$app->get('/alunni/{idAl}/certificazioni/{idC}', "AlunniController:showCertificazioni");
$app->post('/alunni/{idAl}/certificazioni', "AlunniController:createCertificazioni");
$app->put('/alunni/{idAl}/certificazioni/{idC}', "AlunniController:updateCertificazioni");
$app->delete('/alunni/{idAl}/certificazioni{idC}', "AlunniController:destroyCertificazioni");

$app->run();
