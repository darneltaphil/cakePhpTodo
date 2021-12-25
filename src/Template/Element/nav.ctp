<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only"></span>
        </button>
    </div>
    <div class="p-4">
        <h1><a href=<?= $this->Url->build(['controller' => 'todos', 'action' => 'index']); ?> class="logo">Todo List <span></span></a></h1>
        <ul class="text-white mb-5">
            <a href=<?= $this->Url->build(['controller' => 'todos', 'action' => 'index', 'key' => null, 'day' => 'all']); ?> class="logo">
                <span class="btn btn-light p-2 fa fa-home mr-3"> All Todos </span>
            </a>

            <!-- <form method="get" action=<?php $_SERVER['PHP_SELF'] ?>>
                <input name='day' type="date" value="<?= $this->request->getQuery('day') ?>"><button>go</button>
            </form>
 -->
        </ul>

    </div>
</nav>
