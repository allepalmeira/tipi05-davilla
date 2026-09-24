# API Confeitaria DaVilla

# 1. Objetivo da etapa
Já criamos e validamos a API pública, o próximo passo agora é permitir que um cliente se autentique usando e-mail e senha e receba um token para acessar rotas protegidas. Ao final desse fluxo teremos: O cliente fazendo login, recebendo um token e usando esse token nas próximas requisições protegidas do aplicativo.


# 2. Validação inicial do banco
docker compose exec mysql mysql -uuser -puser davilla -e "DESCRIBE tbl_clientes;"

docker compose exec mysql mysql -uuser -puser davilla -e "SELECT COUNT(*) AS clientes FROM tbl_clientes;"

# 3. Instalação e preparação do Laravel Sanctum

docker compose exec --user "$(id -u):$(id -g)" php php artisan install:api --without-migration-prompt

# 4. Model Cliente

docker compose exec --user "$(id -u):$(id -g)" php php artisan make:model Cliente

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'tbl_clientes';

    protected $primaryKey = 'id_cliente';

    public $timestamps = true;

    const CREATED_AT = 'criado_em_cliente';
    const UPDATED_AT = 'atualizado_em_cliente';

    protected $fillable = [
        'nome_cliente',
        'tipo_cliente',
        'cpf_cnpj_cliente',
        'data_nasc_cliente',
        'endereco_cliente',
        'numero_cliente',
        'complemento_cliente',
        'bairro_cliente',
        'cidade_cliente',
        'uf_cliente',
        'cep_cliente',
        'email_cliente',
        'senha_cliente',
        'telefone_cliente',
        'foto_cliente',
        'status_cliente',
    ];

    protected $hidden = [
        'senha_cliente',
    ];

    protected $casts = [
        'data_nasc_cliente' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->senha_cliente;
    }
}

# 5. AuthController

docker compose exec --user "$(id -u):$(id -g)" php php artisan make:controller Api/V1/AuthController

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ]);

        $cliente = Cliente::where(
            'email_cliente',
            $dados['email']
        )->first();

        if (
            !$cliente ||
            !Hash::check($dados['senha'], $cliente->senha_cliente)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'E-mail ou senha inválidos.'
            ], 401);
        }

        if ($cliente->status_cliente !== 'ATIVO') {
            return response()->json([
                'success' => false,
                'message' => 'Cliente inativo.'
            ], 403);
        }

        $nomeToken = $dados['device_name'] ?? 'app-mobile';

        // Evita acumular vários tokens com o mesmo nome.
        $cliente->tokens()
            ->where('name', $nomeToken)
            ->delete();

        $token = $cliente
            ->createToken($nomeToken)
            ->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'data' => [
                'token' => $token,
                'cliente' => [
                    'id_cliente' => $cliente->id_cliente,
                    'nome_cliente' => $cliente->nome_cliente,
                    'email_cliente' => $cliente->email_cliente,
                    'telefone_cliente' => $cliente->telefone_cliente,
                ]
            ]
        ]);
    }


    public function logout(Request $request): JsonResponse
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso.'
        ]);
    }
}


# 6. ClienteController

docker compose exec --user "$(id -u):$(id -g)" php php artisan make:controller Api/V1/ClienteController

•	show(): retorna os dados do cliente autenticado.
•	update(): atualiza os dados permitidos do perfil.
•	updateSenha(): válida a senha atual e grava a nova senha usando Hash:make().

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    }


    public function update(Request $request): JsonResponse
    {
        $cliente = $request->user();

        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:50',

            'tipo_cliente' => 'required|string|max:2',

            'cpf_cnpj_cliente' => [
                'required',
                'string',
                'max:18',
                Rule::unique(
                    'tbl_clientes',
                    'cpf_cnpj_cliente'
                )->ignore(
                    $cliente->id_cliente,
                    'id_cliente'
                ),
            ],

            'data_nasc_cliente' => 'required|date',

            'email_cliente' => [
                'required',
                'email',
                'max:80',
                Rule::unique(
                    'tbl_clientes',
                    'email_cliente'
                )->ignore(
                    $cliente->id_cliente,
                    'id_cliente'
                ),
            ],

            'telefone_cliente' => 'required|string|max:14',
        ]);

        $cliente->update($dados);

        return response()->json([
            'success' => true,
            'message' => 'Dados atualizados com sucesso.',
            'data' => $cliente->fresh()
        ]);
    }


    public function updateSenha(Request $request): JsonResponse
    {
        $cliente = $request->user();

        $dados = $request->validate([
            'senha_atual' => 'required|string',

            'nova_senha' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);

        if (
            !Hash::check(
                $dados['senha_atual'],
                $cliente->senha_cliente
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Senha atual incorreta.'
            ], 422);
        }

        $cliente->senha_cliente = Hash::make(
            $dados['nova_senha']
        );

        $cliente->save();

        return response()->json([
            'success' => true,
            'message' => 'Senha atualizada com sucesso.'
        ]);
    }
}

# 7. Rotas públicas e protegidas

A rota de login é pública; as demais ficam dentro do middleware auth:sanctum e todas elas fazem parte do Route::prefix('v1')->group(function () { 


 // LOGIN - rota pública
    Route::post('/auth/login', [AuthController::class, 'login']);

// ROTAS COM CREDENCIAL
Route::middleware('auth:sanctum')->group(function () {

    // Cliente logado
    Route::get('/cliente', [ClienteController::class, 'show']);

    // Atualizar os dados
    Route::put('/cliente', [ClienteController::class, 'update']);

    // Também permite atualização parcial
    Route::patch('/cliente', [ClienteController::class, 'update']);

    // Atualizar senha
    Route::put(
        '/cliente/senha',
        [ClienteController::class, 'updateSenha']
    );

    // Logout
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});


Método	Endpoint	            Acesso	        Objetivo
POST:	/api/v1/auth/login	    Público	        Autenticar e gerar token
GET:	/api/v1/cliente	        Token	        Consultar o próprio perfil
PUT:	/api/v1/cliente	        Token	        Atualizar dados do perfil
PATCH:	/api/v1/cliente	        Token	        Atualização parcial do perfil
PUT:	/api/v1/cliente/senha	Token	        Alterar a senha
POST:	/api/v1/auth/logout	    Token	        Invalidar o token atual


# 8. Teste via terminal:


# 8.1 Crie um cliente de teste na tabela: tbl_clientes usando Tinker 
Comando 1 para entrar no tinker:
docker compose exec php php artisan tinker

Comando 2 para criar o cliente:
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;


Cliente::forceCreate([
    'nome_cliente' => 'Cliente Teste',
    'tipo_cliente' => 'PF',
    'cpf_cnpj_cliente' => '000.000.000-00',
    'data_nasc_cliente' => '2000-01-01',
    'endereco_cliente' => 'Rua Teste',
    'numero_cliente' => '100',
    'complemento_cliente' => null,
    'bairro_cliente' => 'Centro',
    'cidade_cliente' => 'São Paulo',
    'uf_cliente' => 'SP',
    'cep_cliente' => '01000-000',
    'email_cliente' => 'cliente@davilla.com.br',
    'senha_cliente' => Hash::make('12345678'),
    'telefone_cliente' => '11999999999',
    'foto_cliente' => 'sem-foto.png',
    'status_cliente' => 'ATIVO',
]);

Comando 3 para sair do tinker:
exit


# Conferir a senha sem exibi-la

docker compose exec mysql \
mysql -uuser -puser davilla -e "
SELECT
    id_cliente,
    nome_cliente,
    email_cliente,
    LEFT(senha_cliente, 4) AS inicio_senha,
    LENGTH(senha_cliente) AS tamanho
FROM tbl_clientes;
"

O $2y$ é uma indicação de hash bcrypt.


# 9. Agora podemos testar o login

curl -X POST \
http://localhost:8081/api/v1/auth/login \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-d '{
    "email": "cliente@davilla.com.br",
    "senha": "12345678",
    "device_name": "aula-tipi05"
}'

# Exemplo de Retorno:
{"success":true,"message":"Login realizado com sucesso.","data":{"token":"4|H7O0PoZBHi8mianBBPcyHBh5FMFiGgvN5O6x5Tt7821e6659","cliente":{"id_cliente":1,"nome_cliente":"Cliente Teste Atualizado","email_cliente":"cliente@davilla.com.br","telefone_cliente":"11988888888"}}}



# 10. Teste de uma rota protegida

curl http://localhost:8081/api/v1/cliente \
-H "Accept: application/json" \
-H "Authorization: Bearer 4|H7O0PoZBHi8mianBBPcyHBh5FMFiGgvN5O6x5Tt7821e6659"

{"success":true,"data":{"id_cliente":1,"nome_cliente":"Cliente Teste Atualizado","tipo_cliente":"PF","cpf_cnpj_cliente":"000.000.000-00","data_nasc_cliente":"2000-01-01T00:00:00.000000Z","endereco_cliente":"Rua Teste","numero_cliente":"100","complemento_cliente":null,"bairro_cliente":"Centro","cidade_cliente":"S\u00e3o Paulo","uf_cliente":"SP","cep_cliente":"01000-000","email_cliente":"cliente@davilla.com.br","telefone_cliente":"11988888888","foto_cliente":"sem-foto.png","status_cliente":"ATIVO","criado_em_cliente":"2026-09-24T11:42:36.000000Z","atualizado_em_cliente":"2026-09-24T13:57:03.000000Z"}}alessandropsilva7@SMP0711494W11-1:~/dev/senac/tipi05/tipi05-davilla$


# 10.1 Testar atualização dos dados:
curl -X PUT \
http://localhost:8081/api/v1/cliente \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-H "Authorization: Bearer 1|SEU_TOKEN" \
-d '{
    "nome_cliente": "Cliente Teste Atualizado",
    "tipo_cliente": "PF",
    "cpf_cnpj_cliente": "000.000.000-00",
    "data_nasc_cliente": "2000-01-01",
    "email_cliente": "cliente@davilla.com.br",
    "telefone_cliente": "11988888888"
}'

# Validar:
curl \
http://localhost:8081/api/v1/cliente \
-H "Accept: application/json" \
-H "Authorization: Bearer 1|TOKEN"


# 10.2 Testar atualização de senha
curl -X PUT \
http://localhost:8081/api/v1/cliente/senha \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-H "Authorization: Bearer 1|TOKEN" \
-d '{
    "senha_atual": "12345678",
    "nova_senha": "NovaSenha123",
    "nova_senha_confirmation": "NovaSenha123"
}'


# 10.3 Testar logout
curl -X POST \
http://localhost:8081/api/v1/auth/logout \
-H "Accept: application/json" \
-H "Authorization: Bearer 1|TOKEN"