<?php require_once 'header.php';

if(isset($_GET['id'])) 
    $tag_edit = $conn->query("SELECT * FROM tags WHERE id = '{$_GET['id']}'")->fetch_object();
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Gestion des tags</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">tags</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des tags</h4>
                        <?php if(isset($_GET['deleted'])) : ?>
                            <?php if($_GET['deleted'] == 1) : ?>
                                <div class="alert alert-success">Le tag à été supprimé avec succès</div>
                            <?php else: ?>
                                <div class="alert alert-danger">Erreur pendant la suppression de tag, essayer plus tard!</div>
                            <?php endif ?>
                        <?php endif ?>
                        <div class="table-responsive">
                            <table class="table user-table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Nom</th>
                                        <th class="border-top-0">Description</th>
                                        <th class="border-top-0">Niveau</th>
                                        <th class="border-top-0">Synonymes</th>
                                        <th class="border-top-0">Opérations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $tags = $conn->query('SELECT * FROM tags ORDER BY id DESC');
                                        if($tags->num_rows <= 0) echo "<tr><td colspan=6 align=center>Aucun tag ajouté</td></tr>";
                                        while($tag = $tags->fetch_object()):
                                    ?>
                                        <tr>
                                            <td><?= $tag->id ?></td>
                                            <td><?= $tag->name ?></td>
                                            <td><?= $tag->description ?></td>
                                            <td><?= $tag->level ?></td>
                                            <td><?= $tag->synonyms ?></td>
                                            <td align="center">
                                                <a href="<?= route('tags.delete', ['id' => $tag->id]) ?>" onclick="return confirm('êtes vous sûr de supprimer ce tag?')">
                                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="?id=<?= $tag->id ?>">
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php if(! isset($_GET['id'])) : ?>
                                Ajouter un tag
                            <?php else: ?>
                                Modifier le tag : <?= $tag_edit->name ?>
                                <span class="fright"><a href="tags.php"><small>Annuler la modification</small></a></span>
                            <?php endif ?>
                        </h4>

                        <?php if(isset($_GET['added'])) : ?>
                            <?php if($_GET['added'] == 1) : ?>
                                <div class="alert alert-success">Tag ajouté avec succès</div>
                            <?php else: ?>
                                <div class="alert alert-danger">Erreur pendant l'ajout de tag, essayer plus tard!</div>
                            <?php endif ?>
                        <?php endif ?>

                        <form action="<?= route('tags.add_edit') ?>" method="POST" role="form">
                            <div class="form-group">
                                <label for="name">Nom de tag</label>
                                <input type="hidden" class="hidden" style="display: none;" name="id" value="<?= $tag_edit->id ?? '' ?>">
                                <input type="text" name="name" class="form-control" placeholder="Nom de tag" id="name" value="<?= $tag_edit->name ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="level">Niveau</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="0" selected disabled>Choisir un niveau</option>
                                    <option value="1" <?= isset($tag_edit) ? ($tag_edit->level == 1 ? 'selected' : '') : '' ?>>Niveau 1</option>
                                    <option value="2" <?= isset($tag_edit) ? ($tag_edit->level == 2 ? 'selected' : '') : '' ?>>Niveau 2</option>
                                    <option value="3" <?= isset($tag_edit) ? ($tag_edit->level == 3 ? 'selected' : '') : '' ?>>Niveau 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="synonyms">Synonymes</label>
                                <small>Utiliser la virgule pour séparer</small>
                                <select id="synonyms" class="form-control js-example-basic-multiple" name="synonyms[]" multiple="multiple">
                                    <?php
                                        if(isset($tag_edit)){
                                            $syns = explode(',', $tag_edit->synonyms);
                                            foreach($syns as $syn){
                                                echo "<option value='$syn' selected>$syn</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" name="description" class="form-control" placeholder="Description ici..." rows="5"><?= $tag_edit->description ?? '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <?php if(isset($_GET['id'])) : ?>
                                    <button name="doedittag" class="btn btn-warning fright" type="submit">Enregistrer</button>
                                <?php else : ?>
                                    <button name="doaddtag" class="btn btn-primary fright" type="submit">Ajouter</button>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
<?php require_once 'footer.php' ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>