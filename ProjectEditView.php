<?php


namespace View;
use Repository\abstract\ProjectRepositoryInterface;
use View\ViewInterface;

class ProjectEditView implements ViewInterface
{
    private ProjectRepositoryInterface $rep;
    private int $id;
    public function __construct(ProjectRepositoryInterface $rep,int $id)
    {
        $this->rep = $rep;
        $this->id = $id;
    }

    public function render(): void
    {
        $project = $this->rep->findById($this->id);
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Название</span>
                        </div>
                        <input type="text" value="<?= $project->getName() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" value="<?= $project->getPlannedReleaseDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Завершено</span>
                            <div class="input-group-text">
                                <input type="checkbox" <?=is_null($project->getRealReleaseDate()) ? "" : "checked"; ?> aria-label="Checkbox for following text input">
                            </div>
                        </div>

                        <input type="text" value="<?= is_null($project->getRealReleaseDate()) ? "" : $project->getRealReleaseDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Версия</span>
                        </div>
                        <input type="text" value="<?= $project->getVersion() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" <?= $project->getIsByOrder() ? "checked" : "" ?> id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">По заказу</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    <?php
    }
}