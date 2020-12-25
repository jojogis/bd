<?php


namespace View;


use Repository\abstract\CategoryRepositoryInterface;

class CategoriesAddView implements ViewInterface
{
    private CategoryRepositoryInterface $rep;
    public function __construct(CategoryRepositoryInterface $rep)
    {
        $this->rep = $rep;

    }

    public function render(): void
    {
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="/db_app/categories/insert">
                    <input type="hidden" name="id">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Название</span>
                        </div>
                        <input name="name" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Родительская категория</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect02" name="parent_id">
                            <option value="null">null</option>
                            <?php
                            $cats = $this->rep->findAll();
                            foreach ($cats as $cat){
                                echo '<option value="' . $cat->getId() . '">' . $cat->getName() . '</option>';

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