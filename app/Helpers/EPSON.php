<?php

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\RTLBuffer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class EPSON
{

    public static function deskPrint($inputs)
    {
        $printer = self::USBPrint($inputs['printer_ip']);
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        // Image
        $img = EscposImage::load(public_path('assets/images/ganz-logo-print.jpg'));
        $printer->graphics($img, Printer::IMG_DEFAULT);
//        $printer->feed(1);

        // Queue Number
        $printer->setTextSize(4, 4);
        $printer->setEmphasis(true);
        $printer->setFont(Printer::FONT_A);
        $printer->text($inputs['queue_number'] . "\n");
        $printer->initialize();

        $printer->feed(1);
        $printer->setTextSize(2, 2);
        $printer->setFont(Printer::FONT_B);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text(date('h:i:s A - dMY') . "\n");

        $printer->cut();

        // Close printer
        $printer->close();
    }

    public static function USBPrint($printerIp)
    {
//        $connector = new WindowsPrintConnector($printerName);
//        $printer = new Printer($connector);
        $connector = new NetworkPrintConnector($printerIp, 9100);
        $printer = new Printer($connector);
        return $printer;
    }

    public static function Test()
    {
        try {
            $connector = new NetworkPrintConnector("10.1.10.225", 9100);
            $printer = new Printer($connector);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $img = EscposImage::load(public_path('images/sgh-logo.jpg'));
            $printer->graphics($img, 3);
            $printer->setTextSize(4, 4);
            $printer->setEmphasis(true);
            $printer->text("Hi Hossam\n");
            $printer->cut();

            /* Close printer */
            $printer->close();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}