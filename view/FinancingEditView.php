<?php


namespace View;


use Repository\abstract\ExternalFinancingRepositoryInterface;
use Repository\abstract\InvestorRepositoryInterface;
use Repository\abstract\ProjectRepositoryInterface;

class FinancingEditView implements ViewInterface
{
    private ExternalFinancingRepositoryInterface $rep;
    private ProjectRepositoryInterface $projectRep;
    private InvestorRepositoryInterface $investRep;
    private int $id;
    public function __construct(ExternalFinancingRepositoryInterface $rep,ProjectRepositoryInterface $projectRep,InvestorRepositoryInterface $investRep,int $id)
    {
        $this->projectRep = $projectRep;
        $this->investRep = $investRep;
        $this->rep = $rep;
        $this->id = $id;
    }
    public function render(): void
    {
        $financing = $this->rep->findById($this->id);
        if(is_null($financing)){?>
            <div class="row justify-content-center">
                <h3>Инвестор не найден</h3>
            </div>
        <?php
        }else{
        ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="/db_app/financing/save">
                        <input type="hidden" name="id" value="<?= $financing->getId();?>">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Сумма</span>
                            </div>
                            <input name="total" type="text" value="<?= $financing->getTotal() ?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Проект</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="project_id">
                                <?php
                                $projects = $this->projectRep->findAll();
                                foreach ($projects as $project){
                                    if($project->getId() == $financing->getProjectId()){
                                        echo '<option selected value="'.$project->getId().'">'.$project->getName().'</option>';
                                    }else{
                                        echo '<option value="'.$project->getId().'">'.$project->getName().'</option>';
                                    }

                                }
                                ?>

                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Инвестор</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01" name="investor_id">
                                <?php
                                $investors = $this->investRep->findAll();
                                foreach ($investors as $investor){
                                    if($investor->getId() == $financing->getInvestorId()){
                                        echo '<option selected value="'.$investor->getId().'">'.$investor->getName().'</option>';
                                    }else{
                                        echo '<option value="'.$investor->getId().'">'.$investor->getName().'</option>';
                                    }

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
}