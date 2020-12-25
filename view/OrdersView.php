<?php

declare(strict_types=1);
namespace View;


use Repository\abstract\OrderRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;

class OrdersView implements ViewInterface
{
    private OrderRepositoryInterface $rep;
    private ProjectRepositoryInterface $projectRep;
    public function __construct(OrderRepositoryInterface $rep,ProjectRepositoryInterface $projectRep)
    {
        $this->rep = $rep;
        $this->projectRep = $projectRep;
    }


    public function render(): void
    {

    if(isset($_GET['customer'])){
        $orders = $this->rep->filter(customerId : intval($_GET['customer']) );
    }else{
        $orders = $this->rep->findAll();
    }
        foreach ($orders as $i=>$order) {
            if($i % 2 == 0)echo '<div class="row justify-content-center">';
    ?>
            <div class="col-md-5">
                <div class="card <?php if($order->getActOfCompletionId() != 0 )echo "border-success "; ?>text-center">
                    <div class="card-header <?php if($order->getActOfCompletionId() != 0 )echo "bg-success text-white"; ?>">
                        <?=$order->getDate()->format("Y-m-d"); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?=$order->getDescription(); ?></p>
                        <p class="card-text"><?=$order->getSum(); ?> руб.</p>
                        <a href="/db_app/orders/edit/<?=$order->getId(); ?>" class="btn btn-info"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg></a>
                        <a href="/db_app/orders/remove/<?=$order->getId()?>" class="btn btn-danger"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg></a>
                        <a target="_blank" href="/db_app/assets/<?=$order->getScan(); ?>" class="btn btn-dark"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                            </svg></a>
                        <?php
                            $project = $this->projectRep->findByOrdersId($order->getId());
                            if(!is_null($project)){
                        ?>
                        <a href="/db_app/projects/edit/<?=$project->getId(); ?>" class="btn btn-primary">Перейти к проекту</a>
                                <?php } ?>

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