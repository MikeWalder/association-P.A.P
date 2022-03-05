<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description ?>">
    <link href=" <?= URL ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/main.css" rel="stylesheet">
    <!-- Font awesome 5.14.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Copse&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
</head>

<body>
    <div class="container p-0 mt-2 rounded perso_shadowBox">
        <header class="bg-dark text-white rounded-top perso_policeTitle perso_shadowBox">
            <div class="row align-items-center m-0">
                <div class="col-2 p-2 text-center">
                    <a href="accueil">
                        <img src="<?= URL ?>/public/content/images/Others/logo.png" alt="logo de l'association" class="rounded-circle img-fluid perso_imgLogo" title="Association Pattes à Pouffes">
                    </a>
                </div>
                <div class="col-6 col-lg-8 m-0 p-0">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark perso_headerFontSize">
                        <button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav text-light">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold perso_headerAsso" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        L'asso
                                    </a>
                                    <div class="dropdown-menu bg-dark rounded" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item perso_headerAsso" href="<?= URL ?>association">Qui sommes-nous ?</a>
                                        <a class="dropdown-item perso_headerAsso" href="<?= URL ?>partenaires">Nos partenaires</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold perso_headerPensionnaires" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pensionnaires
                                    </a>
                                    <div class="dropdown-menu bg-dark rounded" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item perso_headerPensionnaires" href="<?= URL ?>pensionnaires&idstatut=1">Ils cherchent une famille</a>
                                        <a class="dropdown-item perso_headerPensionnaires" href="<?= URL ?>pensionnaires&idstatut=3">Famille d'accueil longue durée</a>
                                        <a class="dropdown-item perso_headerPensionnaires" href="<?= URL ?>pensionnaires&idstatut=2">Les anciens</a>
                                        <?php if (Securite::verificationAccessSession()) { ?>
                                            <a class="dropdown-item text-info" href="<?= URL ?>adminPensionnaire">Gestion des Pensionnaires</a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold perso_headerActus" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actus
                                    </a>
                                    <div class="dropdown-menu bg-dark rounded" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item perso_headerActus" href="<?= URL ?>actus&type=<?= TYPE_NEWS ?>">Nouvelles des adoptés</a>
                                        <a class="dropdown-item perso_headerActus" href="<?= URL ?>actus&type=<?= TYPE_EVENT ?>">Evénements</a>
                                        <a class="dropdown-item perso_headerActus" href="<?= URL ?>actus&type=<?= TYPE_ACTION ?>">Nos actions au quotidien</a>
                                        <?php if (Securite::verificationAccessSession()) { ?>
                                            <a class="dropdown-item text-info" href="<?= URL ?>adminNews">Gestion des Actus</a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold perso_headerConseils" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Conseils
                                    </a>
                                    <div class="dropdown-menu bg-dark rounded" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item perso_headerConseils" href="<?= URL ?>temperatures">Températures</a>
                                        <a class="dropdown-item perso_headerConseils" href="<?= URL ?>chocolat">Le chocolat</a>
                                        <a class="dropdown-item perso_headerConseils" href="<?= URL ?>plantes">Les plantes toxiques</a>
                                        <a class="dropdown-item perso_headerConseils" href="<?= URL ?>sterilisation">Stérilisation</a>
                                        <a class="dropdown-item perso_headerConseils" href="<?= URL ?>educateur">Educateur canin</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle font-weight-bold perso_headerContacts" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Contacts
                                    </a>
                                    <div class="dropdown-menu bg-dark rounded" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item perso_headerContacts" href="<?= URL ?>contact">Contacts</a>
                                        <a class="dropdown-item perso_headerContacts" href="<?= URL ?>dons">Dons</a>
                                        <a class="dropdown-item perso_headerContacts" href="<?= URL ?>mentions">Mentions légales</a>
                                    </div>
                                </li>
                                <?php if (Securite::verificationAccessSession()) { ?>
                                    <li class="nav-item dropdown pl-5 pt-2 d-none d-md-block">
                                        <button type="submit" class="btn btn-secondary" title="Quitter mode administrateur" value="&#xf011; Login" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-lg fa-power-off text-white"></i>
                                        </button>
                                    </li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header text-secondary text-center">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmez-vous la sortie du mode administrateur ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- <div class="modal-body">
                                                    ...
                                                </div> -->
                                                <div class="modal-footer mx-auto">
                                                    <form method="POST" action="admin">
                                                        <div class="row">
                                                            <div class="form-group no-gutters m-1">
                                                                <input type="hidden" name="deconnection" value="true">
                                                                <button type="submit" class="btn btn-success col p-1 p-lg-3">Valider</button>
                                                            </div>
                                                            <div class="form-group no-gutters  m-1">
                                                                <button type="button" class="btn btn-danger col p-1 p-lg-3" data-dismiss="modal">Annuler</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="nav-item col-2 col-md-2 font-weight-bold pr-1 pr-md-2 pr-lg-4">
                    <a href="login" class="text-white text-center" title="Se connecter à la partie administration">
                        P. A. P.<br>
                        <span class="text-left d-none d-md-block">Centre Alsace</span></a>
                </div>
            </div>
        </header>

        <!-- Contenu du site -->
        <div class="border p-1 perso_minCorpsSize px-lg-3">

            <?= $content ?>

        </div>

        <footer class="bg-dark text-center text-white rounded-bottom perso_shadowBox">
            <a href="login" class="text-white">&copy; Association &nbsp; P.A.P. &ensp;&ensp; 2019 - 2022</a>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= URL ?>public/bootstrap/js/bootstrap.js"></script>
</body>

</html>