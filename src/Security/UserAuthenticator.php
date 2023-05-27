<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
use Symfony\Component\Security\Core\User\UserInterface;
class UserAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'login';
    private UrlGeneratorInterface $urlGenerator;
    private Security $security;

    public function __construct(UrlGeneratorInterface $urlGenerator, Security $security)
    {
        $this->urlGenerator = $urlGenerator;
        $this->security = $security;
    }
    private function isEntraineur(UserInterface $user): bool
    {
        // Implement your own logic to determine if the user has the ROLE_ENTRAINEUR role
        // You may check the user's roles, database records, or any other criteria
        
        // Example implementation: Check if the user has the ROLE_ENTRAINEUR role
        return in_array('ROLE_ENTRAINEUR', $user->getRoles());
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

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        
        if ($this->security->isGranted("ROLE_ADMIN")) {
            return new RedirectResponse($this->urlGenerator->generate('app_chart'));
        } elseif ($token->getUser() instanceof UserInterface && $this->isEntraineur($token->getUser())) {
            // Retrieve the entraineur's ID from the logged-in user's data
            $entraineurId = $token->getUser()->getId();
            
            // Generate the URL for the entraineur's profile page with the "id" parameter
            $url = $this->urlGenerator->generate('app_admin_entraineur_profile', ['id' => $entraineurId]);
            
            return new RedirectResponse($url);
        } elseif ($this->security->isGranted("ROLE_NAGEUR")) {
            // Retrieve the nageur's ID from the logged-in user's data
            $nageurId = $token->getUser()->getId();
            
            // Generate the URL for the nageur's profile page with the "id" parameter
            $url = $this->urlGenerator->generate('app_admin_nageur_profil', ['id' => $nageurId]);
            
            return new RedirectResponse($url);
        } elseif ($this->security->isGranted("ROLE_PARENTS")) {
            // Retrieve the parent's ID from the logged-in user's data
            $parentId = $token->getUser()->getId();
            
            // Generate the URL for the parent's profile page with the "id" parameter
            $url = $this->urlGenerator->generate('app_admin_parent_profile', ['id' => $parentId]);
            
            return new RedirectResponse($url);
        }
        
        // For example:
        // return new RedirectResponse($this->urlGenerator->generate('login'));
        // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
