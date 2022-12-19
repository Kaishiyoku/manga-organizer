<?php

namespace App\View\Components\Button;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var bool
     */
    public $primary;

    /**
     * @var bool
     */
    public $secondary;

    /**
     * @var bool
     */
    public $plain;

    /**
     * @var bool
     */
    public $danger;

    /**
     * @var bool
     */
    public $link;

    /**
     * @var bool
     */
    public $iconOnly;

    /**
     * @var bool
     */
    public $confirm;

    /**
     * @var true
     */
    public $confirmMessage;

    /**
     * @var string|null
     */
    public $href;

    /**
     * @var string|null
     */
    public $action;

    /**
     * @var string|null
     */
    public $method;

    /**
     * Create a new component instance.
     *
     * @param string|null $type
     * @param bool $primary
     * @param bool $secondary
     * @param bool $plain
     * @param bool $danger
     * @param bool $link
     * @param bool $iconOnly
     * @param bool $confirm
     * @param string|null $confirmMessage
     * @param string|null $href
     * @param string|null $action
     * @param string|null $method
     * @return void
     */
    public function __construct($type = null, $primary = false, $secondary = false, $plain = false, $danger = false, $link = false, $iconOnly = false, $confirm = false, $confirmMessage = null, $href = null, $action = null, $method = null)
    {
        $validator = Validator::make(
            ['type' => $type, 'primary' => $primary, 'secondary' => $secondary, 'plain' => $plain, 'danger' => $danger, 'link' => $link, 'iconOnly' => $iconOnly, 'confirm' => $confirm, 'href' => $href, 'action' => $action, 'method' => $method],
            [
                'type' => [Rule::prohibitedIf(!!$href || !!$action), 'nullable', Rule::in(['button', 'submit', 'reset'])],
                'primary' => ['bool', Rule::when(!$secondary && !$plain && !$danger && !$link, 'accepted'), Rule::when($secondary || $plain || $danger || $link, Rule::notIn(true))],
                'secondary' => ['bool', Rule::when(!$primary && !$plain && !$danger && !$link, 'accepted'), Rule::when($primary || $plain || $danger || $link, Rule::notIn(true))],
                'plain' => ['bool', Rule::when(!$primary && !$secondary && !$danger && !$link, 'accepted'), Rule::when($primary || $secondary || $danger || $link, Rule::notIn(true))],
                'danger' => ['bool', Rule::when(!$primary && !$secondary && !$plain && !$link, 'accepted'), Rule::when($primary || $secondary || $plain || $link, Rule::notIn(true))],
                'link' => ['bool', Rule::when(!$primary && !$secondary && !$plain && !$danger, 'accepted'), Rule::when($primary || $secondary || $plain || $danger, Rule::notIn(true))],
                'iconOnly' => ['bool'],
                'confirm' => ['bool', Rule::when($confirmMessage, 'accepted')],
                'confirmMessage' => ['nullable', 'string'],
                'href' => ['nullable', Rule::prohibitedIf(!!$type || !!$action)],
                'action' => [Rule::prohibitedIf(!!$type || !!$href), Rule::when($method, 'required', 'nullable')],
                'method' => [Rule::prohibitedIf(!!$type || !!$href), Rule::when($action, 'required', 'nullable'), Rule::in(['post', 'put', 'patch', 'delete'])],
            ],
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->primary = $primary;
        $this->secondary = $secondary;
        $this->plain = $plain;
        $this->danger = $danger;
        $this->link = $link;
        $this->iconOnly = $iconOnly;
        $this->confirm = $confirm;
        $this->href = $href;
        $this->action = $action;
        $this->method = $method;

        if ($action) {
            $type = 'submit';
        }

        if (!$href) {
            $this->type = $type ?: 'button';
        }

        if ($confirm) {
            $this->confirmMessage = $confirmMessage ?: __('Are you sure?');
        }
    }

    /**
     * @return string
     */
    public function clickHandler()
    {
        $clickHandlerAttribute = $this->attributes->get('@click') ?: $this->attributes->get('x-on:click');

        if ($clickHandlerAttribute && $this->confirm) {
            return "if (confirm('{$this->confirmMessage}')) {{$clickHandlerAttribute}} else {\$event.preventDefault();}";
        }

        if ($clickHandlerAttribute) {
            return $clickHandlerAttribute;
        }

        if ($this->confirm) {
            return "confirm('{$this->confirmMessage}') ? true : \$event.preventDefault()";
        }

        return '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.button');
    }
}
