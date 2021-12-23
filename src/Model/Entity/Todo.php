<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Todo Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Cake\I18n\FrozenTime $scheduled_time
 * @property \Cake\I18n\FrozenDate|null $scheduled_date
 * @property string $status
 * @property \Cake\I18n\FrozenTime|null $created_at
 *
 * @property \App\Model\Entity\Todostatus $todostatus
 */
class Todo extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'scheduled_time' => true,
        'scheduled_date' => true,
        'status' => true,
        'created_at' => true,
    ];
}
