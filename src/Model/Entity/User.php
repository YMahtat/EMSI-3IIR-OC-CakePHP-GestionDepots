<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $ID
 * @property string $last_name
 * @property string $first_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $profil
 * @property int $center_id
 * @property string $organization
 * @property string $NERC
 * @property string $CNSS
 * @property string $ICE
 * @property string $address
 * @property string $city
 * @property int $is_new
 *
 * @property \App\Model\Entity\Center $center
 * @property \App\Model\Entity\Deposit[] $deposits
 * @property \App\Model\Entity\Log[] $logs
 * @property \App\Model\Entity\Domain[] $domains
 */
class User extends Entity
{

    public function _getFull()
    {
        return $this->_properties['ID'] . ' - ' .
            $this->_properties['first_name']. ' ' .$this->_properties['last_name'];
    }

     public function _getOperator()
    {
        return $this->_properties['ID'] . ' - ' .
            $this->_properties['organization'];
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
        'ID' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
