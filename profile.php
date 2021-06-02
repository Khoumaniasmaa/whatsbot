<?php require_once 'header.php' ?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Profil d'utilisateur</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body profile-card">
                    <style type="text/css" rel="stylesheet">
                        @media (max-width: 768px){
                            #avatar-img { width: 200px; }
                        }
                    </style>
                        <center class="mt-4"> <img src="assets/images/logo.jpg"
                                class="rounded-circle" width="309" id="avatar-img"/>
                            <h4 class="card-title mt-2"><?= $user->username ?></h4>
                            <div class="row text-center justify-content-center">
                                <div class="col-8">
                                    <a href="javascript:void(0)" class="link" title="Nombre de questions ajoutés">
                                        <i class="icon-question" aria-hidden="true"></i>
                                        <span class="value-digit"><?= $conn->query("SELECT count(*) nb FROM questions WHERE user_id = '{$user->id}'")->fetch_array()['nb'] ?></span>
                                    </a></div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($_GET['edited'])) : ?>
                            <?php if($_GET['edited'] == 1) : ?>
                                <div class="alert alert-success">Profil mis à jour avec succès</div>
                            <?php else: ?>
                                <div class="alert alert-danger">Erreur pendant la mise a jour, essayer plus tard!</div>
                            <?php endif ?>
                        <?php endif ?>
                        <?php if(isset($_GET['down'])) : ?>
                            <div class="alert alert-danger">Votre mot de passe est incorrect!</div>
                        <?php endif ?>
                        <form class="form-horizontal form-material mx-2" action="<?= route('profile.edit') ?>" method="POST">
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Nom d'utilisateur</label>
                                <div class="col-md-12">
                                    <input type="text" name="username" placeholder="Johnathan Doe" value="<?= $user->username ?>"
                                        class="form-control ps-0 form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input placeholder="johnathan@admin.com" disabled value="<?= $user->email ?>"
                                        class="form-control ps-0 form-control-line" name="example-email"
                                        id="example-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Mot de passe</label>
                                <div class="col-md-12">
                                    <input type="password" value="" name="password" placeholder="Mot de passe"
                                        class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Nouveau mot de passe</label>
                                <div class="col-md-12">
                                    <input type="password" value="" name="password2" placeholder="Mot de passe"
                                        class="form-control ps-0 form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 d-flex">
                                    <button type="submit" name="doeditprofile" class="btn btn-success mx-auto mx-md-0 text-white">Modifier le profil</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>

<?php require_once 'footer.php' ?>

<script type="text/javascript">
    function getAnswer(){
        let question = document.getElementById('question').value;
        fetch("http://localhost/whatsbot/controllers/questions/answer.php?message="+question)
        .then(data => data.json())
        .then(response => {
            let target = document.getElementById('target');
            target.innerHTML = response.question.answer;
        })
        .catch(console.log);
}
</script>