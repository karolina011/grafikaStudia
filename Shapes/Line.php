<?php


class Line
{
    protected $x1;
    protected $y1;
    protected $x2;
    protected $y2;
    protected $color;

    public function __construct($x1, $y1, $x2, $y2, $color)
    {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
        $this->color = $color;
    }

    public function get_x1()
    {
        return $this->x1;
    }

    public function get_y1()
    {
        return $this->y1;
    }

    public function get_x2()
    {
        return $this->x2;
    }

    public function get_y2()
    {
        return $this->y2;
    }

    public function getColor()
    {
        $color = [
            'red' => 0,
            'green' => 0,
            'blue' => 0,
        ];

        if ($this->color == "Red")
        {
            $color['red'] = 255;
        }
        elseif ($this->color == "Green")
        {
            $color['green'] = 255;
        }
        elseif ($this->color == "Blue")
        {
            $color['blue'] = 255;
        }

        return $color;
    }

}