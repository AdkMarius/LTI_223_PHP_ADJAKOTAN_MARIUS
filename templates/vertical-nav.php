<?php
    $current_page = $_SERVER['PHP_SELF'];
?>

<div class="vertical-menu">
    <a href="<?php if (isset($_GET['action'])) echo './src/views/admin/dashboard.php';
        else echo './dashboard.php'; ?>" class="vertical-menu__link <?php
        if ($current_page == '/workspace-php/LTI_223_PHP_ADJAKOTAN_MARIUS/src/views/admin/dashboard.php') echo 'active' ?>"><i class="fas fa-list"></i>&ensp;Tableau de bord</a>

    <a href="<?php if (isset($_GET['action'])) echo 'index.php?action=viewDoc';
    else echo '../../../index.php?action=viewDoc'; ?>" class="vertical-menu__link <?php if (isset($_GET['action'])) echo 'active' ?>"><i class="fas fa-table"></i>&ensp;Documents enrégistrés</a>

    <a href="<?php if (isset($_GET['action'])) echo './src/views/admin/add-document.php';
        else echo './add-document.php'; ?>" class="vertical-menu__link"><i class="fas fa-file <?php
        if ($current_page == '/workspace-php/LTI_223_PHP_ADJAKOTAN_MARIUS/src/views/admin/add-document.php') echo 'active' ?>"></i>&ensp;Ajouter un document</a>
</div>