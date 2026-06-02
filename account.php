<?php require_once 'src/initAccount.php'; ?>

<?php include 'src/header.php' ?>

        <main id="main" class="flex-shrink-0" role="main">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol id="w4" class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">заявки</li>
                    </ol>
                </nav>
                <div class="application-index">
    
                    <?php if (isset($_GET['delete_ok'])): ?>
                        <p style="color: green;">
                            Вы удалили заявку
                        </p>
                    <?php endif; ?>

                    <h1>Заявки</h1>
    
                    <p>
                        <a class="btn btn-success" href="add-application.php">подать заявку</a>
                    </p>
                    <p>
                        <a class="btn btn-primary" href="change-password.php">сменить пароль</a>
                    </p>
    
                    <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
                        <div class="application-search">
    
                            <form id="w0" action="account.php" method="get" data-pjax="1">
                                <div class="form-group field-applicationsearch-status_id">
                                    <label class="control-label" for="applicationsearch-status_id">статус</label>
                                    <select id="applicationsearch-status_id" class="form-control" name="ApplicationSearch[status_id]">
                                        <option value="">выберите статус</option>
                                        <option value="new">На посещение</option>
                                        <option value="timereserv">Время забронировано</option>
                                        <option value="provideo">Услуга оказана</option>
                                        <option value="timechange">Посещение перенесено</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">найти</button> 
                                    <a class="btn btn-outline-secondary" href="account.php">сбросить</a>
                                </div>
    
                            </form>
                        </div>
                        <div id="w1" class="list-view">
                            <div class="d-flex flex-wrap justify-content-between layout-card">
                                
                                <?php if (isset($userApplications) && is_array($userApplications)): ?>
                                    <?php foreach ($userApplications as $app): ?>
                                    <div class="item" data-key="<?= $app['id'] ?>">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">
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
                                                    <?php 
                                                        $statusMap = [
                                                            'timereserv' => 'Время забронировано',
                                                            'timechange' => 'Посещение перенесено',
                                                            'provideo'   => 'Услуга оказана',
                                                            'new'        => 'На посещение'
                                                        ];
                                                        echo $statusMap[$app['status']];
                                                    ?>
                                                </div>
                                                <a class="btn btn-primary" href="application.php?id=<?= $app['id'] ?>">просмотр</a>
                                                <a class="btn btn-danger" href="delete-app.php?id=<?= $app['id'] ?>" onclick="confirm('Вы хотите удалить заявку?');">отменить</a>

                                            </div>
                                        </div>
                                      
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
<?php include 'src/footer.php' ?>
