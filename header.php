<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>БД</title>
    <link href="/db_app/assets/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="no-gutters">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/db_app">IT CORP</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/db_app">Главная</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Элементы
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/db_app/projects">Проекты</a>
                                <a class="dropdown-item" href="/db_app/orders">Заказы</a>
                                <a class="dropdown-item" href="/db_app/customers">Заказчики</a>
                                <a class="dropdown-item" href="/db_app/investors">Инвесторы</a>
                                <a class="dropdown-item" href="/db_app/categories">Категории</a>
                                <a class="dropdown-item" href="/db_app/financing">Финансирования</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/db_app/programmers">Программисты</a>
                                <a class="dropdown-item" href="/db_app/tasks">Задачи</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Добавить
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/db_app/projects/add/">Проект</a>
                                <a class="dropdown-item" href="/db_app/orders/add/">Заказ</a>
                                <!--<a class="dropdown-item" href="/db_app/categories/add/">Категорию</a>-->
                                <a class="dropdown-item" href="/db_app/customers/add/">Заказчика</a>
                                <a class="dropdown-item" href="/db_app/investors/add/">Инвестора</a>
                                <a class="dropdown-item" href="/db_app/financing/add/">Финансирование</a>
                                <a class="dropdown-item" href="/db_app/categories/add/">Категорию</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/db_app/programmers/add/">Программиста</a>
                                <a class="dropdown-item" href="/db_app/tasks/add/">Задачу</a>
                            </div>
                        </li>
                    </ul>
                    <!--<form class="form-inline my-2 my-lg-0" action="search">
                        <input class="form-control mr-sm-2" name="q" type="search" placeholder="Поиск" value="<?=empty($_GET['q']) ? '' : $_GET['q'] ?>" aria-label="Поиск">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg></button>
                    </form>-->
                </div>
            </nav>
        </div>
    </div>
    <br>
    <br>

</div>
<div class="container">