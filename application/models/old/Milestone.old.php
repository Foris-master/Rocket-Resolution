<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Milestone
 *
 * @ORM\Table(name="milestone")
 * @ORM\Entity
 */
class Milestone implements  JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmilestone", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmilestone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dead_line", type="datetime", nullable=true)
     */
    private $deadLine;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var \Resolution
     *
     * @ORM\ManyToOne(targetEntity="Resolution")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resolution_idresolution", referencedColumnName="idresolution")
     * })
     */
    private $resolutionresolution;


    /**
     * Get idmilestone
     *
     * @return integer 
     */
    public function getIdmilestone()
    {
        return $this->idmilestone;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Milestone
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
     * Set title
     *
     * @param string $title
     * @return Milestone
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
     * @return Milestone
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
     * Set deadLine
     *
     * @param \DateTime $deadLine
     * @return Milestone
     */
    public function setDeadLine($deadLine)
    {
        $this->deadLine = $deadLine;
    
        return $this;
    }

    /**
     * Get deadLine
     *
     * @return \DateTime 
     */
    public function getDeadLine()
    {
        return $this->deadLine;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Milestone
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
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Milestone
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
     * Set resolutionresolution
     *
     * @param \Resolution $resolutionresolution
     * @return Milestone
     */
    public function setResolutionresolution(\Resolution $resolutionresolution = null)
    {
        $this->resolutionresolution = $resolutionresolution;
    
        return $this;
    }

    /**
     * Get resolutionresolution
     *
     * @return \Resolution 
     */
    public function getResolutionresolution()
    {
        return $this->resolutionresolution;
    }
    function jsonSerialize()
    {
        return array('id'=>$this->getIdmilestone(),
            'title'=> $this->getTitle(),
            'description'=>$this->getDescription(),
            'start_date'=>$this->getStartDate(),
            'end_date'=>$this->getEndDate(),
            'status'=>$this->getStatus(),
            'icon'=>$this->getIcon(),
            'dead)line'=>$this->getDeadLine(),
            'resolution'=>$this->getResolutionresolution()
        );
    }
}