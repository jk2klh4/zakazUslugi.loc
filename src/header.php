<!DOCTYPE html>
<html lang="ru-RU" class="h-100">

<head>
    <title>Заказ услуги</title>
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="YYWMo8nm2RWzZQ2blSGEi_JZkduKhNmkfzJyMJYc-_0gzLWXsbXtZP8oY8LdGMPHkzDWg-_bnOAHWyt-pUyIqg==">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    
    <header id="header">
        <nav id="w1" class="navbar-expand-md navbar-dark bg-dark fixed-top navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">Заказ услуги</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w1-collapse"
                    aria-controls="w1-collapse" aria-expanded="false" aria-label="Переключить навигацию">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="w1-collapse" class="collapse navbar-collapse">
                    <ul id="w2" class="navbar-nav nav">
                        <li class="nav-item"><a class="nav-link <?= $page == 'feedback.php' ? 'active' : '' ?>" href="feedback.php">отзывы</a></li>
                        
                        <?php if ($user->isAdmin()): ?>
                            <li class="nav-item"><a class="nav-link <?= $page == 'admin-panel.php' ? 'active' : '' ?>" href="admin-panel.php">админ панель</a></li>
                            <li class="nav-item"><a class="nav-link <?= $page == 'register.php' ? 'active' : '' ?>" href="register.php">регистрация</a></li>
                        <?php endif ?>

                        <?php if ($user->isGuest()): ?> 
                            <li class="nav-item"><a class="nav-link <?= $page == 'login.php' ? 'active' : '' ?>" href="login.php">войти</a></li>
                        <?php else: ?>
                            
                            <?php if (!$user->isAdmin()): ?>
                                <li class="nav-item"><a class="nav-link <?= $page == 'account.php' ? 'active' : '' ?>" href="account.php">личный кабинет</a></li>
                            <?php endif ?>
                            
                            <li class="nav-item"><a class="nav-link" href="logout.php"><?= $user->getLogin() ?>(выйти)</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
