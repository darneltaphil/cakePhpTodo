<?php
// //require_once(ROOT . DS . 'vendor' . DS . 'mpdf' . DS . 'mpdf' . DS . 'src' . DS . 'Mpdf.php');

// //Mpdf class containing pdf parameters which defines page size (A4-L),character set(utf-8), margin,padding,orientation(L- Landscape) etc.
// $mpdf = new \Mpdf\Mpdf();

// // $content = '<table cellpadding="0" cellspacing="0" class="table table-hover vw-90">
// //                 <thead>
// //                     <tr>
// //                         <th scope="col">' . $this->Paginator->sort('scheduled_time')  . '</th>
// //                         <th scope="col">' . $this->Paginator->sort('title') . '</th>
// //                         <th scope="col">' . $this->Paginator->sort('status') . '</th>
// //                         <th scope="col" class="actions">' . __('Actions') . '</th>
// //                     </tr>
// //                 </thead>
// //                 <tbody>
// //                     ';
// // foreach ($pdf as $todo) :
// //     $time = explode(',', $todo->scheduled_time);

// //     $content .= '
// //         <tr>
// //         <td>' . h($time[1]) . '</td>
// //         <td>' . h($todo->title) . '</td>
// //         <td>' . h($todo->status) . '</td>
// //         <td class="actions">
// //             <a class="mx-2" href="' . $this->Url->build(['controller' => 'todos', 'action' => 'view', $todo->id]) . '" title="View">
// //                 <span class="fa fa-eye fa-1x text-dark"></span>
// //             </a>
// //             <a class="mx-2" href="' . $this->Url->build(['controller' => 'todos', 'action' => 'edit', $todo->id]) . '" title="Edit>
// //                 <span class="fa fa-edit fa-1x text-primary"></span>
// //             </a>
// //             ' . $this->Form->postLink(__(''), ['action' => 'delete', $todo->id], ['class' => 'fa fa-trash fa-1x text-danger', 'title' => 'Delete', 'confirm' => __('Are you sure you want to delete this item?', $todo->id)]) . '
// //         </td>
// //     </tr>';
// // endforeach;
// // $content .= '</tbody>
// // </table>';

// //Cakephp set method to set the dynamic value of the variable declared in pdf html.
// // $this->set('courseName', $this->request->data['courseName']);
// // $this->set('primaryColor', $this->request->data['primaryColor']);

// //Cakephp method to render the ctp file containing pdf html that needs to be converted.
// // $pdfHtml = $this->render($this->fetch('content'));

// // $pdfHtml = $pdfHtml->body(); // get only the html from complete rendered element.

// $pdfName = 'Certificate.pdf'; //name of the pdf file

// $mpdf->SetAuthor('CustomGuide'); // author added to pdf file

// $mpdf->SetTitle('Certificate'); // title that is shown when pdf is opened in browser

// $mpdf->WriteHTML('testing'); //function used to convert HTML to pdf
// // $mpdf->WriteHTML($content); //function used to convert HTML to pdf

// $mpdf->showImageErrors = true; // show if any image errors are present

// $mpdf->debug = true; // Debug warning or errors if set true(false by default)
// $mpdf->Output($pdfName, 'I'); //output the pdf file
