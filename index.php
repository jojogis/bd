<?php

require_once 'vendor/autoload.php';

use View\OrderAddView;
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
use View\OrderEditView;
use Repository\CategoryRepository;
use View\FinancingView;
use Repository\ExternalFinancingRepository;
use View\ProjectAddView;

$route = explode('?', $_SERVER['REQUEST_URI'])[0];
$route = explode('/', $route);
$db = new DB();

if(count($route) == 5 && $route[3] == "remove"){
    if($route[2] == "financing"){
        $rep = new ExternalFinancingRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/financing');
    }else if($route[2] == "programmers"){
        $rep = new ProgrammerRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/programmers');
    }else if($route[2] == "projects"){
        $rep = new ProjectRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/projects');
    }else if($route[2] == "investors"){
        $rep = new InvestorRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/investors');
    }else if($route[2] == "orders"){
        $rep = new OrderRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/orders');
    }else if($route[2] == "tasks"){
        $rep = new TaskRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/tasks');
    }else if($route[2] == "customers"){
        $rep = new CustomerRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/customers');
    }else if($route[2] == "categories"){
        $rep = new CategoryRepository($db);
        $rep->delete(intval($route[4]));
        header('Location: /db_app/categories');
    }
}else if(count($route) == 4 && $route[3] == "save"){
    if($route[2] == "financing"){
        $rep = new ExternalFinancingRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/financing');
    }else if($route[2] == "projects"){
        $rep = new ProjectRepository($db);
        if(!isset($_GET["is_by_order"]))$_GET["is_by_order"] = 0;
        if(strlen($_GET["real_release_date"]) < 3)$_GET["real_release_date"] = null;
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/projects');
    }else if($route[2] == "orders"){
        $rep = new OrderRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/orders');
    }else if($route[2] == "customers"){
        $rep = new CustomerRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/customers');
    }else if($route[2] == "investors"){
        $rep = new InvestorRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/investors');
    }else if($route[2] == "programmers"){
        $rep = new ProgrammerRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/programmers');
    }else if($route[2] == "tasks"){
        $rep = new TaskRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/tasks');
    }else if($route[2] == "categories"){
        $rep = new CategoryRepository($db);
        $rep->update($rep->fromStringArray($_GET));
        header('Location: /db_app/categories');
    }
}else if(count($route) == 4 && $route[3] == "insert"){
    if($route[2] == "projects"){
        $rep = new ProjectRepository($db);
        if(!isset($_GET["is_by_order"]))$_GET["is_by_order"] = 0;
        if(strlen($_GET["real_release_date"]) < 3)$_GET["real_release_date"] = null;
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/projects');
    }else if($route[2] == "orders"){
        $rep = new OrderRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/orders');
    }else if($route[2] == "customers"){
        $rep = new CustomerRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/customers');
    }else if($route[2] == "investors"){
        $rep = new InvestorRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/investors');
    }else if($route[2] == "financing"){
        $rep = new ExternalFinancingRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/financing');
    }else if($route[2] == "programmers"){
        $rep = new ProgrammerRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/programmers');
    }else if($route[2] == "tasks"){
        $rep = new TaskRepository($db);
        if(strlen($_GET["real_finish_date"]) < 3)$_GET["real_finish_date"] = null;
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/tasks');
    }else if($route[2] == "categories"){
        $rep = new CategoryRepository($db);
        $rep->create($rep->fromStringArray($_GET));
        header('Location: /db_app/categories');
    }

}else if(count($route) == 3){
    require_once 'header.php';
    if($route[2] == "projects") {

        $rep = new ProjectRepository($db);
        $project = new ProjectsView($rep);
        $project->render();
    }else if($route[2] == "orders"){
        $rep = new OrderRepository($db);
        $projectRep = new ProjectRepository($db);
        $orders = new OrdersView($rep,$projectRep);
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
    }else if($route[2] == "financing"){
        $rep = new ExternalFinancingRepository($db);
        $projectRep = new ProjectRepository($db);
        $investorsRep = new InvestorRepository($db);
        $financing = new FinancingView($rep,$investorsRep,$projectRep);
        $financing->render();
    }else if($route[2] == "categories"){
        $rep = new CategoryRepository($db);
        $view = new \View\CategoriesView($rep);
        $view->render();
    }


}else if(count($route) == 5){
    require_once 'header.php';
    if($route[2] == "projects" && $route[3] == "edit"){
        $rep = new ProjectRepository($db);
        $rep1 = new CategoryRepository($db);
        $rep2 = new OrderRepository($db);
        $view = new ProjectEditView($rep,intval($route[4]),$rep1,$rep2);
        $view->render();
    }else if($route[2] == "orders" && $route[3] == "edit"){
        $rep = new OrderRepository($db);
        $customerRep = new CustomerRepository($db);
        $actsRep = new \Repository\ActOfCompletionRepository($db);
        $projectRep = new ProjectRepository($db);
        $view = new OrderEditView($rep,$customerRep,$actsRep,$projectRep,intval($route[4]));
        $view->render();
    }else if($route[2] == "investors" && $route[3] == "edit"){
        $rep = new InvestorRepository($db);
        $view = new \View\InvestorEditView($rep,intval($route[4]));
        $view->render();
    }else if($route[2] == "programmers" && $route[3] == "edit"){
        $rep = new ProgrammerRepository($db);
        $view = new \View\ProgrammerEditView($rep,intval($route[4]));
        $view->render();
    }else if($route[2] == "tasks" && $route[3] == "edit"){
        $rep = new TaskRepository($db);
        $projectRep = new ProjectRepository($db);
        $view = new \View\TaskEditView($rep,$projectRep,intval($route[4]));
        $view->render();
    }else if($route[2] == "customers" && $route[3] == "edit"){
        $rep = new CustomerRepository($db);
        $view = new \View\CustomerEditView($rep,intval($route[4]));
        $view->render();
    }else if($route[2] == "financing" && $route[3] == "edit"){
        $rep = new ExternalFinancingRepository($db);
        $projectRep = new ProjectRepository($db);
        $investorsRep = new InvestorRepository($db);
        $view = new \View\FinancingEditView($rep,$projectRep,$investorsRep,intval($route[4]));
        $view->render();
    }else if($route[2] == "categories" && $route[3] == "edit"){
        $rep = new CategoryRepository($db);
        $view = new \View\CategoryEditView($rep,intval($route[4]));
        $view->render();
    }else if($route[2] == "projects" && $route[3] == "add"){
        $rep1 = new CategoryRepository($db);
        $rep2 = new OrderRepository($db);
        $view = new ProjectAddView($rep1,$rep2);
        $view->render();
    }else if($route[2] == "orders" && $route[3] == "add"){
        $customerRep = new CustomerRepository($db);
        $actsRep = new \Repository\ActOfCompletionRepository($db);
        $projectRep = new ProjectRepository($db);
        $view = new OrderAddView($customerRep,$actsRep,$projectRep);
        $view->render();
    }else if($route[2] == "customers" && $route[3] == "add"){
        $view = new \View\CustomerAddView();
        $view->render();
    }else if($route[2] == "investors" && $route[3] == "add"){
        $view = new \View\InvestorAddView();
        $view->render();
    }else if($route[2] == "financing" && $route[3] == "add"){
        $projectRep = new ProjectRepository($db);
        $investorsRep = new InvestorRepository($db);
        $view = new \View\FinancingAddView($projectRep,$investorsRep);
        $view->render();
    }else if($route[2] == "programmers" && $route[3] == "add"){
        $view = new \View\ProgrammerAddView();
        $view->render();
    }else if($route[2] == "tasks" && $route[3] == "add"){
        $projectRep = new ProjectRepository($db);
        $view = new \View\TaskAddView($projectRep);
        $view->render();
    }else if($route[2] == "categories" && $route[3] == "add"){
        $rep = new CategoryRepository($db);
        $view = new \View\CategoriesAddView($rep);
        $view->render();
    }

}
$db->close();


?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(".date-input").mask("9999-99-99");

    })
    </script>
</body>
</html>
