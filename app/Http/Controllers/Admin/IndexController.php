<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Chart\{Chart, DataSeries, DataSeriesValues, Legend, PlotArea, Title};
use PhpOffice\PhpSpreadsheet\Chart\Layout;



class IndexController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalReservations = Reservation::count();
        $recentEvents = Event::orderBy('created_at', 'desc')->take(5)->get();
        $eventsWithReservations = Event::withCount('reservations')->get();
        $newUsersThisDay = User::whereDay('created_at', now()->day)->count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
        $registrationsThisYear = User::whereYear('created_at', now()->year)->count();
        
        // Récupérer les utilisateurs par rôle
        $adminsCount = User::role('Admin')->count();
        $organizersCount = User::role('Organizer')->count();
        $participantsCount = User::role('Participant')->count();
    
        // Répartition des événements par catégorie
        $eventCategories = Event::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');
    
        // Réservations par événement
        $eventNames = Event::pluck('name');
        $reservationsCount = Event::withCount('reservations')->pluck('reservations_count');
        $eventCapacities = Event::pluck('available_tickets');
    
        // Évolution des inscriptions (mensuel)
        $monthlyRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->all();
    
        // Nouveaux utilisateurs par jour (semaine en cours)
        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $newUsersWeekly = [];
        $startOfWeek = now()->startOfWeek(); // Début de la semaine
        
        foreach ($weekDays as $index => $day) {
            $date = $startOfWeek->copy()->addDays($index); // Copie la date et ajoute l'index
            $newUsersWeekly[] = User::whereDate('created_at', $date)->count();
        }
        
        $averageRatings = Event::with('comments')
        ->get()
        ->mapWithKeys(function ($event) {
            // Calcul de la moyenne des ratings pour cet événement
            $averageRating = $event->comments->avg('rating') ?? 0;
            return [$event->name => $averageRating];
        });
    
        return view('admin.index', compact(
            'totalUsers', 'totalEvents', 'totalReservations', 'recentEvents', 'eventsWithReservations',
            'newUsersThisMonth', 'newUsersThisDay', 'registrationsThisYear', 'adminsCount', 'organizersCount', 
            'participantsCount', 'eventCategories', 'eventNames', 'reservationsCount', 'eventCapacities',
            'monthlyRegistrations', 'weekDays', 'newUsersWeekly','averageRatings'
        ));
    }
    
    public function downloadPdf()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalReservations = Reservation::count();
        $recentEvents = Event::orderBy('created_at', 'desc')->take(5)->get();
        $eventsWithReservations = Event::withCount('reservations')->get();
        $newUsersThisDay = User::whereDay('created_at', now()->day)->count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
        $registrationsThisYear = User::whereYear('created_at', now()->year)->count();
        
        // Récupérer les utilisateurs par rôle
        $adminsCount = User::role('Admin')->count();
        $organizersCount = User::role('Organizer')->count();
        $participantsCount = User::role('Participant')->count();
    
        // Répartition des événements par catégorie
        $eventCategories = Event::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');
    
        // Réservations par événement
        $eventNames = Event::pluck('name');
        $reservationsCount = Event::withCount('reservations')->pluck('reservations_count');
        $eventCapacities = Event::pluck('available_tickets');
    
        // Évolution des inscriptions (mensuel)
        $monthlyRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->all();
    
        // Nouveaux utilisateurs par jour (semaine en cours)
        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $newUsersWeekly = [];
        $startOfWeek = now()->startOfWeek(); // Début de la semaine
        
        foreach ($weekDays as $index => $day) {
            $date = $startOfWeek->copy()->addDays($index); // Copie la date et ajoute l'index
            $newUsersWeekly[] = User::whereDate('created_at', $date)->count();
        }
        
    
        $pdf = Pdf::loadView('admin.statistics-pdf', compact( 'totalUsers', 'totalEvents', 'totalReservations', 'recentEvents', 'eventsWithReservations',
        'newUsersThisMonth', 'newUsersThisDay', 'registrationsThisYear', 'adminsCount', 'organizersCount', 
        'participantsCount', 'eventCategories', 'eventNames', 'reservationsCount', 'eventCapacities',
        'monthlyRegistrations', 'weekDays', 'newUsersWeekly'));

        return $pdf->download('statistiques.pdf');
    }

       




    public function downloadExcel()
    {
        // Création du fichier Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Définir le style pour les titres
        $titleStyle = [
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
    
        // Définir le style pour les sous-titres
        $subtitleStyle = [
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['argb' => 'FF000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFF0F0F0'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
    
        // Définir le style général pour les cellules de données
        $dataStyle = [
            'font' => [
                'size' => 12,
                'color' => ['argb' => 'FF000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
    
        // Section 1 : Statistiques Générales
        $sheet->setCellValue('A1', 'Statistiques Générales');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1:B1')->applyFromArray($titleStyle);
    
        $sheet->setCellValue('A2', 'Total Utilisateurs:');
        $sheet->setCellValue('B2', User::count());
        $sheet->setCellValue('A3', 'Total Événements:');
        $sheet->setCellValue('B3', Event::count());
        $sheet->setCellValue('A4', 'Total Réservations:');
        $sheet->setCellValue('B4', Reservation::count());
        $sheet->setCellValue('A5', 'Nouveaux Utilisateurs Aujourd\'hui:');
        $sheet->setCellValue('B5', User::whereDay('created_at', now()->day)->count());
        $sheet->setCellValue('A6', 'Nouveaux Utilisateurs Ce Mois-ci:');
        $sheet->setCellValue('B6', User::whereMonth('created_at', now()->month)->count());
        $sheet->setCellValue('A7', 'Inscriptions Cette Année:');
        $sheet->setCellValue('B7', User::whereYear('created_at', now()->year)->count());
    
        $sheet->getStyle('A2:B7')->applyFromArray($dataStyle);
    
        // Section 2 : Statistiques des Événements
        $sheet->setCellValue('A10', 'Statistiques des Événements');
        $sheet->mergeCells('A10:B10');
        $sheet->getStyle('A10:B10')->applyFromArray($titleStyle);
    
        $sheet->setCellValue('A11', 'Événements Passés:');
        $sheet->setCellValue('B11', Event::where('end_date', '<', now())->count());
        $sheet->setCellValue('A12', 'Événements à Venir:');
        $sheet->setCellValue('B12', Event::where('start_date', '>', now())->count());
    
        $sheet->getStyle('A11:B12')->applyFromArray($dataStyle);
    
        // Section 3 : Répartition des Événements par Catégorie
        $sheet->setCellValue('A15', 'Répartition des Événements par Catégorie');
        $sheet->mergeCells('A15:B15');
        $sheet->getStyle('A15:B15')->applyFromArray($titleStyle);
    
        $categories = Event::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');
    
        $row = 16;
        foreach ($categories as $category => $total) {
            $sheet->setCellValue('A' . $row, $category);
            $sheet->setCellValue('B' . $row, $total);
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($dataStyle);
            $row++;
        }
    
        // Ajuster la largeur des colonnes pour une meilleure lisibilité
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
    
        // Ajout d'un graphique pour la répartition des catégories
        $dataSeriesLabels = [new DataSeriesValues('String', 'Worksheet!$A$15', null, 1)];
        $xAxisTickValues = [new DataSeriesValues('String', 'Worksheet!$A$16:$A$' . ($row - 1), null, 4)];
        $dataSeriesValues = [new DataSeriesValues('Number', 'Worksheet!$B$16:$B$' . ($row - 1), null, 4)];
    
        $series = new DataSeries(
            DataSeries::TYPE_PIECHART, // Type de graphique
            null,                      // Pas de disposition
            range(0, count($dataSeriesValues) - 1), // Plages de données
            $dataSeriesLabels,         // Légendes des séries
            $xAxisTickValues,          // Légendes des axes
            $dataSeriesValues          // Valeurs des séries
        );
    
        $layout = new Layout();
        $layout->setShowVal(true);
    
        $plotArea = new PlotArea($layout, [$series]);
        $chart = new Chart(
            'chart1',               // Nom du graphique
            new Title('Répartition des Événements par Catégorie'), // Titre du graphique
            new Legend(Legend::POSITION_RIGHT, null, false),       // Légende
            $plotArea               // Zone du graphique
        );
    
        $chart->setTopLeftPosition('E15');
        $chart->setBottomRightPosition('L25');
        $sheet->addChart($chart);
    
        // Section 4 : Analyse des Réservations par Utilisateur
        $sheet->setCellValue('A30', 'Analyse des Réservations par Utilisateur');
        $sheet->mergeCells('A30:B30');
        $sheet->getStyle('A30:B30')->applyFromArray($titleStyle);
    
        $reservations = Reservation::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->pluck('total', 'user_id');
    
        $row = 31;
        foreach ($reservations as $userId => $total) {
            $sheet->setCellValue('A' . $row, User::find($userId)->name);
            $sheet->setCellValue('B' . $row, $total);
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($dataStyle);
            $row++;
        }
    
        // Ajuster la largeur des colonnes pour une meilleure lisibilité
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
    
        // Sauvegarde du fichier Excel avec graphiques
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
    
        $filename = 'statistiques_complexes.xlsx';
        $writer->save($filename);
    
        // Téléchargement du fichier Excel
        return response()->download($filename)->deleteFileAfterSend(true);
    }
    



       

}
