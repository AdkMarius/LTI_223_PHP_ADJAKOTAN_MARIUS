<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil_user</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/c8f266e724.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="header__head">
            <div class="header__logo">
                <img src="./images/EASY DOCS.png" alt="EASY DOCS">
            </div>
            <div class="header__heading">
                <h1>Bienvenue sur votre plateforme de téléchargements d'e-books!</h1>
            </div>
        </div>
        <div>
            <nav id="menu">
                <ul id="menu">
                    <li id="menu"><a id="menu" href="index.php"><i class="fa fa-home"></i>Accueil</a></li>
                    <li id="menu"><a id="menu" href="index.php">
                            <div class="dropdown">
                                <button class="dropbtn"><i class="fa fa-clone"></i>Catégories</button>
                                <div class="dropdown-content">
                                    <a href="#">Informatique-Programmation</a>
                                    <a href="#">Ingénierie Industrielle</a>
                                    <a href="#">Marketing Digital</a>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>  
    </header>

    <div class = "container-custom">
        <div class="custom-row">
            <?php
                $server = "localhost";
                $user = "root";
                $pwd = "";
                $db = "doc_repertory";

                $conn = mysqli_connect($server, $user, $pwd, $db);

                if (!$conn) 
                {
                    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
                }

                $query = "SELECT Title, Cover_Photo FROM Documents";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $title = $row['Title'];
                    $coverPhoto = base64_encode($row['Cover_Photo']);
                    ?>
                    
                    <div class="custom-col-4">
                        <div class="custom-card">
                            <div>
                    <?php
                        echo "<img class='custom-card-img' src='data:image/jpeg;base64,$coverPhoto' alt='$title'>"
                    ?>
                            </div>
                            <div class="custom-card-description">
                    <?php
                        echo "<p>$title</p>"
                    ?>  
                            </div>
                        </div>
                    </div>

                    <?php
                }

                mysqli_close($conn);
            ?>
        </div>
    </div>
    
</body>
</html>