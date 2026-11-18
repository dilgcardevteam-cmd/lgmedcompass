<?php

namespace App\Http\Requests;

use App\Models\LgmedReport;

class UpdateLgmedReportRequest extends StoreLgmedReportRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', LgmedReport::class) ?? false;
    }
}
