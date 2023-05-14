<?php

namespace App\Security;
use App\Entity\Entraineur;
use App\Entity\Seance;
use App\Form\Admin\EntraineurType;
use App\Form\Admin\EntraineurTypee;
use App\Entity\Physionomie;
use App\Form\Admin\PhysionomieType;
use App\Form\Admin\PhysionomieTypee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\HttpFoundation\RedirectResponse;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'login';
    private UrlGeneratorInterface $urlGenerator;
    private Security $security;

    public function __construct(
        UrlGeneratorInterface $urlGenerator, 
        Security $security,
        private EntityManagerInterface $em
        )
    {
        $this->urlGenerator = $urlGenerator;
        $this->security = $security;
    }


    public function authenticate(Request $request): Passport
    {
        $login = $request->request->get('login', '');

        $request->getSession()->set(Security::LAST_USERNAME, $login);

        return new Passport(
            new UserBadge($login),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(
        Request $request, TokenInterface $token, 
        string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath(
        $request->getSession(), 
        $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        
        if ($this->security->isGranted("ROLE_ADMIN")) {
            return new RedirectResponse($this->urlGenerator->generate('app_chart'));
          }
        if ($this->security->isGranted("ROLE_ENTRAINEUR")) {
          //  return new RedirectResponse($this->urlGenerator->generate('app_admin_entraineur_list'));
       // $entraineur = new Entraineur();
       $entraineurs = $this->em->getRepository(Entraineur::class)->findAll() ;
      //return new RedirectResponse($this->urlGenerator->generate('app_admin_entraineur_list'));
      return new RedirectResponse($this->urlGenerator->generate('app_admin_entraineur_entraineurprofile'));
     // return new RedirectResponse($this->urlGenerator->generate('app_admin_entraineur_page'));
      //return $this->redirectToRoute('app_admin_entraineur_page');
       }
       else if ($this->security->isGranted("ROLE_NAGEUR")) {
       // return new RedirectResponse($this->urlGenerator->generate('app_admin_nageur_list'));
        return new RedirectResponse($this->urlGenerator->generate('nageur_nageurprofile'));
        //nageur_nageurprofile
           }
        else if ($this->security->isGranted("ROLE_PARENTS")) {
            //return new RedirectResponse($this->urlGenerator->generate('app_admin_parent_list'));
            return new RedirectResponse($this->urlGenerator->generate('app_admin_parent_parentprofile'));
           // app_admin_parent_parentprofile
               }
        // For example:
         return new RedirectResponse($this->urlGenerator->generate('login'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
