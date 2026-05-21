<?php require_once 'src/initApplication.php'; ?>


<?php include 'src/header.php' ?>

        <main id="main" class="flex-shrink-0" role="main">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol id="w4" class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="account.php">заявки</a></li>
                    </ol>
                </nav>
                <div class="application-index">
    
                    <h1>Заявка на посещение</h1>
                        <?php if(!empty($error)): ?>
                        <div style="color:red"> <?= $error ?></div>
                        <?php endif ?>

    
                    <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
 
                        <div id="w1" class="list-view">
                            <div class="d-flex flex-wrap justify-content-between layout-card">
                                <?php foreach($applications as $app): ?>
                                
                                <div class="item" data-key="<?= $app['id'] ?>">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h3 class="card-title">
                                            <?= $app['reason'] ?> </h5>
                                            <p class="card-text">
                                            <?= $app['content'] ?></p>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    дата и время посещения:
                                                </div>
                                                <?= $app['date'] ?> <?= $app['time'] ?>
                                            </div>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    дата и время создания:
                                                </div>
                                                <?= $app['create_at'] ?>
                                                 
                                            </div>
                                            <div class="card-text">
                                                <div class="opacity-50">
                                                    статус:
                                                </div>
                                                На посещение
                                            </div>
                                            
                                            <a class="btn btn-danger" href="delete-app.php?id=<?= $app['id'] ?>">отменить</a>
                                        </div>
                                    </div>
                                  
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
<?php include 'src/footer.php' ?>
