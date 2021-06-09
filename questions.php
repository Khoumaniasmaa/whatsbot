<?php require_once 'header.php';

if(isset($_GET['id'])) 
    $question_edit = $conn->query("SELECT * FROM questions WHERE id = '{$_GET['id']}'")->fetch_object();

if(isset($_GET['filter_tag'])){
    $_SESSION['filter_tag'] = $_GET['filter_tag'];
}

if(isset($_GET['cancel'])){
    if(isset($_SESSION['filter_tag'])) {
        unset($_SESSION['filter_tag']);
    }
}
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Gestion des questions</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">questions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des questions</h4>
                        <h5>Appliquer un filtre par tag : 
                            <small><?= isset($_SESSION['filter_tag']) ? "<a href='questions.php?cancel=true'>annuler le filtre</a>"  : '' ?></small>
                            <form class="form-inline" method="GET">
                                <select name="filter_tag" required>
                                    <option value="-1" selected disabled>Choisir un tag</option>
                                    <?php
                                        $tags = $conn->query("SELECT * FROM tags");
                                        while($tag = $tags->fetch_object()):
                                    ?>
                                    <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                                    <?php endwhile ?>
                                </select>
                                <button type="submit" class="btn btn-primary mb-2">Appliquer</button>
                            </form>  
                        </h5>
                        <?php if(isset($_GET['deleted'])) : ?>
                            <?php if($_GET['deleted'] == 1) : ?>
                                <div class="alert alert-success">La question à été supprimé avec succès</div>
                            <?php else: ?>
                                <div class="alert alert-danger">Erreur pendant la suppression de question, essayer plus tard!</div>
                            <?php endif ?>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table user-table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Question</th>
                                        <th class="border-top-0">Réponse</th>
                                        <th class="border-top-0">Complémentaire</th>
                                        <th class="border-top-0">Utilisateur</th>
                                        <th class="border-top-0">Tags</th>
                                        <th class="border-top-0">Opérations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $questions = $conn->query('SELECT questions.id id, content, answer, related_to, username FROM questions INNER JOIN users ON 
                                        users.id = questions.user_id ORDER BY questions.id DESC');
                                        if($questions->num_rows <= 0) echo "<tr><td colspan=7 align=center>Aucun question ajouté</td></tr>";
                                        while($question = $questions->fetch_object()):
                                            $tags = $conn->query("SELECT * FROM questions_tags INNER JOIN tags ON questions_tags.tag_id=tags.id
                                            WHERE questions_tags.question_id='{$question->id}'")->fetch_all(MYSQLI_ASSOC);
                                            $tg = [];
                                            $tags_ids = [];
                                            foreach($tags as $tag){
                                                $tg[] = $tag['name'];
                                                $tags_ids[] = $tag['id'];
                                            }
                                            if(isset($_SESSION['filter_tag'])){
                                                if(! in_array($_SESSION['filter_tag'], $tags_ids))
                                                    continue;
                                            }
                                            $tags = implode(', ', $tg);
                                            if($question->related_to != 0)
                                                $related = $conn->query("SELECT content FROM questions WHERE id='{$question->related_to}'")
                                                ->fetch_array()['content'];
                                            else $related = "";
                                    ?>
                                        <tr>
                                            <td><?= $question->id ?></td>
                                            <td><?= $question->content ?></td>
                                            <td><?= substr($question->answer, 0, 20) . (strlen($question->answer) > 20 ? '...' : '') ?></td>
                                            <td><?= $related ?></td>
                                            <td><?= $question->username ?></td>
                                            <td><?= $tags ?></td>
                                            <td align="center">
                                                <a href="<?= route('questions.delete', ['id' => $question->id]) ?>" onclick="return confirm('êtes vous sûr de supprimer cette question?')">
                                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="?id=<?= $question->id ?>">
                                                    <i class="fa fa-fw fa-edit text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php if(! isset($_GET['id'])) : ?>
                                Ajouter un question
                            <?php else: ?>
                                Modifier la question : <?= $question_edit->id ?>
                                <span class="fright"><a href="questions.php"><small>Annuler la modification</small></a></span>
                            <?php endif ?>
                        </h4>

                        <?php if(isset($_GET['added'])) : ?>
                            <?php if($_GET['added'] == 1) : ?>
                                <div class="alert alert-success">question ajouté avec succès</div>
                            <?php else: ?>
                                <div class="alert alert-danger">Erreur pendant l'ajout de la question, essayer plus tard!</div>
                            <?php endif ?>
                        <?php endif ?>

                        <form action="<?= route('questions.add_edit') ?>" method="POST" role="form">
                            <div class="form-group">
                                <label for="question">La question</label>
                                <input type="hidden" class="hidden" style="display: none;" name="id" value="<?= $question_edit->id ?? '' ?>">
                                <input type="text" name="question" class="form-control" placeholder="Contenu de la question" id="question" value="<?= $question_edit->content ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="answer">La réponse</label>
                                <textarea name="answer" rows="5" class="form-control" placeholder="Réponse de la question" id="answer"><?= $question_edit->answer ?? '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select id="tags" class="form-control js-example-basic-multiple" name="tags[]" multiple="multiple">
                                    <?php
                                        $tags = $conn->query("SELECT * FROM tags");
                                        while($tag = $tags->fetch_object()):
                                            if(isset($question_edit))
                                                $is_selected = $conn->query("SELECT count(*) nb FROM questions_tags WHERE question_id={$question_edit->id} AND tag_id={$tag->id}")
                                                ->fetch_array()['nb'] > 0;
                                            else $is_selected = false;
                                    ?>
                                    <option value="<?= $tag->id?> " <?= $is_selected ? 'selected' : '' ?>><?= $tag->name ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="related_to">Complémentaire</label>
                                <select name="related_to" id="related_to" class="form-control js-example-basic-single" name="related_to">
                                    <option value="0" selected>Aucune relation</option>
                                    <?php
                                        $questions = $conn->query("SELECT * FROM questions");
                                        while($question = $questions->fetch_object()):
                                            if(isset($question_edit))
                                                $is_selected = $question->id==$question_edit->related_to ? 'selected' : '';
                                            else $is_selected = false;
                                    ?>
                                    <option value="<?= $question->id?> " <?= $is_selected ?>><?= $question->content ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php if(isset($_GET['id'])) : ?>
                                    <button name="doeditquestion" class="btn btn-warning fright" type="submit">Enregistrer</button>
                                <?php else : ?>
                                    <button name="doaddquestion" class="btn btn-primary fright" type="submit">Ajouter</button>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
<?php require_once 'footer.php' ?>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>