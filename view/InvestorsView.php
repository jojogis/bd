<?php

declare(strict_types=1);
namespace View;
use View\ViewInterface;
use Model\Investor;
use Repository\abstract\InvestorRepositoryInterface;

class InvestorsView implements ViewInterface
{

    private InvestorRepositoryInterface $rep;

    public function __construct(InvestorRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }

    public function render(): void
    {
        $investors = $this->rep->findAll();

        foreach ($investors as $i=>$investor){
            if($i % 2 == 0)echo '<div class="row justify-content-center">';
        ?>
            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-header">
                        <?=$investor->getName(); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Телефон: <?=$investor->getPhone(); ?></p>
                        <p class="card-text">Адрес: <?=$investor->getAddress(); ?></p>
                        <a href="/db_app/financing/?investor=<?=$investor->getId(); ?>" class="btn btn-primary">Просмотреть инвестиции</a>
                    </div>

                </div>

            </div>

            <?php
            if($i % 2 == 1 )echo '</div><br>';
        }

    }
}