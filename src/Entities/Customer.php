<?php

namespace App\Entities;

/**
 * @Entity @Table(name="customers")
 *  @HasLifecycleCallbacks
 */
class Customer
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;

    /** @Column(type="string") */
    private $name;

    /** @Column(type="string",nullable=true)) */
    private $address;
    /**
     * @var datetime
     *
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime
     *
     * @Column(type="datetime", nullable = true)
     */
    protected $updated_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName(string $name) :void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress() :string
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setAddress(string  $address)
    {
        $this->address = $address;
    }


    /**
     * Gets triggered only on insert.
     *
     * @PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new \DateTime('now');
    }

    /**
     * Gets triggered every time on update.
     *
     * @PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime('now');
    }


}
