<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['login'], message: 'There is already an account with this login')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr_type', type: 'string')]
#[ORM\DiscriminatorMap(['user' => User::class, 'parent' => Parents::class, 'nageur' => Nageur::class, 'entraineur' => Entraineur::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const STATUT_ACTIF = 1;
    const STATUT_BLOQUE = 0;
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_NAGEUR = 'ROLE_NAGEUR';
    const ROLE_ENTRAINEUR = 'ROLE_ENTRAINEUR';
    const ROLE_PARENTS = 'ROLE_PARENTS';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255, unique: true)]
    private ?string $login = null;



    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;


    #[ORM\Column]
    private array $roles = [];


    #[ORM\Column(type: 'smallint')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::STATUT_ACTIF, self::STATUT_BLOQUE])]
    private $status;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profileFacebook = null;
    
    #[Assert\Length(
        max: 255,
        minMessage: 'Minimum 2 character',
        maxMessage: 'Maximum 255 character',
    )]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */


     
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getProfileFacebook(): ?string
    {
        return $this->profileFacebook;
    }

    public function setProfileFacebook(?string $profileFacebook): self
    {
        $this->profileFacebook = $profileFacebook;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }


    

   public function __toString(){
    return $this->prenom." ".$this->nom;

   }
}
?>