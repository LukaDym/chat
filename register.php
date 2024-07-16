<?php
require_once("./mysql.php");
if (isset($_POST["login_submit"])) {
    if (!empty($_POST["login_username"]) && !empty($_POST["login_password"])) {
        $email = filter_var($_POST["login_email"], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST["login_username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST["login_password"]);
        $pass_hash = sha1($password);

        $create_user = $pdo->prepare("INSERT INTO user VALUES (DEFAULT,:email,:username,:pass,:img_profil)");
        $create_user->bindValue(':email', $email);
        $create_user->bindValue(':username', $username);
        $create_user->bindValue(':pass', $pass_hash);
        $create_user->bindValue(':img_profil', "no_image");

        $create_user->execute();

        header("Location: login.php");
    };
};
require_once("./_htdocs.php")
?>

<title>System Chat</title>
</head>

<body>
    <?php require_once("./_header.php") ?>
    <div class="global_background_div">
        <form action="./register.php" method="post">
            <div class="form_global_input">
                <div class="input_div">
                    <label for="login_email">EMAIL</label>
                    <input type="text" name="login_email" id="login_email">
                </div>
                <div class="input_div">
                    <label for="login_username">USERNAME</label>
                    <input type="text" name="login_username" id="login_username">
                </div>
                <div class="input_div">
                    <label for="login_password">PASSWORD</label>
                    <input type="password" name="login_password" id="login_password">
                </div>
                <div class="input_div">
                    <input type="submit" name="login_submit" id="login_submit">
                </div>
            </div>
        </form>
    </div>
</body>

</html>