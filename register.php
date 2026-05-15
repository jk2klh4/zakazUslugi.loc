<?php require 'src/initRegister.php'; ?>

<?php include 'src/header.php' ?>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol id="w2" class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">регистрация</li>
                </ol>
            </nav>
            <div class="site-register">
                <h1>регистрация</h1>
                <?php if(!empty($error)): ?>
                    <div style="color:red"> <?= $error ?></div>
                <?php endif ?>

                <?php if(!empty($successMessage)): ?>
                    <div class="alert alert-success" role="alert" style="margin-bottom: 15px;">
                        <?= $successMessage ?>
                    </div>
                <?php endif ?>
                <form id="contact-form" action="" method="post">
                    <input type="hidden" name="_csrf"
                        value="rI0t9QFOm_bq9-tz8v8o0PlFBi-r8gGoNNEz1CtEt__v-H-4OXfyprKHgCzAsFuKphJQZ5mcbNxX4lWbHhCHtA==">
                    <div class="mb-3 field-registerform-login required">
                        <label class="form-label" for="registerform-login">логин</label>
                        <input type="text" id="registerform-login" class="form-control" name="login"
                            aria-required="true">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-registerform-password required">
                        <label class="form-label" for="registerform-password">пароль</label>
                        <input type="text" id="registerform-password" class="form-control" name="password"
                            aria-required="true">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-registerform-fio required">
                        <label class="form-label" for="registerform-fio">фио</label>
                        <input type="text" id="registerform-fio" class="form-control" name="fio"
                            aria-required="true">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-registerform-email">
                        <label class="form-label" for="registerform-email">Email</label>
                        <input type="text" id="registerform-email" class="form-control" name="email">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3 field-registerform-phone required">
                        <label class="form-label" for="registerform-phone">телефон</label>
                        <input type="text" id="registerform-phone" class="form-control" name="phone"
                            aria-required="true" data-plugin-inputmask="inputmask_f59f28e6">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">зарегистрировать</button>
                    </div>
                </form>
            </div><!-- site-register -->
        </div>
    </main>

<?php include 'src/footer.php' ?>
