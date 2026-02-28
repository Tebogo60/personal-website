<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSummaryLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_summary_id',
        'link_name',
        'link_type',
        'link_url'
    ];

    public function pageSummary()
    {
        return $this->belongsTo(PageSummary::class);
    }
}
