<?php
    include_once('app.php');
    global $app;
    $app = new App();
    $app->redirect();
    $app->head("Inventario de elementos", "Inventario");
    $app->start_session();
    $app->nav();
    $app->footer();

    echo "
        <p>Te has logueado correctamente</p> 
    "
?>