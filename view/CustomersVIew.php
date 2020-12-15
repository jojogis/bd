<?php

declare(strict_types=1);
namespace View;
use View\ViewInterface;
use Model\Customer;
use Repository\abstract\CustomerRepositoryInterface;

class CustomersVIew implements ViewInterface
{
    private CustomerRepositoryInterface $rep;
    public function __construct(CustomerRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }

    public function render(): void
    {
        $customers = $this->rep->findAll();
        foreach ($customers as $i=>$customer){
        if($i % 2 == 0)echo '<div class="row justify-content-center">';
        ?>
<div class="col-md-5">
    <div class="card text-center">
        <div class="card-header">
            <?=$customer->getName(); ?>
        </div>
        <div class="card-body">
            <p class="card-text">Телефон: <?=$customer->getPhone(); ?></p>
            <p class="card-text">Адрес: <?=$customer->getAddress(); ?></p>
            <a href="/db_app/orders/?investor=<?=$customer->getId(); ?>" class="btn btn-primary">Просмотреть заказы</a>
        </div>

    </div>

</div>

            <?php
            if($i % 2 == 1 )echo '</div><br>';
        }

    }
}