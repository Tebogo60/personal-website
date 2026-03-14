<?php

namespace App\Http\Controllers;

use App\Models\PageSummary;
use App\Models\PageSummaryLink;
use Illuminate\Http\Request;

class PageSummaryLinkController extends Controller
{
    public function addPageSummaryLink(PageSummary $pageSummary, Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_type' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $pageSummary->user_id) {
            $formFields['page_summary_id'] = auth()->id();
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_type'] = strip_tags($formFields['link_type']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            PageSummaryLink::create($formFields);

            return redirect('/')->with('message', 'Page summary link added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updatePageSummaryLink(PageSummaryLink $pageSummaryLink, Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_type' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        $pageSummary = PageSummary::find($pageSummaryLink->page_summary_id);

        if ($pageSummary && auth()->check() && auth()->id() === $pageSummary->user_id) {
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_type'] = strip_tags($formFields['link_type']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            $pageSummaryLink->update($formFields);

            return redirect('/')->with('message', 'Page summary link updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deletePageSummaryLink(PageSummaryLink $pageSummaryLink)
    {
        $pageSummary = PageSummary::find($pageSummaryLink->page_summary_id);

        if ($pageSummary && auth()->check() && auth()->id() === $pageSummary->user_id) {
            $pageSummaryLink->delete();

            return redirect('/')->with('message', 'Page summary link deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
