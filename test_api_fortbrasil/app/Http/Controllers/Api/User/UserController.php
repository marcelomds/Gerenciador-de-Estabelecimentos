<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->repository->all();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao Listar Usuários'], 400);
        }

        return response()->json($users, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * Registrar Novo Usuário
     */
    public function register(Request $request)
    {
        // Validar campos
        $request->validate([
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' => ['required', 'string', 'min:6']
        ],[
            'name.required' => 'O campo Nome é Obrigatório',
            'email.required' => 'O campo E-mail é Obrigatório',
            'password.required' => 'O campo Senha é Obrigatório',
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password)
        ]);

        return response()->json($user, 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws ValidationException
     *
     * Login de Usuário
     */
    public function login(Request $request)
    {
        // Validar campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
            ],[
            'email.required' => 'O campo E-mail é Obrigatório',
            'email.email' => 'O formato do E-mail está incorreto',
            'password.required' => 'O campo Senha é Obrigatório',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas']
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 200);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * Mostrar dados de usuário Logado
     */
    public function user()
    {
        $user = auth()->user();

        return response()->json($user, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Logout de Usuário Logado
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([], 200);
    }

}
