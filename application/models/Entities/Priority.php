<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Priority
 *
 * @ORM\Table(name="priority")
 * @ORM\Entity
 */
class Priority implements  JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpriority", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpriority;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     */
    private $value;


    /**
     * Get idpriority
     *
     * @return integer 
     */
    public function getIdpriority()
    {
        return $this->idpriority;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Priority
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Priority
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
    function jsonSerialize()
    {
        return array('id'=>$this->getIdpriority(),
            'name'=> $this->getName(),
            'value'=>$this->getValue()
        );
    }
}
