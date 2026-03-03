<?php

namespace App\Http\Controllers;

use App\Models\PageSummary;
use Illuminate\Http\Request;

class PageSummaryController extends Controller
{
    /**
     * Add a new page summary
     */
    public function addPageSummary(Request $request)
    {
        $formFields = $request->validate([
            'muted_text' => ['nullable', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:255'],
        ]);

        if (auth()->check()) {
            $formFields['user_id'] = auth()->id();

            // sanitize
            $formFields['muted_text'] = strip_tags($formFields['muted_text']);
            $formFields['title'] = strip_tags($formFields['title']);
            $formFields['sub_title'] = strip_tags($formFields['sub_title']);

            PageSummary::create($formFields);

            return redirect('/')->with('message', 'Page summary added successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }

    /**
     * Update an existing page summary
     */
    public function updatePageSummary(PageSummary $pageSummary, Request $request)
    {
        $formFields = $request->validate([
            'muted_text' => ['nullable', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $pageSummary->user_id) {
            $formFields['muted_text'] = strip_tags($formFields['muted_text']);
            $formFields['title'] = strip_tags($formFields['title']);
            $formFields['sub_title'] = strip_tags($formFields['sub_title']);

            $pageSummary->update($formFields);

            return redirect('/')->with('message', 'Page summary updated successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }

    /**
     * Delete a page summary
     */
    public function deletePageSummary(PageSummary $pageSummary)
    {
        if (auth()->check() && auth()->id() === $pageSummary->user_id) {
            $pageSummary->delete();
            return redirect('/')->with('message', 'Page summary deleted successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }
}
