<?php


namespace View;
use View\ViewInterface;
use Repository\abstract\TaskRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;
class TasksView implements ViewInterface
{
    private TaskRepositoryInterface $rep;
    private ProjectRepositoryInterface $projectRep;
    public function __construct(TaskRepositoryInterface $rep,ProjectRepositoryInterface $projectRep)
    {
        $this->rep = $rep;
        $this->projectRep = $projectRep;
    }
    public function render(): void
    {
        $tasks = $this->rep->findAll();
        foreach ($tasks as $i=>$task){
            if($i % 2 == 0)echo '<div class="row justify-content-center">';
            ?>

            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-header">
                        <?=$task->getName(); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?=$task->getDescription(); ?></p>

                        <p class="card-text">Проект: <?=$this->projectRep->findById($task->getProjectId())->getName() ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        Дедлайн: <?=$task->getPlanFinishDate()->format("Y-m-d"); ?><br>
                        <?php
                        if(!is_null($task->getRealFinishDate())){
                            echo "Завершено: ".$task->getRealFinishDate()->format("Y-m-d");
                        }else{
                            echo "Не завершено";
                        }
                        ?>


                    </div>
                </div>

            </div>
            <?php
            if($i % 2 == 1 )echo '</div><br>';
        }

    }
}