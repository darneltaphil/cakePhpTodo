<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Todos Controller
 *
 * @property \App\Model\Table\TodosTable $Todos
 *
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TodosController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout('todo');
    }
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->Todos->find('all')
                ->where([
                    'OR' => [
                        'title like' => '%' . $key . '%',
                        'description like' => '%' . $key . '%',
                        'status like' => '%' . $key . '%',
                    ]
                ])->order('scheduled_time ASC');
            // debug($query);
            // exit;
        } else {
            $query = $this->Todos->find()->order('scheduled_time ASC');
        }
        // $query = $this->Todos->find()->order('scheduled_time ASC');

        $todos = $this->paginate($query);
        $this->set('todos', $todos);

        $query = $this->Todos->find()
            ->where([
                'status like' => '%Completed%',
            ]);
        $completed = $this->paginate($query);
        $this->set('completed', sizeof($completed));

        $query = $this->Todos->find()
            ->where([
                'status like' => '%Pending%',
            ]);
        $pending = $this->paginate($query);
        $this->set('pending', sizeof($pending));

        $query = $this->Todos->find()
            ->where([
                'status like' => '%Failed%',
            ]);
        $failed = $this->paginate($query);
        $this->set('failed', sizeof($failed));
    }

    /**
     * View method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);

        $this->set('todo', $todo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $todo = $this->Todos->newEntity();
        if ($this->request->is('post')) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $this->set(compact('todo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $this->set(compact('todo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $todo = $this->Todos->get($id);
        if ($this->Todos->delete($todo)) {
            $this->Flash->success(__('The todo has been deleted.'));
        } else {
            $this->Flash->error(__('The todo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function exportpdf()
    {
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->Todos->find('all')
                ->where([
                    'OR' => [
                        'title like' => '%' . $key . '%',
                        'description like' => '%' . $key . '%',
                        'status like' => '%' . $key . '%',
                    ]
                ])->order('scheduled_time ASC');
            // debug($query);
            // exit;
        } else {
            $query = $this->Todos->find()->order('scheduled_time ASC');
        }
        $todos = $this->paginate($query);

        //$data = $this->request->getParam();
        // debug($this->request->getQuery('filter'));
        // exit;
        debug($todos);
        exit;
        // Set the view vars that have to be serialized.
        $this->set('todos', $this->paginate());
        // Specify which view vars JsonView should serialize.
        $this->viewBuilder()->setOptions($todos, 'todos');
    }
}
