<?php
declare(strict_types=1);
namespace PIEFrost\Common\Exceptions;

use PIEFrost\Common\ValueObjects\Redirect;

class RequestException extends CommonException
{
    public ?Redirect $redirect = null;
    public function setRedirect(Redirect $redirect): static
    {
        $this->redirect = $redirect;
        return $this;
    }

    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }
}
