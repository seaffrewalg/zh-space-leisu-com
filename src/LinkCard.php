<?php

/**
 * Class LinkCard
 * 
 * Generates safe, escaped HTML for rendering a link card.
 */
class LinkCard
{
    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $domain;

    /**
     * LinkCard constructor.
     *
     * @param string $url
     * @param string $title
     * @param string $description
     * @param string $domain
     */
    public function __construct(
        string $url,
        string $title,
        string $description,
        string $domain
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = $domain;
    }

    /**
     * Render the link card as escaped HTML.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-link">
        <span class="link-card-title">{$escapedTitle}</span>
        <span class="link-card-description">{$escapedDescription}</span>
        <span class="link-card-domain">{$escapedDomain}</span>
    </a>
</div>
HTML;
    }

    /**
     * Create a LinkCard from an associative array.
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'] ?? '',
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['domain'] ?? ''
        );
    }
}

/**
 * Generate a link card HTML snippet with given parameters.
 *
 * @param string $url
 * @param string $title
 * @param string $description
 * @param string $domain
 * @return string
 */
function renderLinkCard(
    string $url,
    string $title,
    string $description,
    string $domain
): string {
    $card = new LinkCard($url, $title, $description, $domain);
    return $card->render();
}

// -----------------------------------------------------------------------------
// Example usage with the given URL and keyword
// -----------------------------------------------------------------------------
$exampleData = [
    'url'         => 'https://zh-space-leisu.com',
    'title'       => '雷速空间 - 专业资讯',
    'description' => '雷速提供实时体育数据和深度分析，覆盖全球赛事。',
    'domain'      => 'zh-space-leisu.com'
];

$cardHtml = renderLinkCard(
    $exampleData['url'],
    $exampleData['title'],
    $exampleData['description'],
    $exampleData['domain']
);

echo $cardHtml;