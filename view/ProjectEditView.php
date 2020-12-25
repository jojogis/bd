<?php


namespace View;
use Repository\abstract\CategoryRepositoryInterface;
use Repository\abstract\OrderRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;
use View\ViewInterface;

class ProjectEditView implements ViewInterface
{
    private ProjectRepositoryInterface $rep;
    private CategoryRepositoryInterface $catRep;
    private OrderRepositoryInterface $orderRep;
    private int $id;
    public function __construct(ProjectRepositoryInterface $rep,int $id,CategoryRepositoryInterface $catRep,OrderRepositoryInterface $orderRep)
    {
        $this->rep = $rep;
        $this->id = $id;
        $this->catRep = $catRep;
        $this->orderRep = $orderRep;
    }

    public function render(): void
    {
        $project = $this->rep->findById($this->id);
        if(is_null($project)){?>
            <div class="row justify-content-center">
                <h3>Проект не найден</h3>
            </div>
            <?php
        }else{
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/projects/save">
                    <input type="hidden" name="id" value="<?= $project->getId();?>">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Название</span>
                        </div>
                        <input type="text" name="name" value="<?= $project->getName() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" name="planned_release_date" value="<?= $project->getPlannedReleaseDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Завершено</span>
                            <div class="input-group-text">
                                <input  type="checkbox" <?=is_null($project->getRealReleaseDate()) ? "" : "checked"; ?> aria-label="Checkbox for following text input">
                            </div>
                        </div>

                        <input type="text" name="real_release_date" value="<?= is_null($project->getRealReleaseDate()) ? "" : $project->getRealReleaseDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Версия</span>
                        </div>
                        <input type="text" name="version" value="<?= $project->getVersion() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="categories_id">
                            <?php
                            $cats = $this->catRep->findAll();
                            foreach ($cats as $cat){
                                if($cat->getId() == $project->getCategoriesId()){
                                    echo '<option selected value="'.$cat->getId().'">'.$cat->getName().'</option>';
                                }else{
                                    echo '<option value="'.$cat->getId().'">'.$cat->getName().'</option>';
                                }

                            }
                            ?>

                        </select>
                    </div>
                    <?php if($project->getIsByOrder()){ ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Заказ</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect02" name="orders_id">
                            <?php
                            $orders = $this->orderRep->findAll();
                            foreach ($orders as $order){
                                if($order->getId() == $project->getOrdersId()){
                                    echo '<option selected value="'.$order->getId().'">'.$order->getDescription().'</option>';
                                }else{
                                    echo '<option value="'.$order->getId().'">'.$order->getDescription().'</option>';
                                }

                            }
                            ?>

                        </select>
                    </div>
                    <?php } ?>
                    <div class="form-group form-check">
                        <input type="checkbox" name="is_by_order" class="form-check-input" <?= $project->getIsByOrder() ? "checked" : "" ?> id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">По заказу</label>
                    </div>
                    <button type="submit" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                        </svg></button>
                    <?php if($project->getIsByOrder()){ ?><a href="/db_app/orders/edit/<?=$project->getOrdersId(); ?>" class="btn btn-primary">Перейти к заказу</a><?php } ?>
                </form>
            </div>
        </div>
    <?php
        }
    }
}