<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Center Entity
 *
 * @property int $id
 * @property int $CODE
 * @property string $name
 * @property string $city
 *
 * @property \App\Model\Entity\User[] $users
 */
class Center extends Entity
{

    public function _getFull()
    {
        return $this->_properties['CODE'] . ' - ' .
            $this->_properties['name']. ' - ' .$this->_properties['city'];
    }

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
        'id' => false
    ];
}
