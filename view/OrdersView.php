<?php

declare(strict_types=1);
namespace View;

use Repository\OrderRepository;
use Repository\abstract\OrderRepositoryInterface;

class OrdersView implements ViewInterface
{
    private OrderRepositoryInterface $rep;
    public function __construct(OrderRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }


    public function render(): void
    {
        $orders = $this->rep->findAll();

        foreach ($orders as $i=>$order) {
            if($i % 2 == 0)echo '<div class="row justify-content-center">';
    ?>
            <div class="col-md-5">
                <div class="card <?php if($order->getActOfCompletionId() != 0 )echo "border-success "; ?>text-center">
                    <div class="card-header">
                        <?=$order->getDate()->format("Y-m-d"); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?=$order->getDescription(); ?></p>
                        <p class="card-text"><?=$order->getSum(); ?> руб.</p>
                        <a href="/db_app/orders/edit/<?=$order->getId(); ?>" class="btn btn-primary">Редактировать</a>
                        <a target="_blank" href="/db_app/assets/<?=$order->getScan(); ?>" class="btn btn-primary">Скачать скан</a>

                    </div>
                    <div class="card-footer text-muted">
                        Дедлайн: <?=$order->getDeadline()->format("Y-m-d"); ?><br>
                    </div>
                </div>

            </div>
            <br><br>


            <?php
            if($i % 2 == 1 )echo '</div><br>';
        }
    }
}