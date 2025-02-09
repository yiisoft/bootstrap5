<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

/**
 * Types for the {@see Button} component.
 */
enum ButtonType: string
{
    /**
     * Link button, renders as `<a>` element.
     */
    case LINK = 'link';
    /**
     * Reset button, renders as `<button type="reset">`.
     */
    case RESET = 'reset';
    /**
     * Reset input, renders as `<input type="reset">`.
     */
    case RESET_INPUT = 'reset-input';
    /**
     * Submit button, renders as `<button type="submit">`.
     */
    case SUBMIT = 'submit';
    /**
     * Submit input, renders as `<input type="submit">`.
     */
    case SUBMIT_INPUT = 'submit-input';
}
