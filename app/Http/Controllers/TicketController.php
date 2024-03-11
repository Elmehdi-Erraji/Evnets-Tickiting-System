<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{

    public function getTicket($reservationId)
    {
        $user = Auth::user();

        $reservation = $user->events()->withPivot('status','num_tickets')->where('event_id', $reservationId)->first();

        return view('partials.ticket', compact('reservation'));
    }


    public function downloadTicket($reservationId)
    {
        $user = Auth::user();

        $reservation = $user->events()->withPivot('status','num_tickets')->where('event_id', $reservationId)->first();

        // Generate PDF for the ticket
        $pdf = $this->generateTicketPDF($reservation);

        // Generate file name
        $fileName = 'ticket_' . $reservationId . '.pdf';

        // Download PDF
        return $pdf->stream($fileName);
    }
    private function generateTicketPDF($reservation)
    {
        // Render the ticket view to HTML content
        $html = view::make('partials.ticket', compact('reservation'))->render();

        // Initialize Dompdf
        $dompdf = new Dompdf();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set PDF options like paper size, etc.
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        return $dompdf;
    }
}
