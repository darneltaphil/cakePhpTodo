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
                <a class="btn btn-primary text-white m-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'edit', $todo->id]); ?>" title='Edit Todo'>
                    <span class="fa fa-edit fa-1x "></span> Edit
                </a>
                <span class="btn btn-danger fa fa-trash fa-1x m-2 p-2 text-white">
                    <?= $this->Form->postLink(__('Delete'), ['class' => ' fa fa-trash fa-2x text-danger text-white', 'action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id)]) ?> </span>
            </ul>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6">
            <h3 style="display: inline;"><?= h($todo->title) ?></h3>
            <?= $this->Form->create($todo) ?>
            <fieldset>
                <legend><?= __('Edit Todo') ?></legend>
                <?php
                echo $this->Form->control('title');
                echo $this->Form->control('description');
                echo $this->Form->control('scheduled_time');
                echo $this->Form->control('status');
                echo $this->Form->control('created_at');
                echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<!-- <div class="todos form large-9 medium-8 columns content">
    <?= $this->Form->create($todo) ?>
    <fieldset>
        <legend><?= __('Edit Todo') ?></legend>
        <?php
        echo $this->Form->control('title');
        echo $this->Form->control('description');
        echo $this->Form->control('scheduled_time');
        echo $this->Form->control('status');
        echo $this->Form->control('created_at');
        echo $this->Form->control('updated_at');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->