<?php

namespace App\Charts;

class BaseChart
{
    protected $name;
    protected $type = "bar";
    protected $data = [];
    protected $options = [];

    public function __construct()
    {
        $classNames = explode("\\", static::class);
        $this->name = strtolower(end($classNames));
    }

    public function getData()
    {
        return json_encode($this->data);
    }

    public function getOptions()
    {
        return json_encode($this->options);
    }

    public function renderElement()
    {
        return <<<ELEMENT
            <canvas id="$this->name"></canvas>
        ELEMENT;
    }

    public function renderScript(): string
    {
        return <<<SCRIPT
            <script>
                const ctx = document.getElementById("{$this->name}")

                new Chart(ctx, {
                    type: "{$this->type}",
                    data: {$this->getData()},
                    options: {$this->getOptions()}
                })
            </script>
        SCRIPT;
    }
}
