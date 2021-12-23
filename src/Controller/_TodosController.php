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

    public function search()
    {
        $key = $this->request->getData('id');
        // exit($id);
        // $key = $this->request->getQuery('key');
        if ($key) {
            # code...
            $query = $this->Todos->find('all')
                ->where([
                    'OR' => [
                        'title like' => '%' . $key . '%',
                        'description like' => '%' . $key . '%',
                        'status like' => '%' . $key . '%',
                    ]
                ])->order('scheduled_time ASC');
        } else {
            # code...
            $query = $this->Todos->find()->order('scheduled_time ASC');
        }
        $search = $this->paginate($query);
        $this->set(compact('search'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $key = $this->request->getData('id');
        if ($key) {
            # code...
            $query = $this->Todos->find('all')
                ->where([
                    'OR' => [
                        'title like' => '%' . $key . '%',
                        'description like' => '%' . $key . '%',
                        'status like' => '%' . $key . '%',
                    ]
                ])->order('scheduled_time ASC');
        } else {
            # code...
            $query = $this->Todos->find()->order('scheduled_time ASC');
        }
        $todos = $this->paginate($query);
        $this->set(compact('todos'));

        // $todos = $this->paginate('todos');
        // $this->set(compact('todos'));
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
            $todo = ($this->Todos->patchEntity($todo, $this->request->getData()));
            $addition = array(
                'title' => date("Y-m-d"),
                'description' => date("Y-m-d"),
                'scheduled_time' => $todo->scheduled_time,
                'scheduled_date' => $todo->scheduled_date,
                'status' => 'pending',
                'created_at' => date("Y-m-d"),
            );
            // echo json_encode($todo);
            // var_dump($todo);
            //array_merge($todo, $addition);
            // $todo = debug($this->Todos->patchEntity($todo, $this->request->getData()));
            //exit;

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
}
