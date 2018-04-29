<?php    
require('fpdf/fpdf.php');

$moodb = array();

foreach ($_COOKIE as $key => $value){
    if (strpos($key, 'moodb-') !== false) {        
        $moodb[] = $value;
    }    
}

class PDF extends FPDF
{
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    // tweak these values (in pixels)
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }

    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);
        // you will probably want to swap the width/height
        // around depending on the page's orientation
        $this->Image(
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }

    function Header()
    {
        $this->Image('../img/logo.png',10,10,-300);
    }

    function test($moodb){
        print_r($moodb);
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddFont('quattrocento','','Quattrocento-Regular.php');
$pdf->AddPage();
$pdf->SetSubject("BRAHMINO");
$pdf->SetRightMargin(43);
$pdf->SetY(-35);
$pdf->SetFont('quattrocento','',38);
$pdf->Cell(0,0,'SIMONE BRAMANTE',0,0,'R');
$pdf->Ln(11);
$pdf->SetFont('quattrocento','',11);
$pdf->Cell(0,0,'BRAHMINO.COM',0,0,'R');

foreach ($moodb as $key => $value){
    $pdf->AddPage();

    if (strpos($value, 'files/') !== false) {
        $value = '../'.$value;   
    }    

    $pdf->centreImage($value);

    //demo
    // $pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',60,30,90,0,'PNG');
}
// $pdf->AddPage();
// $pdf->centreImage("../img/posts/55.jpg");

$pdf->Output();
?>    

<html>
    <head>
        <title>Simone Bramante // Brahmino &#8211; Photographer // Director</title>
        <link rel="icon" href="https://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-32x32.jpg" sizes="32x32" />
        <link rel="icon" href="https://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-192x192.jpg" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="https://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-180x180.jpg" />
        <meta name="msapplication-TileImage" content="https://www.brahmino.com/wp-content/uploads/2017/02/cropped-browser_icon_512px-270x270.jpg" />
    </head>
    <body>        
    </body>
</html>

