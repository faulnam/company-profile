<?php

namespace App\Http\Middleware;

use App\Models\DemoRecord;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanDemoContentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Opportunistic cleanup of expired demo records
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('demo_records')) {
                $expiredRecords = DemoRecord::where('expires_at', '<=', now())->get();
                foreach ($expiredRecords as $record) {
                    try {
                        $modelClass = $record->record_type;
                        if (class_exists($modelClass)) {
                            $item = $modelClass::find($record->record_id);
                            if ($item) {
                                $item->delete();
                            }
                        }
                    } catch (\Throwable $e) {
                        // ignore error to prevent breaking response
                    } finally {
                        $record->delete();
                    }
                }
            }
        } catch (\Throwable $e) {
            // ignore if database not available
        }

        return $next($request);
    }
}
