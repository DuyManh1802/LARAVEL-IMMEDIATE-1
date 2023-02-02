<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Jobs\SendWelcomeEmail;

    class JobController extends Controller
    {
        /**
         * Handle Queue Process
         */
        public function enqueue(Request $request)
        {
            $details = new SendWelcomeEmail();
            dispatch($details);
        }
    }
?>