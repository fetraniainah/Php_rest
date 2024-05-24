<?php
namespace app\middlewares;

use app\core\Middleware;

class DebugMiddleware implements Middleware {
    public function handle() {
        // Placeholder debug logic
        error_log("Request received: " . json_encode($_REQUEST));
    }
}
?>