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
                        <a class="dropdown-item" href="/db_app/">Проекты</a>
                        <a class="dropdown-item" href="/db_app/orders">Заказы</a>
                        <a class="dropdown-item" href="/db_app/customers">Заказчики</a>
                        <a class="dropdown-item" href="/db_app/investors">Инвесторы</a>
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
                        <a class="dropdown-item" href="/db_app/">Проект</a>
                        <a class="dropdown-item" href="/db_app/orders">Заказ</a>
                        <a class="dropdown-item" href="#">Категорию</a>
                        <a class="dropdown-item" href="/db_app/customers">Заказчика</a>
                        <a class="dropdown-item" href="/db_app/investors">Инвестора</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/db_app/programmers">Программиста</a>
                        <a class="dropdown-item" href="/db_app/tasks">Задачу</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search">
                <input class="form-control mr-sm-2" name="q" type="search" placeholder="Поиск" value="<?=empty($_GET['q']) ? '' : $_GET['q'] ?>" aria-label="Поиск">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg></button>
            </form>
        </div>
    </nav>
        </div>
    </div>
    <br>
    <br>

</div>
<div class="container">
<?php
require_once 'vendor/autoload.php';
use View\ProjectsView;
use Repository\ProjectRepository;
use Repository\OrderRepository;
use Repository\DB;
use View\OrdersView;
use View\InvestorsView;
use Repository\InvestorRepository;
use View\CustomersVIew;
use Repository\CustomerRepository;
use View\ProgrammersView;
use Repository\ProgrammerRepository;
use View\TasksView;
use Repository\TaskRepository;
use View\ProjectEditView;

$route = explode('?', $_SERVER['REQUEST_URI'])[0];
$route = explode('/', $route);
$db = new DB();
if(count($route) == 3){
    if($route[2] == "") {

        $rep = new ProjectRepository($db);
        $project = new ProjectsView($rep);
        $project->render();
    }else if($route[2] == "orders"){
        $rep = new OrderRepository($db);
        $orders = new OrdersView($rep);
        $orders->render();
    }else if($route[2] == "investors"){
        $rep = new InvestorRepository($db);
        $investors = new InvestorsView($rep);
        $investors->render();
    }else if($route[2] == "customers"){
        $rep = new CustomerRepository($db);
        $customers = new CustomersVIew($rep);
        $customers->render();
    }else if($route[2] == "programmers"){
        $rep = new ProgrammerRepository($db);
        $programmers = new ProgrammersView($rep);
        $programmers->render();
    }else if($route[2] == "tasks"){
        $rep = new TaskRepository($db);
        $projectRep = new ProjectRepository($db);
        $tasks = new TasksView($rep,$projectRep);
        $tasks->render();
    }


}else if(count($route) == 5){
    if($route[2] == "projects" && $route[3] == "edit"){
        $rep = new ProjectRepository($db);
        $project = new ProjectEditView($rep,intval($route[4]));
        $project->render();
    }
}
//var_dump($route);


?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
