<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Repositories\{UserRepository};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $messageLogRepository;
    protected $temporality_points;
    protected $ticketRepository;
    protected $promotionRepository;
    protected $userRepository;

    public function __construct ()
    {
        $this->middleware('auth:admin');

        $this->userRepository = new UserRepository;
    }

    /**
     * Displays all users
     * @return View admin.users.index
     */
    public function index ()
    {
        $users = $this->userRepository->all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display user details
     * @param int $id
     * @return View admin.users.show
     */
    public function show (User $user)
    {
        return view('admin.users.show', compact([
                                                    'user'
                                                ]));
    }

    /**
     * Shows Conversation Template
     * @param int $user_id
     * @return View admin.users.conversation
     */
    public function showUserConversation ($user_id) 
    {
        return view('admin.users.conversation');
    }

    /**
     * 
     */
    public function update ($user_id, Request $request)
    {
        $user = User::find($user_id);
        $user->update(['active' => $request->active]);

        return redirect(route('admin.users.show', $user_id));
    }

    /**
     * Block or unblock a user
     * @param Request $request
     * @return redirect /admin/usuarios/{user_id}
     */
    public function blockUser (Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            abort(404);
        }

        // Block/Unblock user
        $user->active = !$user->active;
        $user->save();

        return redirect('/admin/usuarios/' . $user->id);
    }

    /**
     * Add obsevations about user participation
     * @param Request $request
     * @return Redirect
     */
    public function addObservations (Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            abort(404);
        }

        $user->observations = $request->observations;
        $user->save();

        return redirect()->back();
    }

    /**
     * Delete all User Data
     * @param User $user
     * @return Redirect
     */
    public function delete (Request $request) 
    {
        $admin = \Auth::user();

        if ($admin->cant('deleteUsers', $admin)) {
            redirect('/admin/home');
        } 

        // Find Whatsapp Number Register
        $wa = $this->wa_numberRepository->findNumber($request->wa_id);

        // Delete tickets
        $this->ticketRepository->deleteUserTickets($wa->id);

        // Delete temporality_points
        $this->temporality_points->deleteUserPoints($wa->id);

        // Delete Messages
        $this->messageLogRepository->deleteUserMessages($wa->id);
        
        // Delete Bot Status
        $wa->status()->detach();

        // Delete Whatsapp_number
        $this->wa_numberRepository->deleteWhatsappNumber($wa->id);

        // Delete User
        $user = User::find($wa->user_id);
        $user->delete();

        return redirect('/admin/usuarios');
    }
}
