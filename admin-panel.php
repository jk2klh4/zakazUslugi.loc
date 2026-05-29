<?php require_once 'src/initAdminPanel.php'; ?>


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

                <h1>Заявки</h1>
                <?php if (isset($_GET['success_id'], $_GET['success_status'])): ?>
                        <p style="color: green; margin-top: 20px;"> Статус изменен на 
                        <?= $_GET['success_status'] === 'timereserv' ? 'Время забронировано' : 'Услуга оказана' ?>
                        </p>
                <?php endif; ?>

                <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
                    <div class="application-search">

                        <form id="w0" action="admin-panel.php" method="get" data-pjax="1">
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

                            <div class="form-group mb-3 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" id="all-days-checkbox" class="form-check-input" name="ApplicationSearch[all_days]" value="1">
                                    <label class="form-check-label" for="all-days-checkbox">Показать заявки за все дни</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">найти</button> 
                                <a class="btn btn-outline-secondary" href="admin-panel.php">сбросить</a>
                            </div>

                        </form>
                    </div>

                    <div id="w1" class="list-view">
                        <div class="d-flex flex-wrap justify-content-between">
                        <?php foreach ($userApplications as $app): ?>
                            
                            <div class="item" data-key="9">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                        <?= $app['reason'] ?></h5>
                                        <p class="card-text">
                                        <?= $app['content'] ?></p>
                                        <div class="card-text">
                                            <div class="opacity-50">
                                                дата и время посещения
                                            </div>
                                            <?= $app['date'] ?> в <?= $app['time'] ?>
                                        </div>
                                        <div class="card-text">
                                            <div class="opacity-50">
                                                дата и время создания:
                                            </div>
                                            <?= $app['create_at'] ?>
                                        </div>
                                        <div class="card-text">
                                                <div class="opacity-50">статус:</div>
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
                                            <a class="btn btn-primary" href="admin-app.php?id=<?= $app['id'] ?>">Просмотр</a>

                                            <?php if (in_array($app['status'], ['new', 'timechange', 'На посещение', 'Посещение перенесено'])): ?>
                                                <a class="btn btn-primary" href="admin-panel.php?id=<?= $app['id'] ?>&status=submit">Подтвердить</a>

                                            <?php elseif ($app['status'] === 'timereserv'): ?>
                                                <a class="btn btn-primary" href="admin-panel.php?id=<?= $app['id'] ?>&status=complete">Завершить</a>

                                            <?php else: ?>
                                                <div class="text" style="width: 18rem;">Заявка завершена</div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    
<?php include 'src/footer.php' ?>
