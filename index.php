<?php
session_start();
// require __DIR__ . '/login.php';
$login = $_SESSION['username'];
$password = $_SESSION['password'];

require __DIR__ . '/function.php';


if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // Время начала сессии в секундах
}

$currentTime = time(); // Текущее время в секундах
$discountEndTime = $_SESSION['start_time'] + 86400; // Время окончания скидки (через 24 часа)

// Вычисление разницы во времени
$timeDiff = $discountEndTime - $currentTime;

// Переводим секунды в часы, минуты и секунды
$hours = floor($timeDiff / 3600);
$minutes = floor(($timeDiff % 3600) / 60);
$seconds = $timeDiff % 60;

// Если время скидки истекло, сообщаем об этом
if ($timeDiff <= 0) {
    $message = 'Персональная скидка истекла.';
} else {
    $message = "Осталось: {$hours} ч {$minutes} мин {$seconds} сек";
};

for ($i=0; $i <3 ; $i++) { 
  if($login == getUsersList()[$i]['login']){
    $_SESSION['birthday'] = getUsersList()[$i]['birthday'];
    // Получаем дату рождения из сессии
    $birthday = isset($_SESSION['birthday']) ? $_SESSION['birthday'] : '';

    // Если дата рождения пустая, возможно, она ещё не введена
    if (empty($birthday)) {
      echo 'Не удалось найти дату вашего дня рождения.';
    } else {
      // Получаем сегодняшнюю дату
      $today = date('Y-m-d');
      var_dump($today);

      // Преобразуем дату рождения в объект DateTime
      $dateOfBirth = DateTime::createFromFormat('Y-m-d', $birthday);
      var_dump($dateOfBirth->format('Y-m-d'));

      // Проверяем, наступил ли уже следующий год
      while($dateOfBirth->format('Y-m-d') < $today){
        $nextBirthday = $dateOfBirth->modify('+1 year')->format('Y-m-d');
      }

      // Создаем объект DateTime для следующей даты дня рождения
      $nextBirthdayDate = DateTime::createFromFormat('Y-m-d', $nextBirthday);

      // Рассчитываем разницу в днях
      $interval = $nextBirthdayDate->diff(new DateTime());
      $daysLeft = $interval->days;
    };
  }
};

if (null !== $login || null !== $password){
    for ($i=0; $i < 3; $i++) { 
        if ($password === getUsersList()[$i]['password']){

            $_SESSION['auth'] = true;
            $_SESSION['username'] = $login;
        }
    }
};

$auth = $_SESSION['auth'] ?? null;
if($auth){
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>RELAX & ENJOY</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="bg-light bg-gradient">
    <header>
      <!-- Навигационная панель -->
      <nav class="navbar fixed-top bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">RELAX & ENJOY</a>
            <ul class="nav justify-content-end">
              <li class="nav-item">
                <span class="nav-link"><?php echo getCurrentUser() ?></span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/logout.php">Выйти</a>
              </li>
            </ul>
        </div>
      </nav>
    </header>
    <!-- Приветственная информация -->
    <div class="container text-center">
      <div class="col" style="height: 5em"></div>
      <div class="row" id="mainInfo" style="align-items: center;">
        <div class="col-7">
          <p><h2 class="text-muted display-5">Добро пожаловать <?php echo getCurrentUser() ?> и ждём Вас у нас в гостях!</h2></p>
        </div>
        <div class="col">
          <h1 class="display-1">RELAX & ENJOY</h1>
        </div>
      </div>
      <div class="col" style="height: 1em;"></div>
    </div>
    <!-- Карусель изображений -->
    <div class="container" >
      <div class="carousel slide" data-bs-ride="carousel" id="carouselSlide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselSlide" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselSlide" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselSlide" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="/images/spa2.jpg" class="d-block w-100" alt="spaitem">
            <div class="carousel-caption d-none d-md-block">
              <h5>Лучшие составлящие для вашего отдыха</h5>
              <p>Благодаря нашим ароматным маслам Вы почувствуете полное раслабление.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="/images/spa1.jpg" class="d-block w-100" alt="spa">
            <div class="carousel-caption d-none d-md-block">
              <h5>Проффесионалы своего дела</h5>
              <p>Опытные специалисты погрузят Вас и Ваше тело в новые горизонты чувств.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <img src="/images/spa3.jpg" class="d-block w-100" alt="spasalon">
            <div class="carousel-caption d-none d-md-block">
              <h5>Расслабляющая атмосфера для Вашего комфорта</h5>
              <p>Современный дизайн, приятная музыка, раслабляющий свет ждут Вас в нашем салоне</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col" style="height: 1em;"></div>
    </div>
    <div class="container">
      <h2 class="display-3 text-center">
        Акции и Бонусы
      </h2>
    </div>
    <!-- Акции и бонусы -->
    <div class="container overflow-hidden">
      <div class="row row-cols-2 text-center align-items-center justify-content-center">
        <div class="col gy-3">
          <img src="/images/birthdaySale.jpg" alt="birthday Sale" class="rounded" style="height: 30em;">
        </div>
        <div class="col gy-3"><h2>Скидка в честь дня рождения</h2>
        <h3 class="text-muted"><?php if($daysLeft == 0){?>Сегодня Ваш день рождения. Скидка в 5% активирована! Поздравляем!<?php } else {?> Получите скидку 5% в день Вашего  рождения. <?php echo "До вашего дня рождения осталось {$daysLeft} дней" ?><?php } ?></h3>
        <a class="btn btn-outline-dark btn-lg" href="#tradeItems">Перейти к покупкам</a>
        </div>
        <div class="col gy-3"><h2>
            1500 бонусных балов ждут вас!
        </h2>
        <h3 class="text-muted"> Успей потратить их! <?php echo $message ?></h3>
        <a class="btn btn-outline-dark btn-lg" href="#tradeItems">Перейти к покупкам</a>
        </div>
        <div class="col gy-3"><img src="/images/inviteBonus.jpg" alt="bonus invite" class="rounded" style="height: 30em;"></div>
      </div>
      <div class="col" style="height: 1em;"></div>
    </div>
    <div class="container">
      <h2 class="display-3 text-center">
        Наши услуги
      </h2>
    </div>
    <!-- Услуги -->
    <div class="container overflow-hidden" id="tradeItems">
      <div class="row row-cols-3 text-center align-items-center gy-3">
        <div class="col">
          <img src="/images/faceEnj.jpg" alt="faceEnj" class="rounded d-block w-100">
        </div>
        <div class="col">
          <img src="/images/spaForOne.jpg" alt="spa for one" class="rounded d-block w-100">
        </div>
        <div class="col">
          <img src="/images/spaForTwo.jpg" alt="spa for two" class="rounded d-block w-100">
        </div>
        <div class="col">
          <h3 class="display-6">Уход за лицом</h3>
        </div>
        <div class="col">
          <h3 class="display-6">Спа-программы (на одного)</h3>
        </div>
        <div class="col">
          <h3 class="display-6">Спа-программы (на двоих)</h3>
        </div>
        <div class="col">
          <a class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#faceEnj">Узнать подробнее</a>
        </div>
        <div class="col">
          <a href="#" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#spaForOne">Узнать подробнее</a>
        </div>
        <div class="col">
          <a href="#" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#spaForTwo">Узнать подробнее</a>
        </div>
        <div class="col">
          <img src="/images/processForBody.jpg" alt="body processing" class="rounded d-block w-100">
        </div>
        <div class="col">
          <img src="/images/apparatingSpa.jpg" alt="apparating Spa" class="rounded d-block w-100">
        </div>
        <div class="col">
          <img src="/images/wrapping_1.jpg" alt="spa wrapping" class="rounded d-block w-100">
        </div>
        <div class="col">
          <h3 class="display-6">Процедуры для тела</h3>
        </div>
        <div class="col">
          <h3 class="display-6">Аппаратные процедуры</h3>
        </div>
        <div class="col">
          <h3 class="display-6">Обёртывания</h3>
        </div>
        <div class="col">
          <a href="#" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#bodyPro">Узнать подробнее</a>
        </div><div class="col">
          <a href="#" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#apparatingSpa">Узнать подробнее</a>
        </div><div class="col">
          <a href="#" class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#spaWrapping">Узнать подробнее</a>
        </div>
      </div>
      <div class="col" style="height: 1em;"></div>
    </div>
    <!-- Модальные окна услуг -->
    <div class="modal" tabindex="-1" id="faceEnj">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Уход за лицом</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 4500*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 4500 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 2 часа;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="spaForOne">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Спа-программы (на одного)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 5500*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 5500 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 3 часа;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="spaForTwo">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Спа-программы (на двоих)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 10000*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 10000 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 3 часа;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="bodyPro">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Процедуры для тела</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 15000*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 15000 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 5 часов;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="apparatingSpa">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Аппаратные процедуры</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 7000*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 7000 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 2 часа;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" id="spaWrapping">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Аппаратные процедуры</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <p><?php if($daysLeft==0){?>Стоимость услуги - <?php echo 6000*0.95 ?> р/сеанс;</p>
            <?php }else{?><p>Стоимость услуги - 6000 р/сеанс;</p><?php } ?>
            <p>Продолжительность - 2 часа;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            <button type="button" class="btn btn-primary">Записаться</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer>
      <div class="container-fluid text-center bg-dark text-light ">
        <div class="col p-1">
          <h6 class="font-monospace">desing by <a href="https://github.com/fdi619" class="link-light link-opacity-75-hover link-underline-opacity-0">FDI</a></h6>
        </div>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
  <?php
  }else{
    header('Location: /login.php');
  }
  ?>
</html>