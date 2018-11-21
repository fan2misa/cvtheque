<?php

namespace App\PartageResponse;

use App\Service\Wrapper\Entity\Cv;
use App\Service\PartageResponse;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfPartageResponse extends PartageResponse {

    public function render(Cv $cv)
    {
        $cv->setBasePath($this->publicPath);

        $dompdf = new Dompdf($this->getOptions($cv));

        $html = $this->templating->render($this->getTemplate($cv), [
            'cv' => $cv
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setCss($this->getStylesheet($dompdf, $cv));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }

    private function getOptions(Cv $cv) {
        $pdfOptions = new Options();

        $pdfOptions
            ->setDefaultFont('Roboto')
            ->setIsHtml5ParserEnabled(true)
            ->setFontHeightRatio(1)
            ->setChroot($this->appPath . '/public')
            ->setFontDir($pdfOptions->getChroot() . '/' . $cv->getTheme()->getPublicPath() . '/css/fonts')
            ->setIsRemoteEnabled(true);
        return $pdfOptions;
    }

    private function getStylesheet(Dompdf $dompdf, Cv $cv) {
        $pdfStylesheet = new Stylesheet($dompdf);
        $pdfStylesheet->load_css_file($cv->getTheme()->getCssPathGlobal());
        $pdfStylesheet->load_css_file($cv->getTheme()->getCssPathVisualisation());
        $pdfStylesheet->load_css_file($cv->getTheme()->getCssPathVisualisation($this->getExtension()));
        return $pdfStylesheet;
    }

    protected function getExtension()
    {
        return 'pdf';
    }
}