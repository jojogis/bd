<?php


namespace View;
use Repository\abstract\ActOfCompletionRepositoryInterface;
use Repository\abstract\CustomerRepositoryInterface;
use Repository\abstract\OrderRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;
use View\ViewInterface;

class OrderEditView implements ViewInterface
{
    private OrderRepositoryInterface $rep;
    private CustomerRepositoryInterface $customerRep;
    private ActOfCompletionRepositoryInterface $actsRep;
    private ProjectRepositoryInterface $projectRep;
    private int $id;
    public function __construct(OrderRepositoryInterface $rep,CustomerRepositoryInterface $customerRep,ActOfCompletionRepositoryInterface $actsRep,ProjectRepositoryInterface $projectRep,int $id)
    {
        $this->rep = $rep;
        $this->id = $id;
        $this->customerRep = $customerRep;
        $this->actsRep = $actsRep;
        $this->projectRep = $projectRep;
    }
    public function render(): void
    {
        $order = $this->rep->findById($this->id);
        if(is_null($order)){?>
            <div class="row justify-content-center">
                <h3>Заказ не найден</h3>
            </div>
            <?php
        }else{

        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/orders/save">
                    <input type="hidden" name="id" value="<?= $order->getId();?>">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Сумма</span>
                        </div>
                        <input type="text" name="sum" value="<?= $order->getSum() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Описание</span>
                        </div>
                        <input type="text" name="description" value="<?= $order->getDescription() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input  type="text" placeholder="0000-00-00" aria-label="0000-00-00" name="deadline" value="<?= $order->getDeadline()->format("Y-m-d") ?>" class="date-input form-control" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дата</span>
                        </div>
                        <input type="text" name="date" value="<?= $order->getDate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Скан</span>
                        </div>
                        <input type="text" name="scan" value="<?= $order->getScan() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Заказчики</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="customers_id">
                            <?php
                            $customers = $this->customerRep->findAll();
                            foreach ($customers as $customer){
                                if($customer->getId() == $order->getCustomerId()){
                                    echo '<option selected value="'.$customer->getId().'">'.$customer->getName().'</option>';
                                }else{
                                    echo '<option value="'.$customer->getId().'">'.$customer->getName().'</option>';
                                }

                            }
                            ?>

                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Акт завершения</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect02" name="acts_of_completion_id">
                            <?php
                            $acts = $this->actsRep->findAll();
                            foreach ($acts as $act){
                                if($act->getId() == $order->getActOfCompletionId()){
                                    echo '<option selected value="'.$act->getId().'">'.$act->getScan().'</option>';
                                }else{
                                    echo '<option value="'.$act->getId().'">'.$act->getScan().'</option>';
                                }

                            }
                            ?>

                        </select>
                    </div>
                    <button type="submit" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                        </svg></button>
                    <a href="/db_app/projects/edit/<?=$this->projectRep->findByOrdersId($order->getId())->getId(); ?>" class="btn btn-primary">Перейти к проекту</a>
                </form>
            </div>
        </div>
        <?php
        }
    }
}