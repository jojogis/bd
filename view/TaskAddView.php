<?php


namespace View;


use Repository\abstract\ProjectRepositoryInterface;

class TaskAddView implements ViewInterface
{
    private ProjectRepositoryInterface $projectRep;
    public function __construct(ProjectRepositoryInterface $projectRep)
    {
        $this->projectRep = $projectRep;
    }
    public function render(): void
    {
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/tasks/insert">
                    <input type="hidden" name="id">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Имя</span>
                        </div>
                        <input name="name" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" name="plan_finish_date" class="date-input form-control" placeholder="0000-00-00" aria-label="0000-00-00" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Завершено</span>
                            <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>

                        <input type="text" name="real_finish_date" class="date-input form-control" placeholder="0000-00-00" aria-label="0000-00-00" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Проект</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="project_id">
                            <?php
                            $projects = $this->projectRep->findAll();
                            foreach ($projects as $project){
                                echo '<option value="'.$project->getId().'">'.$project->getName().'</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descriptionTextarea">Описание</label>
                        <textarea class="form-control" id="descriptionTextarea" name="description" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>

                </form>
            </div>
        </div>
        <?php
    }
}