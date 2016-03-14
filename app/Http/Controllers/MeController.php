<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use GrahamCampbell\GitHub\GitHubManager;

/**
 * Class MeController
 *
 * @package App\Http\Controllers
 * @author Jason Michels <michelsja@icloud.com>
 * @author Ozzie
 */
class MeController extends Controller
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @var GitHubManager
     */
    private $gitHubManager;

    /**
     * MeController constructor.
     * @param Guard $auth
     * @param GitHubManager $gitHubManager
     */
    public function __construct(Guard $auth, GitHubManager $gitHubManager)
    {
        $this->auth = $auth;
        $this->gitHubManager = $gitHubManager;
    }

    /**
     * Get authenticated users github repositories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function repos()
    {
        $user = $this->auth->user();
        $repositories = $this->gitHubManager->api('user')->repositories($user->github_username);

        return response()->json($repositories);
    }
}
