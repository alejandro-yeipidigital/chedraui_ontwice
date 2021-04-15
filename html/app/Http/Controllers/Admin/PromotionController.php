<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RankingExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\{DownloadRankingRequest};
use App\Models\{Country, Temporality, Promotion};
use App\Repositories\{AccountRepository, CountryRepository, PromotionRepository, TemporalityPointsRepository, TicketRepository, UserRepository};
use App\Services\{TemporalityServiceClass};

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $countryRepository;
    protected $accountRepository;
    protected $temporalityService;
    protected $temporalityPointsRepository;

    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {
                                        return (\Auth::user()->cannot('accessPromotions', \Auth::user())) ? redirect('/admin/home') : $next($request);
                                    });

        $this->accountRepository            = new AccountRepository;
        $this->countryRepository            = new CountryRepository;
        $this->promotionRepository          = new PromotionRepository;
        $this->temporalityPointsRepository  = new TemporalityPointsRepository;
        $this->temporalityService           = new TemporalityServiceClass;
        $this->ticketRepository             = new TicketRepository;
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
        $promotions = $this->promotionRepository->allPromotions();
        
        foreach ($promotions as $promotion) {
            // Add temporality to promotions
            $promotion->temporality_name = $this->getPromotionCurrentTemporality($promotion->id);
        }

        return view('admin.promotions.index')->with(compact(['promotions']));
    }

    /**
     * Displays country details
     * @param Country $promotion
     * @return View admin.countries.show
     */
    public function show (Promotion $promotion) 
    {
        // Add temporality to country
        $promotion->temporality_name = $this->getPromotionCurrentTemporality($promotion->id);

        // Get Statistics
        $total_users                = $this->userRepository->countUsers();
        $total_registred_users      = $this->userRepository->countRegisteredUsers();
        $tickets                    = $this->ticketRepository->countAllTickets();
        $sended                     = $this->promotionRepository->messagesByPromotion($promotion->id, 'sent');
        $received                   = $this->promotionRepository->messagesByPromotion($promotion->id, 'received');

        // General data
        $response = [
            0 => [
                'classification'    => "Mayoría de Edad",
                'total'             => $promotion->country->age_majority
            ],
            1 => [
                'classification'    => "Tickets Registrados",
                'total'             => $tickets
            ],
            2 => [
                'classification'    => "Usuarios Que Escribieron",
                'total'             => $total_users
            ],
            3 => [
                'classification'    => "Usuarios Registrados",
                'total'             => $total_registred_users
            ],
            4 => [
                'classification'    => "Mensajes Recibidos",
                'total'             => $received
            ],
            5 => [
                'classification'    => "Mensajes Enviados",
                'total'             => $sended
            ]
        ];

        $response = json_encode($response);

        // Get Whatsapp Numbers
        $numbers = $this->accountRepository->getNumbersByCountry($promotion->id);

        // Get Temporalities
        $temporalities = $this->promotionRepository->getPromotionTemporalities($promotion->id);

        return view('admin.promotions.show')->with(compact([
                                                            'promotion',
                                                            'numbers',
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
     * Download temporality temporality
     * @param DownloadRankingRequest $request
     * @return file $temporality_ranking
     */
    public function downloadTemporalityRanking(DownloadRankingRequest $request) 
    {
        $promotion = Temporality::find($request->temporality_id);

        return (new RankingExport($request->temporality_id))->download('Ranking ' . $promotion->name .'.xlsx');
    }

    /**
     * Display temporality ranking
     * @param Temporality $temporality
     * @return View
     */
    public function displayTemporalityRanking(Temporality $temporality) 
    {
        $ranking = $this->temporalityPointsRepository->getRankingByTemporalityReport($temporality->id);

        return view('admin.promotions.ranking_show')->with(compact(['ranking', 'temporality']));
    }
}
