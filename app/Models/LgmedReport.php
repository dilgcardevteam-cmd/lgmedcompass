<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LgmedReport extends Model
{
    use HasFactory;

    /**
     * Fields searched by the free-text search box.
     *
     * @var list<string>
     */
    public const SEARCHABLE = [
        'ppa',
        'frequency',
        'timelines',
        'focal_person',
        'section',
        'mode_of_submission',
        'monitoring_link',
        'ppa_category',
        'legal_basis_reference',
        'remarks',
    ];

    /**
     * Fields that have a dropdown filter on the index page.
     *
     * @var list<string>
     */
    public const FILTERABLE = ['section', 'frequency', 'ppa_category', 'end_user_level'];

    public const OTHER_FREQUENCY = 'Others - specify';

    /**
     * Fields that can hold several people, stored as one name per line.
     *
     * @var list<string>
     */
    public const MULTI_VALUE_FIELDS = ['focal_person'];

    /**
     * Dropdown options used by the add/edit form.
     *
     * @return array<string, list<string>>
     */
    public static function dropdownOptions(): array
    {
        return [
            'frequency' => [
                'Annual', 'Semestral', 'Quarterly', 'Bi-Monthly', 'Monthly', 'Weekly', 'Daily',
                'Once only', 'As need arises', self::OTHER_FREQUENCY,
            ],
            'person' => [
                'ADC Bable G. Adnol',
                'LGOO IV Alex Ian A. Pacis, Jr.',
                'LGOO IV Sigfred G. Bumangil',
                'LGOO V Allan F. Ocal',
                'LGOO V Lala G. Geron',
                'LGOO V Mary Jheama Rachine E. Canullas',
                'STAT II Jhosua Philip A. Palaruan',
                'STAT I Jan Mikhail P. Kimayong',
                'PEO II Angelo Cornelio',
                'PEO I Matt Andrei Gallamos',
                'ADAC-RTA Nikko May L. Gunday',
            ],
            'section' => [
                'Local Governance Relations and Policy Compliance Section (LG-RPCS)',
                'Local Governance Performance Management, Recognition, and Awards Section (LG-PMRAS)',
                'Local Governance Peace and Order and Public Safety Compliance and Monitoring (LG-POPSCM)',
                'Support Services Unit (SSU)',
                'Database and Statistical Unit (DSU)',
            ],
            'end_user_level' => [
                'All Levels',
                'Region, Province, HUC, CC, Municipality, Barangay',
                'Region, Province, HUC, CC, Municipality',
                'Region, Province, HUC',
                'Region Only',
                'Province, HUC, CC, Municipality, Barangay',
                'Province, HUC, CC',
                'Province, HUC',
                'Province Only',
                'HUC, CC, Municipality, Barangay',
                'HUC, CC, Municipality',
                'HUC, CC',
                'Municipality, Barangay',
                'Municipality only',
                'Barangay only',
                'CC only',
            ],
            'ppa_category' => [
                'ADAC', 'Barangay Assembly', 'BFDP', 'BIS', 'BODBA (QP1)', 'BOPS', 'C4PEACE', 'CBMS', 'CDP',
                'CMGP', 'CSBP', 'CSIS', 'ECLIP', 'ELCAC', 'ELOPDS', 'EOC', 'FALGU', 'FDP', 'Frontline Services',
                'GADPB', 'IATF', 'LGRRC', 'LSI', 'LTIA', 'NEO', 'PADS', 'PCVE', 'POC', 'POPS- PCMS', 'PRIME HRM',
                'QMS', 'RCSP', 'BarKaDa', 'SGLGB', 'SK Funds', 'SLGP', 'SBDP', 'LCPC', 'CFLGA', 'VAW Desk',
                'SAFER CITIES', 'DA-related', 'NNC-related', 'DOH-related', 'CPD-related', 'DSWD-related',
            ],
        ];
    }

    protected $fillable = [
        'item_no',
        'ppa',
        'frequency',
        'timelines',
        'focal_person',
        'section',
        'mode_of_submission',
        'monitoring_link',
        'end_user_level',
        'ppa_category',
        'legal_basis_reference',
        'reference_link',
        'remarks',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $search = trim((string) ($filters['search'] ?? ''));

        if ($search !== '') {
            $like = '%'.addcslashes($search, '%_\\').'%';
            $query->where(function (Builder $q) use ($like) {
                foreach (self::SEARCHABLE as $column) {
                    $q->orWhere($column, 'like', $like);
                }
            });
        }

        foreach (self::FILTERABLE as $column) {
            $value = $filters[$column] ?? null;
            if (filled($value)) {
                $query->where($column, $value);
            }
        }

        if (isset($filters['status']) && in_array($filters['status'], ['active', 'inactive'], true)) {
            $query->where('is_active', $filters['status'] === 'active');
        }

        return $query;
    }
}
