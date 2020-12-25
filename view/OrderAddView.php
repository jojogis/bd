<?php


namespace View;


use Repository\abstract\ActOfCompletionRepositoryInterface;
use Repository\abstract\CustomerRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;

class OrderAddView implements ViewInterface
{
    private CustomerRepositoryInterface $customerRep;
    private ActOfCompletionRepositoryInterface $actsRep;
    private ProjectRepositoryInterface $projectRep;
    public function __construct(CustomerRepositoryInterface $customerRep,ActOfCompletionRepositoryInterface $actsRep,ProjectRepositoryInterface $projectRep)
    {
        $this->customerRep = $customerRep;
        $this->actsRep = $actsRep;
        $this->projectRep = $projectRep;
    }
    public function render(): void
    {?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/orders/insert">
                    <input type="hidden" name="id" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Сумма</span>
                        </div>
                        <input type="text" name="sum" required class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Описание</span>
                        </div>
                        <input type="text" name="description" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дедлайн</span>
                        </div>
                        <input type="text" name="deadline" required placeholder="0000-00-00" aria-label="0000-00-00" class="date-input form-control" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дата</span>
                        </div>
                        <input type="text" name="date" required class="date-input form-control" placeholder="0000-00-00" aria-label="0000-00-00" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Скан</span>
                        </div>
                        <input type="text" name="scan" required class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Заказчики</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="customers_id">
                            <?php
                            $customers = $this->customerRep->findAll();
                            foreach ($customers as $customer){
                                    echo '<option value="'.$customer->getId().'">'.$customer->getName().'</option>';
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
                                    echo '<option value="'.$act->getId().'">'.$act->getScan().'</option>';
                            }
                            ?>

                        </select>
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