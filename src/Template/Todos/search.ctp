<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo[]|\Cake\Collection\CollectionInterface $todos
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8  col-lg-8 col-md-8  col-sm-6">
            <h3 style="display: inline;"><?= __('Todos');    ?></h3><a class="btn btn-primary text-white mx-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'add']); ?>" title='Add New Todo'>
                <span class="fa fa-plus fa-1x "></span> Add Todo
            </a>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <?= $this->Form->create(null, ['type' => 'get'])    ?>
            <?= $this->Form->control('key', ['label' => '', 'style' => 'display:inline', 'value' => $this->request->getQuery('key'), 'placeholder' => 'Search', 'class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-6'])    ?>
            <!-- <?= $this->Form->submit(['style' => 'display:inline',])    ?> -->
            <?= $this->Form->end()    ?>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
            <table cellpadding="0" cellspacing="0" class="table table-hover vw-90">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('scheduled_time') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($search as $todo) : ?>
                        <?php $time = explode(',', $todo->scheduled_time) ?>
                        <tr>
                            <!-- <td><?= h($todo->scheduled_time) ?></td> -->
                            <td><?= h($time[1]) ?></td>
                            <td><?= h($todo->title) ?></td>
                            <td><?= h($todo->status) ?></td>
                            <td class="actions">
                                <a class="mx-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'view', $todo->id]); ?>" title='View'>
                                    <span class="fa fa-eye fa-1x text-dark"></span>
                                </a>
                                <a class="mx-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'edit', $todo->id]); ?>" title='Edit'>
                                    <span class="fa fa-edit fa-1x text-primary"></span>
                                </a>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $todo->id], ['class' => 'fa fa-trash fa-1x text-danger', 'title' => 'Delete', 'confirm' => __('Are you sure you want to delete this item?', $todo->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>