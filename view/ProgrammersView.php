<?php

declare(strict_types=1);
namespace View;
use View\ViewInterface;
use Repository\abstract\ProgrammerRepositoryInterface;

class ProgrammersView implements ViewInterface
{
    private ProgrammerRepositoryInterface $rep;
    public function __construct(ProgrammerRepositoryInterface $rep)
    {
        $this->rep = $rep;
    }

    public function render(): void
    {
        $programmers = $this->rep->findAll();

        foreach ($programmers as $i=>$programmer){
        if($i % 2 == 0)echo '<div class="row justify-content-center">';
        ?>
            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-header">
                        <?=$programmer->getName(); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Дата рождения: <?=$programmer->getBirthdate()->format("Y-m-d");; ?></p>
                        <p class="card-text">Телефон: <?=$programmer->getPhone(); ?></p>
                        <p class="card-text">Специализация: <?=$programmer->getSpecialization(); ?></p>
                        <a href="/db_app/tasks/?programmer=<?=$programmer->getId(); ?>" class="btn btn-primary">Просмотреть задачи</a>
                    </div>

                </div>

            </div>
            <?php
            if($i % 2 == 1 )echo '</div><br>';
        }

    }
}