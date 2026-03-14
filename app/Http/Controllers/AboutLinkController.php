<?php

namespace App\Http\Controllers;

use App\Models\AboutLink;
use App\Models\AboutUser;
use Illuminate\Http\Request;

class AboutLinkController extends Controller
{
    public function addAboutLink(AboutUser $aboutUser, Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_icon' => ['nullable', 'string', 'max:255'],
            'link_type' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        if (auth()->check() && auth()->id() === $aboutUser->user_id) {
            $formFields['about_user_id'] = $aboutUser->id;
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_icon'] = isset($formFields['link_icon']) ? strip_tags($formFields['link_icon']) : null;
            $formFields['link_type'] = strip_tags($formFields['link_type']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            AboutLink::create($formFields);

            return redirect('/')->with('message', 'About link added successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function updateAboutLink(AboutLink $aboutLink, Request $request)
    {
        $formFields = $request->validate([
            'link_name' => ['required', 'string', 'max:255'],
            'link_icon' => ['nullable', 'string', 'max:255'],
            'link_type' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string', 'max:255'],
        ]);

        $aboutUser = AboutUser::find($aboutLink->about_user_id);

        if ($aboutUser && auth()->check() && auth()->id() === $aboutUser->user_id) {
            $formFields['link_name'] = strip_tags($formFields['link_name']);
            $formFields['link_icon'] = isset($formFields['link_icon']) ? strip_tags($formFields['link_icon']) : null;
            $formFields['link_type'] = strip_tags($formFields['link_type']);
            $formFields['link_url'] = filter_var($formFields['link_url'], FILTER_SANITIZE_URL);

            $aboutLink->update($formFields);

            return redirect('/')->with('message', 'About link updated successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }

    public function deleteAboutLink(AboutLink $aboutLink)
    {
        $aboutUser = AboutUser::find($aboutLink->about_user_id);

        if ($aboutUser && auth()->check() && auth()->id() === $aboutUser->user_id) {
            $aboutLink->delete();

            return redirect('/')->with('message', 'About link deleted successfully!');
        }

        return redirect('/login')->withErrors([
            'message' => 'Could not verify credentials, please login!',
        ]);
    }
}
