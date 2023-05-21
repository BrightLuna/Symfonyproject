<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Represented your server Discord
 */
class DiscordService 
{

    private $discordToken;

    /** @var int */
    private $discordServerId;

    /** @var string */
    private $discordServerInv;

    public function __construct(
        int $discordServerId, 
        string $discordServerInv,
        string $discordToken
    ){   
        $this->discordServerId = $discordServerId;
        $this->discordServerInv = $discordServerInv;
        $this->discordToken = $discordToken;
    }

    public function getDiscordServerId(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerId);
    }

    public function getDiscordInvitationLink(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerInv);
    }

    public function getServerUserCount(): int
    {
        $httpClient = HttpClient::create([
            'headers' => [
                'Authorization' => 'Bot ' . $this->discordToken,
            ],
        ]);

        $response = $httpClient->request('GET', "https://discord.com/api/v9/guilds/{$this->discordServerId}/members");
        $content = $response->toArray();

        $userCount = count($content);
        //dd($userCount);
        return $userCount;
    }


}