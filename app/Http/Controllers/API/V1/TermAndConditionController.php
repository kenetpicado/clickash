<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Services\SettingService;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {
    }

    public function __invoke(Request $request)
    {
        return SettingResource::make($this->settingService->getTermsAndConditions());
    }
}
