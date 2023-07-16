<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;
class AjoutJWTheader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMzUyMzU1MmU5ZDNiYzk4YzYxM2Y3ZGZiNWQ0NTE1NmZjZGFkMDk1NDc2YmQzMjMyOWI1YWNhYzE0ZjNmOGIwMjEyYWMyYjdmNzA1MmM1NjYiLCJpYXQiOjE2ODkxNjYyMjguMDk3NzcyLCJuYmYiOjE2ODkxNjYyMjguMDk3Nzc0LCJleHAiOjE3MjA3ODg2MjguMDg2NTczLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ZOxJ7CGuf063vEuSC4sMKERUaVBVDdKOBoCX-2_NgK5pVr2j00UmPyDGtNuN5roOCpZNb2HDBBPvE6k9n5pW7ZYGjFLTXCZCjeUCYE9jxbbUW75CimXTqZngzoRdkJMw9s_sKRACvkx8t_XvbEm0JvtTHTfsszC3Tyzgr58vs55yMrg9Ykgg1W2UktjRmksFoZ346x9Gs8Wh_Wo8a9Xud-8h5a0O9E_-yXjnGNlvOmrr1bkGze9NY80FseVpNvDNRAeYyv-59Mjab3vk4eBGLM9rH3QMZA-tSX_mISaFCqsVqW6qPsn2jRvta81z_YQIIXffrH9O1nmX-8BRTzt5LCLZrfP9fo_7SCAM-W-5amg4VOUi_jKy7NHnS7iN9iGLqcVrh35mgnA_5yKAeUmD_KpbmgiTNkA9A_l7TNS0xo4kKE30j2mY3dX6UxdFRapUGUOrHRlXo4xcbldP_qKdiMh4evVJdufQQSJ5wy6_FZJvWFG1kON1YZZG-mocGD0f2LkVF49Nf6CewY69thBXV6htY_g-ItRu2qYkt3i4-KCQUCd8I4SSHVNUuqeMWomuARnMAiIgeTGV3bsWJr7a8VuieJL-1hROnHjLpQSgXGzmxhOc4Q_4L3j9YxwpuYrSjw-Z_pXDQ_do33IHqdZxdO146oly_mxS_Iccf7NWQdg";

        if ($token){
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        return $next($request);
    }
}
