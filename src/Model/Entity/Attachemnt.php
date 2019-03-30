<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attachemnt Entity
 *
 * @property int $ID
 * @property int $deposit_id
 * @property string $url
 * @property string $comment
 *
 * @property \App\Model\Entity\Deposit $deposit
 */
class Attachemnt extends Entity
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
        '*' => true,
        'ID' => false
    ];
}
