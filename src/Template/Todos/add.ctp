<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo $todo
 */
?>
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
            <ul class="side-nav">
                <a class="btn btn-dark text-white m-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'index']); ?>" title='List Todo'>
                    <span class="fa fa-bars fa-1x "></span> Todo List
                </a>
            </ul>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6">
            <?= $this->Form->create($todo) ?>
            <fieldset>
                <legend><?= __('Add Todo') ?></legend>
                <?php
                //$status = $this->set('groups', $this->Todostatus->find('list')->all());
                echo $this->Form->control('title', ['class' => ' border-10']);
                echo $this->Form->control('description');
                echo $this->Form->control('scheduled_date', ['type' => 'date']);
                echo $this->Form->control('scheduled_time', ['type' => 'time']);
                echo $this->Form->control('status', ['options' => ['Completed' => 'Completed', 'Failed' => 'Failed', 'Pending' => 'Pending']]);
                // echo $this->Form->control('created_at');
                // echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
