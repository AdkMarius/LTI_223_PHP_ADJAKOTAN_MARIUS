<?php if (!isset($_SESSION)) { session_start(); } ?>

<header class="header">
    <nav class="header__nav">
        <div class="dropdown">
            <div class="dropbtn header__nav--dropbtn">
                <p><i class="fa fa-user">&ensp;</i>Bonjour <?php if ($_SESSION['emailUser']) echo $_SESSION['emailUser'] ?></p>
            </div>
            <div class="dropdown-content">
                <a href="#">Aller sur le site</a>
                <a href="#">Se déconnecter</a>
            </div>
        </div>
    </nav>
</header>