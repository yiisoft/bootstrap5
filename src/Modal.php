<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use JsonException;
use Stringable;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_merge;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the {@see begin()} and {@see end()} calls within the
 * modal window:
 *
 * ```php
 * Modal::widget()
 *     ->title('Hello world')
 *     ->withToggleOptions(['label' => 'click me'])
 *     ->begin();
 *
 * echo 'Say hello...';
 *
 * echo Modal::end();
 * ```
 */
final class Modal extends AbstractToggleWidget
{
    use CloseButtonTrait;

    /**
     * Size classes
     */
    public const SIZE_SMALL = 'modal-sm';
    public const SIZE_DEFAULT = null;
    public const SIZE_LARGE = 'modal-lg';
    public const SIZE_EXTRA_LARGE = 'modal-xl';

    /**
     * Fullscreen classes
     */
    public const FULLSCREEN_ALWAYS = 'modal-fullscreen';
    public const FULLSCREEN_BELOW_SM = 'modal-fullscreen-sm-down';
    public const FULLSCREEN_BELOW_MD = 'modal-fullscreen-md-down';
    public const FULLSCREEN_BELOW_LG = 'modal-fullscreen-lg-down';
    public const FULLSCREEN_BELOW_XL = 'modal-fullscreen-xl-down';
    public const FULLSCREEN_BELOW_XXL = 'modal-fullscreen-xxl-down';

    private string|Stringable|null $title = null;
    private array $titleOptions = [];
    private array $headerOptions = [];
    private array $dialogOptions = [];
    private array $contentOptions = [];
    private array $bodyOptions = [];
    private ?string $footer = null;
    private array $footerOptions = [];
    private ?string $size = self::SIZE_DEFAULT;
    private array $options = [];
    private bool $encodeTags = false;
    private bool $fade = true;
    private bool $staticBackdrop = false;
    private bool $scrollable = false;
    private bool $centered = false;
    private ?string $fullscreen = null;
    protected string|Stringable $toggleLabel = 'Show';

    public function getId(?string $suffix = '-modal'): ?string
    {
        // TODO: fix the method call, there's no suffix anymore.
        return $this->options['id'] ?? parent::getId($suffix);
    }

    protected function toggleComponent(): string
    {
        return 'modal';
    }

    public function getTitleId(): string
    {
        return $this->titleOptions['id'] ?? $this->getId() . '-label';
    }

    public function begin(): string
    {
        parent::begin();

        $options = $this->prepareOptions();
        $dialogOptions = $this->prepareDialogOptions();
        $contentOptions = $this->contentOptions;
        $contentTag = ArrayHelper::remove($contentOptions, 'tag', 'div');
        $dialogTag = ArrayHelper::remove($dialogOptions, 'tag', 'div');

        Html::addCssClass($contentOptions, ['modal-content']);

        return
            ($this->renderToggle ? $this->renderToggle() : '') .
            Html::openTag('div', $options) .
            Html::openTag($dialogTag, $dialogOptions) .
            Html::openTag($contentTag, $contentOptions) .
            $this->renderHeader() .
            $this->renderBodyBegin();
    }

    public function render(): string
    {
        return
            $this->renderBodyEnd() .
            $this->renderFooter() .
            Html::closeTag($this->contentOptions['tag'] ?? 'div') . // modal-content
            Html::closeTag($this->dialogOptions['tag'] ?? 'div') . // modal-dialog
            Html::closeTag('div');
    }

    /**
     * Prepare options for modal layer
     */
    private function prepareOptions(): array
    {
        $options = array_merge([
            'role' => 'dialog',
            'tabindex' => -1,
            'aria-hidden' => 'true',
        ], $this->options);

        $options['id'] = $this->getId();

        /** @psalm-suppress InvalidArgument */
        Html::addCssClass($options, ['widget' => 'modal']);

        if ($this->fade) {
            Html::addCssClass($options, ['animation' => 'fade']);
        }

        if (!isset($options['aria-label'], $options['aria-labelledby']) && !empty($this->title)) {
            $options['aria-labelledby'] = $this->getTitleId();
        }

        if ($this->staticBackdrop) {
            $options['data-bs-backdrop'] = 'static';
        }

        return $options;
    }

    /**
     * Prepare options for dialog layer
     */
    private function prepareDialogOptions(): array
    {
        $options = $this->dialogOptions;
        $classNames = ['modal-dialog'];

        if ($this->size) {
            $classNames[] = $this->size;
        }

        if ($this->fullscreen) {
            $classNames[] = $this->fullscreen;
        }

        if ($this->scrollable) {
            $classNames[] = 'modal-dialog-scrollable';
        }

        if ($this->centered) {
            $classNames[] = 'modal-dialog-centered';
        }

        Html::addCssClass($options, $classNames);

        return $options;
    }

    /**
     * Dialog layer options
     */
    public function dialogOptions(array $options): self
    {
        $new = clone $this;
        $new->dialogOptions = $options;

        return $new;
    }

    /**
     * Set options for content layer
     */
    public function contentOptions(array $options): self
    {
        $new = clone $this;
        $new->contentOptions = $options;

        return $new;
    }

    /**
     * Body options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function bodyOptions(array $options): self
    {
        $new = clone $this;
        $new->bodyOptions = $options;

        return $new;
    }

    /**
     * The footer content in the modal window.
     */
    public function footer(?string $content): self
    {
        $new = clone $this;
        $new->footer = $content;

        return $new;
    }

    /**
     * Additional footer options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function footerOptions(array $options): self
    {
        $new = clone $this;
        $new->footerOptions = $options;

        return $new;
    }

    /**
     * Additional header options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function headerOptions(array $options): self
    {
        $new = clone $this;
        $new->headerOptions = $options;

        return $new;
    }

    /**
     * @param array $options the HTML attributes for the widget container tag. The following special options are
     * recognized.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function options(array $options): self
    {
        $new = clone $this;
        $new->options = $options;

        return $new;
    }

    /**
     * The title content in the modal window.
     */
    public function title(?string $title): self
    {
        $new = clone $this;
        $new->title = $title;

        return $new;
    }

    /**
     * Additional title options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function titleOptions(array $options): self
    {
        $new = clone $this;
        $new->titleOptions = $options;

        return $new;
    }

    /**
     * The modal size. Can be {@see SIZE_LARGE} or {@see SIZE_SMALL}, or null for default.
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#optional-sizes
     */
    public function size(?string $size): self
    {
        $new = clone $this;
        $new->size = $size;

        return $new;
    }

    /**
     * Enable/disable static backdrop
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#static-backdrop
     */
    public function staticBackdrop(bool $enabled = true): self
    {
        if ($enabled === $this->staticBackdrop) {
            return $this;
        }

        $new = clone $this;
        $new->staticBackdrop = $enabled;

        return $new;
    }

    /**
     * Enable/Disable scrolling long content
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#scrolling-long-content
     */
    public function scrollable(bool $enabled = true): self
    {
        if ($enabled === $this->scrollable) {
            return $this;
        }

        $new = clone $this;
        $new->scrollable = $enabled;

        return $new;
    }

    /**
     * Enable/Disable vertically centered
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#vertically-centered
     */
    public function centered(bool $enabled = true): self
    {
        if ($enabled === $this->centered) {
            return $this;
        }

        $new = clone $this;
        $new->centered = $enabled;

        return $new;
    }

    /**
     * Set/remove fade animation
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#remove-animation
     */
    public function fade(bool $enabled = true): self
    {
        $new = clone $this;
        $new->fade = $enabled;

        return $new;
    }

    /**
     * Enable/disable fullscreen mode
     *
     * @link https://getbootstrap.com/docs/5.1/components/modal/#fullscreen-modal
     */
    public function fullscreen(?string $enabled): self
    {
        $new = clone $this;
        $new->fullscreen = $enabled;

        return $new;
    }

    /**
     * Renders the header HTML markup of the modal.
     *
     * @throws JsonException
     *
     * @return string the rendering result
     */
    private function renderHeader(): string
    {
        $title = (string) $this->renderTitle();
        $button = (string) $this->renderCloseButton(true);

        if ($button === '' && $title === '') {
            return '';
        }

        $options = $this->headerOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $content = $title . $button;

        Html::addCssClass($options, ['headerOptions' => 'modal-header']);

        return Html::tag($tag, $content, $options)
            ->encode(false)
            ->render();
    }

    /**
     * Render title HTML markup
     */
    private function renderTitle(): ?string
    {
        if ($this->title === null) {
            return '';
        }

        $options = $this->titleOptions;
        $options['id'] = $this->getTitleId();
        $tag = ArrayHelper::remove($options, 'tag', 'h5');
        $encode = ArrayHelper::remove($options, 'encode', $this->encodeTags);

        Html::addCssClass($options, ['modal-title']);

        return Html::tag($tag, $this->title, $options)
            ->encode($encode)
            ->render();
    }

    /**
     * Renders the opening tag of the modal body.
     *
     * @throws JsonException
     *
     * @return string the rendering result
     */
    private function renderBodyBegin(): string
    {
        $options = $this->bodyOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        Html::addCssClass($options, ['widget' => 'modal-body']);

        return Html::openTag($tag, $options);
    }

    /**
     * Renders the closing tag of the modal body.
     *
     * @return string the rendering result
     */
    private function renderBodyEnd(): string
    {
        $tag = ArrayHelper::getValue($this->bodyOptions, 'tag', 'div');

        return Html::closeTag($tag);
    }

    /**
     * Renders the HTML markup for the footer of the modal.
     *
     * @throws JsonException
     *
     * @return string the rendering result
     */
    private function renderFooter(): string
    {
        if ($this->footer === null) {
            return '';
        }

        $options = $this->footerOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $encode = ArrayHelper::remove($options, 'encode', $this->encodeTags);
        Html::addCssClass($options, ['widget' => 'modal-footer']);

        return Html::tag($tag, $this->footer, $options)
            ->encode($encode)
            ->render();
    }
}
