<?php if (!isset($_SESSION)) { session_start(); } ?>

<header class="header">
    <nav class="header__nav">
        <div class="dropdown">
            <div class="dropbtn header__nav--dropbtn">
                <p><i class="fa fa-user">&ensp;</i>Bonjour <?php if ($_SESSION['emailUser']) echo $_SESSION['emailUser'] ?></p>
            </div>
            <div class="dropdown-content">
                <a href="<?php if (isset($_GET['action'])) echo 'index.php?action=user';
                    else echo '../../../index.php'; ?>" target="_blank">Aller sur le site</a>
                <a href="<?php if (isset($_GET['action'])) echo 'index.php?action=logout';
                else echo '../../../index.php?action=logout'; ?>">Se déconnecter</a>
            </div>
        </div>
    </nav>
</header>