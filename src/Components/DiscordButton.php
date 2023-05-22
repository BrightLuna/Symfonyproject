<?php

namespace App\Components;

use App\Service\DiscordService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'partials/components/_discord_button.html.twig')]
class DiscordButton
{

    public $discordUsers;
    public $discordLink;

    public function __construct(DiscordService $discord)
    {
        $this->discordUsers = $discord->getServerUserCount();
        $this->discordLink = $discord->getDiscordInvitationLink();
    }

}