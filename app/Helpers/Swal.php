<?php

class Toast
{
    protected $type;
    protected $title;
    protected $message;
    protected $options = [
        'toast' => false,
        'position' => 'center',
        'timer' => null
    ];
    protected $isSent = false;

    public function __construct()
    {
        // Opciones por defecto para todos los toasts
    }

    public static function make()
    {
        return new self();
    }

    public function success($title, $message, $customOptions = [])
    {
        $this->setParameters('success', $title, $message, $customOptions);
        return $this;
    }

    public function error($title, $message, $customOptions = [])
    {
        $this->setParameters('error', $title, $message, $customOptions);
        return $this;
    }

    public function info($title, $message, $customOptions = [])
    {
        $this->setParameters('info', $title, $message, $customOptions);
        return $this;
    }

    public function warning($title, $message, $customOptions = [])
    {
        $this->setParameters('warning', $title, $message, $customOptions);
        return $this;
    }

    public function toast()
    {
        $this->options['toast'] = true;
        $this->options['position'] = 'top-right';
        $this->options['timer'] = $this->options['timer'] ?? 5000;
        $this->options['timerProgressBar'] = true;
        $this->options['showConfirmButton'] = false;

        return $this->send();
    }

    public function timer($milliseconds = 5000)
    {
        $this->options['timer'] = $milliseconds;
        return $this;
    }

    protected function setParameters($type, $title, $message, $customOptions)
    {
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        $this->options = array_merge($this->options, $customOptions);
    }

    public function send()
    {
        if (!$this->isSent) {
            flashify($this->title, $this->message, $this->type, $this->options);
            $this->isSent = true;
        }
        return $this;
    }

    public function __call($name, $arguments)
    {
        $validTypes = ['success', 'error', 'info', 'warning'];

        if (in_array($name, $validTypes)) {
            $title = $arguments[0] ?? 'Notification';
            $message = $arguments[1] ?? '';
            $customOptions = $arguments[2] ?? [];

            $this->setParameters($name, $title, $message, $customOptions);
            return $this;
        }

        throw new \BadMethodCallException("Method {$name} does not exist.");
    }

    public function withOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function __destruct()
    {
        if (!$this->isSent) {
            $this->send();
        }
    }
}

function swal()
{
    return Toast::make();
}