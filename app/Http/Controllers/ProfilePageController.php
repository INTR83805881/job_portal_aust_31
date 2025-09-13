<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\ContactController;
use App\Http\Controllers\Profile\SkillController;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function index(ProfileController $profile, Request $request)
    {
        return $profile->index($request);
    }

    public function storeApplicant(ProfileController $profile, Request $request)
    {
        return $profile->storeApplicant($request);
    }

    public function storeOrganization(ProfileController $profile, Request $request)
    {
        return $profile->storeOrganization($request);
    }

    public function updateApplicant(ProfileController $profile, Request $request)
    {
        return $profile->updateApplicant($request);
    }

    public function updateOrganization(ProfileController $profile, Request $request)
    {
        return $profile->updateOrganization($request);
    }

    public function storeApplicantContact(ContactController $contact, Request $request)
    {
        return $contact->storeApplicantContact($request);
    }

    public function updateApplicantContact(ContactController $contact, Request $request, $id)
    {
        return $contact->updateApplicantContact($request, $id);
    }

    public function storeOrganizationContact(ContactController $contact, Request $request)
    {
        return $contact->storeOrganizationContact($request);
    }

    public function updateOrganizationContact(ContactController $contact, Request $request, $id)
    {
        return $contact->updateOrganizationContact($request, $id);
    }

    public function storeApplicantSkill(SkillController $skill, Request $request)
    {
        return $skill->storeApplicantSkill($request);
    }
}
