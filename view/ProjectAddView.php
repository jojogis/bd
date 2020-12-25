<?php


namespace View;


use Repository\abstract\CategoryRepositoryInterface;
use Repository\abstract\OrderRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;

class ProjectAddView implements ViewInterface
{
    private CategoryRepositoryInterface $catRep;
    private OrderRepositoryInterface $orderRep;
    public function __construct(CategoryRepositoryInterface $catRep,OrderRepositoryInterface $orderRep)
    {
        $this->catRep = $catRep;
        $this->orderRep = $orderRep;
    }

    public function render(): void
    {?>
         <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/projects/insert">
                    <input type="hidden" name="id" value="NULL" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Название</span>
                        </div>
                        <input type="text" required name="name" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" required placeholder="0000-00-00" aria-label="0000-00-00" name="planned_release_date" class="date-input form-control" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Завершено</span>
                            <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>

                        <input type="text" name="real_release_date" class="date-input form-control" placeholder="0000-00-00" aria-label="0000-00-00" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Версия</span>
                        </div>
                        <input type="text" required name="version" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Категория</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="categories_id">
                            <?php
                            $cats = $this->catRep->findAll();
                            foreach ($cats as $cat){
                                echo '<option value="'.$cat->getId().'">'.$cat->getName().'</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Заказ</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect02" name="orders_id">
                            <?php
                            $orders = $this->orderRep->findAll();
                            foreach ($orders as $order){
                                echo '<option value="'.$order->getId().'">'.$order->getDescription().'</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="is_by_order" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">По заказу</label>
                    </div>
                    <button type="submit" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                        </svg></button>
                </form>
            </div>
        </div>
    <?php
    }
}