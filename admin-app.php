<?php require_once 'src/initAdminApp.php'; ?>

<?php include 'src/header.php' ?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol id="w4" class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="http://localhost/zakazUslugi.loc/admin-panel.php">заявки</a></li>
            </ol>
        </nav>
        <div class="application-index">

            <h1>Заявка на посещение</h1>
            <?php if(!empty($error)): ?>
                <div style="color:red"> <?= $error ?></div>
            <?php endif ?>
            <?php if (isset($_GET['success_id'], $_GET['success_status'])): ?>
                <!-- УБРАН ЖИРНЫЙ ШРИФТ: Обычный чистый текст -->
                <p style="color: green; font-weight: normal; margin-top: 15px;"> Статус изменен на: 
                <?php 
                    $messages = [
                        'timereserv' => 'Время забронировано',
                        'timechange' => 'Посещение перенесено',
                        'provideo'   => 'Услуга оказана',
                        'new'        => 'На посещение'
                    ];
                    echo $messages[$_GET['success_status']];
                ?>
                </p>
            <?php endif; ?>
                <div class="feedback-index p-3">
                    <form id="w0" action="" method="post">
                        <input type="hidden" name="_csrf" value="Y8NMvvT3LR7_0FE4QlfcxYPKc6Y2OK44IrCGNdMqbagnjTjstcRneKWCP3EvEIap9vpLxXJbx1sS4-9C6ksc4w==">
                        
                        <div class="mb-3 field-feedback-fio required">
                            <label class="form-label" for="app-date">Выберите дату</label>
                            <input type="date" id="app-date" class="form-control" name="date" value="<?= $currentApplication['date'] ?>" aria-required="true">
                        </div>
                        
                        <div class="mb-3 field-feedback-fio required">
                            <label class="form-label" for="app-time">Выберите время посещения</label>
                            <input type="time" id="app-time" class="form-control" name="time" value="<?= $currentApplication['time'] ?>" aria-required="true">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">изменить время</button>
                        </div>
                    </form>
                </div>

                <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
                    <div id="w1" class="list-view">
                        <div class="d-flex flex-wrap justify-content-between layout-card">
                            
                            <div class="item" data-key="<?= $currentApplication['id'] ?>">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            <?= $currentApplication['reason'] ?>
                                        </h3>
                                        <p class="card-text">Пользователь: <?= $applicantFio ?></p>
                                        <p class="card-text">
                                            <?= $currentApplication['content'] ?>
                                        </p>
                                        <div class="card-text">
                                            <div class="opacity-50">дата и время посещения:</div>
                                            <?= $currentApplication['date'] ?> в <?= $currentApplication['time'] ?>
                                        </div>
                                        <div class="card-text">
                                            <div class="opacity-50">дата и время создания:</div>
                                            <?= $currentApplication['create_at'] ?>
                                        </div>
                                        
                                        <div class="card-text mb-3">
                                            <div class="opacity-50">статус:</div>
                                            <?php 
                                                $statusMap = [
                                                    'timereserv' => 'Время забронировано',
                                                    'timechange' => 'Посещение перенесено',
                                                    'provideo'   => 'Услуга оказана',
                                                    'new'        => 'На посещение'
                                                ];
                                                echo $statusMap[$currentApplication['status']] ?? 'На посещение';
                                            ?>
                                        </div>
                                        
                                        <?php if ($currentApplication['status'] === 'new' || empty($currentApplication['status'])): ?>
                                            <a class="btn btn-primary" href="admin-panel.php?id=<?= $currentApplication['id'] ?>&status=submit">подтвердить</a>

                                        <?php elseif ($currentApplication['status'] === 'timereserv' || $currentApplication['status'] === 'timechange'): ?>
                                            <a class="btn btn-danger" href="admin-panel.php?id=<?= $currentApplication['id'] ?>&status=complete">Завершить</a>

                                        <?php else: ?>
                                            <div class="text" style="font-weight: normal;">Заявка завершена</div>
                                        <?php endif; ?>

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
