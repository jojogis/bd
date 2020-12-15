<?php

declare(strict_types=1);
namespace View;
use Model\Project;
use Repository\abstract\ProjectRepositoryInterface;
use View\ViewInterface;

class ProjectsView implements ViewInterface
{
    private ProjectRepositoryInterface $rep;
    public function __construct(ProjectRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }

    public function render(): void
    {
        $projects = $this->rep->findAll();
        foreach ($projects as $i=>$project){
            if($i % 2 == 0)echo '<div class="row justify-content-center">';
            ?>
            <div class="col-md-5">
            <div class="card <?php if(!is_null($project->getRealReleaseDate()))echo "border-success "; ?>text-center">
                <div class="card-header">
                    <?=$this->rep->getBreadcrumbs($project->getId()); ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$project->getName(); ?></h5>
                    <p class="card-text">Версия: <?=$project->getVersion(); ?></p>
                    <p class="card-text"><?=$project->getIsByOrder() ? "По заказу" : "Не по заказу"; ?></p>
                    <a href="/db_app/projects/edit/<?=$project->getId(); ?>" class="btn btn-primary">Редактировать</a>
                    <?php if($project->getIsByOrder()){ ?><a href="/db_app/orders/view/<?=$project->getOrdersId(); ?>" class="btn btn-primary">Перейти к заказу</a><?php } ?>
                </div>
                <div class="card-footer text-muted">
                    Дедлайн: <?=$project->getPlannedReleaseDate()->format("Y-m-d"); ?><br>
                    <?php
                    if(!is_null($project->getRealReleaseDate())){
                        echo "Завершено: ".$project->getRealReleaseDate()->format("Y-m-d");
                    }else{
                        echo "Не завершено";
                    }
                    ?>


                </div>
            </div>

            </div>
            <br><br>




<?php
            if($i % 2 == 1 )echo '</div><br>';
        }

    }
}