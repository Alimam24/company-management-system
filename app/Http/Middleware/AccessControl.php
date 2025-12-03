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
     * @param  string|null  $roleName
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $departmentName = null, $roleName = null)
    {
        $user = Auth::user();

        $employee = $user->employee;

        // // Check state
        // if ($employee->emp_state->StateName !== 'Active Employee') {
        //     abort(403, 'Your account is inactive.');
        // }

        // Check department
        if ($departmentName && $employee->department->DeptName != $departmentName) {
            abort(403, 'You do not have access to this department.');
        }

        // Check role
        if ($roleName && $employee->role->name != $roleName) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
