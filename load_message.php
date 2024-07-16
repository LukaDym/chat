<?php
session_start();
require_once("./mysql.php");
require_once("./function.php");

$get_id = (int) $_POST["lastid"];

$idplus20 = $get_id + 20;

if ($get_id <= 0 || empty($get_id) || gettype($get_id) != 'integer') {
    echo ("il n'y a aucun message dans la discussions ???");
}
if (IsConnected() == true) {
    // debug_to_console($get_id);
    $get_all_message = $pdo->prepare("SELECT * FROM messagerie WHERE id BETWEEN :lastid AND :idplus20");
    $get_all_message->bindValue("lastid", $get_id + 1);
    $get_all_message->bindValue("idplus20", $idplus20);
    $get_all_message->execute();
    // echo ("envois message");
    $new_message = $get_all_message->fetchAll();
    if (!empty($new_message)) {
        foreach ($new_message as $key => $message) {
            echo ('
                <div class="message_display_div" id="' . $message["id"] . '">
                    <h4>' . $message["pseudo"] . ':</h4>
                    <h5>' . $message["text"] . '</h5>
                </div>
            ');
        };
    } else {
        // echo ("Pas de nouveau messages");
    };
};
