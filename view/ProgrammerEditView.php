<?php


namespace View;


use Repository\abstract\ProgrammerRepositoryInterface;

class ProgrammerEditView implements ViewInterface
{
    private ProgrammerRepositoryInterface $rep;
    private int $id;
    public function __construct(ProgrammerRepositoryInterface $rep,int $id)
    {
        $this->rep = $rep;
        $this->id = $id;
    }
    public function render(): void
    {
       $programmer = $this->rep->findById($this->id);
        if(is_null($programmer)){?>
            <div class="row justify-content-center">
                <h3>Работник не найден</h3>
            </div>
            <?php
        }else{
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/programmers/save">
                    <input type="hidden" name="id" value="<?= $programmer->getId();?>">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">ФИО</span>
                        </div>
                        <input name="name" type="text" value="<?= $programmer->getName() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Специализация</span>
                        </div>
                        <input type="text" name="specialization" value="<?= $programmer->getSpecialization() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Телефон</span>
                        </div>
                        <input type="text" name="phone" value="<?= $programmer->getPhone() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Дата рождения</span>
                        </div>
                        <input type="text" name="birthdate" value="<?= $programmer->getBirthdate()->format("Y-m-d") ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
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
}