<?php require_once 'src/initAddApplication.php'; ?>


<?php include 'src/header.php' ?>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if(!empty($error)): ?>
                <div style="color:red"> <?= $error ?></div>
            <?php endif ?>
            <div class="feedback-index p-3">
                <form id="w0" action="" method="post" enctype="multipart/form-data">
                    <?php if (!empty($success)): ?>
                        <div style="color: green;">
                        <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="_csrf"
                        value="Y8NMvvT3LR7_0FE4QlfcxYPKc6Y2OK44IrCGNdMqbagnjTjstcRneKWCP3EvEIap9vpLxXJbx1sS4-9C6ksc4w==">
                    <div class="mb-3 field-feedback-fio required">
                        <label class="form-label" for="feedback-fio">Выберите дату</label>
                        <input type="date" id="app-date" class="form-control" name="date" value="<?= $_POST['date'] ?? '' ?>" aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-feedback-fio required">
                        <label class="form-label" for="feedback-fio">Выберите время посещения</label>
                        <input type="time" id="app-time" class="form-control" name="time" value="<?= $_POST['time'] ?? '' ?>" aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-feedback-fio required">
                        <label class="form-label" for="feedback-fio">Причина посещения (кратко)</label>
                        <input type="text" id="feedback-fio" class="form-control" name="reason" value="<?= $_POST['reason'] ?? '' ?>"  aria-required="true">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3 field-feedback-text required">
                        <label class="form-label" for="feedback-text">Причина посещения (подробно)</label>
                            <textarea id="feedback-text" class="form-control" name="content" 
                            aria-required="true"><?= $_POST['content'] ?? '' ?></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                   

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">отправить заявку</button>
                    </div>
                </form>
            </div><!-- feedback-index -->
        </div>
    </main>

<?php include 'src/footer.php' ?>
