<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Spatie\ArrayToXml\ArrayToXml;
use Mpdf\Mpdf;


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
        $type = $this->request->getQuery('type');
        $day = $this->request->getQuery('day') ? $this->request->getQuery('day') : date('Y-m-d');
        if ($key && $day) {
            if ($type == 'all') {
                $query = $this->Todos->find('all')
                    ->where([
                        'OR' => [
                            'title like' => '%' . $key . '%',
                            'description like' => '%' . $key . '%',
                            'status like' => '%' . $key . '%',
                        ]
                    ])->order('scheduled_time ASC');
            } else {
                $query = $this->Todos->find('all')
                    ->where(['AND' => [
                        'scheduled_date' => $day,
                        'OR' => [
                            'title like' => '%' . $key . '%',
                            'description like' => '%' . $key . '%',
                            'status like' => '%' . $key . '%',
                        ]
                    ]])->order('scheduled_time ASC');
            }

            // debug($query);
            // exit;
        } else {
            $query = $this->Todos->find()->where(['scheduled_date' => $day])->order('scheduled_time ASC');
        }
        if ($day == 'all') {
            $query = $this->Todos->find('all')->order('scheduled_time ASC');
            // debug($query);
            // exit;
        }

        $todos = $this->paginate($query);
        $this->set('todos', $todos);


        /**
         * Setting the dashboard widget
         */
        $completed = $this->Todos->find()->select(['count' => $query->func()->count('*')])
            ->where([
                'status =' => 'Completed',
            ])->toArray();
        // debug(($completed[0]->count));
        // exit;
        $pending = $this->Todos->find()->select(['count' => $query->func()->count('*')])
            ->where([
                'status =' => 'Pending',
            ])->toArray();

        $failed = $this->Todos->find()->select(['count' => $query->func()->count('*')])
            ->where([
                'status =' => 'Failed',
            ])->toArray();

        $dashboard = array(
            'completed' =>  $completed[0]->count,
            'pending' =>   $pending[0]->count,
            'failed' => $failed[0]->count,
        );
        // debug($dashboard);
        // exit;
        //Send resultSet
        $this->set('dashboard', $dashboard);
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
        $type = $this->request->getQuery('type');
        $day = $this->request->getQuery('day') ? $this->request->getQuery('day') : date('Y-m-d');
        if ($key && $day) {
            if ($day == 'all') {
                $query = $this->Todos->find('all')
                    ->where([
                        'OR' => [
                            'title like' => '%' . $key . '%',
                            'description like' => '%' . $key . '%',
                            'status like' => '%' . $key . '%',
                        ]
                    ])->order('scheduled_time ASC');
            } else {
                $query = $this->Todos->find('all')
                    ->where(['AND' => [
                        'scheduled_date' => $day,
                        'OR' => [
                            'title like' => '%' . $key . '%',
                            'description like' => '%' . $key . '%',
                            'status like' => '%' . $key . '%',
                        ]
                    ]])->order('scheduled_time ASC');
            }
        } else {

            if ($day == 'all') {
                $query = $this->Todos->find('all')->order('scheduled_time ASC');
            } else {
                $query = $this->Todos->find('all')
                    ->where([
                        'scheduled_date' => $day,

                    ])->order('scheduled_time ASC');
            }
            // $query = $this->Todos->find('all')->order('scheduled_time ASC');
        }

        $mpdf = new \Mpdf\Mpdf();
        $content = 'Todos PDF Export  <br> <b>Date</b>: ' . $day . ', <b>Search Key</b>: ' . $key . '<br/>';
        $content .= '<br/><table width=100%>
                            <tr>
                            <td>Date and Time</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Status</td>
                            </tr>
                            ';
        foreach ($query as $todo) :
            $time = explode(',', $todo->scheduled_time);
            $date = date_create($todo->scheduled_date . ' ' . $time[1]);

            $content .= '
                <tr>
                <td>' . h(date_format($date, 'Y M, jS - g:ia (l)   ')) . '</td>
                <td>' . h($todo->title) . '</td>
                <td>' . h($todo->description) . '</td>
                <td>' . h($todo->status) . '</td>
            </tr>';
        endforeach;
        $content .= '</table>';


        $pdfName = 'TodoExport.pdf'; //name of the pdf file

        $mpdf->SetAuthor('Kof-Ano Akpadji'); // author added to pdf file

        $mpdf->SetTitle($pdfName); // title that is shown when pdf is opened in browser

        $mpdf->WriteHTML($content); //function used to convert HTML to pdf

        $mpdf->showImageErrors = true; // show if any image errors are present

        $mpdf->debug = true; // Debug warning or errors if set true(false by default)
        $mpdf->Output($pdfName, 'I'); //output the pdf file

    }

    public function exportxml()

    {
        //Still building
        $this->viewBuilder()->setLayout('exportxml');
        $array = [
            'Good guy' => [
                'name' => 'Kof-ano',
                'weapon' => 'Lightsaber'
            ],
            'Bad guy' => [
                'name' => 'Akpadji',
                'weapon' => 'Evil Eye'
            ]
        ];

        $result = ArrayToXml::convert($array);

        $this->set('xml', $result);
    }
}
