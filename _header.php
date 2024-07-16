<header>
    <div>
        <div class="header_container">
            <a href="./index.php">
                <h3>System de chat direct</h3>
            </a>
            <div class="div_image_login">
                <?php
                if (isset($_SESSION["email"])) {
                    echo '<a href="./leave.php"><img src="./images/deconnexion.png" alt="image_connexion"></a>';
                } else {
                    echo '<a href="./login.php"><img src="./images/connexion.png" alt="image_connexion"></a>';
                }
                ?>
            </div>
        </div>
    </div>
</header>