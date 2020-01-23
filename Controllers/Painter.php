<?php
require_once __DIR__.'/../Shapes/Line.php';

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}


class Painter
{

    public function __construct()
    {

    }

    public function clear($img)
    {
        session_unset();
        return $img;
    }

    public function drawLine($img, $points)
    {
        $x1 = $points['line_x1'];
        $y1 = $points['line_y1'];
        $x2 = $points['line_x2'];
        $y2 = $points['line_y2'];
        $color = $points['color'];

        $newLine = new Line($x1, $y1, $x2, $y2, $color);

        $_SESSION['lines'][] = serialize($newLine);


        $image = $img;
        foreach ($_SESSION['lines'] as $line)
        {
            $line = unserialize($line);
            $colors = $line->getColor();

            $color = imagecolorallocate($image, (int)$colors['red'], (int)$colors['green'], (int)$colors['blue']);



            $x1 = $line->get_x1();
            $y1 = $line->get_y1();
            $x2 = $line->get_x2();
            $y2 = $line->get_y2();

            $deltax = $x2-$x1;
            $g = $deltax > 0 ? 1 : -1;
            $deltax = abs($deltax);

            $deltay = $y2-$y1;
            $h = $deltay > 0 ? 1 : -1;
            $deltay = abs($deltay);


            if ($deltax > $deltay)
            {
                $c = -$deltax;

                while($x1 != $x2)
                {
                    imagesetpixel($image, $x1, $y1, $color);
                    $c += 2*$deltay;
                    if ($c > 0)
                    {
                        $y1 += $h;
                        $c -= 2*$deltax;
                    }
                    $x1 += $g;
                }
            }
            else
            {
                $c = -$deltay;

                while($y1 != $y2)
                {
                    imagesetpixel($image, $x1, $y1, $color);
                    $c += 2*$deltax;
                    if ($c > 0)
                    {
                        $x1 += $g;
                        $c -= 2*$deltay;
                    }
                    $y1 += $h;
                }
            }

        }

        return $image;

    //    header('Content-Type: image/png');

    //        ob_start();
    //        imagepng($img);
    //        $imgData=ob_get_clean();
    //        imagedestroy($img);
    //
    //        return $imgData;

    }
}