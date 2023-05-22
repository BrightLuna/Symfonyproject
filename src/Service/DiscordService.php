<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Represented your server Discord
 */
class DiscordService 
{

    /**
     * @var string
     */
    private $discordToken;

    /** @var int */
    private $discordServerId;

    /** @var string */
    private $discordServerInv;

    /**
     * Discord Service Constructor
     *
     * @param integer $discordServerId
     * @param string $discordServerInv
     * @param string $discordToken
     */
    public function __construct(
        int $discordServerId, 
        string $discordServerInv,
        string $discordToken
    ){   
        $this->discordServerId = $discordServerId;
        $this->discordServerInv = $discordServerInv;
        $this->discordToken = $discordToken;
    }

    /**
     * Function for your Server ID
     *
     * @return string
     */
    public function getDiscordServerId(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerId);
    }

    /**
     * Function for your Server Invitation Link
     *
     * @return string
     */
    public function getDiscordInvitationLink(): string
    {
        return sprintf('https://discord.gg/%s', $this->discordServerInv);
    }

    /**
     * Function for Count all members on your server
     *
     * @return integer
     */
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