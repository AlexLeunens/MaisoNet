<?php
/**
 * Created by PhpStorm.
 * User: cwy
 * Date: 06/01/2019
 * Time: 15:16
 */

define("ROOT", __DIR__);

require ROOT . "\controllers\controller.php";

if (isset($_GET["action"])) {
    $action = htmlspecialchars($_GET["action"]);

    switch ($action) {
        case "see_home":
            seeHome();
            break;
        case "see_login":
            seeLogin();
            break;
        case "see_register":
            seeRegister();
            break;
        case "see_forum":
            seeForum();
            break;
        case "see_userPage":
            seeUserPage();
            break;
        case "see_adminPage":
            seeAdminPage();
            break;

        case "register_request":
            registerRequest();
            break;

        case "add_user":
            addUser();
            break;

        case "login":
            login();
            break;

        case "logout":
            logout();
            break;

        default:
            echo "Error 404: Page not found :( ";
            break;
    }
} else {
    seeHome();
}