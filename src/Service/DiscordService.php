<?php

namespace App\Service;

/**
 * Represented your server Discord
 */
class DiscordService 
{

    /** @var int */
    private $discordServerId;

    /** @var string */
    private $discordServerInv;

    public function __construct(int $discordServerId, string $discordServerInv)
    {   
        $this->discordServerId = $discordServerId;
        $this->discordServerInv = $discordServerInv; 
    }

    public function getDiscordServerId(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerId);
    }

    public function getDiscordInvitationLink(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerInv);
    }

}