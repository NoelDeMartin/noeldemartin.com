<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CvPdf extends Controller
{
    public function __invoke(): BinaryFileResponse
    {
        $pdfPath = public_path('cv.pdf');

        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Noel De Martin - CV.pdf"',
        ]);
    }
}
