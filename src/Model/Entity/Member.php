<?php
declare(strict_types=1);

namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Member Entity
 *
 * @property string $id
 * @property string $name
 * @property string $about_title
 * @property string $about
 * @property string|null $link_facebook
 * @property string|null $link_twitter
 * @property string|null $link_instagram
 * @property string|null $link_linkedin
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class Member extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'about_title' => true,
        'about' => true,
        'link_facebook' => true,
        'link_twitter' => true,
        'link_instagram' => true,
        'link_linkedin' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
    ];
}
