<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firts_name", type="string", length=45, nullable=false)
     */
    private $firtsName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="localization", type="string", length=45, nullable=false)
     */
    private $localization;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=45, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="useruser")
     * @ORM\JoinTable(name="user_has_group",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_iduser", referencedColumnName="iduser")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="group_idgroup", referencedColumnName="idgroup")
     *   }
     * )
     */
    private $groupgroup;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupgroup = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firtsName
     *
     * @param string $firtsName
     * @return User
     */
    public function setFirtsName($firtsName)
    {
        $this->firtsName = $firtsName;
    
        return $this;
    }

    /**
     * Get firtsName
     *
     * @return string 
     */
    public function getFirtsName()
    {
        return $this->firtsName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set localization
     *
     * @param string $localization
     * @return User
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    
        return $this;
    }

    /**
     * Get localization
     *
     * @return string 
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return User
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    
        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add groupgroup
     *
     * @param \Group $groupgroup
     * @return User
     */
    public function addGroupgroup(\Group $groupgroup)
    {
        $this->groupgroup[] = $groupgroup;
    
        return $this;
    }

    /**
     * Remove groupgroup
     *
     * @param \Group $groupgroup
     */
    public function removeGroupgroup(\Group $groupgroup)
    {
        $this->groupgroup->removeElement($groupgroup);
    }

    /**
     * Get groupgroup
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupgroup()
    {
        return $this->groupgroup;
    }
    function jsonSerialize()
    {
        return array('id'=>$this->getIduser(),
            'user_name'=>$this->getUserName(),
            'email'=> $this->getEmail(),
            'first_name'=>$this->getFirtsName(),
            'last_name'=>$this->getLastName(),
            'phone'=>$this->getPhone(),
            'localization'=>$this->getLocalization(),
            'password'=>$this->getPassword(),
            'create_date'=>$this->getCreateDate(),
            'picture'=>$this->getPicture(),
            'group'=>$this->getGroupgroup()
        );
    }
}
