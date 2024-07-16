<?php
require_once("./mysql.php");
require_once("./function.php");

session_start();

if (IsConnected()) {
    header('Location: ./index.php');
}
if (isset($_POST["login_submit"])) {
    if (!empty($_POST["login_email"]) && !empty($_POST["login_password"])) {
        $email = filter_var($_POST["login_email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["login_password"]);
        // $pass_hash = password_hash($password, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
        $pass_hash = sha1($password);

        $get_user = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $get_user->bindValue(':email', $email);
        $get_user->execute();

        $create_session = $pdo->prepare("INSERT INTO 'session' VALUES (:id_gen,:id_user)");

        $info_user = $get_user->fetch();

        if ($info_user["password"] == $pass_hash) {
            $create_session->bindValue(":id", bin2hex(random_bytes(32)));
            $create_session->bindValue(":user_id", $info_user["user_id"]);
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $info_user["username"];
            $_SESSION["password"] = $pass_hash;
            $_SESSION["user_id"] = $info_user["user_id"];
            $_SESSION["id"] = $info_user["user_id"];
            header("Location: index.php");
        } else {
            echo "Votre mot de passe ou Email est invalide";
        }
    };
};
require_once("./_htdocs.php")
?>

<title>login</title>
</head>


<body>
    <?php require_once("./_header.php") ?>
    <div class="global_background_div">
        <form action="./login.php" method="post">
            <div class="input_div">
                <label for="login_email">EMAIL</label>
                <input type="text" name="login_email" id="login_email">
            </div>
            <div class="input_div">
                <label for="login_password">PASSWORD</label>
                <input type="password" name="login_password" id="login_password">
            </div>
            <div class="submit_input_div">
                <!-- <label for="login_submit">Inscription</label> -->
                <input type="submit" name="login_submit" id="login_submit">
            </div>
            <div>
                <div class="valide_div_container login_div_button">
                    <a href="./register.php">Don't have an account? Sign up now!</a>
                </div>
            </div>
        </form>
    </div>
</body>