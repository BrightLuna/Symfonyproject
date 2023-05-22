<?php

namespace App\Subscriber;

use App\Entity\User;
use App\Service\SteamApiService;
use Doctrine\Persistence\ManagerRegistry;
use Knojector\SteamAuthenticationBundle\Event\AuthenticateUserEvent;
use Knojector\SteamAuthenticationBundle\Event\FirstLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LoginSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private ManagerRegistry $managerRegistry,
        private SteamApiService $steamApiService)
    {}

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FirstLoginEvent::NAME => 'onFirstLogin'
        ];
    }

    /**
     * Check if User exist
     * Create new user if not exist
     *
     * @param FirstLoginEvent $event
     * @return array
     */
    public function onFirstLogin(FirstLoginEvent $event)
    {
        $communityId = $event->getCommunityId();
        
        $user = $this->managerRegistry->getRepository(User::class)->findOneBy(['steamID' => $communityId]);
        
        if (!$user) {
            $details = $this->steamApiService->getPlayerSummary($communityId)['response']['players'][0];

            $user = (new User())
                ->setUsername($details['personaname'])
                ->setSteamID($details['steamid'])
                ->setAvatar($details['avatar'])
                ->setAvatarMedium($details['avatarmedium'])
                ->setAvatarFull($details['avatarfull'])
                ->setProfileUrl($details['profileurl'] ?? null)
                ->setRoles(['ROLE_STEAM'])
                ->setWhitelisted(0);

            $manager = $this->managerRegistry->getManager();
            $manager->persist($user);
            $manager->flush();
        }
        
        // Dispatch the authenticate event in order to sign in the user.
        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);
    }

}