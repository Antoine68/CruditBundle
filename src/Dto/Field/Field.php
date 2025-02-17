<?php

declare(strict_types=1);

namespace Lle\CruditBundle\Dto\Field;

use Lle\CruditBundle\Dto\Path;

class Field
{

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $sort;

    /** @var ?Path */
    private $path;

    /** @var string */
    private string $linkId = 'id';

    /** @var array */
    private $options;

    /** @var ?string */
    private $type;

    /** @var ?string */
    private $template;

    /** @var ?string */
    private $ruptGroup = 0;

    private ?string $role = null;

    private bool $editInPlace = false;

    public function __construct(string $name, ?string $type = null, array $options = [])
    {
        $this->name = $name;
        $this->label = 'field.' . strtolower(str_replace('.', '_', $name));
        $this->type = $type;
        $this->setOptions($options);
    }

    public static function new(string $name, ?string $type = null, array $options = []): self
    {
        return new self($name, $type, $options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): self
    {
        $this->label = $options['label'] ?? $this->label;
        $this->sort = $options['sort'] ?? true;
        $this->path = $options['path'] ?? $options['link_to'] ?? null;
        $this->template = (isset($options['template'])) ? $options['template'] : null;
        unset($options['label']);
        unset($options['sort']);
        unset($options['path']);
        unset($options['template']);
        $this->options = $options;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getEditInPlace(): bool
    {
        return $this->editInPlace;
    }

    public function setEditInPlace(bool $editInPlace): self
    {
        $this->editInPlace = $editInPlace;
        return $this;
    }

    public function setEditable(string $edit_route): self
    {
        $this->options['edit_route'] = $edit_route;
        $this->editInPlace = true;
        return $this;
    }

    public function setCssClass($cssClass): self
    {
        $this->options["cssClass"] = $cssClass;
        return $this;
    }

    public function hasCascade(): bool
    {
        return \str_contains($this->getName(), '.');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        $this->label = ($this->label) ? $this->name : $this->label;
        return $this;
    }

    public function getId(): string
    {
        return str_replace('.', '_', $this->getName());
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sort;
    }

    public function setSortable(bool $sort): self
    {
        $this->sort = $sort;
        return $this;
    }

    public function linkTo(Path $path, string $linkId = "id"): self
    {
        $this->path = $path;
        $this->linkId = $linkId;
        return $this;
    }

    public function getLinkId(): string
    {
        return $this->linkId;
    }

    public function getPath(): ?Path
    {
        return $this->path;
    }

    public function getEntityPath(): ?Path
    {
        return $this->entityPath;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;
        return $this;
    }

    public function getRuptGroup(): ?int
    {
        return $this->ruptGroup;
    }

    public function setRuptGroup(int $ruptGroup): self
    {
        $this->ruptGroup = $ruptGroup;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     * @return self
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
