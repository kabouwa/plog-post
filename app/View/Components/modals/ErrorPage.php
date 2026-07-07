<?php

namespace App\View\Components\modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorPage extends Component
{
    public $status;
    public string $title;
    public string $message;
    public string $button;
    public string $href;
    public function __construct(
        int $status = 404
    )
    {
        $this->href = route('posts.index');
        switch ($status) {
            case 403:
                $this->title = 'Access Denied';
                $this->message = "You don't have permission to access this page or perform this action. If you believe this is a mistake, please contact the site administrator.";
                $this->button = 'Return Home';
                break;

            case 404:
                $this->title = 'Not Found';
                $this->message = "The page you're looking for doesn't exist, may have been moved, or the URL might be incorrect.";
                $this->button = 'Return Home';
                break;

            case 419:
                $this->title = 'Session Expired';
                $this->message = 'Your session has expired for security reasons. Please refresh the page and try again.';
                $this->button = 'Refresh Page';
                $this->href = url()->current();
                break;

            case 429:
                $this->title = 'Too Many Requests';
                $this->message = "You've sent too many requests in a short period. Please wait a moment before trying again.";
                $this->button = 'Try Again Later';
                $this->href = url()->previous();
                break;

            case 500:
                $this->title = 'Something Went Wrong';
                $this->message = "An unexpected error occurred while processing your request. We're working to resolve the issue. Please try again in a few moments.";
                $this->button = 'Return Home';
                break;

            case 503:
                $this->title = "We'll Be Back Soon";
                $this->message = 'Our website is temporarily unavailable due to maintenance. Please check back in a few minutes.';
                $this->button = 'Refresh';
                $this->href = url()->current();
                break;

            default:
                $this->title = 'Unexpected Error';
                $this->message = 'An unexpected error occurred. Please try again later.';
                $this->button = 'Return Home';
                break;
        }

        $this->status = str_split((string) $status);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.error-page');
    }
}
