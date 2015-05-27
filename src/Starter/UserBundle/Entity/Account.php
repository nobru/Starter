<?php

namespace Starter\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity
 */
class Account
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="account")
     **/
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\EmpregadosBundle\Entity\Empregado", mappedBy="account")
     **/
    private $empregados;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->empregados = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Account
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Account
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set owner
     *
     * @param \Starter\UserBundle\Entity\User $owner
     * @return Account
     */
    public function setOwner(\Starter\UserBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return \Starter\UserBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add users
     *
     * @param \Starter\UserBundle\Entity\User $users
     * @return Account
     */
    public function addUser(\Starter\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Starter\UserBundle\Entity\User $users
     */
    public function removeUser(\Starter\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add empregados
     *
     * @param \App\EmpregadosBundle\Entity\Empregado $empregados
     * @return Account
     */
    public function addEmpregado(\App\EmpregadosBundle\Entity\Empregado $empregados)
    {
        $this->empregados[] = $empregados;
    
        return $this;
    }

    /**
     * Remove empregados
     *
     * @param \App\EmpregadosBundle\Entity\Empregado $empregados
     */
    public function removeEmpregado(\App\EmpregadosBundle\Entity\Empregado $empregados)
    {
        $this->empregados->removeElement($empregados);
    }

    /**
     * Get empregados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpregados()
    {
        return $this->empregados;
    }
}