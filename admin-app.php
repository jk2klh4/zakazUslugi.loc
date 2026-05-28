<?php require_once 'src/initAdminApp.php'; ?>

<?php include 'src/header.php' ?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol id="w4" class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="account.php">заявки</a></li>
            </ol>
        </nav>
        <div class="application-index">

            <h1>Заявка на посещение</h1>
            <?php if(!empty($error)): ?>
                <div style="color:red"> <?= $error ?></div>
            <?php endif ?>
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
                                        <p class="card-text">Пользователь: Сергей</p>
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
                                        <div class="card-text">
                                            <div class="opacity-50">статус:</div>
                                            <?= $currentApplication['status'] ?>
                                        </div>
                                        
                                        <a class="btn btn-danger" href="delete-app.php?id=<?= $currentApplication['id'] ?>">удалить</a>
                                        <a class="btn btn-primary" href="admin-panel.php?submit&id=<?= $currentApplication['id'] ?>">подтвердить</a>
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
