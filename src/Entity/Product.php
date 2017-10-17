<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    public $id;

    /** @ORM\Column */
    public $name;

    /** @ORM\Column(type="text") */
    public $description;

    /** @ORM\Column(type="integer") */
    public $price;

    /** @ORM\Column(type="integer") */
    public $taxRate;

    public static function fromArray(array $data): self
    {
        $instance = new static();

        $instance->id = $data['id'];
        $instance->name = $data['name'];
        $instance->description = $data['description'];
        $instance->price = $data['price'];
        $instance->taxRate = $data['taxRate'];

        return $instance;
    }
}
