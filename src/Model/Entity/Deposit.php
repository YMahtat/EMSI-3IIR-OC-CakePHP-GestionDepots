<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Deposit Entity
 *
 * @property int $ID
 * @property int $survey_id
 * @property int $user_id
 * @property int $deposit_year
 * @property int $period
 * @property string $deposit_type
 * @property string $url
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Survey $survey
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Attachemnt[] $attachemnts
 */
class Deposit extends Entity
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
