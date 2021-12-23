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
                <!-- <?= $this->Form->postLink(__('d'), ['action' => 'delete', $todo->id], ['class' => 'fa fa-trash fa-2x text-danger', 'title' => 'Delete', 'confirm' => __('Are you sure you want to delete this item?', $todo->id)]) ?> -->

                <a class="btn btn-dark text-white m-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'index']); ?>" title='List Todo'>
                    <span class="fa fa-bars fa-1x "></span> Todo List
                </a>
                <a class="btn btn-info text-white m-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'add']); ?>" title='Add Todo'>
                    <span class="fa fa-plus fa-1x "></span> Add Todo
                </a>

                <span class="btn btn-danger fa fa-trash fa-1x m-2 p-2 text-white">
                    <?= $this->Form->postLink(__('Delete'), ['class' => ' fa fa-trash fa-2x text-danger text-white', 'action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id)]) ?> </span>
            </ul>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-6">
            <h3 style="display: inline;"><?= h($todo->title) ?></h3>
            <em class="<?php
                        if (h($todo->status) == 'Uncompleted') {
                            echo "text-danger";
                        } elseif (h($todo->status) == 'Completed') {
                            echo "text-success";
                        } else {
                            echo "text-warning";
                        }  ?>"><?= h($todo->status) ?></em>
            <table class="vertical-table">
                <tr>
                    <th scope="row"><?= __('Created At') ?></th>
                    <td><?= h($todo->created_at) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Scheduled Time') ?></th>
                    <td><?= h($todo->scheduled_time) ?></td>
                </tr>
            </table>
            <div class="row mt-5">
                <h4><?= __('Description') ?></h4>
                <?= $this->Text->autoParagraph(h($todo->description)); ?>
            </div>
        </div>
    </div>
</div>