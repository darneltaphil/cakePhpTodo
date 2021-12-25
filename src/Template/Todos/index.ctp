<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo[]|\Cake\Collection\CollectionInterface $todos
 */
?>

<div class="container-fluid">
    <div class="row shadow p-5 rounded justify-content-center align-center">
        <div class="col-xl-4  col-lg-4 col-md-4  col-sm-6">
            <h5 class="text-primary" style="display: ;"><?= __('Pending');    ?></h5>
            <div class=" display-4" title='Pending Todos'>
                <span class="fa fa-spinner fa-1x "></span><?= $dashboard['pending'] ?>
            </div>
        </div>
        <div class="col-xl-4  col-lg-4 col-md-4  col-sm-6">
            <h5 class="text-success"><?= __('Completed');    ?></h5>
            <div class=" display-4 mx-2" title='Completed Todos'>
                <span class="fa fa-check fa-1x "></span> <?= $dashboard['completed'] ?>
            </div>
        </div>
        <div class="col-xl-4  col-lg-4 col-md-4  col-sm-6">
            <h5 class="text-danger"><?= __('Failed');    ?></h5>
            <div class="display-4 mx-2" title='Failed Todos'>
                <span class="fa fa-ban fa-1x "></span> <?= $dashboard['failed'] ?>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">

            <a class="btn btn-primary text-white mx-2 my-2" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'add']); ?>" title='Add New Todo'>
                <span class="fa fa-plus fa-1x "></span> Add Todo
            </a>
            <div class="btn-group" role="group" aria-label="Basic example">
                <span class="btn btn-dark text-white  my-2 exportPdf" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'exportpdf', 'key' => $this->request->getQuery('key')]); ?>" title='Export PDF'>
                    <span class="fa fa-file-pdf-o fa-1x "></span> PDF
                </span>
                <a class="btn btn-info text-white my-2 exportXml" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'exportxml', 'key' =>  $this->request->getQuery('key')]); ?>" title='Export XML'>
                    <span class="fa fa-file-code-o fa-1x "></span> XML
                </a>
            </div>

        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
            <form style="display:inline;">
                <a href=<?= $this->Url->build(['controller' => 'todos', 'action' => 'index', 'key' => null, 'day' => 'all']); ?> class="logo">
                    <span class="btn btn-primary my-2">All Todos</span>
                </a>
                <input id="day" name='day' type="date" value="<?= $this->request->getQuery('day') ?>">
                <input id="type" type="checkbox" name="type" value="">Search in All
                <input id="key" name='key' type="text" value="<?= $this->request->getQuery('key') ?>" placeholder="Search">
                <button class="btn btn-primary">go</button>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
            <table cellpadding="0" cellspacing="0" class="table table-hover vw-90">
                <thead>
                    <tr>
                        <!-- <th scope="col"><?= $this->Paginator->sort('scheduled_time') ?></th> -->
                        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (sizeof($todos) == 0) { ?>
                        <tr>
                            <td colspan=3>
                                <span class="btn btn-danger  m-0 ">
                                    <small>No schedule</small>
                                </span>

                            </td>
                        </tr>
                        <?php
                    } else {
                        foreach ($todos as $todo) : ?>
                            <?php $time = explode(',', $todo->scheduled_time);
                            $date = date_create($todo->scheduled_date . ' ' . $time[1]);
                            ?>
                            <tr>
                                <td>
                                    <span class="btn btn-light p-1 m-0 small">
                                        <small><?= h(date_format($date, 'Y M, jS - g:ia (l)   ')) ?></small>
                                    </span>
                                    <b><?= h($todo->title) ?></b>
                                </td>
                                <td><?= h($todo->status) ?></td>
                                <td class="actions">
                                    <a class="mx-4" href=" <?= $this->Url->build(['controller' => 'todos', 'action' => 'view', $todo->id]); ?>" title='View'>
                                        <span class="fa fa-eye fa-2x text-dark"></span>
                                    </a>

                                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $todo->id], ['class' => 'fa fa-trash fa-2x text-danger', 'title' => 'Delete', 'confirm' => __('Are you sure you want to delete this item?', $todo->id)]) ?>
                                </td>
                            </tr>
                    <?php endforeach;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
