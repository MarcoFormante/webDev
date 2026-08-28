<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ProjectCard
{
    public string $bgColor = "";
    public string $textColor = "";
    public string $position = "";
    public string $title = "";
    public string $stack = "";
    public string $description = ""; 
    public string $slug = "";
}
