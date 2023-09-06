<?php

class StepEntity
{
    protected ?int $id;
    protected ?int $stepNumber;
    protected string $description;

    public function __construct(string $description, int $stepNumber = null, int $id = null)
    {
        $this->setDescription($description)
            ->setId($id)
            ->setStepNumber($stepNumber);

    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id 
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStepNumber(): ?int
    {
        return $this->stepNumber;
    }

    /**
     * @param int|null $stepNumber 
     * @return self
     */
    public function setStepNumber(?int $stepNumber): self
    {
        $this->stepNumber = $stepNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description 
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}