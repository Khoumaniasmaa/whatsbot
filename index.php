<?php require_once 'header.php' ?>
        <div class="page-wrapper">
            
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Accueil</h3>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div>
                                                <h3 class="card-title"> Les Statistiques des questions</h3>
                                                <h6 class="card-subtitle">Questions publiées ce moi</h6>
                                            </div>
                                            <div class="ms-lg-auto mx-sm-auto mx-lg-0">
                                                <ul class="list-inline d-flex">
                                                    <li>
                                                        <h6 class="text-info"><i
                                                                class="fa fa-circle font-10 me-2"></i>Question</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="amp-pxl" style="height: 360px;">
                                            <div class="chartist-tooltip"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Questions par tag </h3>
                                <h6 class="card-subtitle">Nombre de questions par tag</h6>
                                <div id="visitor"
                                    style="height: 360px; width: 100%; max-height: 360px; position: relative;"
                                    class="c3">
                                    <div class="c3-tooltip-container"
                                        style="position: absolute; pointer-events: none; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <hr class="mt-0 mb-0">
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="card-body bg-info">
                                <h4 class="text-white card-title">Tags populaire</h4>
                                <h6 class="card-subtitle text-white mb-0 op-5">Les tags les plus utilisés</h6>
                            </div>
                            <div class="card-body">
                                <div class="message-box contact-box">
                                    <h2 class="add-ct-btn"><a href="tags.php"
                                            class="btn btn-circle btn-lg btn-success waves-effect waves-dark">+</a>
                                    </h2>
                                    <div class="message-widget contact-widget">
                                        <?php
                                            $tags = $conn->query("SELECT *, count(tag_id) nb from tags INNER JOIN questions_tags ON tags.id=questions_tags.tag_id 
                                            GROUP BY tags.id DESC ORDER BY nb DESC LIMIT 5");
                                            while($tag = $tags->fetch_object()):
                                        ?>                                        
                                        <a class="d-flex align-items-center">
                                            <div class="user-img mb-0"> <i class="fa fa-fw fa-tag m-2 fa-lg"></i></div>
                                            <div class="mail-contnet">
                                                <h5 class="mb-0"><?= $tag->name ?></h5> <span
                                                    class="mail-desc"><?= $tag->nb ?> questions</span>
                                            </div>
                                        </a>
                                        <?php endwhile ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#home"
                                        role="tab">Dérniers questions ajoutées</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question</th>
                                                    <th>Réponse</th>
                                                    <th>Complémentaire</th>
                                                    <th>Utilisateur</th>
                                                    <th>Tags</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $questions = $conn->query('SELECT questions.id id, content, answer, related_to, username FROM questions INNER JOIN users ON 
                                                users.id = questions.user_id ORDER BY questions.id DESC LIMIT 5');
                                                if($questions->num_rows <= 0) echo "<tr><td colspan=5 align=center>Aucune question ajouté</td></tr>";
                                                while($question = $questions->fetch_object()):
                                                    $tags = $conn->query("SELECT * FROM questions_tags INNER JOIN tags ON questions_tags.tag_id=tags.id
                                                    WHERE questions_tags.question_id='{$question->id}'")->fetch_all(MYSQLI_ASSOC);
                                                    $tg = [];
                                                    foreach($tags as $tag) $tg[] = $tag['name'];
                                                    $tags = implode(', ', $tg);
                                                    if($question->related_to != 0)
                                                        $related = $conn->query("SELECT content FROM questions WHERE id='{$question->related_to}'")
                                                        ->fetch_array()['content'];
                                                    else $related = "";
                                            ?>
                                                <tr>
                                                    <td><?= $question->id ?></td>
                                                    <td><?= $question->content ?></td>
                                                    <td><?= $question->answer ?></td>
                                                    <td><?= $related ?></td>
                                                    <td><?= $question->username ?></td>
                                                    <td><?= $tags ?></td>
                                                </tr>
                                            <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            
<?php require_once 'footer.php' ?>
<script type="text/javascript">
    $(document).ready(function(){
        var chart2 = new Chartist.Bar('.amp-pxl', {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29 ,30, 31],
        
        <?php
            $questions = $conn->query("SELECT DAY(created_at) datee, count(*) nb
            FROM questions
            WHERE YEAR(created_at)=YEAR(CURRENT_TIMESTAMP) AND MONTH(created_at)=MONTH(CURRENT_TIMESTAMP)
            GROUP BY YEAR(created_at), MONTH(created_at), DAY(created_at)")->fetch_all(MYSQLI_ASSOC);
            $values = [];
            for($i=0;$i<=31;$i++) $values[$i] = 0;
            foreach($questions as $q) $values[$q['datee']+0-1] = $q['nb']+0;
            $maximum = max($values);
            $questions = '[' . implode(', ', $values) . ']';
        ?>
        series: [ <?= $questions ?> ],
    }, {
        axisX: {
            // On the x-axis start means top and end means bottom
            position: 'end',
            showGrid: false
        },
        axisY: {
            // On the y-axis start means left and end means right
            position: 'start'
        },
        high: '<?= $maximum+1 ?>',
        low: '0',
        plugins: [
            Chartist.plugins.tooltip()
        ]
    });

    var chart = [chart2];

    // ============================================================== 
    // This is for the animation
    // ==============================================================

    for (var i = 0; i < chart.length; i++) {
        chart[i].on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 500 * data.index,
                        dur: 500,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
            if (data.type === 'bar') {
                data.element.animate({
                    y2: {
                        dur: 500,
                        from: data.y1,
                        to: data.y2,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    },
                    opacity: {
                        dur: 500,
                        from: 0,
                        to: 1,
                        easing: Chartist.Svg.Easing.easeInOutElastic
                    }
                });
            }
        });
    }

        var chart = c3.generate({
        bindto: '#visitor',
        data: {
            <?php
                $tags = $conn->query("SELECT *, count(tag_id) nb from tags INNER JOIN questions_tags ON tags.id=questions_tags.tag_id 
                GROUP BY tags.id DESC ORDER BY nb DESC LIMIT 4")->fetch_all(MYSQLI_ASSOC);
                $tg = [];
                foreach($tags as $tag) $tg[] = '[\''.$tag['name'].'\', '.$tag['nb'].']';
                $tags = '[' . implode(', ', $tg) . ']';
            ?>
            columns: <?= $tags ?>,

            type: 'donut',
            onclick: function(d, i) {  },
            onmouseover: function(d, i) { },
            onmouseout: function(d, i) {  }
        },
        donut: {
            label: {
                show: false
            },
            title: "Questions / Tag",
            width: 20,

        },

        legend: {
            hide: true
                //or hide: 'data1'
                //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ['#745af2', '#26c6da', '#1e88e5', '#5a88ca']
        }
    });
    })
</script>