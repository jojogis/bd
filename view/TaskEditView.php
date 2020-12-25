<?php


namespace View;


use Repository\abstract\TaskRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;


class TaskEditView implements ViewInterface
{
    private TaskRepositoryInterface $rep;
    private ProjectRepositoryInterface $projectRep;
    private int $id;
    public function __construct(TaskRepositoryInterface $rep,ProjectRepositoryInterface $projectRep,int $id)
    {
        $this->rep = $rep;
        $this->id = $id;
        $this->projectRep = $projectRep;
    }
    public function render(): void
    {
        $task = $this->rep->findById($this->id);
        if(is_null($task)){?>
            <div class="row justify-content-center">
                <h3>Задача не найдена</h3>
            </div>
            <?php
        }else{
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/tasks/save">
                    <input type="hidden" name="id" value="<?= $task->getId() ?>">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Имя</span>
                        </div>
                        <input name="name" type="text" value="<?= $task->getName() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" name="plan_finish_date" value="<?= $task->getPlanFinishDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Завершено</span>
                            <div class="input-group-text">
                                <input  type="checkbox" <?=is_null($task->getRealFinishDate()) ? "" : "checked"; ?> aria-label="Checkbox for following text input">
                            </div>
                        </div>

                        <input type="text" name="real_finish_date" value="<?= is_null($task->getRealFinishDate()) ? "" : $task->getRealFinishDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Проект</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="project_id">
                            <?php
                            $projects = $this->projectRep->findAll();
                            foreach ($projects as $project){
                                if($project->getId() == $task->getProjectId()){
                                    echo '<option selected value="'.$project->getId().'">'.$project->getName().'</option>';
                                }else{
                                    echo '<option value="'.$project->getId().'">'.$project->getName().'</option>';
                                }

                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descriptionTextarea">Описание</label>
                        <textarea class="form-control" id="descriptionTextarea" name="description" rows="3"><?=$task->getDescription()?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                        </svg></button>
                    <a href="/db_app/projects/edit/<?=$task->getProjectId()?>" class="btn btn-primary">Перейти к проекту</a>
                </form>
            </div>
        </div>
<?php
        }
    }
}