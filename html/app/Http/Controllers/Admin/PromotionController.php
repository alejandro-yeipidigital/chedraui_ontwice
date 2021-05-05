<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RankingExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\{DownloadRankingRequest};
use App\Models\{Country, Temporality, Promotion, UserPoint};
use App\Repositories\{PromotionRepository, TemporalityPointsRepository, UserRepository};
use App\Services\{TemporalityServiceClass};
use App\Traits\{CsvExportTrait, TemporalityTrait};

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    use TemporalityTrait;
    use CsvExportTrait;

    protected $temporalityService;
    protected $temporalityPointsRepository;

    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
                                        return (\Auth::user()->cannot('accessPromotions', \Auth::user())) ? redirect('/admin/home') : $next($request);
                                    });

        $this->promotionRepository          = new PromotionRepository;
        $this->temporalityPointsRepository  = new TemporalityPointsRepository;
        $this->temporalityService           = new TemporalityServiceClass;
        $this->userRepository               = new UserRepository;
    }        

    /**
     * Shows all Participating Countries and its current temporality
     * 
     * @param none
     * @return View admin.countries.index
     */
    public function index () 
    {
        // Get all promotions
        $promotions = [
                                'id'                => 1,
                                'name'              => "Una promo grande como El Sol",
                                'temporality_name'  => $this->activeTemporality()->name
                            ];        

        return view('admin.promotions.index')->with(compact(['promotions']));
    }

    /**
     * Displays country details
     * @param Country $promotion
     * @return View admin.countries.show
     */
    public function show ($promotion_id) 
    {
        // Create a promotion array
        $promotion = [];
        // Add temporality to country
        $promotion['name'] = "Saladitas Cuaresma";
        $promotion['temporality_name'] = $this->activeTemporality()->name;

        // Get Statistics
        // $total_users                = $this->userRepository->countUsers();
        // $total_registred_users      = $this->userRepository->countRegisteredUsers();
        // $tickets                    = $this->ticketRepository->countAllTickets();

        // General data
        $response = [
            0 => [
                'classification'    => "Mayoría de Edad",
                'total'             => 18
            ],
            1 => [
                'classification'    => "Tickets Registrados",
                'total'             => 200
            ],
            3 => [
                'classification'    => "Usuarios Participando",
                'total'             => 2
            ],
            4 => [
                'classification'    => "Usuarios Registro Completo",
                'total'             => 1
            ]
        ];

        $response = json_encode($response);

        // Get Temporalities
        $temporalities = Temporality::whereFinalized(0)->get();

        return view('admin.promotions.show')->with(compact([
                                                            'promotion',
                                                            'temporalities',  
                                                            'response'
                                                        ]));
    }

    /**
     * Block or unblock a promotion
     * @param Request $request
     * @return redirect /admin/usuarios/{user_id}
     */
    public function blockPromotion(Request $request) 
    {
        // Find promotion
        $promotion = $this->promotionRepository->findPromotion($request->promotion_id);

        if (!$promotion) {
            abort(404);
        }

        // Block/Unblock promotion
        $this->promotionRepository->switchActivePromotion($promotion->id, !$promotion->active);

        // Block/Unlock Accounts
        $accounts = $this->accountRepository->getNumbersByCountry($promotion->country_id);
        foreach ($accounts as $account) {
            $this->accountRepository->switchActiveAccount($account->id, !$promotion->active);
        }

        return redirect('/admin/promociones/' . $promotion->id);
    }

    /**
     * Get the Promotion's current Temporality Name
     * @param int $Promotion_id
     * @return string $temporality_name
     */
    public function getPromotionCurrentTemporality(int $promotion_id) : string 
    {
        $temporality = $this->temporalityService->getCurrentTemporality($promotion_id);
        return $temporality->name ?? 'Finalizada';
    }

    /**
     * Switch account status
     * @param Request $request
     * @return Redirect
     */
    public function switchAccountStatus(Request $request) 
    {
        // Find Country
        $account = $this->accountRepository->findAccount($request->account_id);

        if (!$account) {
            abort(404);
        }

        // Activate/Deactivate account
        $this->accountRepository->switchActiveAccount($account->id, !$account->active);

        return redirect()->back();
    }

    /**
     * Display form to update ticket validation metrics
     * @param Country $param
     * @return View admin.countries.ticket_metrics
     */
    public function editMetrics(Promotion $promotion) 
    {
        return view('admin.promotions.edit_ticket_metrics')->with(compact(['promotion']));
    }

    /**
     * Update Ticket Validation Metrics
     * @param Request $request
     * @return Redirect
     */
    public function updateTicketValidationMetrics(Request $request) 
    {
        $this->promotionRepository->updateTicketValidationMetrics($request->country_id, $request->metrics);

        return redirect('admin/promociones/' . $request->country_id);
    }

    /**
     * Exports query results to a CSV file
     * 
     * @param Request $request
     * @return CSV
     */
    public function downloadTemporalityRanking (Request $request)
    {
        // Obtain temporality name
        $temporality = Temporality::find($request->temporality_id);
        
        // Create params required to csv export
        $name       = 'Ranking_' . $temporality->name;
        $location   = '/rankings';
        $data       = $this->getRanking($request->temporality_id)->toArray();

        return $this->exportToCsv($name, $location, $data);
    }

    /**
     * Display temporality ranking
     * @param Temporality $temporality
     * @return View
     */
    public function displayTemporalityRanking(Temporality $temporality) 
    {
        $ranking = $this->getRanking($temporality->id);

        return view('admin.promotions.ranking_show')->with(compact(['ranking', 'temporality']));
    }

    /**
     * Get ranking by specific temporality
     * 
     * @param int $temporality_id
     * @return Ranking
     */
    public function getRanking (int $temporality_id)
    {
        return $users = UserPoint::whereTemporalityId($temporality_id)
                    ->join('users', 'users.id', '=', 'user_points.user_id')
                    ->where('points', '>', 0)
                    ->where('users.active', '=', 1)
                    ->orderBy('points', 'desc')
                    ->get([
                        'points AS Puntos',
                        'users.name AS Nombre',
                        'users.middle_name AS Apellido_Materno',
                        'users.last_name AS Apellido_Paterno',
                        'users.email AS Correo',
                        'users.telephone AS Telefono',
                        'users.birthday AS Fecha_Nacimiento'
                    ]);
    }
}
