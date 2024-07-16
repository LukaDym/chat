<?php
require_once("./mysql.php");
require_once("./function.php");

ini_set('display_errors', 'on');
require_once("./_htdocs.php");
session_start();


if (IsConnected() === false) {
    header('Location: ./login.php');
}

$get_all_message = $pdo->prepare("SELECT * FROM messagerie");
$get_all_message->execute();

$all_message = $get_all_message->fetchall();

$insert_message = $pdo->prepare("INSERT INTO messagerie VALUES(DEFAULT,:pseudo,:text_send)");

if (isset($_POST["valider"])) {
    if (!empty($_POST["message"] && IsConnected())) {
        $pseudo = htmlspecialchars(getPseudo());
        $message = nl2br(htmlspecialchars($_POST["message"]));

        $insert_message->bindValue(":pseudo", $pseudo);
        $insert_message->bindValue(":text_send", $message);
        $insert_message->execute();
    } else {
        echo "Vous devez être connecter afin d'envoyer un message";
    }
}
?>

<title>System Chat</title>
</head>

<body class="body_index">
    <?php require_once("./_header.php") ?>
    <main class="background_main">

        <section class="message_section">
            <?php foreach ($all_message as $key => $message) {
                echo ('
                    <div class="message_display_div" id="' . $message["id"] . '">
                        <h4>' . $message["pseudo"] . ':</h4>
                        <h5>' . $message["text"] . '</h5>
                    </div>
                ');
            }; ?>
        </section>
    </main>
    <?php
    if (IsConnected()) {
        echo ('
            <form class="create_message_form" method="POST" action="">
                <textarea name="message" id="create_message_textarea"></textarea>

                <input type="submit" name="valider" id="submit_button">
            </form>
        ');
    }
    ?>
    <?php if (IsConnected()) { ?> <script src="./src/index.js"></script> <?php }; ?>
</body>

</html>