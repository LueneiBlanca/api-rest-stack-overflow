<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class ApiQuery
{
    /**
     * @Assert\NotBlank
     */
    protected $tagged;
    protected $fromdate;
    protected $todate;

    public function __construct( $data)
    {
        $this->tagged = $data['tagged'] ?? null;
        $this->fromdate = $data['fromdate'] ?? null;
        $this->todate = $data['todate'] ?? null;

    }

    // public function getTagged(): ?string
    // {
    //     return $this->tagged;
    // }

    // public function setTagged(?string $tagged): void
    // {
    //     $this->tagged = $tagged;
    // }

    // public function getFromdate(): ?\DateTime
    // {
    //     return $this->fromdate;
    // }

    // public function setFromdate(?\DateTime $fromdate): void
    // {
    //     $this->fromdate = $fromdate;
    // }

    // public function getTodate(): ?\DateTime
    // {
    //     return $this->todate;
    // }

    // public function setTodate(?\DateTime $todate): void
    // {
    //     $this->todate = $todate;
    // }
}