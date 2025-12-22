<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int|null  $departmentName
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $departmentName = null)
    {
        $user = Auth::user();

        $employee = $user->employee;

        // Check state
        if ($user->Is_Active !== 1) {
            abort(403, 'Your account is inactive.');
        }

        // Check department
        if($employee->department->DeptName === 'Headquarters') {
            return $next($request);
        }


        elseif ($departmentName && $employee->department->DeptName != $departmentName) {
            abort(403, 'You do not have access to this department.');
        }

        return $next($request);
    }
}
