<?php
session_start();

require __DIR__ . '/function.php';

if (!empty($_POST['login']) && !empty($_POST['password'])){
  $login = $_POST['login'];
  $password = $_POST['password'];
  if(checkPassword($login, $password) == true){
    $_SESSION['auth'] = true;

    $_SESSION['username'] = $login;
    $_SESSION['password'] = $password;
    $auth = $_SESSION['auth'] ?? null;
    if($auth){

      header('Location: /index.php');
    }

  };
};

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
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Переключатель навигации"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"
                  >Главная</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#registerModal">Регистрация</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginInModal">Войти</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Выйти</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Модальные окна для входа и регистрации -->
      <form action=" " method="post">
        <div class="modal fade" id="loginInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Войти</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="login">
                  <div id="emailHelp" class="form-text">Введите адрес электронной почты указвнный при регистрации</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Пароль</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp" name="password">
                  <div id="passwordHelp" class="form-text">Введите ваш пароль</div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Войти</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <form action="registration.php" method="post">
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Регистрация</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="login">
                    <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordHelp" name="password">
                    <div id="passwordHelp" class="form-text">Придумайте надёжный пароль</div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </header>
    <!-- Приветственная информация -->
    <div class="container text-center">
      <div class="col" style="height: 5em"></div>
      <div class="row" id="mainInfo" style="align-items: center;">
        <div class="col-7">
          <p><h2 class="text-muted display-5">Добро пожаловать и ждём Вас у нас в гостях!</h2></p>
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
        <h3 class="text-muted">Зарегистрируйся на сайте, и получите скидку в 5% в день Вашего  рождения</h3>
        <a class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</a>
        </div>
        <div class="col gy-3"><h2>
          Бонус за регистрацию
        </h2>
        <h3 class="text-muted">Получи приветсвенные бонусы за регистрацию на сайте.</h3>
        <a class="btn btn-outline-dark btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</a>
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
            <p>Стоимость услуги - 4500 р/сеанс;</p>
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
            <p>Стоимость услуги - 5500 р/сеанс;
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
            <p>Стоимость услуги - 10000 р/сеанс;
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
            <p>Стоимость услуги - 15000 р/сеанс;</p>
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
            <p>Стоимость услуги - 7000 р/сеанс;</p>
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
            <p>Стоимость услуги - 6000 р/сеанс;</p>
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
</html>
