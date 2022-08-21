<?php

namespace App\Entity;

use App\Repository\HarbourRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HarbourRepository::class)]
class Harbour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column]
    private string $uuid;
    #[ORM\Column]
    private string $name;
    #[ORM\Column(nullable: true)]
    private ?string $image;
    #[ORM\Column]
    private string $lat;
    #[ORM\Column]
    private string $lon;
    #[ORM\Column]
    private bool $isPriceHidden;
    #[ORM\Column]
    private bool $isFree;
    #[ORM\Column]
    private bool $canBook;
    #[ORM\Column]
    private bool $cashOnlyBookings;
    #[ORM\Column]
    private bool $notActivated;
    #[ORM\Column]
    private array $translations;
    #[ORM\Column]
    private bool $acceptBankPayments;
    #[ORM\Column]
    private bool $acceptEpayPayments;
    #[ORM\Column]
    private bool $acceptGoCardlessPayments;
    #[ORM\Column]
    private bool $subscribedBerthsHiddenFromGuests;
    #[ORM\Column]
    private bool $bookOneDayOnly;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): string
    {
        return $this->lon;
    }

    public function setLon(string $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function isPriceHidden(): bool
    {
        return $this->isPriceHidden;
    }

    public function setIsPriceHidden(bool $isPriceHidden): self
    {
        $this->isPriceHidden = $isPriceHidden;

        return $this;
    }

    public function isFree(): bool
    {
        return $this->isFree;
    }

    public function setIsFree(bool $isFree): self
    {
        $this->isFree = $isFree;

        return $this;
    }

    public function isCanBook(): bool
    {
        return $this->canBook;
    }

    public function setCanBook(bool $canBook): self
    {
        $this->canBook = $canBook;

        return $this;
    }

    public function isCashOnlyBookings(): bool
    {
        return $this->cashOnlyBookings;
    }

    public function setCashOnlyBookings(bool $cashOnlyBookings): self
    {
        $this->cashOnlyBookings = $cashOnlyBookings;

        return $this;
    }

    public function isNotActivated(): bool
    {
        return $this->notActivated;
    }

    public function setNotActivated(bool $notActivated): self
    {
        $this->notActivated = $notActivated;

        return $this;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;

        return $this;
    }

    public function isAcceptBankPayments(): bool
    {
        return $this->acceptBankPayments;
    }

    public function setAcceptBankPayments(bool $acceptBankPayments): self
    {
        $this->acceptBankPayments = $acceptBankPayments;

        return $this;
    }

    public function isAcceptEpayPayments(): bool
    {
        return $this->acceptEpayPayments;
    }

    public function setAcceptEpayPayments(bool $acceptEpayPayments): self
    {
        $this->acceptEpayPayments = $acceptEpayPayments;

        return $this;
    }

    public function isAcceptGoCardlessPayments(): bool
    {
        return $this->acceptGoCardlessPayments;
    }

    public function setAcceptGoCardlessPayments(bool $acceptGoCardlessPayments): self
    {
        $this->acceptGoCardlessPayments = $acceptGoCardlessPayments;

        return $this;
    }

    public function isSubscribedBerthsHiddenFromGuests(): bool
    {
        return $this->subscribedBerthsHiddenFromGuests;
    }

    public function setSubscribedBerthsHiddenFromGuests(bool $subscribedBerthsHiddenFromGuests): self
    {
        $this->subscribedBerthsHiddenFromGuests = $subscribedBerthsHiddenFromGuests;

        return $this;
    }

    public function isBookOneDayOnly(): bool
    {
        return $this->bookOneDayOnly;
    }

    public function setBookOneDayOnly(bool $bookOneDayOnly): self
    {
        $this->bookOneDayOnly = $bookOneDayOnly;

        return $this;
    }
}
