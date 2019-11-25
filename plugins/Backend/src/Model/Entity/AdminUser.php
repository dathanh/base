<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

/**
 * AdminUser Entity.
 *
 * @property int $id
 * @property int $admin_role_id
 * @property \App\Model\Entity\AdminRole $admin_role
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property bool $active
 * @property \Cake\I18n\Time $last_login
 * @property bool $locked
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class AdminUser extends Entity {

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
        'id' => false,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Hash password before save
     * @param string $password password
     * @return string
     */
    protected function _setPassword($password) {
        return $this->hashPassword($password);
    }

    /**
     * Hash password before save
     * @param string $password password
     * @return string
     */
    public function hashPassword($password) {
        if (strlen($password)) {
            $hash = new DefaultPasswordHasher();
            return $hash->hash($password);
        }
    }

    protected $_virtual = ['emailFormat', 'roleFormat'];

    protected function _getEmailFormat() {
        $htmlHelper = new HtmlHelper(new View());
        return $htmlHelper->link($this->email, ['controller' => 'AdminUsers', 'action' => 'edit', $this->id]);
    }

    protected function _getRoleFormat() {
        if (!empty($this->admin_role)) {
            $htmlHelper = new HtmlHelper(new View());
            return $htmlHelper->link($this->admin_role->name, ['controller' => 'AdminRoles', 'action' => 'view', $this->admin_role->id]);
        } else {
            return null;
        }
    }

}
