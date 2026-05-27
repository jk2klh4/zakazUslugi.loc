<?php require_once 'src/initIndex.php'; ?>

<?php include 'src/header.php'; ?>

    <main id="main" class="flex-shrink-0" role="main">
       <h1 class="mt-5">Ремонт электроники</h1>
       <h3 class="mt-5">Отзывы</h3>
       
        <?php foreach ($reviews as $review): ?>
           <div>
               <h6>Имя: <?= $review['fio'] ?></h6> 
                Дата: <?= $review['create_at'] ?>
               <h6>Отзыв: <?= $review['feedback'] ?></h6>
               <hr>
           </div>
       <?php endforeach; ?>
    </main>

<?php include 'src/footer.php'; ?>
