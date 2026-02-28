<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class SocialMediaLinkController extends Controller
{
    //
    public function addSocialMediaLink(Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->check()) {

            $formFields['user_id'] = auth()->id();
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            SocialMediaLink::create($formFields);
            return redirect('/')->with('message', 'Social media link added successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }

    public function updateSocialMediaLink(SocialMediaLink $socialMediaLink, Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $socialMediaLink->user_id) {
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            $socialMediaLink->update($formFields);
            return redirect('/')->with('message', 'Social media link updated successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }

    public function deleteSocialMediaLink(SocialMediaLink $socialMediaLink)
    {
        if (auth()->check() && auth()->id() === $socialMediaLink->user_id) {
            $socialMediaLink->delete();
            return redirect('/')->with('message', 'Social media link deleted successfully!');
        }

        return redirect('/login')->withErrors(['message' => 'Could not verify credentials, please login!']);
    }
}
