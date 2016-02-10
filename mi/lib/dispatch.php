<?php

session_start();
# definitely a hack FIXME
require('../../app/models/entry.php');
require('../../app/models/user.php');
require('../../app/models/home.php');
require('../../app/controllers/entries_controller.php');
require('../../app/controllers/users_controller.php');
require('../../app/controllers/homes_controller.php');

function run()
{
    require_once('routes.php');
    $installation_folder = "/\/" . Configure::read('INSTALLATION_FOLDER') . "\//";
    $action_url = preg_replace($installation_folder, '', $_SERVER['REQUEST_URI']);

    $url_parts = explode('/', $action_url);
    $flash = '';

$controller = '';
$action = '';
$params = '';
$primary_key = '';

/*
print_r($url_parts);
print_r($routes);
print_r($action_url);
*/
$route_matched = false;
foreach ($routes as $k => $v) {
    if (preg_match("/\$k/", $action_url)) {
        $controller = $v['controller'];
        $action = $v['action'];
        $primary_key = $v['primary_key'];
        $route_matched = true;
    }
}

if (!$route_matched) {
    $controller = array_shift($url_parts);
    $action = array_shift($url_parts);
    $primary_key = array_shift($url_parts);
    $params = implode("::", $url_parts);
}

    $runThisController = ucfirst($controller) . 'Controller';
    $runThisAction = $action;

    // Guess Model name from controller in URI
    if (substr($controller, -3) == 'ies')
        $runThisModel = str_replace('ies', 'y', ucfirst($controller));
    elseif (substr($controller, -1, 1) == 's')
        $runThisModel = preg_replace("/s$/", "", ucfirst($controller));
    else
        $runThisModel = ucfirst($controller);


    #$model = new $runThisModel();
    $model = $runThisModel;

    $object = Object::singleton($model, $controller, $action, $primary_key, $params);
    $object->$runThisController->$runThisAction();

    // Get debug information to display
    if (Configure::read('DEBUG')) {
        $debug = '<div id="debug_box">Debug Box'
               . '<a href="" id="debug_details_toggle">Show Details</a>'
               . '<div id="debug_details"><ul>'
               . '<li><span class="label">use table: </span><span>'
               . $model->getUseTable() . '</span></li>'
               . '<li><span class="label">run model: </span><span>'
               . $runThisModel . '</span></li>'
               . '<li><span class="label">run controller: </span><span>'
               . $runThisController . '</span></li>'
               . '<li><span class="label">run action: </span><span>'
               . $runThisAction . '</span></li>'
               . '</ul></div></div>';
    } else {
        $debug = '';
    }

    if ($object->$runThisController->getFlash())
        $flash = '<div id="flash_box">' . $object->$runThisController->getFlash() . '</div>';

    // flash piece is hacked together FIXME
    if ($object->$runThisController->getFlashCount() > 0)
        $object->$runThisController->setFlash('');  // reset flash
    else
        $object->$runThisController->increaseFlashCount();

    // debug
    // echo '<pre>' . print_r($object, true) . '</pre>';

    $object->View->display(
        $object->$runThisController->get(),
        $object->$runThisController->getLayout(),
        $flash,
        $debug);

}

if (isset($_GET['do'])) {
    $_GET['do']();
} else {
    run();
}

?>
