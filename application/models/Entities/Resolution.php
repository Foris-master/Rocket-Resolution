<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Resolution
 *
 * @ORM\Table(name="resolution")
 * @ORM\Entity
 */
class Resolution implements  JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idresolution", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idresolution;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Coach", mappedBy="resolutionresolution")
     */
    private $coachcoach;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_idcategory", referencedColumnName="idcategory")
     * })
     */
    private $categorycategory;

    /**
     * @var \Priority
     *
     * @ORM\ManyToOne(targetEntity="Priority")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="priority_idpriority", referencedColumnName="idpriority")
     * })
     */
    private $prioritypriority;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_iduser", referencedColumnName="iduser")
     * })
     */
    private $useruser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coachcoach = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idresolution
     *
     * @return integer 
     */
    public function getIdresolution()
    {
        return $this->idresolution;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Resolution
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Resolution
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Resolution
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Resolution
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
     * Set title
     *
     * @param string $title
     * @return Resolution
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Resolution
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add coachcoach
     *
     * @param \Coach $coachcoach
     * @return Resolution
     */
    public function addCoachcoach(\Coach $coachcoach)
    {
        $this->coachcoach[] = $coachcoach;
    
        return $this;
    }

    /**
     * Remove coachcoach
     *
     * @param \Coach $coachcoach
     */
    public function removeCoachcoach(\Coach $coachcoach)
    {
        $this->coachcoach->removeElement($coachcoach);
    }

    /**
     * Get coachcoach
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoachcoach()
    {
        return $this->coachcoach;
    }

    /**
     * Set categorycategory
     *
     * @param \Category $categorycategory
     * @return Resolution
     */
    public function setCategorycategory(\Category $categorycategory = null)
    {
        $this->categorycategory = $categorycategory;
    
        return $this;
    }

    /**
     * Get categorycategory
     *
     * @return \Category 
     */
    public function getCategorycategory()
    {
        return $this->categorycategory;
    }

    /**
     * Set prioritypriority
     *
     * @param \Priority $prioritypriority
     * @return Resolution
     */
    public function setPrioritypriority(\Priority $prioritypriority = null)
    {
        $this->prioritypriority = $prioritypriority;
    
        return $this;
    }

    /**
     * Get prioritypriority
     *
     * @return \Priority 
     */
    public function getPrioritypriority()
    {
        return $this->prioritypriority;
    }

    /**
     * Set useruser
     *
     * @param \User $useruser
     * @return Resolution
     */
    public function setUseruser(\User $useruser = null)
    {
        $this->useruser = $useruser;
    
        return $this;
    }

    /**
     * Get useruser
     *
     * @return \User 
     */
    public function getUseruser()
    {
        return $this->useruser;
    }

    function jsonSerialize()
    {
        return array('id'=>$this->getIdresolution(),
            'title'=> $this->getTitle(),
            'description'=>$this->getDescription(),
            'start_date'=>$this->getStartDate(),
            'end_date'=>$this->getEndDate(),
            'status'=>$this->getStatus(),
            'create_date'=>$this->getCreateDate(),
            'category'=>$this->getCategorycategory(),
            'user'=>$this->getUseruser(),
            'priority'=>$this->getPrioritypriority()
        );
    }
}
