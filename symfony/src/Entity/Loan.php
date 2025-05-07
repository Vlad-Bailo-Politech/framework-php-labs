<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $loanDate = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reader $reader = null;

    #[ORM\OneToOne(mappedBy: 'loan', cascade: ['persist', 'remove'])]
    private ?Returning $bookReturn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoanDate(): ?\DateTimeInterface
    {
        return $this->loanDate;
    }

    public function setLoanDate(\DateTimeInterface $loanDate): self
    {
        $this->loanDate = $loanDate;
        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;
        return $this;
    }

    public function getReader(): ?Reader
    {
        return $this->reader;
    }

    public function setReader(?Reader $reader): self
    {
        $this->reader = $reader;
        return $this;
    }

    public function getBookReturn(): ?Returning
    {
        return $this->bookReturn;
    }

    public function setBookReturn(?Returning $bookReturn): self
    {
        // unset the owning side of the relation if necessary
        if ($bookReturn === null && $this->bookReturn !== null) {
            $this->bookReturn->setLoan(null);
        }

        // set the owning side of the relation if necessary
        if ($bookReturn !== null && $bookReturn->getLoan() !== $this) {
            $bookReturn->setLoan($this);
        }

        $this->bookReturn = $bookReturn;

        return $this;
    }
}